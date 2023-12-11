<?php

namespace Controllers;

use Libs\Session;
use Models\ClienteModel;
use Models\DeliveryModel;
use Models\DetalleModel;
use Models\PagoModel;
use Models\PedidoModel;
use Models\VentaModel;

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
    $metodosPago = new PagoModel();
    $this->view->render('pedido/nuevo', ["metodosPago" => $metodosPago->getAll()]);
  }

  public function list()
  {
    $data = [];
    $items = $this->model->getAll();
    if (count($items) > 0) {
      foreach ($items as $item) {
        $botones = "<a href='" . URL . "/pedido/edit?idPedido={$item["idPedido"]}' class='btn btn-warning edit' idPedido='{$item["idPedido"]}'><i class='fas fa-pen'></i></a>";
        $botones .= "<button class='btn btn-info detalle' idPedido='{$item["idPedido"]}'><i class='fas fa-info'></i></button>";

        $arrEstado = [
          "0" => [
            "class" => "info", "text" => "En espera",
            "acciones" => "
              <button class='dropdown-item estado' id='{$item["idPedido"]}' estado='1'><i class='fas fa-spinner text-warning'></i> En proceso</button>
              <button class='dropdown-item estado' id='{$item["idPedido"]}' estado='3'><i class='fas fa-times text-danger'></i> Cancelar</button>
            "
          ],
          "1" => [
            "class" => "warning", "text" => "En proceso",
            "acciones" => "
              <button class='dropdown-item terminar' id='{$item["idPedido"]}'><i class='fas fa-check text-success'></i> Terminado</button>
              <button class='dropdown-item estado' id='{$item["idPedido"]}' estado='3'><i class='fas fa-times text-danger'></i> Cancelar</button>
            "
          ],
          "2" => ["class" => "success", "text" => "Terminado", "acciones" => "<button class='dropdown-item informacion' id='{$item["idPedido"]}'><i class='fas fa-info text-info'></i> Informacion</button>"],
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
          $item["cliente"],
          $item["usuario"],
          ucfirst($item["tipo"]),
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
    if (!$this->existsPOST(['tipo', 'documento', 'nombres', 'telefono', 'email', 'subtotal', 'igv', 'total', 'items', 'comprobante', 'pago'])) {
      $this->response(['error' => 'Faltan Parametros']);
    }

    // Transformar el json a un array y validar que halla elementos
    $items = json_decode($this->getPost('items'), true);
    if (empty($items)) {
      $this->response(['error' => 'No hay items en el pedido']);
    }

    // Guardar cliente si no existe
    $clienteModel = new ClienteModel();
    $cliente = $clienteModel->get($_POST['documento'], 'documento');
    if (empty($cliente)) {
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

    // Guardar detalle
    $detalle = new DetalleModel();
    $detalle->idpedido = $newIdPedido;
    foreach ($items as $item) {
      $detalle->iditem = $item['iditem'];
      $detalle->costo = $item['precio'];
      $detalle->cantidad = $item['cantidad'];
      $detalle->save();
    }

    // Guardar venta
    $venta = new VentaModel();
    $venta->idpedido = $newIdPedido;
    $venta->idpago = $this->getPost('pago');
    $venta->comprobante = $this->getPost('comprobante');
    $venta->serie = ($this->getPost('comprobante') === "B") ? "B001" : "F001";
    $venta->descripcion = $this->getPost('descripcion');
    $venta->subtotal = $this->getPost('subtotal');
    $venta->igv = $this->getPost('igv');
    $venta->total = $this->getPost('total');
    $venta->save();

    if ($tipo === "delivery") {
      $delivery = new DeliveryModel();
      $delivery->idpedido = $newIdPedido;
      $delivery->direccion = $this->getPost('direccionDelivery');
      $delivery->costo = $this->getPost('costoDelivery');
      $delivery->save();
    }

    $this->response(['success' => 'Se registro el pedido']);
  }

  public function edit()
  {
    if (!$this->existsGET(['idPedido'])) {
      $this->redirect('pedido', ["mensaje" => "No existe el pedido"]);
    }

    $pedido = new PedidoModel();

    $metodosPago = new PagoModel();
    $this->view->render('pedido/edit', [
      "metodosPago" => $metodosPago->getAll(),
      "pedido" => $pedido->get($_GET['idPedido']),
    ]);
  }

  public function update()
  {
    if (!$this->existsPOST(['tipo', 'subtotal', 'igv', 'total', 'items', 'comprobante', 'pago', 'id'])) {
      $this->response(['error' => 'Faltan Parametros']);
    }

    // Transformar el json a un array y validar que halla elementos
    $items = json_decode($this->getPost('items'), true);
    if (empty($items)) {
      $this->response(['error' => 'No hay items en el pedido']);
    }

    $tipo = $this->getPost('tipo');

    // Registrar pedido
    $pedidoM = new PedidoModel();
    $pedido = $pedidoM->get($_POST['id']);

    // Actualizar pedido
    $pedidoM->idPedido = $pedido['idPedido'];
    $pedidoM->tipo = $tipo;
    $pedidoM->total = $this->getPost('total');
    $pedidoM->update();

    // Guardar detalle
    $detalle = new DetalleModel();
    // Eliminar los items anteriores
    $detalle->delete($pedido['idPedido']);

    $detalle->idpedido = $pedido['idPedido'];
    foreach ($items as $item) {
      $detalle->iditem = $item['iditem'];
      $detalle->costo = $item['precio'];
      $detalle->cantidad = $item['cantidad'];
      $detalle->save();
    }

    // Guardar venta
    $venta = new VentaModel();
    $venta->idpedido = $pedido['idPedido'];
    $venta->idpago = $this->getPost('pago');
    $venta->descripcion = $this->getPost('descripcion');
    $venta->subtotal = $this->getPost('subtotal');
    $venta->igv = $this->getPost('igv');
    $venta->total = $this->getPost('total');
    $venta->update();

    if ($tipo === "delivery") {
      $delivery = new DeliveryModel();
      $delivery->idpedido = $pedido['idPedido'];
      $delivery->direccion = $this->getPost('direccionDelivery');
      $delivery->costo = $this->getPost('costoDelivery');
      $delivery->update();
    }

    $this->response(['success' => 'Se registro el pedido']);
  }
}
