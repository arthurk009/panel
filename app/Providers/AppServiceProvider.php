<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
use App\Repositories\MenuRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer("layouts.menu",function($view){
            $menus = MenuRepository::getMenu(true);
            $view->with('menusComposer',$menus);
        });
    }
}
