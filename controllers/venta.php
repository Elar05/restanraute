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
        $url = URL;
        $botones = "<a href='$url/main/pdf?idPedido=$venta[idpedido]' target='_blank' class='btn btn-danger'><i class='fas fa-file-pdf'></i></a>";

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
