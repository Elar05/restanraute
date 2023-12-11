<?php

namespace Controllers;

use Libs\Session;
use Models\VentaModel;

class Venta extends Session
{
  public function __construct($url)
  {
    parent::__construct($url);
  }

  public function render()
  {
    $this->view->render('venta/index');
  }

  public function list()
  {
    $ventas = VentaModel::getAll();

    if (count($ventas) > 0) {
      foreach ($ventas as $venta) {
        $botones = "<button class='btn btn-info detalle' idventa='{$venta["idventa"]}'><i class='fas fa-info'></i></button>";

        $data[] = [
          $venta["idventa"],
          $venta["cliente"],
          $venta["pago"],
          "$venta[serie]-$venta[correlativo]",
          $venta["subtotal"],
          $venta["igv"],
          $venta["total"],
          $venta["fecha"],
          $botones,
        ];
      }
    }

    $this->response(["data" => $data]);
  }
}
