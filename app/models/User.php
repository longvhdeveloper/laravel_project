<?php

class User extends Cartalyst\Sentry\Users\Eloquent\User {
    public static $loginRules = array(
        'username' => 'required',
        'password' => 'required'
    );

    public static $messages = array(
        'username.required' => 'Vui long nhap username',
        'password.required' => 'Vui long nhap password',
    );
}
