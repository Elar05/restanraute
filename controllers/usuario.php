<?php

namespace Controllers;

use Libs\Session;
use Models\TipoUsuarioModel;
use Models\UsuarioModel;

class Usuario extends Session
{
  public $model;

  public function __construct($url)
  {
    parent::__construct($url);
    $this->model = new UsuarioModel();
  }

  public function render()
  {
    $tipos = new TipoUsuarioModel();
    $this->view->render('usuario/index', ["tipos" => $tipos->getAll()]);
  }

  public function list()
  {
    $data = [];
    $users = $this->model->getAll();
    if (count($users) > 0) {
      foreach ($users as $user) {
        $botones = "<button class='btn btn-warning edit' idUsuario='{$user["idUsuario"]}'><i class='fas fa-pen'></i></button>";

        $class = ($user["estado"] === "1") ? "success" : "danger";
        $text = ($user["estado"] === "1") ? "Activo" : "Inactivo";

        $estado = "<span class='badge badge-$class text-uppercase font-weight-bold cursor-pointer'>$text</span>";
        $estado .= "<button class='ml-1 btn btn-info estado' data-idusuario='{$user["idUsuario"]}' data-estado='{$user["estado"]}'><i class='fas fa-sync'></i></button>";

        $data[] = [
          $user["idUsuario"],
          $user["nombres"],
          $user["telefono"],
          $user["email"],
          $user["direccion"],
          $user["idtipo"],
          $estado,
          $botones,
        ];
      }
    }

    $this->response(["data" => $data]);
  }

  public function create()
  {
    if (!$this->existsPOST(['tipo', 'nombres', 'email', 'password', 'telefono', 'direccion'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    if (!preg_match("/^[0-9]+$/", $_POST['telefono'])) {
      $this->response(["error" => "Documento o télefono deben ser números"]);
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $this->response(["error" => "Ingrese un email valido"]);
    }

    if (!preg_match("/^[a-zA-Z ]+$/", $_POST['nombres'])) {
      $this->response(["error" => "Nombre debe ser letras"]);
    }

    if (!preg_match("/^[a-zA-Z0-9.-_ ]+$/", $_POST['direccion'])) {
      $this->response(["error" => "Dirección debe ser: letras, números y . - _"]);
    }

    $this->model->idtipo = $this->getPost('tipo');
    $this->model->nombres = $this->getPost('nombres');
    $this->model->email = $this->getPost('email');
    $this->model->password = password_hash($this->getPost('password'), PASSWORD_DEFAULT, ["cost" => 10]);
    $this->model->telefono = $this->getPost('telefono');
    $this->model->direccion = $this->getPost('direccion');

    if ($this->model->save()) {
      $this->response(["success" => "user registrado"]);
    }
    $this->response(["error" => "Error al registrar user"]);
  }

  public function get()
  {
    if (!$this->existsPOST(['idUsuario'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    if ($user = $this->model->get($this->getPost('idUsuario'))) {
      unset($user["password"]);
      $this->response(["success" => "user encontrado", "user" => $user]);
    } else {
      $this->response(["error" => "Error al buscar user"]);
    }
  }

  public function edit()
  {
    if (!$this->existsPOST(['idUsuario', 'tipo', 'nombres', 'email', 'telefono'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    if (!preg_match("/^[0-9]+$/", $_POST['telefono'])) {
      $this->response(["error" => "Documento o télefono deben ser números"]);
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $this->response(["error" => "Ingrese un email valido"]);
    }

    if (!preg_match("/^[a-zA-Z ]+$/", $_POST['nombres'])) {
      $this->response(["error" => "Nombre debe ser letras"]);
    }

    if (!preg_match("/^[a-zA-Z0-9.-_ ]+$/", $_POST['direccion'])) {
      $this->response(["error" => "Dirección debe ser: letras, números y . - _"]);
    }

    $this->model->idUsuario = $this->getPost('idUsuario');
    $this->model->idtipo = $this->getPost('tipo');
    $this->model->nombres = $this->getPost('nombres');
    $this->model->telefono = $this->getPost('telefono');
    $this->model->email = $this->getPost('email');
    $this->model->direccion = $this->getPost('direccion');

    if ($this->model->update()) {
      if ($this->existsPOST(['password'])) {
        $this->model->password = password_hash($this->getPost('password'), PASSWORD_DEFAULT, ["cost" => 10]);
        $this->model->updatePassword();
      }

      $this->response(["success" => "user actualizado"]);
    }

    $this->response(["error" => "Error al actualizar user"]);
  }

  public function updateStatus()
  {
    if (!$this->existsPOST(['idUsuario', 'estado'])) {
      $this->response(['error' => 'Faltan parametros']);
    }

    $this->model->idUsuario = $this->getPost('idUsuario');
    $this->model->estado = ($this->getPost('estado') == 0) ? 1 : 0;

    if ($this->model->updateStatus()) {
      $this->response(["success" => "Estado actualizado"]);
    }

    $this->response(["error" => "Error al actualizar estado"]);
  }
}
