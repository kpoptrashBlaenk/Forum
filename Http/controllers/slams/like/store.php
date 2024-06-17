<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$db->query('insert into likes(user_id, post_id) values(:user_id, :post_id)', [
    'user_id' => $_SESSION['user']['user_id'],
    'post_id' => $_POST['post_id']
]);

redirect("/slam?id={$_POST['post_id']}");

exit();
