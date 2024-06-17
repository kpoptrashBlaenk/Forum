<?php

use Core\App;
use Core\Authenticator;
use Core\CookieHandler;
use Core\Database;
use Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$auth = new Authenticator;

$signedIn = $auth->attempt($attributes['email'], $attributes['password']);

if (!$signedIn) {
    $form->error('email_password', 'No matching email or password')
        ->throw();
}

if ($_POST['stayConnected']) {
    $cookies = new CookieHandler;
    $cookies->saveCookie();
}

$user = App::resolve(Database::class)->query("select * from users where email = :email", [
    'email' => $_POST['email'],
])->find();

$auth->login($user);

redirect('/');
