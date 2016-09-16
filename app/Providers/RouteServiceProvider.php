<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);


        /***************************************
         *
         *  DATABIDING, permet d'utiliser les
         *  objets à tous moment grâce au DATABIDING
         *              ex : user
         *
         ***************************************/
        $router->model('users', 'App\Users', function(){
            App::abort(500);
        });

        $router->model('roles_users', 'App\Roles_users', function(){
            App::abort(500);
        });

        $router->model('langues', 'App\Langues', function(){
            App::abort(500);
        });

        $router->model('pays', 'App\Pays', function(){
            App::abort(500);
        });

        $router->model('ville', 'App\Villes', function(){
            App::abort(500);
        });

        $router->model('actu', 'App\Actu', function(){
            App::abort(500);
        });

        $router->model('newsletters', 'App\Newsletters', function(){
            App::abort(500);
        });

        $router->model('mails', 'App\Mails', function(){
            App::abort(500);
        });

        $router->model('mailsHistorique', 'App\MailsHistorique', function(){
            App::abort(500);
        });

        $router->model('params', 'App\Params', function(){
            App::abort(500);
        });

        $router->model('actu', 'App\Actu', function(){
            App::abort(500);
        });







    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
