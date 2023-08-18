<?php 
use Bramus\Router\Router;

require './vendor/autoload.php';

require './functions.php';

require_once 'functions.php';
require_once './models/posts.php';
require_once './controllers/controller.php';

$controller = new Controller(); 
$router = new Router();

$router->get('/', [$controller, 'ReadAllPost']);
$router->get('/get/posts', [$controller, 'ReadAllPost']); 
$router->get('/get/post/{id}', [$controller, 'ReadById']); 
$router->post('/post/post', [$controller, 'CreatePost']);
$router->put('/put/post/{id}', [$controller, 'UpdatePost']);
$router->delete('/delete/post/{id}', [$controller, 'DeletePost']);





