<?php

namespace Controllers;

use Libs\Session;
use Models\CategoriaModel;
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
    $categorias = new CategoriaModel();
    $this->view->render('item/index', [
      "categorias" => $categorias->getAll()
    ]);
  }

  public function list()
  {
    $filtro = $_POST['filtro'] ?? '';

    $data = [];
    $items = $this->model->getAll();
    if (count($items) > 0) {
      foreach ($items as $item) {
        if ($filtro === "") {
          $botones = "<button class='btn btn-warning edit' idItem='{$item["idItem"]}'><i class='fas fa-pen'></i></button>";
          $botones .= "<button class='btn btn-info img' foto='{$item["foto"]}'><i class='fas fa-link'></i></button>";

          $class = ($item["estado"] === "1") ? "success" : "danger";
          $text = ($item["estado"] === "1") ? "Activo" : "Inactivo";

          $estado = "<span class='badge badge-$class text-uppercase font-weight-bold cursor-pointer'>$text</span>";
          $estado .= "<button class='ml-1 btn btn-info estado' data-idItem='{$item["idItem"]}' data-estado='{$item["estado"]}'><i class='fas fa-sync'></i></button>";

          $data[] = [
            $item["idItem"],
            $item["categoria"],
            $item["tipo"],
            $item["precio_c"],
            $item["precio_v"],
            $item["stock"],
            $item["stock_min"],
            $item["descripcion"],
            $estado,
            $botones,
          ];
        } else {
          $botones = "<button class='btn btn-success item' idItem='{$item["idItem"]}' stock='{$item["stock"]}' precio='{$item["precio_v"]}' descripcion='{$item["descripcion"]}'><i class='fas fa-plus'></i></button>";

          $data[] = [
            $item["descripcion"],
            $item["categoria"],
            $item["stock"],
            $item["precio_v"],
            $botones,
          ];
        }
      }
    }

    $this->response(["data" => $data]);
  }

  public function create()
  {
    if (!$this->existsPOST(['idcategoria', 'tipo', 'precio_c', 'precio_v', 'stock', 'stock_min', 'descripcion'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    if (!is_numeric($_POST['precio_c']) || !is_numeric($_POST['precio_v'])) {
      $this->response(["error" => "Precio Venta y Compra debe ser número y/o decimales"]);
    }

    if (!preg_match("/^[0-9]+$/", $_POST['stock']) || !preg_match("/^[0-9]+$/", $_POST['stock_min'])) {
      $this->response(["error" => "Stock debe ser número"]);
    }

    if (!preg_match("/^[a-zA-Z0-9 ]+$/", $_POST['descripcion'])) {
      $this->response(["error" => "Descripción debe ser: letras, y/o números"]);
    }

    $urlFoto = "";
    if (!empty($_FILES["foto"]['name'])) {
      $foto = $_FILES["foto"];

      $types = ["jpg", "png", "webp", "jpeg"];
      $type = pathinfo($foto["name"], PATHINFO_EXTENSION);

      if (!in_array($type, $types))
        $this->response(["error" => "El formato de la imagen no es valida."]);

      $folder = "public/img/productos/";
      if (!file_exists($folder))
        mkdir($folder, 0777, true);

      $urlFoto = $folder . str_replace(" ", "", $foto['name']) . ".$type";
      move_uploaded_file($foto['tmp_name'], $urlFoto);
    }

    $this->model->idcategoria = $this->getPost('idcategoria');
    $this->model->tipo = $this->getPost('tipo');
    $this->model->precio_c = $this->getPost('precio_c');
    $this->model->precio_v = $this->getPost('precio_v');
    $this->model->stock = $this->getPost('stock');
    $this->model->stock_min = $this->getPost('stock_min');
    $this->model->descripcion = $this->getPost('descripcion');
    $this->model->foto = $urlFoto;

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
      $this->response(["success" => "Item encontrado", "item" => $item]);
    } else {
      $this->response(["error" => "Error al buscar el Item"]);
    }
  }

  public function edit()
  {
    if (!$this->existsPOST(['idItem', 'idcategoria', 'tipo', 'precio_c', 'precio_v', 'stock', 'stock_min', 'descripcion'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    if (!is_numeric($_POST['precio_c']) || !is_numeric($_POST['precio_v'])) {
      $this->response(["error" => "Precio Venta y Compra debe ser número y/o decimales"]);
    }

    if (!preg_match("/^[0-9]+$/", $_POST['stock']) || !preg_match("/^[0-9]+$/", $_POST['stock_min'])) {
      $this->response(["error" => "Stock debe ser número"]);
    }

    if (!preg_match("/^[a-zA-Z0-9 ]+$/", $_POST['descripcion'])) {
      $this->response(["error" => "Descripción debe ser: letras, y/o números"]);
    }

    $urlFoto = $this->getPost('urlfoto');
    if (!empty($_FILES["foto"]['name'])) {
      $foto = $_FILES["foto"];

      $types = ["jpg", "png", "webp", "jpeg"];
      $type = pathinfo($foto["name"], PATHINFO_EXTENSION);

      if (!in_array($type, $types))
        $this->response(["error" => "El formato de la imagen no es valida."]);

      $folder = "public/img/productos/";
      if (!file_exists($folder))
        mkdir($folder, 0777, true);

      $urlFoto = $folder . str_replace(" ", "", $foto['name']) . ".$type";
      move_uploaded_file($foto['tmp_name'], $urlFoto);
    }

    $this->model->idItem = $this->getPost('idItem');
    $this->model->tipo = $this->getPost('tipo');
    $this->model->idcategoria = $this->getPost('idcategoria');
    $this->model->precio_c = $this->getPost('precio_c');
    $this->model->precio_v = $this->getPost('precio_v');
    $this->model->stock = $this->getPost('stock_min');
    $this->model->descripcion = $this->getPost('descripcion');
    $this->model->foto = $urlFoto;

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
