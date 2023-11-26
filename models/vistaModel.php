<?php

namespace Models;

use PDO;
use Libs\Model;
use PDOException;

class VistaModel extends Model
{
  public $id;
  public $nombre;

  public function __construct()
  {
    parent::__construct();
  }

  public function get($value, $column = 'id')
  {
    try {
      $query = $this->prepare("SELECT * FROM vistas WHERE $column = ?;");
      $query->execute([$value]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("VistasModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll()
  {
    try {
      $query = $this->query("SELECT * FROM vistas;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("VistasModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save()
  {
    try {
      $query = $this->prepare("INSERT INTO vistas (nombre) VALUES (:nombre);");
      $query->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
      return $query->execute();
    } catch (PDOException $e) {
      error_log("VistasModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function update()
  {
    try {
      $query = $this->prepare("UPDATE vistas SET nombre=:nombre WHERE id=:id;");
      $query->bindParam(':id', $this->id, PDO::PARAM_INT);
      $query->bindParam(':vista', $this->nombre, PDO::PARAM_STR);
      return $query->execute();
    } catch (PDOException $e) {
      error_log("VistasModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete()
  {
    try {
      $query = $this->prepare("DELETE FROM vistas WHERE id = :id;");
      $query->bindParam(':id', $this->id, PDO::PARAM_INT);
      return $query->execute();
    } catch (PDOException $e) {
      error_log("VistasModel::update() -> " . $e->getMessage());
      return false;
    }
  }
}
