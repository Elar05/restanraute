<?php

namespace Libs;

use Libs\View;

class Controller
{
  public $view;

  public function __construct($user, $userType)
  {
    $this->view = new View($user, $userType);
  }

  public function redirect($url, $mensajes = [])
  {
    $data = [];
    $params = '';

    foreach ($mensajes as $key => $value) {
      array_push($data, $key . '=' . $value);
    }
    $params = join('&', $data);

    if ($params != '') {
      $params = '?' . $params;
    }
    header('Location: ' . URL . "/$url$params");
    exit();
  }

  public function response($data)
  {
    echo json_encode($data);
    exit();
  }

  public function existsPOST($params)
  {
    foreach ($params as $param) {
      if (!isset($_POST[$param])) {
        return false;
      }
    }
    return true;
  }

  public function existsGET($params)
  {
    foreach ($params as $param) {
      if (!isset($_GET[$param])) {
        return false;
      }
    }
    return true;
  }

  public function getGet($name)
  {
    return $_GET[$name];
  }

  public function getPost($name)
  {
    return $_POST[$name];
  }

  public function meses()
  {
    return [
      "01" => "Enero",
      "02" => "Febrero",
      "03" => "Marzo",
      "04" => "Abril",
      "05" => "Mayo",
      "06" => "Junio",
      "07" => "Julio",
      "08" => "Agosto",
      "09" => "Septiembre",
      "10" => "Octubre",
      "11" => "Noviembre",
      "12" => "Diciembre",
    ];
  }
}
