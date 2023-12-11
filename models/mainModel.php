<?php

namespace Models;

use PDO;
use PDOException;
use Libs\Model;

class MainModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function getVentasPorMes($year)
    {
        try {
            $query = $this->query("SELECT
          DATE_FORMAT(fecha, '%m') AS mes,
          COUNT(*) AS total
          FROM venta
          WHERE fecha LIKE '$year%'
          GROUP BY mes
          ORDER BY mes;
        ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('MainModel::getVentasPorMes() -> ' . $e->getMessage());
            return false;
        }
    }
    public function getTotalVentasPorMes($year)
    {
        try {
            $query = $this->query("SELECT 
          DATE_FORMAT(fecha, '%m') AS mes, 
          SUM(total) AS total_por_mes 
          FROM venta
          WHERE fecha LIKE '$year%' 
          GROUP BY mes 
          ORDER BY mes;
        ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('MainModel::getTotalVentasPorMes() -> ' . $e->getMessage());
            return false;
        }
    }

    public function getCantidadTipoPedido()
    {
        try {
            $query = $this->query("SELECT COUNT(*) AS total, tipo FROM pedido GROUP BY tipo;");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('MainModel::getCantidadTipoPedido() -> ' . $e->getMessage());
            return false;
        }
    }
}
