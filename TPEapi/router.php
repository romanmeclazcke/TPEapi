<?php
require_once "Config.php";
require_once 'libs/Router.php';
require_once 'Controllers/ProductosApiController.php';
require_once 'Controllers/UserApiController.php'; 

$router = new Router();

$router->addRoute('producto', 'GET', 'ProductosApiController', 'getProductos'); 
$router->addRoute('producto/:id', 'GET', 'ProductosApiController', 'getProductoDeterminado');
$router->addRoute('producto', 'POST', 'ProductosApiController', 'agregarProducto');
$router->addRoute('producto/:id', 'PUT', 'ProductosApiController', 'editarProducto');
$router->addRoute('producto/:id', 'DELETE', 'ProductosApiController', 'eliminarProducto');
$router->addRoute('user/token', 'GET', 'UserApiController', 'getToken');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
