<?php

namespace Libs;

class Errors
{
  const ERROR_LOGIN_AUTHENTICATE                = "11c37cfab311fdbe2";
  const ERROR_LOGIN_AUTHENTICATE_EMPTY          = "2194ac064912bse67";
  const ERROR_LOGIN_AUTHENTICATE_DATA           = "bcbe63ed846468d4a";

  private $errorsList = [];

  public function __construct()
  {
    $this->errorsList = [
      Errors::ERROR_LOGIN_AUTHENTICATE              => 'Hubo un problema al autenticarse',
      Errors::ERROR_LOGIN_AUTHENTICATE_EMPTY        => 'Los parámetros para autenticar no pueden estar vacíos',
      Errors::ERROR_LOGIN_AUTHENTICATE_DATA         => 'Correo y/o password incorrectos',
    ];
  }

  public function get($hash)
  {
    return $this->errorsList[$hash];
  }

  public function existsKey($key)
  {
    return array_key_exists($key, $this->errorsList);
  }
}
