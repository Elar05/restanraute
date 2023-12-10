<?php

namespace Models;

use PDO;
use PDOException;
use Libs\Model;

class ClienteModel extends Model
{
    public $idCliente;
    public $documento;
    public $nombres;
    public $email;
    public $telefono;
    public $direccion;
    public $estado;

    public function __construct()
    {
        parent::__construct();
    }

    public function get($value, $colum = "idCliente")
    {
        try {
            $query = $this->prepare("SELECT * FROM cliente WHERE $colum = ?;");
            $query->execute([$value]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("ClienteModel::get() -> " . $e->getMessage());
            return false;
        }
    }

    public function getAll($colum = null, $value = null)
    {
        try {
            $sql = "";
            if ($colum !== null and $value !== null) $sql = " WHERE $colum = '$value'";

            $query = $this->query("SELECT * FROM cliente $sql;");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("ClienteModel::getAll() -> " . $e->getMessage());
            return false;
        }
    }

    public function save()
    {
        try {
            $pdo = $this->connect();
            $query = $pdo->prepare("INSERT INTO cliente(documento,nombres, email, telefono,direccion) 
            VALUES (:documento,:nombres, :email, :telefono, :direccion);");

            $query->bindParam(':documento', $this->documento, PDO::PARAM_STR);
            $query->bindParam(':nombres', $this->nombres, PDO::PARAM_STR);
            $query->bindParam(':email', $this->email, PDO::PARAM_STR);
            $query->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);
            $query->bindParam(':direccion', $this->direccion, PDO::PARAM_STR);

            $query->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("ClienteModel::save() -> " . $e->getMessage());
            return false;
        }
    }

    public function update()
    {
        try {
            $query = $this->prepare("UPDATE cliente SET documento = :documento, nombres = :nombres, email = :email, telefono = :telefono, direccion = :direccion WHERE idCliente = :idCliente;");

            return $query->execute([
                'idCliente' => $this->idCliente,
                'documento' => $this->documento,
                'nombres' => $this->nombres,
                'email' => $this->email,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
            ]);
        } catch (PDOException $e) {
            error_log("ClienteModel::update() -> " . $e->getMessage());
            return false;
        }
    }

    public function delete($idCliente)
    {
        try {
            $query = $this->prepare("DELETE FROM cliente WHERE idCliente = ?;");
            $query->execute([$idCliente]);
            return true;
        } catch (PDOException $e) {
            error_log("ClienteModel::delete() -> " . $e->getMessage());
            return false;
        }
    }

    public function updateStatus()
    {
        try {
            $query = $this->prepare("UPDATE cliente SET estado = :estado WHERE idcliente=:idcliente;");
            $query->bindParam(':estado', $this->estado, PDO::PARAM_STR);
            $query->bindParam(':idcliente', $this->idCliente, PDO::PARAM_STR);
            return $query->execute();
        } catch (PDOException $e) {
            error_log("ClienteModel::update() -> " . $e->getMessage());
            return false;
        }
    }
}
