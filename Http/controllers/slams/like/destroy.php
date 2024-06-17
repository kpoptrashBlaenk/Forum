<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$db->query('delete from likes where post_id = :post_id and user_id = :user_id', [
    'post_id' => $_POST['post_id'],
    'user_id' => $_SESSION['user']['user_id']
]);

redirect("/slam?id={$_POST['post_id']}");

exit();
