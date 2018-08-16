<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use Mail;
use App\Email;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AnswerController extends Controller{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * AnswerController::showAnswerForm()
     * @Middleware("role:expert")
     * @Get("question/answer/{question_id}", as="show_answer_form")
     * @param mixed $question_id
     * @return mixed
     */
    public function showAnswerForm($question_id){

        try
        {
            $question = Question::findOrFail($question_id);
        }
        catch(ModelNotFoundException $e)
        {
            return redirect()->action('QuestionsController@showAllQuestions');
        }

        return view('questions.submit_answer',[
            'question' => $question,
        ]);
            
    }
    
    /**
     * AnswerController::submitAnswer()
     * @Middleware("role:expert")
     * @Post("question/answer/{question_id}", as="submit_answer")
     * @param mixed $question_id
     * @param mixed $request
     * @return mixed
     */
    public function submitAnswer($question_id, Request $request){

        try
        {
            $question = Question::findOrFail($question_id);
        }
        catch(ModelNotFoundException $e)
        {
            return redirect()->action('QuestionsController@showAllQuestions');
        }

        $user = $this->user;

        $this->validate($request, [
            'answer' => 'required'
        ]);

        $data = array();

        $data['user_id'] = $user->id;
        $data['question_id'] = $question_id;
        $data['answer'] = $request['answer'];

        $answer = $this->saveAnswer($data);

        $question->is_answered = 1;
        $question->save();

        $this->notifyQuestionOwner($question, $answer);

        return redirect()->route('show_question_details', ['question_id'=>$question_id]);

    }
    
    /**
     * AnswerController::saveAnswer()
     * 
     * @param mixed $data
     * @return Answer
     */
    protected function saveAnswer(array $data)
    {
        return Answer::create([
            'user_id' => $data['user_id'],
            'question_id' => $data['question_id'],
            'answer' => $data['answer']
        ]);
    }

    protected function notifyQuestionOwner($question, $answer){
        $owner = $question->user;
        $mail_body = Email::getNewAnswerEmail();
        Mail::send('questions.emails.notifyowner', ['owner' => $owner, 'question' => $question, 'answer' => $answer, 'mail_body' => $mail_body], function ($message) use ($owner, $mail_body) {
            $message->to($owner->email, $owner->first_name)->subject($mail_body->getSubject());
        });
    }
}