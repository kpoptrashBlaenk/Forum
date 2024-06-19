<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

try {
    $userId = $_SESSION['user']['user_id'];
    $postId = $_POST['post_id'];

    $userHasLiked = count($db->query('select * from likes where user_id = :user_id and post_id = :post_id', [
        'user_id' => $userId,
        'post_id' => $postId
    ])->get());

    if ($userHasLiked > 0) {
        $db->query('delete from likes where user_id = :user_id and post_id = :post_id', [
            'user_id' => $userId,
            'post_id' => $postId
        ]);
        $userHasLiked = 0;
    } else {
        $db->query('insert into likes(user_id, post_id) values(:user_id, :post_id)', [
            'user_id' => $userId,
            'post_id' => $postId
        ]);
        $userHasLiked = 1;
    }

    $numLikes = count($db->query('select * from likes where post_id = :post_id', [
        'post_id' => $postId
    ])->get());

    echo json_encode([
        'success' => true,
        'user_has_liked' => $userHasLiked,
        'num_likes' => $numLikes
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

exit();
