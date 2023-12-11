<?php require_once "views/inicio/layout/header.php"; ?>
	<!-- Inicio de la página -->
	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>Contacto</h1>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin de la página -->
	
	<!-- Inicio Contacto -->
	<div class="map-full"></div>
	<div class="contact-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Contacto</h2>
						<p>En el Restaurante "Mi Cesar" valoramos la conexión con nuestros clientes. Estamos aquí para responder tus preguntas, recibir tus comentarios y hacer todo lo posible para que tu experiencia con nosotros sea excepcional.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<form id="contactForm">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" id="name" name="name" placeholder="Escribe tu nombre" required data-error="Porfavor ingresa tu nombre">
									<div class="help-block with-errors"></div>
								</div>                                 
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" placeholder="Escribe tu Email" id="email" class="form-control" name="name" required data-error="Porfavor ingresa tu email">
									<div class="help-block with-errors"></div>
								</div> 
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<select class="custom-select d-block form-control" id="guest" required data-error="Porfavor selecciona persona">
									  <option disabled selected>Porfavor selecciona persona*</option>
									  <option value="1">1</option>
									  <option value="2">2</option>
									  <option value="3">3</option>
									  <option value="4">4</option>
									  <option value="5">5</option>
									</select>
									<div class="help-block with-errors"></div>
								</div> 
							</div>
							<div class="col-md-12">
								<div class="form-group"> 
									<textarea class="form-control" id="message" placeholder="Tu mensaje" rows="4" data-error="Escribe tu mensaje" required></textarea>
									<div class="help-block with-errors"></div>
								</div>
								<div class="submit-button text-center">
									<button class="btn btn-common" id="submit" type="submit">Enviar mensaje</button>
									<div id="msgSubmit" class="h3 text-center hidden"></div> 
									<div class="clearfix"></div> 
								</div>
							</div>
						</div>            
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Contacto -->
	
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
	<!-- MAPA DEL RESTAURANTE-->
	<script>
		$('.map-full').mapify({
			points: [
				{
					lat: -4.891387020724344,
					lng: -80.67860982829029,
					marker: true,
					title: 'Marker title',
					infoWindow: 'Restaurante Mi Cesar'
				}
			]
		});	
	</script>
</body>
</html>