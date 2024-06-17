<?php

namespace Core;

class Authenticator
{

    public function attempt($email, $password): bool
    {
        //REWORK
        $user = App::resolve(Database::class)->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

        if ($user && password_verify($password, $user['password'])) {

            $this->login([
                'email' => $email,
                'user_id' => $user['user_id']
            ]);
            return true;
        }

        return false;
    }

    public function login($user): void
    {

        $_SESSION['user'] = $user;

        session_regenerate_id(true);
    }

    public function logout(): void
    {
        $cookies = new CookieHandler;
        $cookies->deleteCookie();

        Session::destroy();
    }

}
