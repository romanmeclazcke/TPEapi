<?php
require_once "apiController.php";
require_once "../Models/ProductosModel.php";

class ProductosApiController extends apiController{
    private $model;

    function __construct(){
        parent::__construct();
        $this->model= new ProductosModel();
    }
    

    //funcnion listar productos
    function getProductos($params=[]){
        $productos = $this->model->getProductos(); //busco todos los productos a la base de datos
        return $this->view->response($productos,200); //lo paso a la view con un estado 200
    }

    function editarProducto($params= []){
        $idproducto = $params[":id"];
        $producto = $this->model->getProductoDeterminado($idproducto);
        if($producto != null){
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
            $this->view->response("No existe el producto con el id".$idproducto. "que solicitaste editar", 404);
        }
    }

    function agregarProducto($params = []) {
        $body = $this->getData();

        $nombre = $body->nombre;
        $material = $body->material;
        $precio = $body->precio;
        $imagen = $body->imagen;

        if (empty($nombre) || empty($material) || empty($precio) || empty($imagen)) {
            $this->view->response("Complete todos los campos", 400);
        } else {
            $id = $this->model->addProducto($nombre, $material, $precio, $imagen);
            $creado = $this->model->getProductoDeterminado($id);
            $this->view->response($creado, 201);
        }
    }

    function eliminarProducto($params = []) {
        $id = $params[':id'];
        $producto = $this->model->getProductoDeterminado($id);

        if ($producto) {
            $this->model->eliminarProducto($id);
            $this->view->response("El producto de id=". $id ." ha sido eliminado.", 200);
        } else {
            $this->view->response("El producto de id=". $id ." no existe.", 404);
        }
    }


}