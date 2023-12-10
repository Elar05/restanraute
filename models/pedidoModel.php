<?php

namespace Models;

use PDO;
use Libs\Model;
use PDOException;

class PedidoModel extends Model
{
  public $idPedido;
  public $idcliente;
  public $idusuario;
  public $tipo;
  public $total;
  public $fecha;
  public $estado;

  public function __construct()
  {
    parent::__construct();
  }

  public function get($value, $colum = "idPedido")
  {
    try {
      $query = $this->prepare("SELECT * FROM pedido WHERE $colum = ?;");
      $query->execute([$value]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("PedidoModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll($colum = null, $value = null)
  {
    try {
      $sql = "";
      if ($colum !== null && $value !== null) $sql = " WHERE $colum = '$value'";

      $query = $this->query(
        "SELECT p.*, c.nombres AS cliente, u.nombres AS usuario
        FROM pedido p
        INNER JOIN cliente c ON p.idcliente = c.idCliente
        INNER JOIN usuario u ON p.idusuario = u.idUsuario
        $sql;"
      );
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("PedidoModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save()
  {
    try {
      $pdo = $this->connect();
      $query = $pdo->prepare("INSERT INTO pedido (idcliente, idusuario, tipo, total)  VALUES (:idcliente, :idusuario, :tipo, :total);");

      $query->bindValue(':idcliente', $this->idcliente, PDO::PARAM_STR);
      $query->bindValue(':idusuario', $this->idusuario, PDO::PARAM_STR);
      $query->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
      $query->bindValue(':total', $this->total, PDO::PARAM_STR);

      $query->execute();
      return $pdo->lastInsertId();
    } catch (PDOException $e) {
      error_log("PedidoModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function update()
  {
    try {
      $query = $this->prepare("UPDATE pedido SET idcliente = :idcliente, idusuario = :idusuario, tipo = :tipo, total = :total WHERE idPedido = :idPedido;");

      return $query->execute([
        'idPedido' => $this->idPedido,
        'idcliente' => $this->idcliente,
        'idusuario' => $this->idusuario,
        'tipo' => $this->tipo,
        'total' => $this->total,
      ]);
    } catch (PDOException $e) {
      error_log("PedidoModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete($idPedido)
  {
    try {
      $query = $this->prepare("DELETE FROM pedido WHERE idPedido = ?;");
      $query->execute([$idPedido]);
      return true;
    } catch (PDOException $e) {
      error_log("PedidoModel::delete() -> " . $e->getMessage());
      return false;
    }
  }

  public function updateStatus()
  {
    try {
      $query = $this->prepare("UPDATE pedido SET estado = :estado WHERE idPedido = :idPedido;");

      $query->bindParam(':estado', $this->estado, PDO::PARAM_STR);
      $query->bindParam(':idPedido', $this->idPedido, PDO::PARAM_STR);

      return $query->execute();
    } catch (PDOException $e) {
      error_log("PedidoModel::update() -> " . $e->getMessage());
      return false;
    }
  }
}
