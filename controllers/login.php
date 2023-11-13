<?php

use Models\LoginModel;
use Libs\Session;
use Libs\Errors;

class Login extends Session
{
  public $model;

  public function __construct($url)
  {
    parent::__construct($url);
    $this->model = new LoginModel;
  }

  public function render()
  {
    $this->view->render('login/index');
  }

  public function auth()
  {
    if (!$this->existsPOST(['email', 'password'])) {
      $this->redirect('', ["error" => Errors::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
    }

    $user = $this->model->login($this->getPost('email'), $this->getPost('password'));

    if ($user !== NULL) {
      $this->initialize($user);
    } else {
      $this->redirect('', ["error" => Errors::ERROR_LOGIN_AUTHENTICATE_DATA]);
    }
  }
}
