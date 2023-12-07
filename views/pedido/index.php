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

          <a href="<?= URL ?>/pedido/nuevo" class="btn btn-primary">
            <i class="fa fa-plus"></i> Agregar Nuevo</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped w-100" id="table_pedido">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Usuario</th>
                  <th>Cliente</th>
                  <th>Tipo</th>
                  <th>Total</th>
                  <th>Estado</th>
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
</div>

<?php require_once 'views/layout/footer.php'; ?>

<script src="<?= URL ?>/public/bundles/datatables/datatables.min.js"></script>
<script src="<?= URL ?>/public/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script src="<?= URL ?>/public/js/pedido.js" type="module"></script>

<?php require_once 'views/layout/foot.php'; ?>