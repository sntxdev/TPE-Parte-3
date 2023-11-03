<?php

class GameControllerApi extends ControllerApi
{
    function __construct()
    {
        parent::__construct();
        $this->model = new GameModel();
    }
    function get($params = [])
    {
        if (empty($params)) {
            $games = $this->model->getListGames();
            return $this->view->response($games, 200);
        } else {
            $game = $this->model->getGame($params[":ID"]);
            if (!empty($game)) {
                return $this->view->response($game, 200);
            } else {
                return $this->view->response($game, 404);
            }
        }
    }
    function create( $params = [] ) 
    {
       $body = $this->getData();

       $categoria = $body->categoriaJuego;
       $nombre = $body->nombreJuego;
       $precio = $body->precio;
       $imagen = $body->imagen;

       if(empty($categoria) || empty($nombre) || empty ($precio) || empty($imagen) )
       {
            $this->view->response("Completa los datos flaquito", 400);

       } else 
        {
            $id = $this->model->addGame($categoria, $nombre, $precio, $imagen);

            //dijo el profe que en una API es buena practica devolver el recurso creado
            $juego = $this->model->getGame($id); 
            $this->view->response($juego,201);
        }
    }
    function update($params = [])
    {
        $id = $params[':ID'];
        $game = $this->model->getGame($id);

        if($game)
        {
            $body = $this->getData();
            $Id_categoria = $body->Id_categoriaJuego;
            $nombre = $body->nombreJuego;
            $precio = $body->precio;
            $imagen = $body->imagen;
            $this->model->updateGame($Id_categoria, $nombre, $precio, $imagen);

            $this->view->response('El juego con id=' . $id. 'ha sido modificado.', 200);
        }   else  
            {
                $this->view->response('El juego con id=' . $id . 'no existe.', 404);
            }
    }
    function delete ($params [])
    {
        $id = $params[':ID'];
        $game = $this->model->getGame($id);

        if($game)
        {
            $this->model->deleteGame($id);
            $this->view->response('El juego con id= ' . $id . 'ha sido eliminado', 200);
        }   else 
            {
                $this->view->response('El juego con id=' . $id . 'no existe', 404); 
            }
    }
}
