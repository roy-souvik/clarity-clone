<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
    'appointment_id',
    'call_id',
    'title',
    'description',
    'rating'
  ];
  protected $table;

  public function __construct()
  {
    $this->table    = 'feedback';
  }

//==============================================================================
// VALIDATION RULES
//==============================================================================
private $feedbackRules  = [
    'appointment_id' => 'required|integer',
    'call_id'        => 'required|integer',
    'title'          => 'required|string|min:3',
    'description'    => 'string|min:3',
    'rating'         => 'required|integer'
   ];

//==============================================================================
// RELATIONS OF FEEDBACK WITH OTHER MODELS
//==============================================================================

  public function appointment()
  {
    return $this->belongsTo('App\Appointment');
  }

  public function call()
  {
    return $this->belongsTo('App\Call');
  }

//==============================================================================
// METHODS / FEATURES / GETTERS & SETTERS
//==============================================================================

  public function getTitle()
  {
    return $this->title;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function getRating()
  {
    return $this->rating;
  }

  public function getFeedbackRules()
  {
    return $this->feedbackRules;
  }

  public function getCreatedAt()
  {
    return $this->created_at;
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function setDescription($description)
  {
    $this->description = $description;
  }

  public function setRating($rating)
  {
    $this->rating = $rating;
  }

}
