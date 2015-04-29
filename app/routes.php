<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('create_user', function(){
    $user = Sentry::getUserProvider()->create(
        array(
            'email' => 'vohoanglong07@gmail.com',
            'password' => '2871989',
            'username' => 'jackie',
            'first_name' => 'Jackie',
            'last_name' => 'Wu',
            'activated' => '1',
            'permissions' => array(
                'admin' => 1
            )
    ));

    return 'Done';
});

Route::get('/', array('as' => 'index', 'uses' => 'MainController@index'));

Route::any('member/login', array('as' => 'login_post', 'before' => 'is_login', 'uses' => 'AuthController@postLogin'));

Route::get('member/register', array('as' => 'register_get', 'before' => 'is_login' ,'uses' => 'AuthController@getRegister'));

Route::get('member/logout', array('as' => 'logout_get', 'before' => 'check_user', 'uses' => 'AuthController@getLogout'));

Route::post('member/register', array('as' => 'register_post', 'before' => 'csrf|is_login', 'uses' => 'AuthController@postRegister'));
