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
}
