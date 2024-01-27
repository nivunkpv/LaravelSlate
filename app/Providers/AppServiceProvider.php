<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\System\Menu\MenuSystem;
use App\System\Menu\MenuItem;

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
        $this->app->singleton(MenuSystem::class, function ($app) {
            $system = new MenuSystem();
            (function(MenuItem $menu){
                include base_path("menu.php");
            })($system->menu("main-menu"));
            return $system;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
