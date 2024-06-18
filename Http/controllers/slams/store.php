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

$db->query('INSERT INTO posts(user_id, title, category_id, content, date) VALUES(:user_id, :title, :category_id, :content, :date)', [
    'user_id' => $_SESSION['user']['user_id'],
    'title' => $_POST['title'],
    'category_id' => $_POST['category'],
    'content' => $_POST['content'],
    'date' => date('Y-m-d H:i:s')
]);

redirect("/slam?id={$db->lastInsertedId()}");

exit();
