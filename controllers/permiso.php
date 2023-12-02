<?php

namespace Controllers;

use Libs\Session;
use Models\PermisoModel;

class Permiso extends Session
{
  public $model;

  public function __construct($url)
  {
    parent::__construct($url);
    $this->model = new PermisoModel();
  }

  public function get()
  {
    if (!$this->existsPOST(['idTipo'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    $data = [];
    $permisos = $this->model->getAll($this->getPost('idTipo'));

    if (count($permisos) > 0) {
      foreach ($permisos as $permiso) {
        $data[] = $permiso['idvista'];
      }
    }

    $this->response(["permisos" => $data]);
  }

  public function store()
  {
    if (!$this->existsPOST(['idTipo', 'vista'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    if ($permiso = $this->model->get($_POST['vista'], $_POST['idTipo'])) {
      $this->model->delete($_POST['vista'], $_POST['idTipo']);
      $this->response(["success" => "Permiso eliminado"]);
    } else {
      $this->model->save($_POST['vista'], $_POST['idTipo']);
      $this->response(["success" => "Permiso agregado"]);
    }
  }
}
