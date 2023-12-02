<?php

namespace Models;

use PDO;
use PDOException;
use Libs\Model;

class VentaModel extends Model
{
    public $idventa;
    public $idpedido;
    public $idpago;
    public $comprobante;
    public $descripcion;
    public $subtotal;
    public $igv;
    public $total;
    public $fecha;
    public $estado;

    public function __construct()
    {
        parent::__construct();
    }

    public function get($value, $colum = "idventa")
    {
        try {
            $query = $this->prepare("SELECT * FROM venta WHERE $colum = ?;");
            $query->execute([$value]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("VentaModel::get() -> " . $e->getMessage());
            return false;
        }
    }

    public function getAll($colum = null, $value = null)
    {
        try {
            $sql = "";
            if ($colum !== null and $value !== null) $sql = " WHERE $colum = '$value'";

            $query = $this->query("SELECT * FROM venta $sql;");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("VentaModel::getAll() -> " . $e->getMessage());
            return false;
        }
    }

    public function save()
    {
        try {
            $query = $this->prepare("INSERT INTO venta(idpedido, idpago, comprobante,descripcion, subtotal, igv,total,fecha) 
            VALUES (:idpedido,:idpago,:comprobante,:descripcion, :subtotal, :igv, :total,:fecha);");

            $query->bindParam(':idpedido', $this->idpedido, PDO::PARAM_STR);
            $query->bindParam(':idpago', $this->idpago, PDO::PARAM_STR);
            $query->bindParam(':comprobante', $this->comprobante, PDO::PARAM_STR);
            $query->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);
            $query->bindParam(':subtotal', $this->subtotal, PDO::PARAM_STR);
            $query->bindParam(':igv', $this->igv, PDO::PARAM_STR);
            $query->bindParam(':total', $this->total, PDO::PARAM_STR);
            $query->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);

            return $query->execute();
        } catch (PDOException $e) {
            error_log("VentaModel::save() -> " . $e->getMessage());
            return false;
        }
    }

    public function update()
    {
        try {
            $query = $this->prepare("UPDATE venta SET idpedido = :idpedido, idpago = :idpago, comprobante = :comprobante, descripcion = :descripcion, subtotal = :subtotal, igv = :igv, total = :total WHERE idventa = :idventa;");

            return $query->execute([
                'idventa' => $this->idventa,
                'idpedido' => $this->idpedido,
                'idpago' => $this->idpago,
                'comprobante' => $this->comprobante,
                'descripcion' => $this->descripcion,
                'subtotal' => $this->subtotal,
                'igv' => $this->igv,
                'total' => $this->total,
            ]);
        } catch (PDOException $e) {
            error_log("VentaModel::update() -> " . $e->getMessage());
            return false;
        }
    }

    public function delete($idventa)
    {
        try {
            $query = $this->prepare("DELETE FROM venta WHERE idventa = ?;");
            $query->execute([$idventa]);
            return true;
        } catch (PDOException $e) {
            error_log("VentaModel::delete() -> " . $e->getMessage());
            return false;
        }
    }

    public function updateStatus()
    {
        try {
            $query = $this->prepare("UPDATE venta SET estado = :estado WHERE idventa=:idventa;");
            $query->bindParam(':estado', $this->estado, PDO::PARAM_STR);
            $query->bindParam(':idventa', $this->idventa, PDO::PARAM_STR);
            return $query->execute();
        } catch (PDOException $e) {
            error_log("VentaModel::update() -> " . $e->getMessage());
            return false;
        }
    }
}
