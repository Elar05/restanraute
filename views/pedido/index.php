<?php require_once 'views/layout/head.php'; ?>

<link rel="stylesheet" href="<?= URL ?>/public/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="<?= URL ?>/public/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">

<?php require_once 'views/layout/header.php'; ?>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="card">
        <div class="card-header">
          <h4>Mantenimiento pedido</h4>

          <button type="button" class="btn btn-primary" id="add_pedido" data-toggle="modal" data-target="#modal_pedido">
            <i class="fa fa-plus"></i> Agregar</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped w-100" id="table_pedido">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>pedido</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="modal_pedido" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Formulario pedidos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_pedido" class="row" method="post" novalidate>
            <input type="hidden" name="id" id="id">
            <input type="hidden" name="action" id="action" value="create">

            <div class="col-6">
              <div>
                <h6>Datos del cliente</h6>

                <?php require_once 'views/cliente/inputs.php'; ?>
              </div>
            </div>
            <div class="col-6">
              <div>
                <h6>Datos del pedido</h6>

                <div class="form-group">
                  <label for="tipo">Tipo de Pedido</label>
                  <select name="tipo" id="tipo" class="form-control" required>
                    <option value="local">Local</option>
                    <option value="delivery">Delivery</option>
                    <option value="reserva">Reserva</option>
                  </select>

                  <div class="invalid-feedback">
                    Oh no! pedido is invalid.
                  </div>
                </div>

                <div id="group_delivery" class="d-none">
                  <div class="form-group">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" id="ciudad" name="ciudad" class="form-control">

                    <div class="invalid-feedback">
                      Oh no! pedido is invalid.
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="direccionDelivery">Dirección</label>
                    <input type="text" id="direccionDelivery" name="direccionDelivery" class="form-control">

                    <div class="invalid-feedback">
                      Oh no! pedido is invalid.
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="costoDelivery">Costo del delivery</label>
                    <input type="text" id="costoDelivery" name="costoDelivery" class="form-control">

                    <div class="invalid-feedback">
                      Oh no! pedido is invalid.
                    </div>
                  </div>
                </div>

                <div id="group_reserva" class="d-none">
                  <div class="form-group">
                    <label for="costoReserva">Costo de la reserva</label>
                    <input type="text" id="costoReserva" name="costoReserva" class="form-control">

                    <div class="invalid-feedback">
                      Oh no! pedido is invalid.
                    </div>
                  </div>
                </div>

                <div class="mt-2 text-right">
                  <button type="submit" class="btn btn-primary">Registrar pedido</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>

<script src="<?= URL ?>/public/bundles/datatables/datatables.min.js"></script>
<script src="<?= URL ?>/public/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script src="<?= URL ?>/public/js/pedido.js"></script>

<?php require_once 'views/layout/foot.php'; ?>