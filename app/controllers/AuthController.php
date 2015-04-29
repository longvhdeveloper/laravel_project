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

    public function getRegister()
    {
        return View::make('auth.register', array('title' => 'Dang ky thanh vien'));
    }

    public function postRegister()
    {
        $valid = Validator::make(Input::all(), User::$registerRules, User::$messages);

        if ($valid->passes()) {
            $dataRegister = array(
                'first_name' => Input::get('firstname'),
                'last_name' => Input::get('lastname'),
                'username' => Input::get('username'),
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'activated' => 1,
            );

            $dataLogin = array(
                'username' => Input::get('username'),
                'password' => Input::get('password'),
            );
            Sentry::getUserProvider()->create($dataRegister);
            Sentry::Authenticate($dataLogin, false);
            return Redirect::route('index')->with('success', 'Chuc mung ban da dang ky thanh cong vao he thong');
        } else {
            Session::flash('error', $valid->errors()->first());
            return Redirect::route('register_get')->withInput(Input::except('password', 'repassword'));
        }
    }

    public function getChangePassword()
    {
        return View::make('auth.change_password', array(
            'title' => 'Sua mat khau'
        ));
    }

    public function postChangePassword()
    {
        $valid = Validator::make(Input::get(), User::$changePasswordRules, User::$messages);

        if ($valid->passes()) {
            try {
                $user = Sentry::findUserByCredentials(array(
                    'password'   => Input::get('oldpassword'),
                    'username' => Sentry::getUser()->username,
                ));
                $user->password = Input::get('newpassword');
                $user->save();
                return Redirect::route('changepass_get')->with('success', 'Thay doi mat khau thanh cong');
            } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
                return Redirect::route('changepass_get')->with('error', 'Mat khau cu khong hop le');
            }
        } else {
            return Redirect::route('changepass_get')->with('error', $valid->errors()->first());
        }
    }
}