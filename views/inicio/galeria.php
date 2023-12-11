<?php require_once "views/inicio/layout/header.php"; ?>
<body>
	<!-- Inicia todas las páginas -->
	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>Galería</h1>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin todas las paginas -->
	
	<!-- Inicia Galería -->
	<div class="gallery-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Galería</h2>
					</div>
				</div>
			</div>
			<div class="tz-gallery">
				<div class="row">
					<div class="col-sm-12 col-md-4 col-lg-4">
						<a class="lightbox" href="<?= URL ?>/public/inicio/img/galeria_1.png">
							<img class="img-fluid" src="<?= URL ?>/public/inicio/img/galeria_1.png" alt="Gallery Images">
						</a>
					</div>
					<div class="col-sm-6 col-md-4 col-lg-4">
						<a class="lightbox" href="<?= URL ?>/public/inicio/img/galeria_2.png">
							<img class="img-fluid" src="<?= URL ?>/public/inicio/img/galeria_2.png" alt="Gallery Images">
						</a>
					</div>
					<div class="col-sm-6 col-md-4 col-lg-4">
						<a class="lightbox" href="<?= URL ?>/public/inicio/img/galeria_3.png">
							<img class="img-fluid" src="<?= URL ?>/public/inicio/img/galeria_3.png" alt="Gallery Images">
						</a>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4">
						<a class="lightbox" href="<?= URL ?>/public/inicio/img/galeria_4.png">
							<img class="img-fluid" src="<?= URL ?>/public/inicio/img/galeria_4.png" alt="Gallery Images">
						</a>
					</div>
					<div class="col-sm-6 col-md-4 col-lg-4">
						<a class="lightbox" href="<?= URL ?>/public/inicio/img/galeria_5.png">
							<img class="img-fluid" src="<?= URL ?>/public/inicio/img/galeria_5.png" alt="Gallery Images">
						</a>
					</div> 
					<div class="col-sm-6 col-md-4 col-lg-4">
						<a class="lightbox" href="<?= URL ?>/public/inicio/img/galeria_6.png">
							<img class="img-fluid" src="<?= URL ?>/public/inicio/img/galeria_6.png" alt="Gallery Images">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin galería -->
	
	<!-- Inicio Comentarios de clientes -->
	<div class="customer-reviews-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Opiniones de los usuarios</h2>
						<p>¡Descubre lo que nuestros comensales opinan sobre su experiencia en nuestro restaurante!</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 mr-auto ml-auto text-center">
					<div id="reviews" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner mt-4">
							<div class="carousel-item text-center active">
								<div class="img-box p-1 border rounded-circle m-auto">
									<img class="d-block w-100 rounded-circle" src="<?= URL ?>/public/inicio/img/cliente_1.png" alt="">
								</div>
								<h5 class="mt-4 mb-0"><strong class="text-warning text-uppercase">María Campos</strong></h5>
								<h6 class="text-dark m-0">Psicóloga</h6>
								<p class="m-0 pt-3">Desde el momento en que entré, fui recibida por un ambiente cálido y acogedor que inmediatamente estableció el tono para una velada especial. El personal, con su amabilidad y profesionalismo, creó un ambiente donde me sentí atendida y valorada desde el principio.</p>
							</div>
							<div class="carousel-item text-center">
								<div class="img-box p-1 border rounded-circle m-auto">
									<img class="d-block w-100 rounded-circle" src="<?= URL ?>/public/inicio/img/cliente_2.png" alt="">
								</div>
								<h5 class="mt-4 mb-0"><strong class="text-warning text-uppercase">Lizbeth Coronado</strong></h5>
								<h6 class="text-dark m-0">Lic. Ciencias de la comunicación</h6>
								<p class="m-0 pt-3">Los ingredientes frescos y de alta calidad se combinaron de manera innovadora, creando explosiones de sabor que deleitaron mis papilas gustativas. Se demostró un cuidado excepcional por la excelencia culinaria.</p>
							</div>
							<div class="carousel-item text-center">
								<div class="img-box p-1 border rounded-circle m-auto">
									<img class="d-block w-100 rounded-circle" src="<?= URL ?>/public/inicio/img/cliente_3.png" alt="">
								</div>
								<h5 class="mt-4 mb-0"><strong class="text-warning text-uppercase">Daniel Cifuentes</strong></h5>
								<h6 class="text-dark m-0">Técnico eléctrico</h6>
								<p class="m-0 pt-3">El servicio fue impecable. El personal estuvo atento sin ser intrusivo, anticipando mis necesidades y asegurándose de que cada momento fuera placentero. Recomiendo encarecidamente preguntar al camarero por sus sugerencias.</p>
							</div>
							<div class="carousel-item text-center">
								<div class="img-box p-1 border rounded-circle m-auto">
									<img class="d-block w-100 rounded-circle" src="<?= URL ?>/public/inicio/img/cliente_4.png" alt="">
								</div>
								<h5 class="mt-4 mb-0"><strong class="text-warning text-uppercase">Carlos Marciano</strong></h5>
								<h6 class="text-dark m-0">Estudiante universitario</h6>
								<p class="m-0 pt-3">Desde que mi amigo me comentó sobre este lugar tomé la decisión de ir a conocerlo, y al entrar me sumergí en un mundo de sabores exquisitos y un servicio de primera junto a un menú variado y una deliciosa comida. </p>
							</div>
						</div>
						<a class="carousel-control-prev" href="#reviews" role="button" data-slide="prev">
							<i class="fa fa-angle-left" aria-hidden="true"></i>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#reviews" role="button" data-slide="next">
							<i class="fa fa-angle-right" aria-hidden="true"></i>
							<span class="sr-only">Next</span>
						</a>
                    </div>
				</div>
			</div>
		</div>
	</div>
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