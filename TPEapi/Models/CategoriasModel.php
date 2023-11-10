<?php
require_once "Model.php";

class CategoriasModel extends Model {

    function getCategorias() {
        $query = $this->db->prepare("SELECT * FROM categoria");
        $query->execute();
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);

        return $categorias;
    }

    function editarCategoria($id, $tipo) {
        $query = $this->db->prepare('UPDATE categoria SET tipo=? WHERE id=?');
        $query->execute([$tipo, $id]);
    }

    function addCategoria($nombre) {
        $query = $this->db->prepare("INSERT INTO categoria (tipo) VALUES (?)");
        $query->execute([$nombre]);

        return $this->db->lastInsertId();
    }

    function getCategoriaDeterminada($id) {
        $query = $this->db->prepare('SELECT * FROM categoria WHERE id = ?');
        $query->execute([$id]);
        $cat = $query->fetch(PDO::FETCH_OBJ);

        return $cat;
    }
}
