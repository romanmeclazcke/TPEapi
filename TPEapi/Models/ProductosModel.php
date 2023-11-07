<?php
require_once "Model.php";

class ProductosModel extends Model {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }

    function getProductos() {
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    function getProductoDeterminado($id) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE id=?');
        $query->execute([$id]);
        $producto = $query->fetch(PDO::FETCH_OBJ);

        return $producto;
    }

    function addProducto($nombre, $material, $precio, $imagen) {
        $query = $this->db->prepare('INSERT INTO productos (nombre, material, precio, imagen) VALUES (?, ?, ?, ?)');
        $query->execute([$nombre, $material, $precio, $imagen]);

        return $this->db->lastInsertId();
    }

    function editarProducto($id, $nuevoNombre, $nuevoMaterial, $nuevoPrecio, $nuevaImagen) {
        $query = $this->db->prepare('UPDATE productos SET nombre=?, material=?, precio=?, imagen=? WHERE id=?');
        $query->execute([$nuevoNombre, $nuevoMaterial, $nuevoPrecio, $nuevaImagen, $id]);
    }

    function eliminarProducto($id) {
        $query = $this->db->prepare('DELETE FROM productos WHERE id=?');
        $query->execute([$id]);
    }

}