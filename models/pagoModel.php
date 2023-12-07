<?php

namespace Models;

use PDO;
use PDOException;
use Libs\Model;

class PagoModel extends Model
{
  public $idPago;
  public $nombre;
  public $estado;

  public function __construct()
  {
    parent::__construct();
  }

  public function get($id, $colum = "idPago")
  {
    try {
      $query = $this->prepare("SELECT * FROM pago WHERE $colum = ?;");
      $query->execute([$id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("PagoModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll($colum = null, $value = null)
  {
    try {
      $sql = "";
      if ($colum !== null) $sql = " WHERE $colum = '$value'";

      $query = $this->query("SELECT * FROM pago $sql;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Pagoodel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save()
  {
    try {
      $query = $this->prepare("INSERT INTO pago (nombre) VALUES (:nombre);");

      $query->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);

      return $query->execute();
    } catch (PDOException $e) {
      error_log("UserModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function update()
  {
    try {
      $query = $this->prepare("UPDATE pago SET nombre = :nombre WHERE idPago = :idPago;");

      return $query->execute([
        'idPago' => $this->idPago,
        'nombre' => $this->nombre,
      ]);
    } catch (PDOException $e) {
      error_log("PagoModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function updateStatus()
  {
    try {
      $query = $this->prepare("UPDATE pago SET estado = :estado WHERE idPago=:idPago;");
      $query->bindParam(':estado', $this->estado, PDO::PARAM_STR);
      $query->bindParam(':idPago', $this->idPago, PDO::PARAM_STR);
      return $query->execute();
    } catch (PDOException $e) {
      error_log("MarcaModel::update() -> " . $e->getMessage());
      return false;
    }
  }
}
