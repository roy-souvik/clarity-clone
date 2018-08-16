<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Tag;
Use DB;
use App\Appointment;
use Simexis\Searchable\SearchableTrait;
use App\UserRole;
use Bican\Roles\Models\Role;

class Expertise extends Model
{
    use SearchableTrait;
    /**
     * Searchable rules.
     */
    protected $searchable = [
        'columns' => [
            'expertises.title'        => 10,
            'tags.name'               => 6,
            'expertises.description'  => 6
        ],
        'joins' => [
            'expertise_tag' => ['expertises.id', 'expertise_tag.expertise_id'],
            'tags'          => ['tags.id', 'expertise_tag.tag_id'],

        ]
    ];

    /**
     * Expertises per page
     */
    const expertises_per_page = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'category_id',
        'description',
        'cover_image',
        'slug'
    ];


	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function appointments()
    {
        return $this->hasMany('App\Appointment');
    }

    public function confirmedAppointments()
    {
       return ($this->appointments->is_confirmed == 1) ? true : false;
       
    }

    /**
     * Scope a query to only include expertises of expert users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForExperts($query)
    {
        return $query->select(['expertises.*'])
            ->join('role_user', 'role_user.user_id', '=', 'expertises.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->join('users', 'users.id', '=', 'expertises.user_id')
            ->where('roles.slug', '=', 'expert');
    }

    /**
     * Scope a query to only include expertises of selected categories.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCategories($query, $categories)
    {
        return $query->join('categories', 'categories.id', '=', 'expertises.category_id')
            ->whereIn('categories.id', $categories);
    }

    /**
     * Scope a query to only include expertises those are featured.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByFeatured($query)
    {
        return $query->where('expertises.is_featured', '=', 1);
    }

    /**
     * Scope a query to order by rating.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByRating($query)
    {
        return $query->leftJoin('appointments', 'appointments.expertise_id', '=', 'expertises.id')
            ->leftJoin('feedback', 'appointments.id', '=', 'feedback.appointment_id')
            ->select(array('expertises.*',
                DB::raw('AVG(feedback.rating) as ratings_average')
            ))
            ->groupBy('appointments.expertise_id')
            ->orderBy('ratings_average', 'DESC');
    }

    /**
     * Scope a query to order by for expertises.
     * TODO: else should be order by star rating desc
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSetOrder($query, $order_by)
    {
        if($order_by == 'lowest_price')
            return $query->orderBy('users.hourly_rate', 'ASC');
        elseif($order_by == 'highest_price')
            return $query->orderBy('users.hourly_rate', 'DESC');
        else
            return $query->orderBy('expertises.created_at', 'DESC');
    }

    /**
     * @param null $categories
     * @param string $order_by
     * @return mixed
     */
    public static function findExpertisesByCategory($categories = array(), $order_by = ''){
        $expertises = Expertise::forExperts()
            ->byCategories($categories)
            ->setOrder('new')
            ->setOrder($order_by);
        return $expertises;
    }

    /**
     * @param null $categories
     * @param string $order_by
     * @return mixed
     */
    public static function findExpertisesByCategoryRating($categories = array(), $order_by = ''){
        $expertises = Expertise::forExperts()
            ->byCategories($categories)
            ->byRating()
            ->setOrder($order_by);
        return $expertises;
    }

    /**
     * @param null $categories
     * @param string $order_by
     * @return mixed
     */
    public static function findExpertisesByCategoryFeatured($categories = array(), $order_by = ''){
        $expertises = Expertise::forExperts()
            ->byCategories($categories)
            ->byFeatured()
            ->setOrder($order_by);
        return $expertises;
    }

    public function feedback(){
      return $this->hasManyThrough('App\Feedback', 'App\Appointment');
    }

    public function hasFeedback()
    {
      return ($this->feedback->count() === 0) ? false : true;
    }

  /**
   * [get Average Rating of all the feedbacks recieved by $this expertise]
   * @return [int] [average rating]
   */
  public function getAverageRating()
  {
    return intval($this->feedback->avg('rating'));
  }
}
