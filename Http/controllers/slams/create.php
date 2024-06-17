<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$categories = $db->query('SELECT * FROM category')->get();

view('slams/create.view.php', [
    'categories' => $categories,
    'errors' => Session::get('errors')
]);
