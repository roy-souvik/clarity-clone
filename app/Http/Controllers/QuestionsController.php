<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Tag;
use App\Email;
use Mail;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class QuestionsController extends Controller{
    private $user;
    private $validation_rules;
    private $validation_message;

    public function __construct()
    {
        $this->user = Auth::user();

        $this->validation_rules = [
            'question' => 'required|max:150',
            'tags' => 'required',
        ];
        $this->validation_message = [
            'tags.required' => 'Please choose at least one topic.'
        ];
    }

    public function showNewQuestionForm() {
        return view('questions.addquestion');
    }

    public function addNewQuestion(Request $request)    {

        $user = $this->user;

        $this->validate($request, $this->validation_rules, $this->validation_message);

        $data = array();
        $data['user_id'] = $user->id;
        $data['question'] = $request['question'];
        $data['details'] = $request['details'];
        $data['is_anonymous'] = $request['is_anonymous'];

        $newQuestion = $this->createQuestion($data);

        $newQuestion->tags()->detach();

        $tagsFromUI  = $request->get('tags');
        $tags      = Tag::whereIn('id', $tagsFromUI)->get();
        $newQuestion->tags()->attach($tags);

        $expert_users = new Collection();
        foreach($tags as $tag){
            $expertises = $tag->expertises;
            foreach($expertises as $expertise){
                $expert_users->push($expertise->user);
            }
        }

        $expert_users = $expert_users->unique();

        $this->notifyUsers($expert_users, $newQuestion);
        return redirect()->route('show_question_details', ['question_id'=>$newQuestion['id']]);

    }

    /**
     * Create a new question
     *
     * @param  array  $data
     * @return Question
     */
    protected function createQuestion(array $data)
    {
        return Question::create([
            'user_id'       => $data['user_id'],
            'question'      => $data['question'],
            'details'       => $data['details'],
            'is_anonymous'  => $data['is_anonymous'],
            'slug'          => str_slug($data['question'], '-')
        ]);
    }

    /**
     * Show all questions
     *
     * @param Request $request
     * @return mixed
     *
     */
    public function showAllQuestions(Request $request)
    {
        $q = $request->get('q');
        $user               = $this->user;
        $open_questions        = array();
        $open_questions_count  = count($open_questions);
        $questions_per_page = Question::QUESTIONS_PER_PAGE;

        $all_answered_questions_with_answers = Question::where('is_answered', 1)->get();
        $popular_questions = $all_answered_questions_with_answers->sortByDesc(function ($question, $key) {
            return $question->answers->count();
        })->slice(0, 3);

        $top_3_popular_questions = collectionToPaginate($popular_questions, 1, 3);

        $answered_questions = Question::where('is_answered', 1)
                        ->orderBy('updated_at', 'desc')
                        ->paginate($questions_per_page);

        $answered_questions->setPath(route('load_more_questions'));

        if($user && $user->is('expert')){
            $disabled_questions = Question::disabledQuestionsForUser($user)->lists('question_id');

            $open_questions_count = Question::searchQuestions('', 0, $disabled_questions)->count();
            $open_questions = Question::searchQuestions('', 0, $disabled_questions)
                        ->paginate($questions_per_page);

            $open_questions->setPath(route('load_more_questions'));
        }

        return view('questions.allquestions', [
            'answered_questions' => $answered_questions,
            'open_questions' => $open_questions,
            'open_questions_count' => $open_questions_count,
            'popular_questions' => $top_3_popular_questions,
            'q' => $q
        ]);
    }

    /**
     * Show single question details
     *
     * @param null
     * @return mixed
     *
     */
    public function showQuestionDetails($question_id)
    {
        $question = Question::findOrFail($question_id);
        $related_questions = Question::relatedQuestionsByTags($question);
        $paginate_related_questions = collectionToPaginate($related_questions, 1, 3);
        return view('questions.single',['question' => $question, 'related_questions' => $paginate_related_questions]);
    }

    /**
     * AJAX based load more question
     * @Get("questions/load-more/", as="load_more_questions")
     * @param $request
     * @return mixed
     */
    public function loadMoreQuestions(Request $request){
        $type = $request->get('type');
        $q = $request->get('q');
        if($type == 'open'){
            $paginate =  $this->loadMoreViewMaker(0, 'questions.loadmore_open_question', $q);
        }
        else{
            $paginate =  $this->loadMoreViewMaker(1, 'questions.loadmore_answered_question', $q);
        }

        return $paginate;

    }

    /**
     * AJAX based dismiss question
     * @Get("questions/skip/{question_id}", as="dismiss_question")
     * @Middleware("auth")
     * @Middleware("role:expert")
     * @param $question_id
     * @param $request
     * @return mixed
     */
    public function dismissQuestion(Request $request, $question_id){
        if($request->ajax()) {
            $user = $this->user;
            $question = Question::findOrFail($question_id);

            $result = Question::dismissQuestionForUser($question, $user);
            if($result){
                $disabled_questions = Question::disabledQuestionsForUser($user)->lists('question_id');

                $open_questions = Question::searchQuestions('', 0, $disabled_questions);
                echo $open_questions->count();
            }
            else{
                echo 'ERROR';
            }
        }
    }

    protected function notifyUsers($users, $question){
        $mail_body = Email::getNewQuestionEmail();
        foreach ($users as $user){
            if($user->hasAcceptedNewQuestionsEmail()) {
                Mail::send('questions.emails.notifyuser', ['user' => $user, 'question' => $question, 'mail_body' => $mail_body], function ($message) use ($user, $mail_body) {
                    $message->to($user->email, $user->first_name)->subject($mail_body->getSubject());
                });
            } 
        }
    }


    /**
     * [Site search] Process search term and show answered questions listing
     * @Get("/search/questions", as="searchQuestions")
     * @return view
     */
    public function searchAnsweredQuestions(Request $request)
    {
        if($request->ajax()) {
            $user = $this->user;
            $q = $request->get('q');
            $questions_per_page = Question::QUESTIONS_PER_PAGE;
            $disabled_questions = array();
            $is_answered = 1;
            $fragment = 'questions.loadmore_answered_question';
            $type = $request->get('type');

            if ($type == 'open') {
                $is_answered = 0;
                $disabled_questions = Question::disabledQuestionsForUser($user)->lists('question_id');
                $fragment = 'questions.loadmore_open_question';
            }

            $questions = Question::searchQuestions($q, $is_answered, $disabled_questions)->paginate($questions_per_page);

            $view = view($fragment, ['questions' => $questions, 'q' => $q])->render();

            echo $view;
        }
    }


    /**
     * @param $is_answered
     * @param $fragment
     * @param $q : query key
     * @return view
     */
    protected function loadMoreViewMaker($is_answered, $fragment, $q = ''){
        $questions_per_page = Question::QUESTIONS_PER_PAGE;
        $user = $this->user;
        $disabled_questions = array();

        if($is_answered == 0){
            $disabled_questions = Question::disabledQuestionsForUser($user)->lists('question_id');
        }

        $questions =  Question::searchQuestions('', $is_answered, $disabled_questions)
            ->paginate($questions_per_page);
        $questions->setPath(route('load_more_questions'));

        return view($fragment, ['questions' => $questions, 'q' => $q])->render();
    }

}
