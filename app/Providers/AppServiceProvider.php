<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use Cache;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
			view()->composer('includes.bottom_header', function($view) {
				$this->setupCategoriesForMenuBar($view);
			});
			view()->composer('layouts.inner', function($view) {
				$this->setupCategoriesForMenuBar($view);
			});
			view()->composer('auth.register', function($view) {
				$this->setupCategoriesForMenuBar($view);
			});
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		require_once __DIR__ . '/../Http/helpers.php';
    }

		/**
		* Setup the categories for menu bar
		*/
		private function setupCategoriesForMenuBar($view) {

      if ( $this->rehydrationNeeded() === false )
      {
        $cachedChildren = Cache::get('categories');

      } else {

        $children = [];
        $root = Category::where('name', 'root')->get()->first();

        if($root) {
          $children = Category::find($root->id)->childrenRecursive()->get();
        }

        Cache::put('categories', $children, getCacheStoringTime());

        $cachedChildren = Cache::get('categories');

      } //END ELSE

			$view->with('categories', $cachedChildren);
		}

  private function rehydrationNeeded()
  {
    if ( Cache::has('categories') )
    {
      return false;
    }

    return true;
  }

}
