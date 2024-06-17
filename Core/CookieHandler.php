<?php

namespace Core;

class CookieHandler
{

    private $database;

    public function __construct() {
        $db = new App;
        $this->database = $db->getDB();
    }

    public function checkCookie()
    {
        $token = $_COOKIE['stay_connected_token'];
        //REWORK
        return $this->database->query("select * from users where session_token = :session_token", [
            'session_token' => $token
        ])->find();
    }

    public function saveCookie(): void
    {
        $token = bin2hex(random_bytes(16));

        //REWORK
        $this->database->query('update users set session_token = :token where email = :email', [
            'email' => $_POST['email'],
            'token' => $token
        ]);

        setcookie('stay_connected_token', $token, time() + (86400 * 30), '/');
    }

    public function deleteCookie(): void
    {
        //REWORK
        $this->database->query('update users set session_token = null where user_id = :id', [
            'id' => $_SESSION['user']['user_id'],
        ]);

        setcookie('stay_connected_token', '', time() - 3600, "/");
    }

}
