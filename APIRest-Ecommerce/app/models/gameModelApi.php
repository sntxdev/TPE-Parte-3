<?php

class GameModel extends Model
{
    function getListGames()
    {
            $query = $this->db->prepare("SELECT juegos.*, categorias.Nombre AS Categoria FROM juegos JOIN categorias ON juegos.Id_categoria = categorias.Id_categoria GROUP BY juegos.Id_juego ASC");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            
            return $result;
    }

    function getGame($id)
    {
        $query = $this->db->prepare("SELECT FROM juegos WHERE Id_juego = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        
        return $result;
    }
    function addGame($categoriaJuego, $nombreJuego, $precio, $imagen)
    {
        $query = $this->db->prepare("INSERT INTO juegos (Id_categoria, Nombre, Precio, Imagen) VALUES (:id_categoria, :nombre, :precio, :imagen)");
        $query->bindParam(':id_categoria', $categoriaJuego);
        $query->bindParam(':nombre', $nombreJuego);
        $query->bindParam(':precio', $precio);
        $query->bindParam(':imagen', $imagen);
        $query->execute();
        
        
        return $query->lastInsertId();
    }
    function updateGame($id, $Id_categoriaJuego, $nombreJuego, $precio, $imagen)
    {
        try{
            $query = $this->db->prepare("UPDATE juegos SET (Id_categoria, Nombre, Precio, Imagen) VALUES (:id_categoria, :nombre, :precio, :imagen) WHERE Id_juego = :id" );
            $query->bindParam(':id_categoria', $Id_categoriaJuego);
            $query->bindParam(':nombre', $nombreJuego);
            $query->bindParam(':precio', $precio);
            $query->bindParam(':imagen', $imagen);
            $query->execute();

            return true;
        }catch (PDOException $e)
        {
            return false;
        }
    }
}
