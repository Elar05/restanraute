<?php

namespace Controllers;

use Libs\Session;
use Models\ItemModel;

class Item extends Session
{
  public $model;

  public function __construct($url)
  {
    parent::__construct($url);
    $this->model = new ItemModel();
  }

  public function render()
  {
    $this->view->render('item/index');
    
  }

  public function list()
  {
    $data = [];
    $items = $this->model->getAll();
    if (count($items) > 0) {
      foreach ($items as $item) {
        $botones = "<button class='btn btn-warning edit' idItem='{$item["idItem"]}'><i class='fas fa-pen'></i></button>";

        $class = ($item["estado"] === "1") ? "success" : "danger";
        $text = ($item["estado"] === "1") ? "Activo" : "Inactivo";

        $estado = "<span class='badge badge-$class text-uppercase font-weight-bold cursor-pointer'>$text</span>";
        $estado .= "<button class='ml-1 btn btn-info estado' data-idItem='{$item["idItem"]}' data-estado='{$item["estado"]}'><i class='fas fa-sync'></i></button>";

        $data[] = [
          $item["idItem"],
          $item["idcategoria"],
          $item["tipo"],
          $item["precio_c"],
          $item["precio_v"],
          $item["stock"],
          $item["stock_min"],
          $estado,
          $botones,
        ];
      }
    }

    $this->response(["data" => $data]);
  }

  public function create()
  {
    if (!$this->existsPOST(['idCategoria', 'tipo', 'precio_c', 'precio_v', 'stock', 'stock_min', 'foto', 'descripcion'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    $this->model->idCategoria = $this->getPost('idCategoria');
    $this->model->tipo = $this->getPost('tipo');
    $this->model->precio_c = $this->getPost('precio_c');
    $this->model->precio_v = $this->getPost('precio_v');
    $this->model->stock = $this->getPost('stock');
    $this->model->stock_min = $this->getPost('stock_min');
    $this->model->foto = $this->getPost('foto');
    $this->model->estado = $this->getPost('estado');

    if ($this->model->save()) {
      $this->response(["success" => "Item registrado"]);
    }
    $this->response(["error" => "Error al registrar item"]);
  }

  public function get()
  {
    if (!$this->existsPOST(['idItem'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    if ($item = $this->model->get($this->getPost('idItem'))) {
      $this->response(["success" => "Item encontrado", "Item" => $item]);
    } else {
      $this->response(["error" => "Error al buscar el Item"]);
    }
  }

  public function edit()
  {
    if (!$this->existsPOST(['idItem','idCategoria', 'tipo', 'precio_c', 'precio_v', 'stock', 'stock_min', 'descripcion'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    $this->model->idItem = $this->getPost('idItem');
    $this->model->idCategoria = $this->getPost('idCategoria');
    $this->model->tipo = $this->getPost('tipo');
    $this->model->precio_c = $this->getPost('precio_c');
    $this->model->precio_v = $this->getPost('precio_v');
    $this->model->stock = $this->getPost('stock_min');
    $this->model->stock = $this->getPost('descripcion');

    if ($this->model->update()) {
      $this->response(["success" => "Item actualizado"]);
    }

    $this->response(["error" => "Error al actualizar Item"]);
  }

  public function updateStatus()
  {
    if (!$this->existsPOST(['idItem', 'estado'])) {
      $this->response(['error' => 'Faltan parametros']);
    }

    $this->model->idItem = $this->getPost('idItem');
    $this->model->estado = ($this->getPost('estado') == 0) ? 1 : 0;

    if ($this->model->updateStatus()) {
      $this->response(["success" => "Estado actualizado"]);
    }

    $this->response(["error" => "Error al actualizar estado"]);
  }
}