<?php

namespace Controllers;

use Libs\Session;
use Models\ClienteModel;

class Cliente extends Session
{
  public $model;

  public function __construct($url)
  {
    parent::__construct($url);
    $this->model = new ClienteModel();
  }

  public function render()
  {
    $this->view->render('cliente/index');
  }

  public function list()
  {
    $data = [];
    $clientes = $this->model->getAll();
    if (count($clientes) > 0) {
      foreach ($clientes as $cliente) {
        $botones = "<button class='btn btn-warning edit' idcliente='{$cliente["idCliente"]}'><i class='fas fa-pen'></i></button>";

        $class = ($cliente["estado"] === "1") ? "success" : "danger";
        $text = ($cliente["estado"] === "1") ? "Activo" : "Inactivo";

        $estado = "<span class='badge badge-$class text-uppercase font-weight-bold cursor-pointer'>$text</span>";
        $estado .= "<button class='ml-1 btn btn-info estado' data-idcliente='{$cliente["idCliente"]}' data-estado='{$cliente["estado"]}'><i class='fas fa-sync'></i></button>";

        $data[] = [
          $cliente["idCliente"],
          $cliente["documento"],
          $cliente["nombres"],
          $cliente["email"],
          $cliente["telefono"],
          $cliente["direccion"],
          $estado,
          $botones,
        ];
      }
    }

    $this->response(["data" => $data]);
  }

  public function create()
  {
    if (!$this->existsPOST(['documento','nombres', 'email', 'telefono', 'direccion'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    $this->model->documento = $this->getPost('documento');
    $this->model->nombres = $this->getPost('nombres');
    $this->model->email = $this->getPost('email');
    $this->model->telefono = $this->getPost('telefono');
    $this->model->direccion = $this->getPost('direccion');

    if ($this->model->save()) {
      $this->response(["success" => "cliente registrado"]);
    }
    $this->response(["error" => "Error al registrar cliente"]);
  }

  public function get()
  {
    if (!$this->existsPOST(['idcliente'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    if ($cliente = $this->model->get($this->getPost('idcliente'))) {
      $this->response(["success" => "Cliente encontrado", "cliente" => $cliente]);
    } else {
      $this->response(["error" => "Error al buscar cliente"]);
    }
  }

  public function edit()
  {
    if (!$this->existsPOST(['idcliente','documento', 'nombres', 'email', 'telefono', 'direccion'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    $this->model->idCliente = $this->getPost('idcliente');
    $this->model->documento = $this->getPost('documento');
    $this->model->nombres = $this->getPost('nombres');
    $this->model->email = $this->getPost('email');
    $this->model->telefono = $this->getPost('telefono');
    $this->model->direccion = $this->getPost('direccion');


    if ($this->model->update()) {

      $this->response(["success" => "cliente actualizado"]);
    }

    $this->response(["error" => "Error al actualizar cliente"]);
  }

  public function updateStatus()
  {
    if (!$this->existsPOST(['idcliente', 'estado'])) {
      $this->response(['error' => 'Faltan parametros']);
    }

    $this->model->idCliente = $this->getPost('idcliente');
    $this->model->estado = ($this->getPost('estado') == 0) ? 1 : 0;

    if ($this->model->updateStatus()) {
      $this->response(["success" => "Estado actualizado"]);
    }

    $this->response(["error" => "Error al actualizar estado"]);
  }
}
