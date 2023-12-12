<?php require_once 'views/layout/head.php'; ?>

<?php require_once 'views/layout/header.php'; ?>

<div class="main-content">
  <section class="section">
    <div class="section-body">
      <?php if ($this->userType === 1) : ?>
        <div class="row clearfix">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Cantidad de ventas en el año: <?= date('Y') ?> </h4>
              </div>
              <div class="card-body">
                <div class="recent-report__chart">
                  <div id="chart1"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Total de ventas en el año: <?= date('Y') ?> </h4>
              </div>
              <div class="card-body">
                <div class="recent-report__chart">
                  <div id="chart3"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Pie Chart</h4>
              </div>
              <div class="card-body">
                <div class="recent-report__chart">
                  <div id="chart7"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php else : ?>
        <div class="row">
          <div class="col-12">
            <h2>Bienvenido</h2>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>
</div>

<?php require_once 'views/layout/footer.php'; ?>
<script src="<?= URL ?>/public/bundles/apexcharts/apexcharts.min.js"></script>
<!-- Page Specific JS File -->
<script src="<?= URL ?>/public/js/main.js"></script>
<?php require_once 'views/layout/foot.php'; ?>