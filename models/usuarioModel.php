<?php

namespace Models;

use PDO;
use PDOException;
use Libs\Model;

class UsuarioModel extends Model
{
  public $idUsuario;
  public $idtipo;
  public $nombres;
  public $email;
  public $password;
  public $telefono;
  public $direccion;
  public $estado;

  public function __construct()
  {
    parent::__construct();
  }

  public function get($id, $colum = "idUsuario")
  {
    try {
      $query = $this->prepare("SELECT * FROM usuario WHERE $colum = ?;");
      $query->execute([$id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("UserModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll($colum = null, $value = null)
  {
    try {
      $sql = "";
      if ($colum !== null) $sql = " WHERE $colum = '$value'";

      $query = $this->query("SELECT * FROM usuario $sql;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("UserModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save()
  {
    try {
      $query = $this->prepare("INSERT INTO usuario (idtipo, nombres, email, password, telefono, direccion) VALUES (:idtipo, :nombres, :email, :password, :telefono, :direccion);");

      $query->bindParam(':idtipo', $this->idtipo, PDO::PARAM_STR);
      $query->bindParam(':nombres', $this->nombres, PDO::PARAM_STR);
      $query->bindParam(':email', $this->email, PDO::PARAM_STR);
      $query->bindParam(':password', $this->password, PDO::PARAM_STR);
      $query->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);
      $query->bindParam(':direccion', $this->direccion, PDO::PARAM_STR);

      return $query->execute();
    } catch (PDOException $e) {
      error_log("UserModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function update()
  {
    try {
      $query = $this->prepare("UPDATE usuario SET nombres = :nombres, telefono = :telefono, email = :email, password = :password, direccion = :direccion WHERE idUsuario = :idUsuario;");

      return $query->execute([
        'idUsuario' => $this->idUsuario,
        'nombres' => $this->nombres,
        'email' => $this->email,
        'password' => $this->password,
        'telefono' => $this->telefono,
        'direccion' => $this->direccion,
      ]);
    } catch (PDOException $e) {
      error_log("UserModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function updatePassword()
  {
    try {
      $query = $this->prepare("UPDATE usuario SET password = :password WHERE idUsuario = :idUsuario;");

      return $query->execute([
        'idUsuario' => $this->idUsuario,
        'password' => $this->password,
      ]);
    } catch (PDOException $e) {
      error_log("UserModel::updatePassword() -> " . $e->getMessage());
      return false;
    }
  }

  public function updateStatus()
  {
    try {
      $query = $this->prepare("UPDATE usuario SET estado = :estado WHERE idUsuario=:idUsuario;");
      $query->bindParam(':estado', $this->estado, PDO::PARAM_STR);
      $query->bindParam(':idUsuario', $this->idUsuario, PDO::PARAM_STR);
      return $query->execute();
    } catch (PDOException $e) {
      error_log("MarcaModel::update() -> " . $e->getMessage());
      return false;
    }
  }
}
