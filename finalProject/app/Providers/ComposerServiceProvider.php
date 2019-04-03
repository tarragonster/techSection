<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('inc.sidebar', function($view){
            $sidebars = DB::table('searches')->select('list')->distinct()->get();
            $view->with('sidebars', $sidebars);
        });
    }
    public function register()
    {

    }

}
