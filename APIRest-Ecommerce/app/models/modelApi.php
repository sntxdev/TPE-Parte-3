<?php
require_once './config.php';

class Model
{
  protected $db;

  function __construct()
  {
    $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
  }
}
