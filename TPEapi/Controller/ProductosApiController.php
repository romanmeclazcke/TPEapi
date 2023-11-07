<?php
 
 require_once "apiController.php";

class ProductosApiController extends apiController{
    private $model;

    function __construct(){
        parent::__construct();
        $this->model= new Model();
    }
    

    //funcnion listar productos
    function getProductos($params=[]){
        $productos=$this->model->getProductos(); //busco todos los productos a la base de datos
        return $this->view->response($productos,200); //lo paso a la view con un estado 200
    }

   

    function editarProducto($params= []){
        $idproducto= $params[":ID"];
        $producto=$this->model->getProductoDeterminado($idproducto);
        if($producto!=null){
            $body=$this->getData();
            $nombre= $body->nombre;
            $material= $body->material;
            $precio= $body->precio;
            $imagen= $body->imagen;
            if (!empty($nombre) && !empty($material) && !empty($precio) && !empty($imagen)){
                $tarea= $this->model->editarProducto($idproducto,$nombre,$material,$precio,$imagen);
                $this->view->response("Se actualizo el producto con el id=".$idproducto, 201);
            }
            else{
                $this->view->response("No se agrego el producto debido a que no completaste todos los campos", 200);
            }

        }else{
            $this->view->response("No existe el producto con el id".$idproducto. "que solicitaste editar", 400);
        }
    }
}