<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Function appeler à chaque fois
        view()->composer('admin.layout.header', function($view){
            $notifications = \App\NotificationHistory::with('users')->where('status', '=', 1)->orderBy('id', 'desc')->get();
            $view->with('notifications', $notifications);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
