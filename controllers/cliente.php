<?php

namespace Controllers;

use Libs\Session;

class Cliente extends Session
{
    public function __construct($url)
  {
    parent::__construct($url);
  }

  public function render()
  {
    $this->view->render('cliente/index');
  }
}
