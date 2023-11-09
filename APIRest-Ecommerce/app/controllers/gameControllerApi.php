<?php
require_once 'controllerApi.php';
require_once 'app/models/gameModelApi.php';

class GameControllerApi extends ControllerApi
{
    private $model;

    function __construct()
    {
        parent::__construct();
        $this->model = new GameModel();
    }

    function get($params = [])
    {
        if (empty($params)) {
            $games = $this->model->getGames();
            return $this->view->response($games, 200);
        } else {
            $game = $this->model->getGame($params[":ID"]);
            if (!empty($game)) {
                return $this->view->response($game, 200);
            } else {
                return $this->view->response('El juego con id= ' . $params[':ID'] . ' no existe.', 404);
            }
        }
    }

    function create()
    {
        $body = $this->getData();

        $categoria = $body->Id_categoria;
        $nombre = $body->Nombre;
        $descripcion = $body->Descripcion;
        $precio = $body->Precio;
        $imagen = $body->Imagen;

        if (empty($categoria) || empty($nombre) || empty($precio) || empty($imagen)) {
            $this->view->response("Completa los datos flaquito", 400);
        } else {
            $id = $this->model->addGame($categoria, $nombre, $descripcion, $precio, $imagen);

            //dijo el profe que en una API es buena practica devolver el recurso creado
            $juego = $this->model->getGame($id);
            $this->view->response($juego, 201);
        }
    }

    function update($params = [])
    {
        $id = $params[':ID'];
        $game = $this->model->getGame($id);

        if ($game) {
            $body = $this->getData();
            $categoria = $body->Id_categoria;
            $nombre = $body->Nombre;
            $descripcion = $body->Descripcion;
            $precio = $body->Precio;
            $descuento = $body->Descuento;
            $imagen = $body->Imagen;
            $this->model->updateGame($id, $categoria, $nombre, $descripcion, $precio, $descuento, $imagen);

            $this->view->response('El juego con id= ' . $id . ' ha sido modificado.', 201);
        } else {
            $this->view->response('El juego con id= ' . $id . ' no existe.', 404);
        }
    }

    function delete($params = [])
    {
        $id = $params[':ID'];
        $game = $this->model->getGame($id);

        if ($game) {
            $this->model->deleteGame($id);
            $this->view->response('El juego con id= ' . $id . ' ha sido eliminado', 200);
        } else {
            $this->view->response('El juego con id= ' . $id . ' no existe', 404);
        }
    }
}
