<?php
require_once 'app/views/viewApi.php';

abstract class ControllerApi
{
    protected $view;
    private $data;

    function __construct()
    {
        $this->view = new ApiView();
        $this->data = file_get_contents('php://input');
    }

    function getData()
    {
        return json_decode($this->data);
    }
}
