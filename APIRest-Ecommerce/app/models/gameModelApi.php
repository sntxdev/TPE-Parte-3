<?php

require_once 'modelApi.php';

class GameModel extends Model
{
    function getGames()
    {
        $sortField = $_GET['sort'] ?? 'id_juego';
        $orderDirection = $_GET['order'] ?? 'asc';
        $filter = $_GET['filter'] ?? '';
        $condition = $_GET['condition'] ?? '0';
        $comparison = $_GET['comparison'] ?? 'equal';
        $page = $_GET['page'] ?? '';
        $offers = $_GET['offers'] ?? '';

        if (!empty($page)) {
            return $this->gameFunctions->getGamesByPage($sortField, $orderDirection, $page);
        }

        if (!empty($filter) && !empty($condition)) {
            return $this->gameFunctions->getGamesByFilter($sortField, $orderDirection, $filter, $condition, $comparison);
        }

        return $this->gameFunctions->getAllGames($sortField, $orderDirection);
    }

    function getGame($id)
    {
        $query = $this->db->prepare("SELECT * FROM juegos WHERE Id_juego = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    function addGame($categoriaJuego, $nombreJuego, $descripcion, $precio, $imagen)
    {
        $query = $this->db->prepare("INSERT INTO juegos (Id_categoria, Nombre, Descripcion, Precio, Imagen) VALUES (:id_categoria, :nombre, :descripcion, :precio, :imagen)");
        $query->bindParam(':id_categoria', $categoriaJuego);
        $query->bindParam(':nombre', $nombreJuego);
        $query->bindParam(':descripcion', $descripcion);
        $query->bindParam(':precio', $precio);
        $query->bindParam(':imagen', $imagen);
        $query->execute();


        return $this->db->lastInsertId();
    }

    function updateGame($id, $categoriaJuego, $nombreJuego, $descripcion, $precio, $descuento, $imagen)
    {
        $query = $this->db->prepare("UPDATE juegos SET Id_categoria = :id_categoria, Nombre = :nombre, Descripcion = :descripcion, Precio = :precio, Descuento = :descuento, Imagen = :imagen WHERE Id_juego = :id");
        $query->bindParam(':id', $id);
        $query->bindParam(':id_categoria', $categoriaJuego);
        $query->bindParam(':nombre', $nombreJuego);
        $query->bindParam(':descripcion', $descripcion);
        $query->bindParam(':precio', $precio);
        $query->bindParam(':descuento', $descuento);
        $query->bindParam(':imagen', $imagen);
        $query->execute();
    }

    function deleteGame($id)
    {
        $query = $this->db->prepare("DELETE FROM juegos WHERE Id_juego = :id");
        $query->bindParam(':id', $id);
        $query->execute();
    }
}
