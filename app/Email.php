<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
    'subject',
    'content'
   ];
   
   protected $table;

  public function __construct()
  {
    $this->table    = 'emails';
  }

//==============================================================================
// VALIDATION RULES
//==============================================================================

private $validationRules  = [
    'subject'        => 'required|string',
    'content'        => 'required|string'
   ];

//==============================================================================
// METHODS / FEATURES / GETTERS & SETTERS
//==============================================================================

  public function setSubject($subject)
  {
    $this->subject = $subject;
  }

  public function setContent($content)
  {
    $this->content = $content;
  }

  public function getSubject()
  {
    return $this->subject;
  }

  public function getContents()
  {
    return $this->content;
  }

  public function getValidationRules()
  {
    return $this->validationRules;
  }

  public function getEmailSubjects()
  {
    return $this->lists('subject','id');
  }

//==============================================================================
// STATIC METHODS 
//==============================================================================

  public static function getUserVerifyEmail()
  {
    return Email::findOrFail(1);
  }

  public static function getUserVerifiedEmail()
  {
    return Email::findOrFail(2);
  }

  public static function getPasswordResetEmail()
  {
    return Email::findOrFail(3);
  }

  public static function getExpertAppliedEmail()
  {
    return Email::findOrFail(4);
  }

  public static function getExpertApprovedEmail()
  {
    return Email::findOrFail(5);
  }

  public static function getAppointmentRequestEmail()
  {
    return Email::findOrFail(6);
  }

  public static function getAppointmentReplyEmail()
  {
    return Email::findOrFail(7);
  }

    public static function getNewQuestionEmail()
    {
        return Email::findOrFail(8);
    }
    public static function getNewAnswerEmail()
    {
        return Email::findOrFail(9);
    }

}
