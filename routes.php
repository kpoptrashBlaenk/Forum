<?php

global $router;

$router->get('/', 'index.php');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

$router->get('/session', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');

$router->get('/slams', 'slams/index.php');
$router->get('/slams/create', 'slams/create.php')->only('auth');
$router->post('/slams/create', 'slams/store.php')->only('auth');

$router->get('/slam', 'slams/show.php');
$router->patch('/slam', 'slams/patch.php')->only('auth');
$router->delete('/slam', 'slams/destroy.php')->only('auth');
$router->get('/slam/edit', 'slams/edit.php')->only('auth');
$router->post('/slam/comment', 'slams/comment/store.php')->only('auth');
$router->patch('/slam/comment', 'slams/comment/patch.php')->only('auth');
$router->delete('/slam/comment', 'slams/comment/destroy.php')->only('auth');
$router->post('/slam/like', 'slams/like/store.php')->only('auth');
$router->delete('/slam/like', 'slams/like/destroy.php')->only('auth');

$router->get('/profile', 'profile/show.php');
