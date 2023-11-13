<?php

use Controllers\Errores;

class App
{
  public function __construct()
  {
    // controller/method
    $url = $_GET['url'] ?? '';
    $url = rtrim($url, '/');
    $url = explode('/', $url);

    if (empty($url[0])) {
      require_once 'controllers/login.php';
      $login = new Login('login');
      $login->render();
      return false;
    }

    // si la url no es null
    $fileController = 'controllers/' . $url[0] . '.php';
    //condicional, si es que exites un archivo en esta rita
    if (file_exists($fileController)) {
      require_once $fileController;

      $controller = new $url[0]($url[0]);
      /**
       * 0 => controller => login
       * 1 => method => vista
       */
      // si hay un metodo
      if (isset($url[1])) {
        // validar el metodo
        if (method_exists($controller, $url[1])) {
          // Si hay parametros en la url
          if (isset($url[2])) {
            $nparam = sizeof($url);
            $params = [];
            for ($i = 2; $i < $nparam; $i++) {
              array_push($params, $url[$i]);
            }

            $controller->{$url[1]}($params);
          } else {
            $reflection = new ReflectionMethod("{$url[0]}", "{$url[1]}");
            $parameters = $reflection->getParameters();

            if (count($parameters) > 0 && empty($url[2])) {
              new Errores();
            } else {
              $controller->{$url[1]}();
            }
          }
        } else {
          new Errores();
        }
      } else {
        $controller->render();
      }
    } else {
      new Errores();
    }
  }
}
