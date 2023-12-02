<?php require_once 'views/layout/head.php'; ?>

<?php require_once 'views/layout/header.php'; ?>

<div class="main-content">
  <section class="section">
    <div class="card">
      <div class="card-header">
        <h4>Mantenimiento de usuarios</h4>
      </div>
      <div class="card-body">
        <table class="table table-striped" id="table_usuario">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tipo</th>
              <th>Nombres</th>
              <th>Email</th>
              <th>Télefono</th>
              <th>Dirección</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="tbody"></tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<?php require_once 'views/layout/foot.php'; ?>

<script src="<?= URL ?>/public/js/usuario.js"></script>

<?php require_once 'views/layout/footer.php'; ?>
