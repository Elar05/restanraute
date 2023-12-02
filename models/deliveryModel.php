<?php

namespace Models;

use PDO;
use PDOException;
use Libs\Model;

class DeliveryModel extends Model
{
  public $idDelivery;
  public $idpedido;
  public $idventa;
  public $ciudad;
  public $direccion;
  public $costo;
  public $fecha;
  public $estado;

  public function __construct()
  {
    parent::__construct();
  }

  public function get($value, $colum = "idDelivery")
  {
    try {
      $query = $this->prepare("SELECT * FROM delivery WHERE $colum = ?;");
      $query->execute([$value]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("DeliveryModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll($colum = null, $value = null)
  {
    try {
      $sql = "";
      if ($colum !== null and $value !== null) $sql = " WHERE $colum = '$value'";

      $query = $this->query("SELECT * FROM delivery $sql;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("DeliveryModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save()
  {
    try {
      $query = $this->prepare("INSERT INTO delivery (idpedido, direccion, costo)  VALUES (:idpedido, :direccion, :costo);");

      $query->bindValue(':idpedido', $this->idpedido, PDO::PARAM_STR);
      $query->bindValue(':costo', $this->costo, PDO::PARAM_STR);
      $query->bindValue(':direccion', $this->direccion, PDO::PARAM_STR);

      return $query->execute();
    } catch (PDOException $e) {
      error_log("DeliveryModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function update()
  {
    try {
      $query = $this->prepare("UPDATE delivery SET idpedido = :idpedido, direccion= :direccion WHERE idDelivery = :idDelivery;");

      return $query->execute([
        'idDelivery' => $this->idDelivery,
        'idpedido' => $this->idpedido,
        'ciudad' => $this->ciudad,
        'direccion' => $this->direccion,
      ]);
    } catch (PDOException $e) {
      error_log("DeliveryModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete($idDelivery)
  {
    try {
      $query = $this->prepare("DELETE FROM delivery WHERE idDelivery = ?;");
      $query->execute([$idDelivery]);
      return true;
    } catch (PDOException $e) {
      error_log("DeliveryModel::delete() -> " . $e->getMessage());
      return false;
    }
  }

  public function updateStatus()
  {
    try {
      $query = $this->prepare("UPDATE delivery SET estado = :estado WHERE idDelivery=:idDelivery;");
      $query->bindParam(':estado', $this->estado, PDO::PARAM_STR);
      $query->bindParam(':idDelivery', $this->idDelivery, PDO::PARAM_STR);
      return $query->execute();
    } catch (PDOException $e) {
      error_log("DeliveryModel::update() -> " . $e->getMessage());
      return false;
    }
  }
}
