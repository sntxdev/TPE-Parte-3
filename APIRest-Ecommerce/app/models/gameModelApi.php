<?php

require_once 'modelApi.php';

class GameModel extends Model
{
    function getGames()
    {
        $sortField = isset($_GET['sort']) ? $_GET['sort'] : 'Id_juego';
        $orderDirection = isset($_GET['order']) ? $_GET['order'] : 'asc';

        $query = $this->db->prepare("SELECT juegos.*, categorias.Nombre AS Categoria FROM juegos JOIN categorias ON juegos.Id_categoria = categorias.Id_categoria ORDER BY $sortField $orderDirection");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        return $result;
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

    function updateGame($id, $categoriaJuego, $nombreJuego, $descripcion, $precio, $imagen)
    {
        $query = $this->db->prepare("UPDATE juegos SET Id_categoria = :id_categoria, Nombre = :nombre, Descripcion = :descripcion, Precio = :precio,  Imagen = :imagen WHERE Id_juego = :id");
        $query->bindParam(':id', $id);
        $query->bindParam(':id_categoria', $categoriaJuego);
        $query->bindParam(':nombre', $nombreJuego);
        $query->bindParam(':descripcion', $descripcion);
        $query->bindParam(':precio', $precio);
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
