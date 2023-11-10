<?php
require_once "Config.php";
require_once 'libs/Router.php';
require_once 'Controllers/ProductosApiController.php';
require_once 'Controllers/CategoriasApiController.php';

$router = new Router();

$router->addRoute('productos', 'GET', 'ProductosApiController', 'getProductos');
$router->addRoute('producto/:id', 'GET', 'ProductosApiController', 'getProductoDeterminado');
$router->addRoute('producto', 'POST', 'ProductosApiController', 'agregarProducto');
$router->addRoute('producto/:id', 'PUT', 'ProductosApiController', 'editarProducto');
$router->addRoute('producto/:id', 'DELETE', 'ProductosApiController', 'eliminarProducto');
$router->addRoute('producto/:id', 'GET', 'ProductosApiController', 'getProductosPorCategoria');

$router->addRoute('categorias', 'GET', 'CategoriasApiController', 'getCategorias');
$router->addRoute('categoria', 'POST', 'CategoriasApiController', 'agregarCategoria');
$router->addRoute('categoria/:id', 'PUT', 'CategoriasApiController', 'editarCategoria');
$router->addRoute('categoria/:id', 'GET', 'ProductosApiController', 'getCategoriaDeterminada');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
