<?php
require_once 'libs/Router.php';
require_once './Controller/ProductosApiController.php';

$router = new ProductosApiController();

$router->addRoute('productos', 'GET', 'ProductosApiController', 'getProductos');
$router->addRoute('productos/:id', 'GET', 'ProductosApiController', 'getProductoDeterminado');
$router->addRoute('productos', 'POST', 'ProductosApiController', 'agregarProducto');
$router->addRoute('productos/:id', 'PUT', 'ProductosApiController', 'editarProducto');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
