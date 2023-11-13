<?php

namespace Controllers;

use Libs\Controller;

class Errores extends Controller
{
  public function __construct()
  {
    parent::__construct("", "");
    $this->view->render('errores/index');
    exit();
  }
}
