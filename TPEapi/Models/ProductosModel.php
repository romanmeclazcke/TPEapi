<?php
require_once "Model.php";

class ProductosModel extends Model {

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

    function getProductosPorCategoria($idCategoria) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE categoria=?');
        $query->execute([$idCategoria]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }

    function addProducto($nombre, $material, $precio, $imagen, $categoria) {
        $query = $this->db->prepare('INSERT INTO productos (nombre, material, precio, imagen, categoria) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$nombre, $material, $precio, $imagen, $categoria]);

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