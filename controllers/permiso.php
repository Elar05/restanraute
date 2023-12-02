<?php

namespace Controllers;

use Libs\Session;

class Permiso extends Session
{
  public $model;

  public function __construct($url)
  {
    parent::__construct($url);
    // $this->model = new 
  }

  public function get()
  {
    if (empty($_POST['id'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    $data = [];
    $permisos = $this->model->getAll($_POST['id']);

    if (count($permisos) > 0) {
      foreach ($permisos as $permiso) {
        $data[] = $permiso['idvista'];
      }
    }

    $this->response(["permisos" => $data]);
  }

  public function store()
  {
    if (empty($_POST['vista']) || empty($_POST['tipo'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    $permiso = $this->model->get($_POST['vista'], $_POST['tipo']);

    if ($permiso) {
      $this->model->delete($_POST['vista'], $_POST['tipo']);
      $this->response(["success" => "Permiso eliminado"]);
    } else {
      $this->model->save($_POST['vista'], $_POST['tipo']);
      $this->response(["success" => "Permiso agregado"]);
    }
  }
}
