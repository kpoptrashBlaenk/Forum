<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$categories = $db->query('SELECT * FROM category')->get();



$post = $db->query('select posts.*, users.username, category.name
                     from posts
                     join users on posts.user_id = users.user_id
                     join category on posts.category_id = category.id
                     where posts.id = :id',
    [
        'id' => $_GET['id']
    ])->findOrFail();

authorize($post['user_id'] === $_SESSION['user']['user_id']);

view('slams/edit.view.php', [
    'categories' => $categories,
    'post' => $post,
    'errors' => Session::get('errors')
]);
