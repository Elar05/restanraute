<?php

namespace Models;

use PDO;
use Libs\Model;
use PDOException;

class PermisoModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get($vista, $id)
  {
    try {
      $query = $this->prepare("SELECT * FROM permisos WHERE idvista = ? AND idtipousuario = ?;");
      $query->execute([$vista, $id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("PermisoModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll($id)
  {
    try {
      $query = $this->prepare("SELECT p.*, v.nombre FROM permisos p JOIN vistas v ON p.idvista = v.id WHERE p.idtipousuario = ?;");
      $query->execute([$id]);
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("PermisoModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function getPermisos($id)
  {
    try {
      $permisos = ['login'];
      if ($id === 0) return $permisos;

      $query = $this->prepare("SELECT p.*, v.nombre FROM permisos p JOIN vistas v ON p.idvista = v.id WHERE p.idtipousuario = ?;");
      $query->execute([$id]);
      $data = $query->fetchAll(PDO::FETCH_ASSOC);
      $permisos = [];
      foreach ($data as $permiso) {
        $permisos[] = $permiso['nombre'];
      }
      return $permisos;
    } catch (PDOException $e) {
      error_log("PermisoModel::getPermisos() -> " . $e->getMessage());
      return false;
    }
  }

  public function save($vista, $id)
  {
    try {
      $query = $this->prepare("INSERT INTO permisos (idvista, idtipousuario) VALUES (?, ?);");
      return $query->execute([$vista, $id]);
    } catch (PDOException $e) {
      error_log("PermisoModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete($vista, $id)
  {
    try {
      $query = $this->prepare("DELETE FROM permisos WHERE idvista = ? AND idtipousuario = ?;");
      return $query->execute([$vista, $id]);
    } catch (PDOException $e) {
      error_log("PermisoModel::delete() -> " . $e->getMessage());
      return false;
    }
  }
}
