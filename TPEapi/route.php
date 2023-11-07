<?php
require_once 'libs/Router.php';
require_once './Controller/ProductosApiController.php';

$router = new ProductosApiController();

$router->addRoute('Productos', 'GET', 'ProductosApiController', 'getProductos');
$router->addRoute('Productos/:id', 'GET', 'ProductosApiController', 'getProductoDeterminado');
$router->addRoute('Productos', 'POST', 'ProductosApiController', 'agregarProducto');
$router->addRoute('Productos/:id', 'PUT', 'ProductosApiController', 'editarProducto');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);