<?php

namespace Models;

use PDO;
use Libs\Model;
use PDOException;

class DetalleModel extends Model
{
  public $idpedido;
  public $iditem;
  public $costo;
  public $cantidad;

  public function __construct()
  {
    parent::__construct();
  }

  public function getDetalle($idpedido)
  {
    try {
      $query = $this->prepare("SELECT * FROM detalle WHERE idpedido = ?;");
      $query->execute([$idpedido]);
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("DetalleModel::getDetalle() -> " . $e->getMessage());
      return false;
    }
  }

  public function save()
  {
    try {
      $query = $this->prepare("INSERT INTO detalle (idpedido, iditem, costo, cantidad)  VALUES (:idpedido, :iditem, :costo, :cantidad);");

      $query->bindValue(':idpedido', $this->idpedido, PDO::PARAM_INT);
      $query->bindValue(':iditem', $this->iditem, PDO::PARAM_INT);
      $query->bindValue(':costo', $this->costo, PDO::PARAM_STR);
      $query->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);

      return $query->execute();
    } catch (PDOException $e) {
      error_log("DetalleModel::save() -> " . $e->getMessage());
      return false;
    }
  }
}
