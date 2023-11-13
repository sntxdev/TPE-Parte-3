<?php

class GameHandle
{
    function handleGetGames($model, $view, $sortField, $orderDirection, $page, $filter, $condition, $comparison)
    {
        $games = $model->getGames($sortField, $orderDirection, $page, $filter, $condition, $comparison);
        $view->response($games, 200);
    }

    function handleGetGame($model, $view, $params)
    {
        $this->handleGetSingleGame($model, $view, $params);
    }

    function handleGetSingleGame($model, $view, $params)
    {
        $game = $model->getGame($params[':ID']);
        if (!empty($game)) {
            if (!empty($params[':sobrecurso'])) {
                $this->handleSobrecurso($model, $view, $game, $params[':sobrecurso']);
            } else {
                $view->response($game, 200);
            }
        } else {
            $view->response('El juego con id= ' . $params[':ID'] . ' no existe.', 404);
        }
    }

    private function handleSobrecurso($model, $view, $game, $sobrecurso)
    {
        switch ($sobrecurso) {
            case 'nombre':
                $view->response($game->Nombre, 200);
                break;
            case 'precio':
                $view->response($game->Precio, 200);
                break;
            case 'descuento':
                $view->response($game->PrecioDescuento, 200);
                break;
            default:
                $view->response("Dato: '" . $sobrecurso . "' no encontrado.", 404);
                break;
        }
    }
}
