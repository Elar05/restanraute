<?php

namespace Controllers;

use Libs\Session;
use Models\MainModel;

class Main extends Session
{
  public function __construct($url)
  {
    parent::__construct($url);
  }

  public function render()
  {
    $this->view->render('main/index');
  }

  public function getVentasPorMes()
  {
    $main = new MainModel();
    $totales = $main->getVentasPorMes('2023');
    $meses = [];
    $data = [];

    foreach ($totales as $total) {
      $data[] = intval($total['total']);
      $meses[] = $this->meses()[$total['mes']];
    }

    $series = [[
      "name" => "Cantidad de ventas",
      "data" => $data
    ],];
    $this->response(["series" => $series, "categories" => $meses]);
  }
  public function getTotalVentasPorMes()
  {
    $main = new MainModel();
    $totales = $main->getTotalVentasPorMes('2023');
    $meses = [];
    $data = [];

    foreach ($totales as $total) {
      $data[] = intval($total['total_por_mes']);
      $meses[] = $this->meses()[$total['mes']];
    }

    $series = [[
      "name" => "Total de ventas",
      "data" => $data
    ],];
    $this->response(["series" => $series, "categories" => $meses]);
  }
  public function getCantidadTipoPedido()
  {
    $main = new MainModel();
    $totales = $main->getCantidadTipoPedido();
    $labels = [];
    $series = [];

    foreach ($totales as $total) {
      $labels[] = ucfirst($total['tipo']);
      $series[] = $total['total'];
    }

    $this->response(["series" => $series, "labels" => $labels]);
  }
}
