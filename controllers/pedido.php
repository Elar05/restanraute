<?php

namespace Controllers;

use Libs\Session;
use Models\ClienteModel;
use Models\DetalleModel;
use Models\PedidoModel;

class Pedido extends Session
{
  public $model;

  public function __construct($url)
  {
    parent::__construct($url);
    $this->model = new PedidoModel();
  }

  public function render()
  {
    $this->view->render('pedido/index');
  }

  public function nuevo()
  {
    $this->view->render('pedido/nuevo');
  }

  public function list()
  {
    $data = [];
    $items = $this->model->getAll();
    if (count($items) > 0) {
      foreach ($items as $item) {
        $botones = "<button class='btn btn-warning edit' idPedido='{$item["idPedido"]}'><i class='fas fa-pen'></i></button>";

        $arrEstado = [
          "0" => [
            "class" => "info", "text" => "En espera",
            "acciones" => "
              <button class='dropdown-item estado' id='{$item["id"]}' estado='1'><i class='fas fa-spinner text-warning'></i> En proceso</button>
              <button class='dropdown-item estado' id='{$item["id"]}' estado='3'><i class='fas fa-times text-danger'></i> Cancelar</button>
            "
          ],
          "1" => [
            "class" => "warning", "text" => "En proceso",
            "acciones" => "
              <button class='dropdown-item terminar' id='{$item["id"]}' iddoc='{$item["iddoc"]}'><i class='fas fa-check text-success'></i> Terminado</button>
              <button class='dropdown-item estado' id='{$item["id"]}' estado='3'><i class='fas fa-times text-danger'></i> Cancelar</button>
            "
          ],
          "2" => ["class" => "success", "text" => "Terminado", "acciones" => "<button class='dropdown-item informacion' id='{$item["id"]}'><i class='fas fa-info text-info'></i> Informacion</button>"],
          "3" => ["class" => "danger", "text" => "Cancelado", "acciones" => ""],
        ];

        $estado = $item["estado"];
        $class = $arrEstado[$estado]["class"];
        $txt = $arrEstado[$estado]["text"];
        $acciones = $arrEstado[$estado]["acciones"];

        $estado = "<div class='btn-group dropleft'>
          <button type='button' class='btn btn-$class dropdown-toggle font-14' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>$txt</button>
          <div class='dropdown-menu dropleft'>
            $acciones
          </div>
        </div>";

        $data[] = [
          $item["idPedido"],
          $item["idcliente"],
          $item["idusuario"],
          $item["tipo"],
          $item["total"],
          $estado,
          $botones,
        ];
      }
    }

    $this->response(["data" => $data]);
  }

  public function create()
  {
    if (!$this->existsPOST(['tipo', 'documento', 'nombres', 'telefono', 'email', 'subtotal', 'igv', 'total', 'items'])) {
      $this->response(['error' => 'Faltan Parametros']);
    }

    // Guardar cliente si no existe
    $clienteModel = new ClienteModel();
    $cliente = $clienteModel->get($_POST['documento'], 'documento');
    if (empty($cliente)) {
      // $clienteModel->documento = $_POST['documento'];
      $clienteModel->documento = $_POST['documento'];
      $clienteModel->nombres = $_POST['nombres'];
      $clienteModel->email = $_POST['email'];
      $clienteModel->telefono = $_POST['telefono'];
      $clienteModel->direccion = $_POST['direccion'];
      $newIdCliente = $clienteModel->save();
      if (empty($newIdCliente)) {
        $this->response(['error' => 'Error al registrar cliente']);
      }
    }
    $idcliente = $cliente['idCliente'] ?? $newIdCliente;

    $tipo = $this->getPost('tipo');

    // Registrar pedido
    $pedido = new PedidoModel();
    $pedido->idcliente = $idcliente;
    $pedido->idusuario = $this->userId;
    $pedido->tipo = $tipo;
    $pedido->total = $this->getPost('total');
    $newIdPedido = $pedido->save();
    if (empty($newIdPedido)) {
      $this->response(['error' => 'Error al registrar pedido']);
    }

    // Guardar detalle
    $errors = 0;
    $items = json_decode($this->getPost('items'), true);
    $detalle = new DetalleModel();
    $detalle->idpedido = $newIdPedido;
    foreach ($items as $item) {
      $detalle->iditem = $item['iditem'];
      $detalle->costo = $item['precio'];
      $detalle->cantidad = $item['cantidad'];
      if (!$detalle->save()) $errors += 1;
    }

    if ($errors > 0) {
      $this->response(['error' => 'Error al registrar el detalle']);
    }

    // Guardar venta

    $this->response(['success' => 'Se registro el pedido']);
  }
}
