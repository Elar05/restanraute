<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MI CESAR</title>
    <link rel='shortcut icon' type='image/x-icon' href='<?= URL ?>/public/login/img/logo.png' />
    <link rel="stylesheet" href="<?= URL ?>/public/login/css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="wrapper">
        <form action="<?= URL ?>/login/auth" method="post">
            <div class="logo">
                <center><img src="<?= URL ?>/public/login/img/logo.png" alt="usuario" style="height: 12rem"></center>
            </div>
            <h1>RESTAURANTE <h1>"MI CESAR"</h1></h1>
            <div class="mb-2"><?php $this->showMessages() ?></div>
            <div class="input-box">
                <input type="email" placeholder="Correo" name="email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password" autocomplete="on">
                <i class='bx bxs-lock-alt'></i>
            </div>
            <!-- <div class="remember-forgot">
                <label><input type="checkbox">Recuérdame</label>
                <a href="#">Olvidaste tu contraseña??</a>
            </div> -->
            <button type="submit" class="btnIngresar">INGRESAR</button>
            <!-- <div class="consulta-cuenta">
                <p>No tienes una cuenta?
                    Consulta con el administrador
                    <a href="https://wa.me/51982987417?text=Hola%21%20Me%20comunico%20para%20que%20pueda%20crear%20una%20cuenta%20y%20acceder%20al%20sistema%20del%20restaurante%20%22Mi%20C%C3%A9sar%22." target="_blank">
                        <i class='bx bxs-phone'></i> Enviar mensaje por WhatsApp
                    </a>
                </p>
            </div> -->
        </form>
    </div>
</body>
</html>
