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

Route::get('member/changepassword', array('as' => 'changepass_get', 'before' => 'check_user', 'uses' => 'AuthController@getChangePassword'));

Route::post('member/changepassword', array('as' => 'changepass_post', 'before' => 'check_user|csrf', 'uses' => 'AuthController@postChangePassword'));

Route::get('member/forgot', array('as' => 'forgot_get', 'before' => 'is_login', 'uses' => 'AuthController@getForgot'));

Route::post('member/forgot', array('as' => 'forgot_post', 'before' => 'is_login|csrf', 'uses' => 'AuthController@postForgot'));

Route::get('member/active/{user}/{code}', array('as' => 'active_reset', 'before' => 'is_login', 'uses' => 'AuthController@getActiveReset'));

Route::get('create_cate', function(){
    Category::create(array(
        'title' => 'PHP nang cao'
    ));
    Category::create(array(
        'title' => 'Laravel Framework'
    ));
    return 'Done';
});

Route::get('question/create', array(
    'as' => 'question_create_get',
    'before' => 'check_user',
    'uses' => 'QuestionController@getCreate'
));

Route::post('question/create', array(
    'as' => 'question_create_post',
    'before' => 'csrf|check_user',
    'uses' => 'QuestionController@postCreate'
));

Route::get('question/tag/{tag}', array('as' => 'question_tags_get', 'uses' => 'QuestionController@getQuestionByTag'));

Route::get('question/vote/{action}/{id}', array(
    'as' => 'question_vote_get',
    'before' => 'check_user',
    'uses' => 'QuestionController@getVote'
))->where(array(
    'action' => '(like|dislike)',
    'id' => '[0-9]+'
));

Route::get('question/detail/{id}/{title}', array(
    'as' => 'question_detail_get',
    'uses' => 'QuestionController@getDetail'
))->where(array(
    'id' => '[0-9]+',
    'title' => '[a-zA-Z0-9.\-]+'
));
