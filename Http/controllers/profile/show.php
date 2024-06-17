<?php

use Core\App;
use Core\Database;

if (!isset($_GET['page'])) {
    redirect(pageURL(1));
}

$db = App::resolve(Database::class);

$db->query('select users.* from users where username = :username',[
    'username' => $_GET['user'],
])->findOrFail();

$query = 'select posts.*, users.username, category.image_url, category.name, 
                        (select count(*) from likes where likes.post_id = posts.id) as num_likes,
                        (select count(*) from comments where comments.post_id = posts.id) as num_comments
                        from posts
                        join users on posts.user_id = users.user_id 
                        join category on posts.category_id = category.id';

$params = [];
$where = [];
$orderBy = [];


if (isset($_GET['user'])) {
    $where[] = 'users.username = :username';
    $params['username'] = $_GET['user'];
}

$sort_by = $_GET['sort_by'] ?? 'new';

switch ($sort_by) {
    case 'new':
        $orderBy[] = 'posts.date desc';
        break;
    case 'top':
        $orderBy[] = 'num_likes desc';
        break;
    default:
        break;
}

if (!empty($where)) {
    $query .= ' where ' . implode(' and ', $where);
}

if (!empty($orderBy)) {
    $query .= ' order by ' . implode(', ', $orderBy);
}

$limit = 5;

$postsAmount = count($db->query($query, $params)->get());

$lastPage = ceil($postsAmount/$limit);

$postsLength = (isset($_GET['page'])) ? ((int)$_GET['page'] - 1) * $limit : 0;

$query .= " limit {$limit} offset {$postsLength}";

$posts = $db->query($query, $params)->get();

$pages = [
    'back' => (max((int)$_GET['page'] - 1,1)),
    'next' => min((int)$_GET['page'] + 1,$lastPage),
    'last' => $lastPage
];

view('profile/show.view.php', [
    'posts' => $posts,
    'sort_by' => $sort_by,
    'pages' => $pages
]);
