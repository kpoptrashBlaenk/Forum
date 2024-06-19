<?php

use Core\Session;

$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

view('registration/create.view.php', [
    'errors' => Session::get('errors')
]);
