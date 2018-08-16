<?php

namespace App;

use App\Task;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Simexis\Searchable\SearchableTrait;

class Question extends Model
{
    use SearchableTrait;
    /**
     * Questions per page
     */
    const QUESTIONS_PER_PAGE = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'question',
        'details',
        'is_anonymous',
        'slug'
    ];

    /**
     * Searchable rules.
     */
    protected $searchable = [
        'columns' => [
          'question'   => 10,
          'details'    => 10,
          'tags.name'  => 8,
        ],
        'joins' => [
          'question_tag'  => ['questions.id', 'question_tag.question_id'],
          'tags'          => ['tags.id', 'question_tag.tag_id']
        ]
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    /**
     * dismissQuestionForUser: This function dismiss a open question for an expert
     * @param Question $question
     * @param User $expert
     * @return mixed
     */
    public static function dismissQuestionForUser(Question $question, User $expert)
    {
        return DB::table('disabled_questions')->insert([
            'question_id' => $question->id,
            'user_id' => $expert->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    /**
     * searchQuestions: This function returns matching questions for keyword
     * @param $q
     * @param $is_answered
     * @param $disabled_questions
     * @return mixed
     */
    public static function searchQuestions($q = '', $is_answered = 0, $disabled_questions = array())
    {
        return Question::where('is_answered', $is_answered)
            ->search($q, null, true, true)
            ->whereNotIn('id', $disabled_questions)
            ->orderBy('updated_at', 'desc');
    }

    /**
     * disabledQuestionsForUser: This function returns dismissed question list for user
     * @param User $user
     * @return mixed
     */
    public static function disabledQuestionsForUser(User $user){
        return DB::table('disabled_questions')
            ->select('question_id')
            ->where('user_id', $user->id);
    }


    /**
     * relatedQuestionsByTags: This function takes a question and returns related random questions based on tags
     * @param Question $question
     * @param $numbers
     * @return Question Collection
     *
     */
    public static function relatedQuestionsByTags(Question $question, $numbers = 3)
    {
        $tag_ids = $question->tags->lists('id')->toArray();

        return Question::whereIsAnswered(1)
            ->select('questions.*')
            ->join('question_tag', 'question_tag.question_id', '=', 'questions.id')
            ->join('tags', 'question_tag.tag_id', '=', 'tags.id')
            ->whereIn('tags.id', $tag_ids)
            ->where('questions.id', '<>', $question->id)
            ->groupBy('questions.id')
            ->get()
            ->shuffle()
            ->slice(0, $numbers);
    }
}
