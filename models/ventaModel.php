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
    public $serie;
    public $correlativo;
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

    static public function getAll($colum = null, $value = null)
    {
        try {
            $sql = "";
            if ($colum !== null and $value !== null) $sql = " WHERE $colum = '$value'";

            $pdo = new Model();
            $query = $pdo->query(
                "SELECT v.*, c.nombres AS cliente, pa.nombre AS pago, p.tipo
                FROM venta v
                INNER JOIN pedido p ON v.idpedido = p.`idPedido`
                INNER JOIN cliente c ON p.idcliente = c.`idCliente`
                INNER JOIN pago pa ON v.idpago = pa.`idPago`
                $sql;"
            );
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
            $this->correlativo = $this->getLastCorrelativo($this->comprobante) + 1;

            $query = $this->prepare("INSERT INTO venta (idpedido, idpago, comprobante, serie, correlativo, descripcion, subtotal, igv, total) VALUES (:idpedido, :idpago, :comprobante, :serie, :correlativo, :descripcion, :subtotal, :igv, :total);");

            $query->bindValue(':idpedido', $this->idpedido, PDO::PARAM_INT);
            $query->bindValue(':idpago', $this->idpago, PDO::PARAM_INT);
            $query->bindValue(':comprobante', $this->comprobante, PDO::PARAM_STR);
            $query->bindValue(':serie', $this->serie, PDO::PARAM_STR);
            $query->bindValue(':correlativo', $this->correlativo, PDO::PARAM_STR);
            $query->bindValue(':descripcion', $this->descripcion, PDO::PARAM_STR);
            $query->bindValue(':subtotal', $this->subtotal, PDO::PARAM_STR);
            $query->bindValue(':igv', $this->igv, PDO::PARAM_STR);
            $query->bindValue(':total', $this->total, PDO::PARAM_STR);

            return $query->execute();
        } catch (PDOException $e) {
            error_log('VentaModel::save() -> ' . $e->getMessage());
            return false;
        }
    }

    public function getLastCorrelativo($comprobante)
    {
        try {
            $query = $this->prepare("SELECT correlativo FROM venta WHERE comprobante = ? ORDER BY idventa DESC LIMIT 1;");
            $query->execute([$comprobante]);
            return $query->fetch(PDO::FETCH_ASSOC)['correlativo'] ?? 0;
        } catch (PDOException $e) {
            error_log('VentaModel::getLastCorrelativo() -> ' . $e->getMessage());
            return false;
        }
    }

    public function update()
    {
        try {
            $query = $this->prepare("UPDATE venta SET idpago = :idpago, descripcion = :descripcion, subtotal = :subtotal, igv = :igv, total = :total WHERE idpedido = :idpedido;");

            return $query->execute([
                'idpedido' => $this->idpedido,
                'idpago' => $this->idpago,
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

    public function insertData()
    {
        $sql = "INSERT INTO venta (idpedido, idpago, comprobante, subtotal, igv, total, fecha, correlativo) VALUES ";
        for ($i = 1; $i <= 100; $i++) {
            $total = rand(50, 200);
            $randF = rand(1, 12);
            $randD = rand(1, 30);
            $fecha = "2023-$randF-$randD";
            $sql .= "($i, 1, 'B', 1, 1, $total, '$fecha', $i),";
        }
        $longitud = strlen($sql);
        $sql = substr($sql, 0, $longitud - 1) . ";";
        $query = $this->query($sql);
        $query->execute();
    }
}
