<?php

namespace Controllers;

use Libs\Session;
use Models\DeliveryModel;

class Delivery extends Session
{
  public function __construct($url)
  {
    parent::__construct($url);
  }

  public function render()
  {
    $this->view->render('delivery/index');
  }

  public function list()
  {
    $deliverys = DeliveryModel::getAll();

    if (count($deliverys) > 0) {
      foreach ($deliverys as $delivery) {
        $url = URL;
        $botones = "<a href='$url/main/pdf?idPedido=$delivery[idpedido]' target='_blank' class='btn btn-danger'><i class='fas fa-file-pdf'></i></a>";

        $data[] = [
          $delivery["idDelivery"],
          $delivery["cliente"],
          $delivery["direccion"],
          $delivery["costo"],
          $delivery["total"],
          $delivery["fecha"],
          $botones,
        ];
      }
    }

    $this->response(["data" => $data]);
  }
}
