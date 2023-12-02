<?php

namespace Models;

use PDO;
use PDOException;
use Libs\Model;

class ReservaModel extends Model
{
    public $idReserva;
    public $idpedido;
    public $costo;
    public $fecha;
    public $estado;

    public function __construct()
    {
        parent::__construct();
    }

    public function get($value, $colum = "idReserva")
    {
        try {
            $query = $this->prepare("SELECT * FROM reserva WHERE $colum = ?;");
            $query->execute([$value]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("ReservaModel::get() -> " . $e->getMessage());
            return false;
        }
    }

    public function getAll($colum = null, $value = null)
    {
        try {
            $sql = "";
            if ($colum !== null and $value !== null) $sql = " WHERE $colum = '$value'";

            $query = $this->query("SELECT * FROM reserva $sql;");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("ReservaModel::getAll() -> " . $e->getMessage());
            return false;
        }
    }

    public function save()
    {
        try {
            $query = $this->prepare("INSERT INTO reserva(costo, fecha) 
            VALUES (:costo, :fecha);");

            $query->bindParam(':costo', $this->costo, PDO::PARAM_STR);
            $query->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);

            return $query->execute();
        } catch (PDOException $e) {
            error_log("ReservaModel::save() -> " . $e->getMessage());
            return false;
        }
    }

    public function update()
    {
        try {
            $query = $this->prepare("UPDATE reserva SET costo = :costo, fecha= :fecha WHERE idReserva = :idReserva;");

            return $query->execute([
                'idReserva' => $this->idReserva,
                'idpedido' => $this->idpedido,
                'costo' => $this->costo,
                'fecha' => $this->fecha,
            ]);
        } catch (PDOException $e) {
            error_log("ReservaModel::update() -> " . $e->getMessage());
            return false;
        }
    }

    public function delete($idReserva)
    {
        try {
            $query = $this->prepare("DELETE FROM reserva WHERE idReserva = ?;");
            $query->execute([$idReserva]);
            return true;
        } catch (PDOException $e) {
            error_log("ReservaModel::delete() -> " . $e->getMessage());
            return false;
        }
    }

    public function updateStatus()
    {
        try {
            $query = $this->prepare("UPDATE reserva SET estado = :estado WHERE idreserva=:idreserva;");
            $query->bindParam(':estado', $this->estado, PDO::PARAM_STR);
            $query->bindParam(':idreserva', $this->idReserva, PDO::PARAM_STR);
            return $query->execute();
        } catch (PDOException $e) {
            error_log("ReservaModel::update() -> " . $e->getMessage());
            return false;
        }
    }
}
