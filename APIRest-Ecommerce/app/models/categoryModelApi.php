<?php
require_once 'modelApi.php';

class CategoryModel extends Model
{
    function getCategories($sortField, $orderDirection)
    {
        $query = $this->db->prepare("SELECT * FROM categorias ORDER BY $sortField $orderDirection");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    function getCategory($id)
    {
        $query = $this->db->prepare("SELECT categorias.*,
            IF(categorias.Cantidad_juegos > 0,
                CONCAT('[', GROUP_CONCAT(
                    JSON_OBJECT(
                        'Id', juegos.Id_juego,
                        'Nombre', juegos.Nombre,
                        'Descripcion', juegos.Descripcion,
                        'Precio', juegos.Precio, 
                        'Descuento', juegos.Descuento,
                        'Precio Descuento', COALESCE(juegos.PrecioDescuento, NULL)
                    )
                ), ']'), NULL
            ) AS juegos
            FROM categorias
            LEFT JOIN juegos ON categorias.Id_categoria = juegos.Id_categoria 
            WHERE categorias.Id_categoria = :id_categoria");
        $query->bindParam(':id_categoria', $id);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_OBJ);
        $result->juegos = empty($result->juegos) ? null : json_decode($result->juegos, true);
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

    function gameCount($id, $sign)
    {
        $query = $this->db->prepare("UPDATE categorias SET Cantidad_juegos = Cantidad_juegos $sign 1 WHERE Id_categoria = :id");
        $query->bindParam(':id', $id);
        $query->execute();
    }
}
