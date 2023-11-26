<?php

namespace Controllers;

use Libs\Session;
use Models\UsuarioModel;

class User extends Session
{
  public $model;

  public function __construct($url)
  {
    parent::__construct($url);
    $this->model = new UsuarioModel();
  }

  public function render()
  {
    $this->view->render('user/index');
  }

  public function index()
  {
    $data = [];
    $users = $this->model->getAll();
    if (count($users) > 0) {
      foreach ($users as $user) {
        $botones = "<button class='btn btn-warning edit' id='{$user["id"]}'>Editar</button>";
        $botones .= "<button class='ml-1 btn btn-danger delete' id='{$user["id"]}'>Eliminar</button>";

        $data[] = [
          $user["id"],
          $user["names"],
          $user["email"],
          $user["phone"],
          $botones,
        ];
      }
    }

    $this->response($data);
  }

  public function create()
  {
    if (!$this->existsPOST(['nombres', 'telefono', 'email', 'password'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    $this->model->names = $this->getPost('names');
    $this->model->phone = $this->getPost('phone');
    $this->model->email = $this->getPost('email');
    $this->model->password = password_hash($this->getPost('password'), PASSWORD_DEFAULT, ["cost" => 10]);

    if ($this->model->save()) {
      $this->response(["success" => "user registrado"]);
    }
    $this->response(["error" => "Error al registrar user"]);
  }

  public function get()
  {
    if (!$this->existsPOST(['id'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    if ($user = $this->model->get($this->getPost('id'))) {
      unset($user["password"]);
      $this->response(["success" => "user encontrado", "user" => $user]);
    } else {
      $this->response(["error" => "Error al buscar user"]);
    }
  }

  public function edit()
  {
    if (!$this->existsPOST(['id', 'nombres', 'telefono', 'email'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    $this->model->id = $this->getPost('id');
    $this->model->names = $this->getPost('names');
    $this->model->phone = $this->getPost('phone');
    $this->model->email = $this->getPost('email');

    if ($this->model->update()) {
      if ($this->existsPOST(['password'])) {
        $this->model->password = password_hash($this->getPost('password'), PASSWORD_DEFAULT, ["cost" => 10]);
        $this->model->updatePassword();
      }

      $this->response(["success" => "user actualizado"]);
    }

    $this->response(["error" => "Error al actualizar user"]);
  }

  public function delete()
  {
    if (!$this->existsPOST(['id'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    if ($this->model->delete($this->getPost('id'))) {
      $this->response(["success" => "user eliminado"]);
    }
    $this->response(["error" => "Error al eliminar user"]);
  }
}
