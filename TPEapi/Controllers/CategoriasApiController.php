<?php
require_once "apiController.php";
require_once "./Models/CategoriasModel.php";

class CategoriasApiController extends apiController {
    private $model;

    function __construct() {
        parent::__construct();
        $this->model = new CategoriasModel();
    }

    function getCategorias($params = []) {
        $categorias = $this->model->getCategorias();
        return $this->view->response($categorias, 200);
    }

    function editarCategoria($params = []) {
        $id = $params[":id"];
        $categoria = $this->model->getCategoriaDeterminada($id);
        if($categoria != null){
            $body = $this->getData();
            $nuevoTipo = $body->tipo;
            if (!empty($nuevoTipo)){
                $this->model->editarCategoria($id, $nuevoTipo);
                $this->view->response("Se actualizó la categoría con el id=".$id, 200);
            }
            else{
                $this->view->response("No se editó la categoría debido a que no completaste todos los campos", 400);
            }
        }else{
            $this->view->response("No existe la categoría con el id".$id. " que solicitaste editar", 404);
        }
    }

    function agregarCategoria($params = []) {
        $body = $this->getData();
        $tipo = $body->tipo;

        if (empty($tipo))
            $this->view->response("Complete el campo", 400);
        else {
            $id = $this->model->addCategoria($tipo);
            $catCreada = $this->model->getCategoriaDeterminada($id);
            $this->view->response($catCreada, 201);
        }
    }

    function getCategoriaDeterminada($params = []) {
        $id = $params[":id"];
        $categoria = $this->model->getCategoriaDeterminada($id);
        if ($categoria != null) {
            $this->view->response($categoria, 200);
        } else {
            $this->view->response("La categoría de id=" . $id . " no existe. ", 404);
        }
    }
}