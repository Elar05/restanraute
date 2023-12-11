<?php

namespace Controllers;

use Libs\Controller;

class Inicio extends Controller
{
  public $model;

  public function __construct()
  {
    parent::__construct("","");
  }

  public function render()
  {
    $this->view->render('inicio/index');
  }

  public function menu()
  {
    $this->view->render('inicio/menu');
  }

  public function sobre_nosotros()
  {
    $this->view->render('inicio/sobre_nosotros');
  }

  public function galeria()
  {
    $this->view->render('inicio/galeria');
  }

  public function contacto()
  {
    $this->view->render('inicio/contacto');
  }
}
