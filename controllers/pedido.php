<?php

namespace Controllers;

use Libs\Session;

class Pedido extends Session
{
  public function __construct($url)
  {
    parent::__construct($url);
  }

  public function render()
  {
    $this->view->render('pedido/index');
  }

  public function nuevo()
  {
    $this->view->render('pedido/nuevo');
  }
}
