<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  protected $fillable = [
    'title',
    'content'
   ];

   private $title, $content;
   protected $table;

  public function __construct()
  {
    $this->table    = 'pages';
  }

//==============================================================================
// VALIDATION RULES
//==============================================================================

private $validationRules  = [
    'title'          => 'required|string',
    'content'        => 'required|string'
   ];

//==============================================================================
// METHODS / FEATURES / GETTERS & SETTERS
//==============================================================================

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function setContent($content)
  {
    $this->content = $content;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function getContent()
  {
    return $this->content;
  }

  public function getValidationRules()
  {
    return $this->validationRules;
  }

  public function getPageTitles()
  {
    return $this->lists('title','id');
  }
}
