<?php

use Core\App;
use Core\Authenticator;
use Core\CookieHandler;
use Core\Database;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['username'];

$form = LoginForm::validate($attributes = [
    'email' => $email,
    'password' => $password,
    'username' => $username
]);

$auth = new Authenticator;

$db = App::resolve(Database::class);

$user = $db->query("select * from users where email = :email", [
    'email' => $email,
])->find();

if ($user) {
    LoginForm::emailExists($attributes = [
        'email' => $email,
        'password' => $password,
        'username' => $username
    ]);
}

$user = $db->query("select * from users where username = :username", [
    'username' => $username,
])->find();

if ($user) {
    LoginForm::usernameExists($attributes = [
        'email' => $email,
        'password' => $password,
        'username' => $username
    ]);
}

$db->query('INSERT INTO users(email, password, username) VALUES(:email, :password, :username)', [
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT),
    'username' => $username
]);

$signedIn = $auth->attempt($attributes['email'], $attributes['password']);

if (!$signedIn) {
    $form->error('email', 'No matching email or password')
        ->throw();
}

if ($_POST['stayConnected']) {
    $cookies = new CookieHandler;
    $cookies->saveCookie();
}

$user = $db->query("select * from users where email = :email", [
    'email' => $email
])->find();

$auth->login($user);

redirectPreviousReferrer();

exit();
