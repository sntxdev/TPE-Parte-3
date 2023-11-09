<?php
require_once 'controllerApi.php';
require_once 'app/models/categoryModelApi.php';

class CategoryControllerApi extends ControllerApi
{
    private $model;

    function __construct()
    {
        parent::__construct();
        $this->model = new CategoryModel();
    }

    function get($params = [])
    {
        if (empty($params)) {
            $categories = $this->model->getCategories();
            return $this->view->response($categories, 200);
        } else {
            $categories = $this->model->getCategory($params[':ID']);
            if (!empty($categories)) {
                return $this->view->response($categories, 200);
            } else {
                return $this->view->response('La categoria con id= ' . $params[':ID'] . ' no existe.', 404);
            }
        }
    }

    function create()
    {
        $body = $this->getData();

        $nombre = $body->Nombre;
        $descripcion = $body->Descripcion;

        if (empty($nombre) || empty($descripcion)) {
            $this->view->response("Completar los datos.", 400);
        } else {
            $id = $this->model->addCategory($nombre, $descripcion);

            $category = $this->model->getCategory($id);
            $this->view->response($category, 201);
        }
    }

    function update($params = [])
    {
        $id = $params[':ID'];
        $category = $this->model->getCategory($id);

        if ($category) {
            $body = $this->getData();
            $nombre = $body->Nombre;
            $descripcion = $body->Descripcion;
            $this->model->updateCategory($id, $nombre, $descripcion);

            $this->view->response('La categoria con id= ' . $id . ' ha sido modificado.', 201);
        } else {
            $this->view->response('La categoria con id= ' . $id . 'no existe.', 404);
        }
    }

    function delete($params = [])
    {
        $id = $params[':ID'];
        $category = $this->model->getCategory($id);

        if ($category) {
            $this->model->deleteCategory($id);
            $this->view->response('La categoria con id= ' . $id . ' ha sido eliminado', 200);
        } else {
            $this->view->response('La categoria con id= ' . $id . ' no existe.', 404);
        }
    }
}
