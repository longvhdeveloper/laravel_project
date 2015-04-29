<?php

class User extends Cartalyst\Sentry\Users\Eloquent\User {
    public static $loginRules = array(
        'username' => 'required',
        'password' => 'required'
    );

    public static $messages = array(
        'username.required' => 'Vui long nhap username',
        'password.required' => 'Vui long nhap password',
        'firstname.required' => 'Vui long nhap firstname',
        'lastname.required' => 'Vui long nhap lastname',
        'email.required' => 'Vui long nhap email',
        'username.min' => 'Username toi thieu la :min ky tu',
        'password.min' => 'Password toi thieu la :min ky tu',
        'email' => 'Dia chi email khong hop le',
        'email.unique' => 'Dia chi email cua ban da ton tai trong he thong',
        'username.unique' => 'Username cua ban da ton tai trong he thong',
        'repassword.same' => 'Password va Re password khong chinh xac',
        'repassword.required' => 'Vui long nhap Re password',
         "recaptcha-response_field.required" => 'Vui long nhap ma xac nhan',
        "recaptcha-response_field.recaptcha" => 'Ma xac nhan khong hop le',
    );

    public static $registerRules = array(
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|email|unique:users,email',
        'username' => 'required|min:4|unique:users,username',
        'password' => 'required|min:5',
        'repassword' => 'required|same:password',
        'recaptcha-response_field' => 'required|recaptcha',
    );
}
