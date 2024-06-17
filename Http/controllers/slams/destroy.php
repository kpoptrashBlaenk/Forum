<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['user_id'];

$post = $db->query('select * from posts where id = :id', [
    'id' => $_POST['post_id']
])->findOrFail();

authorize($post['user_id'] === $currentUserId);

$db->query('delete from posts where id = :id', [
    'id' => $_POST['post_id']
]);

redirect('/slams');

exit;
