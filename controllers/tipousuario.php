<?php

namespace Controllers;

use Libs\Session;
use Models\TipoUsuarioModel;
use Models\VistaModel;

class TipoUsuario extends Session
{
  public $model;
  public function __construct($url)
  {
    parent::__construct($url);
    $this->model = new TipoUsuarioModel();
  }

  public function render()
  {
    $vistas = new VistaModel();

    $this->view->render('tipousuario/index', [
      "vistas" => $vistas->getAll()
    ]);
  }

  public function list()
  {
    $data = [];
    $tipousuarios = $this->model->getAll();
    if (count($tipousuarios) > 0) {
      foreach ($tipousuarios as $tipousuario) {
        $botones = "<button class='btn btn-warning edit' idTipo='{$tipousuario["idTipo"]}'><i class='fas fa-pen'></i></button>";

        $class = ($tipousuario["estado"] === "1") ? "success" : "danger";
        $text = ($tipousuario["estado"] === "1") ? "Activo" : "Inactivo";

        $estado = "<span class='badge badge-$class text-uppercase font-weight-bold cursor-pointer'>$text</span>";
        $estado .= "<button class='ml-1 btn btn-info estado' data-idTipo='{$tipousuario["idTipo"]}' data-estado='{$tipousuario["estado"]}'><i class='fas fa-sync'></i></button>";

        $permisos = "<button class='btn btn-success permisos' data-idTipo='$tipousuario[idTipo]'><i class='fas fa-id-card'></i></button>";

        $data[] = [
          $tipousuario["idTipo"],
          $tipousuario["nombre"],
          $permisos,
          $estado,
          $botones,
        ];
      }
    }

    $this->response(["data" => $data]);
  }

  public function create()
  {
    if (!$this->existsPOST(['nombre'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    $this->model->nombre = $this->getPost('nombre');

    if ($this->model->save()) {
      $this->response(["success" => "tipousuario registrado"]);
    }

    $this->response(["error" => "Error al registrar tipousuario"]);
  }

  public function get()
  {
    if (!$this->existsPOST(['idTipo'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    if ($tipousuario = $this->model->get($this->getPost('idTipo'))) {
      $this->response(["success" => "tipousuario encontrado", "tipousuario" => $tipousuario]);
    } else {
      $this->response(["error" => "Error al buscar tipousuario"]);
    }
  }

  public function edit()
  {
    if (!$this->existsPOST(['idTipo', 'nombre'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    $this->model->idTipo = $this->getPost('idTipo');
    $this->model->nombre = $this->getPost('nombre');

    if ($this->model->update()) {
      $this->response(["success" => "tipousuario actualizado"]);
    }

    $this->response(["error" => "Error al actualizar tipousuario"]);
  }

  public function updateStatus()
  {
    if (!$this->existsPOST(['idTipo', 'estado'])) {
      $this->response(['error' => 'Faltan parametros']);
    }

    $this->model->idTipo = $this->getPost('idTipo');
    $this->model->estado = ($this->getPost('estado') == 0) ? 1 : 0;

    if ($this->model->updateStatus()) {
      $this->response(["success" => "Estado actualizado"]);
    }

    $this->response(["error" => "Error al actualizar estado"]);
  }
}
