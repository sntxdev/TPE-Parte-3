<?php
require_once 'modelApi.php';

class CategoryModel extends Model
{
    function getCategories()
    {
        $sortField = isset($_GET['sort']) ? $_GET['sort'] : 'Id_categoria';
        $orderDirection = isset($_GET['order']) ? $_GET['order'] : 'asc';

        $query = $this->db->prepare("SELECT * FROM categorias ORDER BY $sortField $orderDirection");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    function getCategory($id)
    {
        $query = $this->db->prepare("SELECT * FROM categorias WHERE Id_categoria = :id_categoria");
        $query->bindParam(':id_categoria', $id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    function addCategory($nombre, $descripcion)
    {
        $query = $this->db->prepare("INSERT INTO categorias (Nombre, Descripcion) VALUES (:nombre, :descripcion)");
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':descripcion', $descripcion);
        $query->execute();

        return $this->db->lastInsertId();
    }

    function updateCategory($id, $nombre, $descripcion)
    {
        $query = $this->db->prepare("UPDATE categorias SET Nombre = :nombre, Descripcion = :descripcion WHERE Id_categoria = :id");
        $query->bindParam(':id', $id);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':descripcion', $descripcion);
        $query->execute();
    }

    function deleteCategory($id)
    {
        $query = $this->db->prepare("DELETE FROM categorias WHERE Id_categoria = :id");
        $query->bindParam(':id', $id);
        $query->execute();
    }
}
