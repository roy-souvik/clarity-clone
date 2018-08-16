<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
  protected $fillable = [
    'requester_id',
    'expert_id',
    'message',
    'requested_call_length',
    'actual_call_length',
    'time_preference_1',
    'time_preference_2',
    'time_preference_3',
    'is_confirmed',
    'is_executed',
    'selected_slot'
  ];

  public function user()
  {
    return $this->belongsTo('App\User', 'requester_id');
  }

  public function expert()
  {
    return $this->belongsTo('App\User', 'expert_id');
  }

  public function feedback()
  {
    return $this->belongsTo('App\Feedback');
  }

  public function expertise()
  {
    return $this->belongsTo('App\Expertise');
  }

  public function getCallLength()
  {
    $slug = 'minutes';

    if (($this->requested_call_length >= 1 &&  $this->requested_call_length <= 9)) {
      
      $slug = ($this->requested_call_length == 1)  ? 'hour' : str_plural ('hour');
    }

    return $this->requested_call_length . ' ' . $slug;
  }


  public function getMessage()
  {
    return $this->message;
  }

  public function isConfirmed()
  {
    return $this->is_confirmed == 1 ? true : false;
  }

  public function isExecuted()
  {
    return $this->is_executed == 1 ? true : false;
  }

  public function getSelectedSlotsTime()
  {
    $selected_slot  = intval($this->selected_slot);
      if ( $selected_slot  === 1 ) {
        return $this->time_preference_1;
      }
      else if ( $selected_slot  === 2 ) {
        return $this->time_preference_2;
      }
      else if ( $selected_slot  === 3 ) {
        return $this->time_preference_3;
      }
      else {
        return null;
      }
  } 

//==============================================================================
// QUERY SCOPES
//==============================================================================

  /**
     * Scope a query to only include confirmed appointments.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeConfirmed($query)
    {
        return $query->where('is_confirmed', 1);
    }


}
