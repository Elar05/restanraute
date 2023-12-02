<?php

namespace Controllers;

use Libs\Session;
use Models\PagoModel;

class Pago extends Session
{
    public $model;

    public function __construct($url)
    {
        parent::__construct($url);
        $this->model = new PagoModel();
    }

    public function render()
    {
        $this->view->render('pago/index');
    }

    public function list()
    {
        $data = [];
        $pagos = $this->model->getAll();
        if (count($pagos) > 0) {
            foreach ($pagos as $pago) {
                $botones = "<button class='btn btn-warning edit' idPago='{$pago["idPago"]}'><i class='fas fa-pen'></i></button>";

                $class = ($pago["estado"] === "1") ? "success" : "danger";
                $text = ($pago["estado"] === "1") ? "Activo" : "Inactivo";

                $estado = "<span class='badge badge-$class text-uppercase font-weight-bold cursor-pointer'>$text</span>";
                $estado .= "<button class='ml-1 btn btn-info estado' data-idpago='{$pago["idpago"]}' data-estado='{$pago["estado"]}'><i class='fas fa-sync'></i></button>";

                $data[] = [
                    $pago["idPago"],
                    $pago["nombre"],
                    $estado,
                    $botones,
                ];
            }
        }

        $this->response(["data" => $data]);
    }

    public function create()
    {
        if (!$this->existsPOST(['nombre'])) {
            $this->response(["error" => "Faltan parametros"]);
        }

        $this->model->nombre = $this->getPost('nombre');

        if ($this->model->save()) {
            $this->response(["success" => "Pago registrado"]);
        }
        $this->response(["error" => "Error al registrar pago"]);
    }

    public function get()
    {
        if (!$this->existsPOST(['idPago'])) {
            $this->response(["error" => "Faltan parametros"]);
        }

        if ($pago = $this->model->get($this->getPost('idPago'))) {

            $this->response(["success" => "Pago encontrado", "pago" => $pago]);
        } else {
            $this->response(["error" => "Error al buscar pago"]);
        }
    }

    public function edit()
    {
        if (!$this->existsPOST(['idPago', 'nombre'])) {
            $this->response(["error" => "Faltan parametros"]);
        }

        $this->model->idPago = $this->getPost('idPago');
        $this->model->nombre = $this->getPost('nombre');

        if ($this->model->update()) {
            $this->response(["success" => "pago actualizado"]);
        }
        $this->response(["error" => "Error al actualizar pago"]);
    }

    public function updateStatus()
    {
        if (!$this->existsPOST(['idPago', 'estado'])) {
            $this->response(['error' => 'Faltan parametros']);
        }

        $this->model->idPago = $this->getPost('idPago');
        $this->model->estado = ($this->getPost('estado') == 0) ? 1 : 0;

        if ($this->model->updateStatus()) {
            $this->response(["success" => "Estado actualizado"]);
        }

        $this->response(["error" => "Error al actualizar estado"]);
    }
}
