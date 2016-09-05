<?php

/***************************************
 *
 *              FRONT
 *
 ***************************************/
Route::get('language', ['as' => 'language', 'uses' => 'Front\RootController@language']);

Route::get('register', ['as' => 'register', 'uses' => 'Front\RootController@register']);
Route::post('postRegister', ['as' => 'postRegister', 'uses' => 'Front\RootController@store']);

Route::post('authentification', array('as' => 'authentification', 'uses' => 'Front\RootController@login'));
Route::get('logout', ['as' => 'root.logout', 'uses' => 'Front\RootController@logout']);

// Password Reset Link Request Routes...
Route::get('password/email', array('as' => 'password/email', 'uses' => 'Front\RootController@getEmail'));
Route::post('password/email', array('as' => 'password/email', 'uses' => 'Front\RootController@postEmail'));

// Password Reset Routes...
Route::get('password/reset', array('as' => 'password/reset', 'uses' => 'Front\RootController@getReset'));
Route::post('password/reset', array('as' => 'password/reset', 'uses' => 'Front\RootController@postReset'));



Route::get('/', ['as' => 'home', 'uses' => 'Front\HomePageController@index']);

















/***************************************
 *
 *              BACK
 *
 ***************************************/
Route::get('/administration', ['as' => 'bo', 'uses' => 'Admin\AdminPageController@index']);


Route::post('search', ['as' => 'actu.search', 'uses' => 'Admin\ActuController@search']);


Route::resource('gestionLanguage', 'Admin\GestionLanguageController');
Route::put('majfiles/{id}', ['as' => 'gestionLanguage.majfiles', 'uses' => 'Admin\GestionLanguageController@majfiles']);


Route::resource('notifications', 'Admin\NotificationController');
Route::post('delete_notifications', ['as' => 'notifications.deleteAll', 'uses' => 'Admin\NotificationController@deleteAll']);


Route::resource('newsletters', 'Admin\NewslettersController');
Route::post('newsletterssearch', ['as' => 'newsletters.search', 'uses' => 'Admin\NewslettersController@search']);


Route::resource('mails', 'Admin\MailsController');
Route::post('mailssearch', ['as' => 'mails.search', 'uses' => 'Admin\MailsController@search']);
Route::post('mails/{mails}', ['as' => 'mails.actif', 'uses' => 'Admin\MailsController@actif']);


Route::resource('mailsHistorique', 'Admin\MailsHistoriqueController');
Route::post('delete_historiqueMails', ['as' => 'mailsHistorique.deleteAll', 'uses' => 'Admin\MailsHistoriqueController@deleteAll']);


Route::get('envoieMails', ['as' => 'envoieMails.index', 'uses' => 'Admin\EnvoieMailsController@index']);
Route::post('envoieMailsSend/{users}', ['as' => 'envoieMails.send', 'uses' => 'Admin\EnvoieMailsController@send']);
Route::post('envoieMailsAll', ['as' => 'envoieMails.all', 'uses' => 'Admin\EnvoieMailsController@all']);
Route::post('envoieMailsPers', ['as' => 'envoieMails.pers', 'uses' => 'Admin\EnvoieMailsController@pers']);


Route::resource('users', 'Admin\UsersController');
Route::post('userssearch', ['as' => 'users.search', 'uses' => 'Admin\UsersController@search']);
Route::post('users/{users}', ['as' => 'users.actif', 'uses' => 'Admin\UsersController@actif']);
Route::put('gestion_password/{users}', ['as' => 'utilisateur.gestion_password', 'uses' => 'Admin\UsersController@gestion_password']);


Route::resource('langues', 'Admin\LanguesController');
Route::post('languessearch', ['as' => 'langues.search', 'uses' => 'Admin\LanguesController@search']);


Route::resource('crons', 'Admin\CronsController');

// Clears cache
Route::get('clearsCache', ['as' => 'clearsCache.reset', 'uses' => 'Admin\ClearsCacheController@reset']);

// Paramètres
Route::resource('params', 'Admin\ParamsController');
Route::post('paramssearch', ['as' => 'params.search', 'uses' => 'Admin\ParamsController@search']);




//AUTHENTICATION
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
