<?php
ob_start();
$pedido = $this->d['pedido'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='shortcut icon' type='image/x-icon' href='<?= URL ?>/public/login/img/logo.png' />

  <title>Comprobante de Pago</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    h1 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    img {
      width: 200px;
    }

    .izquierda {
      float: left;
      margin-right: 100px;
    }
  </style>
</head>

<body>
  <h1>Comprobante de Pago</h1>

  <div>
    <div class="izquierda">
      <h2>Información del Cliente</h2>
      <p><strong>Nombre:</strong> <?= $pedido['nombres'] ?></p>
      <p><strong>Dirección:</strong> <?= $pedido['direccion'] ?></p>
      <p><strong>Email:</strong> <?= $pedido['email'] ?></p>
      <p><strong>Télefono:</strong> <?= $pedido['telefono'] ?></p>
    </div>
    <div class="derecha">
      <img src="<?= URL ?>/public/img/logo_cesar.png" alt="Logo">
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pedido['detalle'] as $item) : ?>
        <tr>
          <td><?= $item['descripcion'] ?></td>
          <td><?= $item['costo'] ?></td>
          <td><?= $item['cantidad'] ?></td>
          <td><?= $item['subtotal'] ?></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td></td>
        <td></td>
        <td><strong>Total: </strong></td>
        <td><?= $pedido['total'] ?></td>
      </tr>
    </tbody>
  </table>
</body>

</html>

<?php

use Dompdf\Dompdf;

$html = ob_get_clean();

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->setIsRemoteEnabled(true);

$dompdf->setOptions($options);

$dompdf->loadHtml($html);


// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("comprobante_pago.pdf", ['Attachment' => 0]);
?>