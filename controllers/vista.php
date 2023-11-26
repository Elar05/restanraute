<?php

namespace Controllers;

use Libs\Session;
use Models\VistaModel;

class Vista extends Session
{
  public $model;

  public function __construct($url)
  {
    parent::__construct($url);
    $this->model = new VistaModel();
  }

  public function render()
  {
    $this->view->render('vista/index');
  }

  public function list()
  {
    $data = [];
    $vistas = $this->model->getAll();
    if (count($vistas) > 0) {
      foreach ($vistas as $vista) {
        $botones = "<button class='btn btn-warning edit' id='{$vista["id"]}'><i class='fas fa-pen'></i></button>";
        $botones .= "<button class='btn btn-danger delete' id='{$vista["id"]}'><i class='fas fa-times'></i></button>";

        $data[] = [
          $vista["id"],
          $vista["nombre"],
          $botones,
        ];
      }
    }

    $this->response(["data" => $data]);
  }

  public function get()
  {
    if (!$this->existsPOST(['id'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    if ($vista = $this->model->get($this->getPost('id'))) {
      $this->response(["success" => "vista encontrado", "vista" => $vista]);
    } else {
      $this->response(["error" => "Error al buscar vista"]);
    }
  }

  public function create()
  {
    // Validar que no este vacio
    if (!$this->existsPOST(['nombre'])) {
      $this->response(['error' => 'Faltan parametros']);
    }

    $nombre = $this->getPost('nombre');

    // Validar existencia
    if ($this->model->get($nombre, 'nombre')) {
      $this->response(['error' => 'Ya existe la vista']);
    }

    // Guardar
    $this->model->nombre = $nombre;
    if ($this->model->save()) {
      $this->response(['success' => 'Se guardo la vista']);
    }
    $this->response(['error' => 'Error al guardar la vista']);
  }

  public function edit()
  {
    if (!$this->existsPOST(['id', 'nombre'])) {
      $this->response(['error' => 'Faltan parametros']);
    }

    $this->model->id = $this->getPost('id');
    $this->model->nombre = $this->getPost('nombre');

    if ($this->model->update()) {
      $this->response(['success' => 'Vista actualizada']);
    }

    $this->response(['error' => 'Faltan parametros']);
  }

  public function delete()
  {
    if (!$this->existsPOST(['id'])) {
      $this->response(['error' => 'Faltan parametros']);
    }

    $this->model->id = $this->getPost('id');
    if ($this->model->delete()) {
      $this->response(['success' => 'Vista actualizada']);
    }

    $this->response(['error' => 'Faltan parametros']);
  }
}
