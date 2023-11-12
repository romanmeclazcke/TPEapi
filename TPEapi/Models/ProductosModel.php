<?php
require_once "Model.php";

class ProductosModel extends Model {
    protected $db;

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

    function addProducto($nombre, $material, $precio, $imagen,$categoria) {
        $query = $this->db->prepare('INSERT INTO productos (nombre, material, precio, imagen,categoria) VALUES (?, ?, ?, ?,?)');
        $query->execute([$nombre, $material, $precio, $imagen,$categoria]);

        return $this->db->lastInsertId();
    }

    function editarProducto($id, $nuevoNombre, $nuevoMaterial, $nuevoPrecio, $nuevaImagen) {
        $query = $this->db->prepare('UPDATE productos SET nombre=?, material=?, precio=?, imagen=? WHERE id=?');
        $query->execute([$nuevoNombre, $nuevoMaterial, $nuevoPrecio, $nuevaImagen, $id]);
    }

    function eliminarProducto($id){
        $query = $this->db->prepare('DELETE FROM productos WHERE id=?');
        $query->execute([$id]);
    }

    function getProductosOrdenados($sort, $order){
        $query = $this->db->prepare("SELECT * FROM productos ORDER BY $sort $order");
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }


    function getCampoProducto($campoProducto,$idproducto){
        $query = $this->db->prepare("SELECT $campoProducto FROM productos WHERE id=?");
        $query->execute([$idproducto]);
        $valor = $query->fetch(PDO::FETCH_OBJ);

        return $valor;
    }

    function obtenerCamposDeTablaProductos() {
        $query = $this->db->prepare("DESCRIBE productos");
        $query->execute();
        $campos = $query->fetchAll(PDO::FETCH_COLUMN);
        
        return $campos;
    }

    function getProductosPrecio($precio) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE precio=?');
        $query->execute([$precio]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }

    
}