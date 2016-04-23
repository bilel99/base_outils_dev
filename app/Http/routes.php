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
Route::put('delete-notifications', ['as' => 'notifications.deleteAll', 'uses' => 'Admin\NotificationController@deleteAll']);

Route::post('userssearch', ['as' => 'users.search', 'uses' => 'Admin\UsersController@search']);
Route::post('users/{users}', ['as' => 'users.actif', 'uses' => 'Admin\UsersController@actif']);
Route::resource('users', 'Admin\UsersController');

Route::resource('langues', 'Admin\LanguesController');







//AUTHENTICATION
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
