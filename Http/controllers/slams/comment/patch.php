<?php

use Core\App;
use Core\Database;
use Http\Forms\CommentForm;

$form = CommentForm::validate($attributes = [
    'title' => $_POST['comment']
]);

$db = App::resolve(Database::class);

$comment = $db->query('select * from comments where id = :id', ['id' => $_POST['comment_id']])->findOrFail();

authorize($comment['user_id'] === $_SESSION['user']['user_id']);

$db->query('update comments set comment = :comment where id = :id', [
    'id' => $_POST['comment_id'],
    'comment' => $_POST['comment']
]);

redirect("/slam?id={$_POST['post_id']}");

exit();
