<?php

namespace Libs;

class View
{
  public $d;
  public $user;
  public $userType;

  public function __construct($user, $userType)
  {
    $this->user = $user;
    $this->userType = $userType;
  }

  public function render($nombre, $data = [])
  {
    $this->d = $data;
    $this->handleMessages();
    require 'views/' . $nombre . '.php';
  }

  private function handleMessages()
  {
    if (isset($_GET['success']) && isset($_GET['error'])) {
      // no se muestra nada porque no puede haber un error y success al mismo tiempo
    } else if (isset($_GET['success'])) {
      $this->handleSuccess();
    } else if (isset($_GET['error'])) {
      $this->handleError();
    } else {
      $this->handleMensaje();
    }
  }

  private function handleError()
  {
    if (isset($_GET['error'])) {
      $hash = $_GET['error'];
      $errors = new Errors();

      if ($errors->existsKey($hash)) {
        // error_log('View::handleError() existsKey =>' . $errors->get($hash));
        $this->d['error'] = $errors->get($hash);
      } else {
        $this->d['error'] = NULL;
      }
    }
  }

  private function handleSuccess()
  {
    if (isset($_GET['success'])) {
      $hash = $_GET['success'];
      $success = new Success();

      if ($success->existsKey($hash)) {
        // error_log('View::handleError() existsKey =>' . $success->existsKey($hash));
        $this->d['success'] = $success->get($hash);
      } else {
        $this->d['success'] = NULL;
      }
    }
  }

  private function handleMensaje()
  {
    if (isset($_GET['mensaje'])) {
      $this->d['mensaje'] = $_GET['mensaje'];
    }
  }

  public function showMessages()
  {
    $this->showError();
    $this->showSuccess();
    $this->showInfo();
  }

  public function showError()
  {
    if (array_key_exists('error', $this->d)) {
      echo '<div class="alert alert-danger alert-dismissible show fade">' . $this->d['error'] . '</div>';
    }
  }

  public function showSuccess()
  {
    if (array_key_exists('success', $this->d)) {
      echo '<div class="alert alert-success alert-dismissible show fade">' . $this->d['success'] . '</div>';
    }
  }

  public function showInfo()
  {
    if (array_key_exists('mensaje', $this->d)) {
      echo "<div class='alert alert-info alert-dismissible show fade'>
        <div class='alert-body'>
          <button class='close' data-dismiss='alert'>
            <span>&times;</span>
          </button>
          {$this->d['mensaje']}
        </div>
      </div>";
    }
  }
}
