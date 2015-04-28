<?php
class AuthController extends BaseController
{
    public function postLogin()
    {
        if (Request::isMethod('post')) {
            $valid = Validator::make(
                Input::all(),
                User::$loginRules,
                User::$messages
            );
            if ($valid->passes()) {
                try {
                    $dataLogin = array(
                        'username' => Input::get('username'),
                        'password' => Input::get('password')
                    );

                    Sentry::Authenticate($dataLogin, false);

                    return Redirect::route('index')->with('success', 'Dang nhap thanh cong');
                } catch(Cartalyst\Sentry\Users\WrongPasswordException $e) {
                    Session::flash('error', 'Username hoac password khong dung');
                } catch(Cartalyst\Sentry\Users\UserNotFoundException $e) {
                    Session::flash('error', 'Username hoac password khong dung');
                }
            } else {
                Session::flash('error', $valid->errors()->first());
            }
        }
        return View::make('auth.login', array(
            'title' => 'Login Page'
        ));
    }

    public function getLogout()
    {
        Sentry::logout();
        return Redirect::route('index')->with('success', 'Dang xuat thanh cong');
    }
}