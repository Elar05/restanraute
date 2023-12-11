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
        $botones = "<button class='btn btn-info detalle' idDelivery='{$delivery["idDelivery"]}'><i class='fas fa-info'></i></button>";

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
