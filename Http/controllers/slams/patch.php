<?php

use Core\App;
use Core\Database;
use Http\Forms\SlamForm;

$form = SlamForm::validate($attributes = [
    'title' => $_POST['title'],
    'content' => $_POST['content'],
    'category' => $_POST['category']
]);

$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['user_id'];

$post = $db->query('select * from posts where id = :id', ['id' => $_POST['post_id']])->findOrFail();

authorize($post['user_id'] === $currentUserId);

$db->query('update posts SET title = :title, category_id = :category_id, content = :content WHERE id = :id', [
    'id' => $_POST['post_id'],
    'title' => $_POST['title'],
    'category_id' => $_POST['category'],
    'content' => $_POST['content']
]);

redirect("/slams?id={$_POST['post_id']}");

exit();
