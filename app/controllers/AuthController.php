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

    public function getForgot()
    {
        return View::make('auth.forgot', array(
            'title' => 'Lay lai mat khau'
        ));
    }

    public function postForgot()
    {
        $valid = Validator::make(Input::all(), User::$forgotPasswordRules, User::$messages);
        if ($valid->passes()) {
            try {
                $user = Sentry::findUserByLogin(Input::get('username'));

                // Get the password reset code
                $resetCode = $user->getResetPasswordCode();

                //send email for user
                Mail::send('emails.auth.activecode', array(
                    'user' => $user->username,
                    'code' => $resetCode,
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'email' => $user->email,
                ), function($message) use ($user){
                    $message->from('longtestsmpt@gmail.com', 'No-reply email');
                    $message->to($user->email, $user->first_name . ' ' . $user->last_name);
                    $message->subject('Yeu cau lay lai email');
                });
                return Redirect::route('forgot_get')->with('success', 'Mot email chua lien ket xac nhan da gui toi email cua ban, vui long kiem tra va hoan tat yeu cau.');
            } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                return Redirect::route('forgot_get')->with('error', 'Username khong ton tai trong he thong');
            }
        } else {
            return Redirect::route('forgot_get')->with('error', $valid->errors()->first());
        }

    }

    public function getActiveReset($user, $code)
    {
        try {
            $user = Sentry::findUserByLogin($user);
            if ($user->checkResetPasswordCode($code)) {
                $newPassword = Str::random(6);
                $user->attemptResetPassword($code, $newPassword);
                $dataEmail = array(
                    'user' => $user->username,
                    'name' => $user->first_name .' ' . $user->last_name,
                    'email' => $user->email,
                    'pass' => $newPassword,
                );
                Mail::send('emails.auth.resetpass', $dataEmail, function($message) use ($dataEmail){
                        $message->from('longtestsmpt@gmail.com', 'No-reply email');
                        $message->to($dataEmail['email']);
                        $message->subject('Mat khau moi cua ban tren faq');
                });
                return Redirect::route('index')->with('success', 'Mat khau moi da duoc goi den email cua ban');
            } else {
                return Redirect::route('forgot_get')->with('error', 'Khong the lay lai mat khau. Vui long thu lai thao tac nay ben duoi');
            }
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::route('forgot_get')->with('error', 'Username khong ton tai trong he thong');
        }
    }
}