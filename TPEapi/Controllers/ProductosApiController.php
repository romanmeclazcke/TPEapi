<?php
require_once "apiController.php";
require_once "helpers/AuthApiHelper.php";
require_once "./Models/ProductosModel.php";

class ProductosApiController extends apiController {
    private $model;
    private $authHelper;

    function __construct() {
        parent::__construct();
        $this->model = new ProductosModel(); 
        $this->authHelper= new AuthHelper();
    }
    

    //funcion listar productos
    function getProductos($params=[]){
        if(isset($_GET["sort"])&& isset($_GET["order"])){//si los campos estan vacios devuelvo normal
            $sort=$_GET["sort"]; //recivo los valores
            $order=$_GET["order"];
            if($this->ExisteCampoEnDb($sort)==true){ //pregunto si el campo es valido
                $productos=$this->model->getProductosOrdenados($sort,$order);// obtengo los productos orendador
                $this->view->response($productos,200);
            }else{//si el campo no existe en la bd devuelvo mensaje de error
                $this->view->response("El campo no existe en la base de datos", 400);
            }
        }else if(isset($_GET["precio"])){
            $precio=$_GET["precio"];
            $productos=$this->model->getProductosPrecio($precio);
            if($productos){
                $this->view->response($productos, 200);
            }else {
                $this->view->response("no existe productos con ese nombre", 400);
            }
        }else{
            $productos = $this->model->getProductos(); //busco todos los productos a la base de datos y mando a la vista
            $this->view->response($productos,200);
        }
    }


    function editarProducto($params= []){
        $user = $this->authHelper->currentUser();
        if(!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }

        if($user->admin!=1){
            $this->view->response('Forbidden', 403);
            return;
        }
        $idproducto = $params[":id"];
        $producto = $this->model->getProductoDeterminado($idproducto);
        if($producto != null){
            $body = $this->getData();
                if($body!=null){
                $body = $this->getData();
                $nombre = $body->nombre;
                $material = $body->material;
                $precio = $body->precio;
                $imagen = $body->imagen;
                    if (!empty($nombre) && !empty($material) && !empty($precio) && !empty($imagen)){
                    $tarea = $this->model->editarProducto($idproducto,$nombre,$material,$precio,$imagen);
                    $this->view->response("Se actualizó el producto con el id=".$idproducto, 200);
                    }
                    else{
                    $this->view->response("No se editó el producto debido a que no completaste todos los campos", 400);
                    }
                }else{
                    $this->view->response("Complete todos los campos para modificar el producto",400);
                }
        }else{
            $this->view->response("No existe el producto con el id".$idproducto. "que solicitaste editar", 404);
        }
    }

    function agregarProducto($params = []) {
        $user = $this->authHelper->currentUser();
        if(!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }

        if($user->admin!=1){
            $this->view->response('Forbidden', 403);
            return;
        }
        
        $body = $this->getData();

        $nombre = $body->nombre;
        $material = $body->material;
        $precio = $body->precio;
        $imagen = $body->imagen;
        $categoria=$body->categoria;

        if (empty($nombre) || empty($material) || empty($precio) || empty($imagen)|| empty($categoria)) {
            $this->view->response("Complete todos los campos", 400);
        } else if (!empty($nombre) && !empty($material) && !empty($precio) && !empty($imagen)&& !empty($categoria)){
            $id = $this->model->addProducto($nombre, $material, $precio, $imagen,$categoria);
            $creado = $this->model->getProductoDeterminado($id);
            $this->view->response($creado, 201);
        }
    }

    function eliminarProducto($params = []) {
        $user = $this->authHelper->currentUser();
        if(!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }

        if($user->admin!=1){
            $this->view->response('Forbidden', 403);
            return;
        
        }
        $id = $params[':id'];
        $producto = $this->model->getProductoDeterminado($id);

        if ($producto) {
            $this->model->eliminarProducto($id);
            $this->view->response("El producto de id=". $id ." ha sido eliminado.", 200);
        } else {
            $this->view->response("El producto de id=". $id ." no existe.", 404);
        }
    }

    function getProductoDeterminado($params=[]){
        //recibo el id del producto y lo busco en la bd
        $idproducto= $params[":id"];
        $producto=$this->model->getProductoDeterminado($idproducto);
        //si trae un producto lo mando a la view con un estado 200
        //sino muestro mensaje que no existe el producto y un estado 404
        if($producto!=null){
            $this->view->response($producto,200);
        }else{      
         $this->view->response("no existe el producto con el id=.$idproducto",404);
        }
    }

    //funcion que verifica si un campo esta en la bd
    function ExisteCampoEnDb($campo){
        $camposbd = $this->model->obtenerCamposDeTablaProductos();  
        //pregunto si la variable campo esta contenido en el array camposdb
        //retorno true si esta sino false
        if(in_array($campo, $camposbd)){
            return true;
        }else{
            return false;
        }
    }
}