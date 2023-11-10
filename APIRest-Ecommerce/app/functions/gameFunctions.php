<?php

class GameFunctions
{
    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    function getAllGames($sortField, $orderDirection)
    {
        $query = $this->db->prepare("SELECT juegos.*, categorias.Nombre AS Categoria FROM juegos JOIN categorias ON juegos.Id_categoria = categorias.Id_categoria ORDER BY $sortField $orderDirection");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getAllGamesOffer($sortField, $orderDirection)
    {
        $query = $this->db->prepare("SELECT juegos.*, categorias.Nombre AS Categoria FROM juegos JOIN categorias ON juegos.Id_categoria = categorias.Id_categoria WHERE Descuento > 0 ORDER BY $sortField $orderDirection");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getGamesByPage($sortField, $orderDirection, $page)
    {
        $perPage = 3;
        $range = ($page - 1) * $perPage;
        $query = $this->db->prepare("SELECT * FROM juegos ORDER BY $sortField $orderDirection LIMIT $range, $perPage");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getGamesByFilter($sortField, $orderDirection, $filter, $condition, $comparison)
    {
        $operator = ($filter === 'precio' || $filter === 'descuento') ? $this->getComparisonOperator($comparison) : 'LIKE';
        $query = $this->db->prepare("SELECT * FROM juegos WHERE $filter $operator :condition ORDER BY $sortField $orderDirection");
        $condition = '%' . $condition . '%';
        $query->bindParam(':condition', $condition);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getComparisonOperator($comparison)
    {
        return ($comparison === 'greater') ? '>' : (($comparison === 'less') ? '<' : '=');
    }
}
