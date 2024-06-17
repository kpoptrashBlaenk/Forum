<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$post = $db->query('SELECT posts.*, users.username, category.image_url, category.name, 
                    COUNT(likes.post_id) AS num_likes,
                    (SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id AND likes.user_id = :user_id) AS user_has_liked
                    FROM posts
                    JOIN users ON posts.user_id = users.user_id
                    JOIN category ON posts.category_id = category.id
                    LEFT JOIN likes ON posts.id = likes.post_id
                    WHERE posts.id = :id
                    GROUP BY posts.id',
    [
        'id' => $_GET['id'],
        'user_id' => ($_SESSION['user']['user_id']) ?? ''
    ])->findOrFail();


$comments = $db->query('select comments.*, users.username
from comments
join users on comments.user_id = users.user_id
where comments.post_id = :post_id',
    [
        'post_id' => $post['id']
    ])->get();

(isset($_GET['comment']))
    ? $editComment = array_values(array_filter($comments, static function ($element) {
        return $element['id'] == $_GET['comment'];
    }))[0]
    : $editComment = '';

view('slams/show.view.php', [
    'post' => $post,
    'comments' => $comments,
    'editComment' => $editComment,
    'errors' => Session::get('errors')
]);
