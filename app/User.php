<?php

namespace App;

use App\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bican\Roles\Models\Role;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Simexis\Searchable\SearchableTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, HasRoleAndPermissionContract
{
    use Authenticatable, CanResetPassword, HasRoleAndPermission; // , SoftDeletes
    use SearchableTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'is_social',
        'fb_name', 'fb_id', 'fb_image', 'li_name', 'li_id', 'li_image',
        'tw_name', 'tw_id', 'tw_image', 'short_bio', 'mini_resume',
        'phone', 'timezone', 'location', 'expert_applied', 'video_link',
        'hourly_rate', 'charity_id', 'username', 'confirmation_code',
        'confirmed', 'address_line1', 'address_line2', 'city', 'state',
        'zip_code', 'country', 'card_number', 'cvv', 'expire_month',
        'expire_year', 'call_requests', 'call_reminder', 'mc_updates',
        'call_management', 'mc_questions'
    ];

    /**
     * Searchable rules.
     */
    protected $searchable = [
        'columns' => [
          'users.first_name'        => 5,
          'users.last_name'         => 5,
          'users.short_bio'         => 2,
          'users.mini_resume'       => 2,
          'tags.name'               => 10,
          'expertises.title'        => 2
        ],
        'joins' => [
          'expertise_tag' => ['expertises.id', 'expertise_tag.expertise_id'],
          'tags'          => ['tags.id', 'expertise_tag.tag_id']
        ]
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//==============================================================================
// VALIDATION RULES
//==============================================================================
  public $profilePicRule   = [
    'profile_picture' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
  ];

  public $billingInfoRules = [
      'address_line1' => 'required',
      'city'          => 'required',
      'state'         => 'required',
      'zip_code'      => 'required|numeric',
      'country'       => 'required'
  ];

  public $creditCardInfoRules  = [
    'card_number'  => 'required|digits:16',
    'cvv'          => 'required|digits:3',
    'expire_month' => 'required|numeric',
    'expire_year'  => 'required|digits:4'
  ];

  public $notificationsRules  = [
    'call_requests'   => 'required',
    'call_reminder'   => 'required',
    'mc_updates'      => 'required',
    'call_management' => 'required',
    'mc_questions'    => 'required'
  ];

  public $updatePasswordRules  = [
    //'new_password' => 'required|confirmed|different:old_password',
    'new_password' => 'required|confirmed|min:6|max:20',
  ];

  public $requestAppointmentRules  = [
    'message'     => 'required|string|min:30',
    'call_length' => 'required|integer',
    'date1'       => 'required|date',
    'date2'       => 'required|date',
    'date3'       => 'required|date'
    ];

//==============================================================================
// RELATIONS OF USER WITH OTHER MODELS
//==============================================================================

	public function roles()
    {
      return $this->belongsToMany('App\UserRole' , 'role_user',  'user_id', 'role_id' )
      ->withPivot('created_at', 'updated_at');
    }

    // Get the tags associated with the user
    public function tags()
    {
      return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    // Get the questions associated with the user
    public function questions()
    {
      return $this->hasMany('App\Question');
    }

    public function answers()
    {
      return $this->hasMany('App\Answer');
    }

    public function expertise()
    {
      return $this->hasMany('App\Expertise');
    }

    // Get the appointments associated with the user
    public function appointments()
    {
      return $this->belongsToMany('App\Appointment')->withTimestamps();
    }

    // Get the charities associated with the user
    public function charity()
    {
      return $this->belongsTo('App\Charity');
    }

    //Get the feedbacks associated with the user
    public function feedbacks()
    {
      return $this->hasMany('App\Feedback')->withTimestamps();
    }

    //Get albums associated with the user
    public function albums()
    {
      return $this->hasMany('App\Album')->withTimestamps();
    }

    
//==============================================================================
// QUERY SCOPES
//==============================================================================

  public function scopeFindExperts($query)
  {
    return $query->select(['users.*'])
        ->join('role_user', 'role_user.user_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->join('expertises', 'expertises.user_id', '=', 'users.id')
        ->where('roles.slug', '=', 'expert');
  }


//==============================================================================
// METHODS / FEATURES
//==============================================================================
    /**
     * [returns all the approved Tags of the current user]
     * @return [Array] [An array where key is name and value is a string]
     */
    public function getVisibleTags()
    {
      return $this->tags()->whereVisibility(1)->lists('name', 'name')->toArray();
    }

    public function getFirstName()
    {
      return $this->first_name;
    }

    public function getFullName()
    {
      return $this->first_name . ' ' . $this->last_name;
    }

    public function getShortBio()
    {
      return $this->short_bio;
    }

    public function getMiniResume()
    {
      return $this->mini_resume;
    }

    public function getEmail()
    {
      return $this->email;
    }

    public function getProfilePicture($getFullPath = false, $imageSize = 'normal')
    {
      if ($getFullPath) {
        return url( '/uploads/profile-pictures/' . $imageSize . '/' . $this->profile_picture );
      }
      return $this->profile_picture;
    }

    public function getHourlyRateInMins()
    {
      return bcdiv($this->hourly_rate, 60, 2);
    }

    public function getUpdatedAtTime()
    {
      return $this->updated_at;
    }

    public function getLoction()
    {
      return $this->location;
    }

    public function getCreatedAt()
    {
      return $this->created_at;
    }

    public function hasCharity()
    {
      return ($this->charity === null) ? false : true;
    }

    public function hasExpertise()
    {
      return ($this->expertise === null) ? false : true;
    }

    /**
     * Get a collection of feedbacks recieved by all expertise of the user
     * @return [Collection] [feedback]
     */
    public function getExpertiseFeedback()
    {
      $grabFeedbacks  = [];
      if ($this->hasExpertise()) {
        foreach ($this->expertise as $expertise) {
          if ($expertise->hasFeedback()) {
            foreach ($expertise->feedback as $feedback) {
              $grabFeedbacks[]  = $feedback;
            }
          }
        }
      }
      return collect($grabFeedbacks);
    }

    /**
     * [get Average Rating of all the feedbacks recieved by $this user]
     * @return [int] [average rating]
     */
    public function getAverageRating()
    {
      $ratings  = [];
      if ($this->hasExpertise()) {
        foreach ($this->expertise as $expertise) {
          if ($expertise->hasFeedback()) {
            $ratings[]  = $expertise->getAverageRating();
          }
        }
      }
      return intval(collect($ratings)->avg());
    }

  // NOTIFICATIONS BEHAVIOUR OF USER [start]

    public function hasAcceptedCallRequestEmail()
    {
      return ($this->call_requests == 1) ? true : false;
    }

    public function hasAcceptedCallReminderEmail()
    {
      return ($this->call_reminder == 1) ? true : false;
    }

    public function hasAcceptedUpdatesEmail()
    {
      return ($this->mc_updates == 1) ? true : false;
    }

    public function hasAcceptedCallManagementEmail()
    {
      return ($this->call_management == 1) ? true : false;
    }

    public function hasAcceptedNewQuestionsEmail()
    {
      return ($this->mc_updates == 1) ? true : false;
    }

  // NOTIFICATIONS BEHAVIOUR OF USER [end]

    /**
     * switch user from one role to other
     * @param $current_role
     * @param $new_role
     * @return bool
     * TODO: attachRole returning null
     */
    public function switchUserRole($current_role, $new_role)
    {
      if($this->detachRole($current_role) ){
        $this->attachRole($new_role);
        return true;
      }
      return false;
    }

    /**
     * getAllAdmins: This function returns all the users who are admins
     * @return User who admins
     */
    public static function getAllAdmins(){
        return User::select('users.*')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('roles.slug', 'admin')
            ->where('roles.level', 1)
            ->get();
    }
}
