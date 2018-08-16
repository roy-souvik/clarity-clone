<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Tag as Tag;
use App\User as User;
use App\Page;
use App\Expertise;

class SearchController extends Controller
{
    private $user;
    private $expertises_per_page;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->expertises_per_page = Expertise::expertises_per_page;
    }

  /**
   * [Site search] Process search term and show listing
   * @Get("/search", as="siteSearch")
   * @return view
   */
  public function index(Request $request)
  {
    $q  = $request->get('q');
    $users = User::findExperts()
                ->search($q, null, true, true)
                ->groupBy('users.id')
                ->paginate($this->expertises_per_page);
    $users->setPath(route('paginateExpertUsers'));

    $expertises = Expertise::forExperts()
                ->whereIsFeatured(1)
                ->search($q, null, true, true)
                ->setOrder('highest_price')
                ->paginate($this->expertises_per_page);
    $expertises->setPath(route('search_filter'));
    return view('search.index', ['users' => $users, 'expertises' => $expertises, 'q' => $q]) ;
  }

  /**
   * [Site search] Process search term and show listing
   * @Get("/page/{slug}", as="sitePage")
   * @return view
   */
  public function getPageContent($slug)
  {
    $page = Page::whereSlug($slug)->firstOrFail();
    return view('staticpage.sitepages', compact('page'));

  }

    /**
     * @Get("/search_filter", as="search_filter")
     * @param $request
     * @return view
     */
    public function searchFilter(Request $request){
        $q = $request['q'];
        $filter_type = $request['filter_type'];
        $sort_by = $request['sort_by'];

        if($filter_type=='featured'){
            $expertises = Expertise::forExperts()
                ->whereIsFeatured(1)
                ->search($q, null, true, true)
                ->setOrder($sort_by)
                ->paginate($this->expertises_per_page);
        }

        elseif($filter_type=='top_rated' || $filter_type=='popular'){
            $expertises = Expertise::forExperts()
                ->search($q, null, true, true)
                ->byRating()
                ->setOrder($sort_by)
                ->paginate($this->expertises_per_page);
        }

        else{
            $expertises = Expertise::forExperts()
                ->search($q, null, true, true)
                ->setOrder('new')
                ->setOrder($sort_by)
                ->paginate($this->expertises_per_page);
        }

        return view('search.single_list', [
            'expertises' => $expertises,
            'q' => $q,
            'filter_type' => $filter_type,
            'sort_by' => $sort_by
        ]);
    }

//==============================================================================

  /**
   * @Get("/nextExpertUsersPage", as="paginateExpertUsers")
   * @param $request
   * @return view
   */
    public function paginateExpertUsers(Request $request){
      $q      = $request['q'];
      $users  = collect([]);
      if($request->ajax()) {
        $users  = User::findExperts()
                    ->search($q, null, true, true)
                    ->groupBy('users.id')
                    ->paginate($this->expertises_per_page);
      }
      return view('search.partials._showUserListing', [
          'users' => $users,
          'q' => $q
      ]);

    }

}
