<?php

use Core\App;
use Core\Database;

if (!isset($_GET['page'])) {
    redirect(pageURL(1));
}

$db = App::resolve(Database::class);

$query = 'select posts.*, users.username, category.image_url, category.name, 
                        (select count(*) from likes where likes.post_id = posts.id) as num_likes,
                        (select count(*) from comments where comments.post_id = posts.id) as num_comments
                        from posts
                        join users on posts.user_id = users.user_id 
                        join category on posts.category_id = category.id';

$params = [];
$where = [];
$orderBy = [];

if (isset($_GET['category'])) {
    $where[] = 'category.id = :category';
    $params['category'] = $_GET['category'];
}

if (isset($_GET['search'])) {
    $where[] = '(posts.content like :search or posts.title like :search)';
    $params['search'] = '%' . $_GET['search'] . '%';
}

$sort_by = $_GET['sort_by'] ?? 'new';

switch ($sort_by) {
    case 'new':
        $orderBy[] = 'posts.date desc';
        break;
    case 'hot':
        $one_week_ago = date('Y-m-d H:i:s', strtotime('-1 week'));
        $where[] = 'posts.date >= :one_week_ago';
        $orderBy[] = 'num_likes desc';
        $params['one_week_ago'] = $one_week_ago;
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

$lastPage = ceil(count($db->query($query, $params)->get())/$limit);

$postsLength = (isset($_GET['page'])) ? ((int)$_GET['page'] - 1) * $limit : 0;

$query .= " limit {$limit} offset {$postsLength}";

$posts = $db->query($query, $params)->get();

$pages = [
    'back' => (max((int)$_GET['page'] - 1,1)),
    'next' => min((int)$_GET['page'] + 1,$lastPage),
    'last' => $lastPage
];

view('slams/index.view.php', [
    'posts' => $posts,
    'sort_by' => $sort_by,
    'pages' => $pages
]);
