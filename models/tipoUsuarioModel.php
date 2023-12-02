<?php

namespace Models;

use PDO;
use Libs\Model;
use PDOException;

class TipoUsuarioModel extends Model
{
  public $idTipo;
  public $nombre;
  public $estado;

  public function __construct()
  {
    parent::__construct();
  }

  public function get($id, $column = 'idTipo')
  {
    try {
      $query = $this->prepare("SELECT * FROM tipousuario WHERE $column = ?;");
      $query->execute([$id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("UsuarioTiposModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll()
  {
    try {
      $query = $this->query("SELECT * FROM tipousuario;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("UsuarioTiposModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save()
  {
    try {
      $query = $this->prepare("INSERT INTO tipousuario (nombre) VALUES (:nombre);");
      $query->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
      return $query->execute();
    } catch (PDOException $e) {
      error_log("UsuarioTiposModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function update()
  {
    try {
      $query = $this->prepare("UPDATE tipousuario SET nombre = :nombre WHERE idTipo = :idTipo;");
      $query->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
      $query->bindParam(':idTipo', $this->idTipo, PDO::PARAM_STR);
      return $query->execute();
    } catch (PDOException $e) {
      error_log("UsuarioTiposModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function updateStatus()
  {
    try {
      $query = $this->prepare("UPDATE tipousuario SET estado = :estado WHERE idTipo=:idTipo;");
      $query->bindParam(':idTipo', $this->idTipo, PDO::PARAM_STR);
      $query->bindParam(':estado', $this->estado, PDO::PARAM_STR);
      return $query->execute();
    } catch (PDOException $e) {
      error_log("MarcaModel::update() -> " . $e->getMessage());
      return false;
    }
  }
}
