<?php

require_once 'modelApi.php';

class GameModel extends Model
{
    function getGames($sortField, $orderDirection, $page, $filter, $condition, $comparison)
    {
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

    function getOffers($sortField, $orderDirection)
    {
        $query = $this->db->prepare("SELECT juegos.*, categorias.Nombre AS Categoria FROM juegos JOIN categorias ON juegos.Id_categoria = categorias.Id_categoria WHERE Descuento > 0 ORDER BY $sortField $orderDirection");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
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

        $categoryModel = new CategoryModel();
        $categoryModel->gameCount($categoriaJuego, '+');

        return $this->db->lastInsertId();
    }

    function updateGame($id, $categoriaJuego, $nombreJuego, $descripcion, $precio, $descuento, $precioDescuento, $imagen)
    {
        $query = $this->db->prepare("UPDATE juegos SET Id_categoria = :id_categoria, Nombre = :nombre, Descripcion = :descripcion, Precio = :precio, Descuento = :descuento, PrecioDescuento = :precioDescuento, Imagen = :imagen WHERE Id_juego = :id");
        $query->bindParam(':id', $id);
        $query->bindParam(':id_categoria', $categoriaJuego);
        $query->bindParam(':nombre', $nombreJuego);
        $query->bindParam(':descripcion', $descripcion);
        $query->bindParam(':precio', $precio);
        $query->bindParam(':descuento', $descuento);
        $query->bindParam(':precioDescuento', $precioDescuento);
        $query->bindParam(':imagen', $imagen);
        $query->execute();
    }

    function deleteGame($id)
    {
        $query = $this->db->prepare("SELECT Id_categoria FROM juegos WHERE Id_juego = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        $query = $this->db->prepare("DELETE FROM juegos WHERE Id_juego = :id");
        $query->bindParam(':id', $id);
        $query->execute();

        if ($result) {
            $categoryId = $result->Id_categoria;
            $categoryModel = new CategoryModel();
            $categoryModel->gameCount($categoryId, '-');
        }
    }
}
