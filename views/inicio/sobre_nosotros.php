<?php require_once "views/inicio/layout/header.php"; ?>

<!-- Inicia pg -->
<div class="all-page-title page-breadcrumb">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-12">
                <h1>Sobre nosotros</h1>
            </div>
        </div>
    </div>
</div>
<!-- Fin pg -->

<!-- Empieza sobre nosotros -->
<div class="about-section-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 text-center">
                <div class="inner-column">
                    <h1>Bienvenidos al <span>Restaurante Mi Cesar</span></h1>
                    <h4>Pequeña historia</h4>
                    <p>Te extendemos una cálida invitación a descubrir el encanto y la delicia que ofrecemos en nuestro querido restaurante "Mi Cesar". Con más de 8 años de dedicación a la cocina familiar, nos enorgullece presentar un lugar donde la tradición y la hospitalidad se fusionan para brindarte una experiencia gastronómica única.</p>
                    <p>En "Mi Cesar", no solo encontrarás una variedad exquisita de platillos preparados con esmero y los mejores ingredientes, sino que también experimentarás el calor de nuestra familia y el compromiso de nuestro talentoso equipo. Nos esforzamos por ofrecer platillos generosos a precios accesibles, sin comprometer la calidad ni la atención personalizada que mereces. </p>
                    <!--<a class="btn btn-lg btn-circle btn-outline-new-white" href="#">Reservation</a>-->
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <img src="<?= URL ?>/public/inicio/img/restaurante_Sn.png" alt="" class="img-fluid">
            </div>
            <div class="col-md-12">
                <div class="inner-pt">
                    <p>Descubre la autenticidad de nuestra cocina, donde cada platillo lleva consigo el sabor de la tradición y la pasión que hemos cultivado a lo largo de los años. Desde nuestro equipo administrativo hasta los meseros, chefs y personal de limpieza, todos trabajamos juntos para brindarte una experiencia memorable en cada visita. </p>
                    <p>Nos enorgullece formar parte de la comunidad y esperamos que "Mi Cesar" se convierta en tu destino preferido para disfrutar de momentos especiales, ya sea en familia, con amigos o en solitario. ¡Ven y únete a nosotros para explorar un mundo de sabores, hospitalidad y alegría en cada bocado! </p>
                    <p>Estamos ansiosos por conocerte y compartir contigo la esencia única de "Mi Cesar". ¡Te esperamos con los brazos abiertos! </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin sobre nosotros -->

<!-- Inicio QT -->
<div class="qt-box qt-background">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
                <p class="lead ">
                    ¡Ven y únete a nosotros para explorar un mundo de sabores, hospitalidad y alegría en cada bocado!
                </p>
                <span class="lead">Restaurante "Mi Cesar"</span>
            </div>
        </div>
    </div>
</div>
<!-- Fin QT -->

<!-- Inicio Comentarios de clientes -->
<?php require_once "views/inicio/layout/comentarios.php"; ?>
<!-- Fin de Comentarios de clientes-->

<!-- Inicio de informacion de contacto -->
<div class="contact-imfo-box">
    <div class="container">
        <div class="row">
            <div class="col-md-4 arrow-right">
                <i class="fa fa-volume-control-phone"></i>
                <div class="overflow-hidden">
                    <h4>Teléfono</h4>
                    <p class="lead">
                        +51 982987417
                    </p>
                </div>
            </div>
            <div class="col-md-4 arrow-right">
                <i class="fa fa-envelope"></i>
                <div class="overflow-hidden">
                    <h4>Email</h4>
                    <p class="lead">
                        ivangironf76@gmail.com
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <i class="fa fa-map-marker"></i>
                <div class="overflow-hidden">
                    <h4>Ubicación</h4>
                    <p class="lead">
                        890, Calle Morropon, Piura - Sullana
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin de informacion de contacto-->

<!-- Info pie de página -->
<?php require_once "views/inicio/layout/footer.php" ?>
<!-- Fin pie de página-->

<?php require_once "views/inicio/layout/foot.php" ?>