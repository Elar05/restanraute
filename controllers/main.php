<?php

namespace Controllers;

use Libs\Session;

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
}
