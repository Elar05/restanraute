<?php

namespace Controllers;

use Libs\Session;
use Models\CategoriaModel;

class Categoria extends Session
{
  public $model;
  public function __construct($url)
  {
    parent::__construct($url);
    $this->model = new CategoriaModel();
  }
  public function render()
  {
    $this->view->render('categoria/index');
  }

  public function list()
  {
    $data = [];
    $categorias = $this->model->getAll();
    if (count($categorias) > 0) {
      foreach ($categorias as $categoria) {
        $botones = "<button class='btn btn-warning edit' idcategoria='{$categoria["idCategoria"]}'><i class='fas fa-pen'></i></button>";

        $class = ($categoria["estado"] === "1") ? "success" : "danger";
        $text = ($categoria["estado"] === "1") ? "Activo" : "Inactivo";

        $estado = "<span class='badge badge-$class text-uppercase font-weight-bold cursor-pointer'>$text</span>";
        $estado .= "<button class='ml-1 btn btn-info estado' data-idcategoria='{$categoria["idCategoria"]}' data-estado='{$categoria["estado"]}'><i class='fas fa-sync'></i></button>";

        $data[] = [
          $categoria["idCategoria"],
          $categoria["nombre"],

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

    if (!preg_match("/^[a-zA-Z ]+$/", $_POST['nombre'])) {
      $this->response(["error" => "La categoria debe ser letras"]);
    }

    $this->model->nombre = $this->getPost('nombre');

    if ($this->model->save()) {
      $this->response(["success" => "categoria registrado"]);
    }
    $this->response(["error" => "Error al registrar categoria"]);
  }

  public function get()
  {
    if (!$this->existsPOST(['idcategoria'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    if ($categoria = $this->model->get($this->getPost('idcategoria'))) {
      $this->response(["success" => "categoria encontrado", "categoria" => $categoria]);
    } else {
      $this->response(["error" => "Error al buscar categoria"]);
    }
  }

  public function edit()
  {
    if (!$this->existsPOST(['idcategoria', 'nombre'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    if (!preg_match("/^[a-zA-Z ]+$/", $_POST['nombre'])) {
      $this->response(["error" => "La categoria debe ser letras"]);
    }

    $this->model->idCategoria = $this->getPost('idcategoria');

    $this->model->nombre = $this->getPost('nombre');

    if ($this->model->update()) {
      $this->response(["success" => "categoria actualizado"]);
    }

    $this->response(["error" => "Error al actualizar categoria"]);
  }

  public function updateStatus()
  {
    if (!$this->existsPOST(['idcategoria', 'estado'])) {
      $this->response(['error' => 'Faltan parametros']);
    }

    $this->model->idCategoria = $this->getPost('idcategoria');
    $this->model->estado = ($this->getPost('estado') == 0) ? 1 : 0;

    if ($this->model->updateStatus()) {
      $this->response(["success" => "Estado actualizado"]);
    }

    $this->response(["error" => "Error al actualizar estado"]);
  }
}
