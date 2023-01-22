<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('search', 'GamesController');

Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('add', 'GamesController');
Routing::post('addGame', 'MylistController');
Routing::post('getUserStats', 'UsersController');

Routing::get('mylist', 'MylistController');
Routing::get('statistics', 'StatController');
Routing::get('users', 'UsersController');
Routing::get('settings', 'UsersController');
Routing::get('likes', 'StatController');

Routing::post('changeData', 'UsersController');
Routing::post('logout', 'SecurityController');

Routing::run($path);