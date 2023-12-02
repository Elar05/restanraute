<?php require_once 'views/layout/head.php'; ?>

<link rel="stylesheet" href="<?= URL ?>/public/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="<?= URL ?>/public/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">

<?php require_once 'views/layout/header.php'; ?>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="card">
        <div class="card-header justify-content-between">
          <h4>Formulario nuevo pedido</h4>

          <a href="<?= URL ?>/pedido" class="btn btn-primary">
            <i class="fa fa-arrow-left"></i> Listado</a>
        </div>
        <div class="card-body">
          <form id="form_pedido" class="row" method="post" novalidate>
            <input type="hidden" name="id" id="id">
            <input type="hidden" name="action" id="action" value="create">

            <div class="col-4">
              <div>
                <h6>Datos del cliente</h6>

                <?php require_once 'views/cliente/inputs.php'; ?>
              </div>
            </div>

            <div class="col-4">
              <div>
                <h6>Productos disponibles</h6>
                <div class="table-responsive">
                  <table class="table table-striped table-sm w-100" id="table_producto">
                    <thead>
                      <tr>
                        <th>Desc.</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>

                <h6>Productos a comprar</h6>
                <div class="table-responsive">
                  <table class="table table-sm w-100">
                    <thead>
                      <tr>
                        <th>Desc.</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="tbody_detalle"></tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-4">
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
  </section>
</div>

<?php require_once 'views/layout/footer.php'; ?>

<script src="<?= URL ?>/public/bundles/datatables/datatables.min.js"></script>
<script src="<?= URL ?>/public/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script src="<?= URL ?>/public/js/pedido.js"></script>

<?php require_once 'views/layout/foot.php'; ?>