<?php
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
/**
 * function for time ago
 * @param $created_at
 * @return string
 */
function timeAgo($created_at){
    $time_ago = strtotime($created_at);
    $cur_time 	= time();
    $time_elapsed 	= $cur_time - $time_ago;
    $seconds 	= $time_elapsed ;
    $minutes 	= round($time_elapsed / 60 );
    $hours 		= round($time_elapsed / 3600);
    $days 		= round($time_elapsed / 86400 );
    $weeks 		= round($time_elapsed / 604800);
    $months 	= round($time_elapsed / 2600640 );
    $years 		= round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "$seconds seconds ago";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hours ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}

/**
 * @param $tags_ary
 * @return string
 */
function tags_stringify($tags_ary){
    return implode(', ', array_map(
        function($el){
            return ucwords($el['name']);
        }, $tags_ary
    ));
}

/**
 * @param $number
 * @param $word
 * @return string
 */
function check_plural($number, $word){
    if($number>1){
        return $number . ' ' . $word . 's';
    }
    else{
        return $number . ' ' . $word;
    }
}

/**
 * Set active class for menu
 */
 function setActive($path, $active = 'active')
 {
    return Request::path() == $path ? $active : '';
 }

 function flushCache($key)
 {
   if (Cache::has($key)) {
     Cache::forget($key);
   }
 }

/**
 * returns time in mins for storing categories in CACHE
 */
function getCacheStoringTime()
{
  return \Config::get('monster_call.cacheStoringTime');
}

/**
 * @param $string
 * @param int $length
 * @return mixed|string
 */
function wordlimit($string, $length = 25 )
{
    $string = preg_replace(" (\[.*?\])",'',$string);
    $string = strip_tags($string);
    $string = trim(preg_replace( '/\s+/', ' ', $string));
    $ellipsis = "...";
    $words = explode(' ', $string);
    if (count($words) > $length)
        return implode(' ', array_slice($words, 0, $length)) . $ellipsis;
    else
        return $string . $ellipsis;
}

function strLimit($str, $limit = 100, $end = '...')
{
  $actualLimit  = strlen($str);
  if (!isset($limit)) {
    $limit  = $actualLimit;
  }
  $end  = ($limit == $actualLimit) ? '' : $end;
  return str_limit($str, $limit, $end);
}

/**
 * collectionToPaginate: This function create paginate from model collections
 * @param Collection $collection
 * @param Integer $page
 * @param Integer $perPage
 * @param URL $path
 * @param array $query, Ex: array('type' => 'xyz', 'action' => 'pqr')
 * @return LengthAwarePaginator
 */
function collectionToPaginate(Collection $collection, $page, $perPage, $path = '', $query = array() ){

    $offset = $perPage * ($page - 1);

    return new LengthAwarePaginator(
        $collection->slice($offset, $perPage), // Only grab the items we need
        count($collection), // Total items
        intval($perPage), // Items per page
        intval($page), // Current page
        ['path' => $path, 'query' => $query] // We need this so we can keep all old query parameters from the url
    );
}

function displayStarRatings($starsRecieved, $outOf = 5)
{
  $output = '';
  for ($i = 1; $i <= $starsRecieved; $i++) {
    $output.=  '<i class="fa fa-star green" aria-hidden="true"></i>';
  }

  for ($i=1; $i <= ($outOf - $starsRecieved) ; $i++) {
    $output.= '<i class="fa fa-star" aria-hidden="true"></i>';
  }
  return $output;
}
