<?php

use Core\App;
use Core\Database;
use Http\Forms\CommentForm;

$db = App::resolve(Database::class);

$comment = $db->query('select * from comments where id = :id', ['id' => $_POST['comment_id']])->findOrFail();

authorize($comment['user_id'] === $_SESSION['user']['user_id']);

$db->query('delete from comments where id = :id', [
    'id' => $_POST['comment_id']
]);

redirect("/slam?id={$_POST['post_id']}");

exit();
