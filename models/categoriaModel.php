<?php

namespace Models;

use PDO;
use PDOException;
use Libs\Model;

class CategoriaModel extends Model
{
    public $idCategoria;
    public $nombre;

    public $estado;

    public function __construct()
    {
        parent::__construct();
    }
    public function get($id, $colum = "idCategoria")
  {
    try {
      $query = $this->prepare("SELECT * FROM usuario WHERE $colum = ?;");
      $query->execute([$id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("UserModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll($colum = null, $value = null)
  {
    try {
      $sql = "";
      if ($colum !== null) $sql = " WHERE $colum = '$value'";

      $query = $this->query("SELECT * FROM categoria $sql;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("UserModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save()
  {
    try {
      $query = $this->prepare("INSERT INTO categoria(nombre) VALUES (:nombre);");

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
      $query = $this->prepare("UPDATE categoria SET nombre = :nombre, estado = :estado WHERE idCategoria = :idCategoria;");

      return $query->execute([
        'idCategoria' => $this->idCategoria,
        'nombre' => $this->nombre,
        'estado' => $this->nombre,



      ]);
    } catch (PDOException $e) {
      error_log("CategoriaModel::update() -> " . $e->getMessage());
      return false;
    }
  }
}
