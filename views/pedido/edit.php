<?php require_once 'views/layout/head.php'; ?>

<link rel="stylesheet" href="<?= URL ?>/public/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="<?= URL ?>/public/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">

<?php
require_once 'views/layout/header.php';
$pedido = $this->d['pedido'];
?>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body mx-auto">
      <form id="form_pedido" class="row mt-3" method="post" novalidate>
        <input type="hidden" name="id" id="id" value="<?= $pedido['idPedido'] ?>">
        <input type="hidden" name="items" id="items" value='<?= json_encode($pedido['detalle']) ?>'>
        <input type="hidden" name="action" id="action" value="update">

        <div class="col-3">
          <div class="card">
            <div class="card-header">
              <h6 class="m-0">Datos del cliente</h6>
            </div>
            <div class="card-body">
              <?php require_once 'views/cliente/inputs.php'; ?>
            </div>
          </div>
        </div>

        <div class="col-4">
          <div class="card">
            <div class="card-header">
              <h6 class="m-0">Datos del pedido</h6>
            </div>

            <div class="card-body">
              <div class="form-group">
                <label for="tipo">Tipo de Pedido</label>
                <select name="tipo" id="tipo" class="form-control" required>
                  <option value="local" <?= ($pedido['tipo'] === 'local') ? 'selected' : '' ?>>Local</option>
                  <option value="delivery" <?= ($pedido['tipo'] === 'delivery') ? 'selected' : '' ?>>Delivery</option>
                </select>

                <div class="invalid-feedback">
                  Oh no! pedido is invalid.
                </div>
              </div>

              <div id="group_delivery" class="<?= ($pedido['tipo'] === 'delivery') ? '' : 'd-none' ?>">
                <div class="form-group">
                  <label for="direccionDelivery">Dirección de delivery</label>
                  <input type="text" id="direccionDelivery" name="direccionDelivery" class="form-control" value="<?= $pedido['delivery']['direccion'] ?? '' ?>">

                  <div class="invalid-feedback">
                    Oh no! pedido is invalid.
                  </div>
                </div>

                <div class="form-group">
                  <label for="costoDelivery">Costo del delivery</label>
                  <input type="text" id="costoDelivery" name="costoDelivery" class="form-control" value="<?= $pedido['delivery']['costo'] ?? '' ?>">

                  <div class="invalid-feedback">
                    Oh no! pedido is invalid.
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="comprobante">Comprobante</label>
                <select name="comprobante" id="comprobante" class="form-control" required>
                  <option value="B" <?= ($pedido['comprobante'] === 'B') ? 'selected' : '' ?>>Boleta</option>
                  <option value="F" <?= ($pedido['comprobante'] === 'F') ? 'selected' : '' ?>>Factura</option>
                </select>

                <div class="invalid-feedback">
                  Seleccione un comprobante
                </div>
              </div>
              <div class="form-group">
                <label for="pago">Método de pago</label>
                <select name="pago" id="pago" class="form-control" required>
                  <?php foreach ($this->d['metodosPago'] as $pago) : ?>
                    <option value="<?= $pago['idPago'] ?>" <?= ($pedido['pago'] == $pago['idPago']) ? 'selected' : '' ?>><?= $pago['nombre'] ?></option>
                  <?php endforeach; ?>
                </select>

                <div class="invalid-feedback">
                  Seleccione un pago
                </div>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input name="descripcion" id="descripcion" class="form-control" required value="<?= $pedido['descripcion'] ?>">

                <div class="invalid-feedback">
                  Seleccione un descripcion
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-5">
          <div class="card">
            <div class="card-body">
              <h6>Productos disponibles</h6>
              <table class="table table-striped table-sm w-100" id="tableItems">
                <thead>
                  <tr>
                    <th>Desc.</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>

              <h6 class="mt-3">Productos a comprar</h6>
              <table class="table table-sm w-100">
                <thead>
                  <tr>
                    <th>Desc.</th>
                    <th style="width: 110px;">Precio</th>
                    <th>Cantidad</th>
                    <th style="width: 120px;">Subtotal</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="tbody_detalle">
                  <?php foreach ($pedido['detalle'] as $item) : ?>
                    <tr data-iditem='<?= $item['iditem'] ?>'>
                      <td><?= $item['descripcion'] ?></td>
                      <td><input type=number min="<?= $item['costo'] ?>" value="<?= $item['costo'] ?>" class='form-control form-control-sm precio'></td>
                      <td><input type=number min="<?= $item['cantidad'] ?>" value="<?= $item['cantidad'] ?>" max="<?= $item['stock'] ?>" class='form-control form-control-sm cantidad'></td>
                      <td><input type=number min="<?= $item['subtotal'] ?>" value="<?= $item['subtotal'] ?>" class='form-control form-control-sm subtotal' readonly></td>
                      <td><button class='btn btn-sm btn-danger deleteItem'><i class='fas fa-times'></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

              <div class="d-flex">
                <div class="form-group">
                  <label for="subtotal">Subtotal</label>
                  <input name="subtotal" id="subtotal" class="form-control" value="<?= $pedido['subtotal'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="igv">IGV</label>
                  <input name="igv" id="igv" class="form-control" value="<?= $pedido['igv'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="total">Total</label>
                  <input name="total" id="total" class="form-control" value="<?= $pedido['total'] ?>" required>
                </div>
              </div>

              <div class="mt-2 text-right">
                <button type="submit" class="btn btn-primary">Registrar pedido</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>

<?php require_once 'views/layout/footer.php'; ?>

<script src="<?= URL ?>/public/bundles/datatables/datatables.min.js"></script>
<script src="<?= URL ?>/public/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script src="<?= URL ?>/public/js/pedido.js" type="module"></script>
<script>
  $(document).ready(function() {
    $("#documento").val('<?= $pedido['documento'] ?>');
    $("#nombres").val('<?= $pedido['nombres'] ?>');
    $("#email").val('<?= $pedido['email'] ?>');
    $("#telefono").val('<?= $pedido['telefono'] ?>');
    $("#direccion").val('<?= $pedido['direccion'] ?>');
  });
</script>
<?php require_once 'views/layout/foot.php'; ?>