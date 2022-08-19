<?php
    include "admin/inc/conexion.php";
?>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- Bootstrap CSS -->
		<link rel="shortcut icon" type="image/x-icon" href="images/logo-pwc.ico" />
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/mdb.css">
		<link rel="stylesheet" href="fontawesome/css/fontawesome.css">
		<link rel="stylesheet" href="fontawesome/css/all.css">
		<link rel="stylesheet" href="css/style.css">
	<title>Tax Litigation</title>
</head>
<style>
	.bg-light{
		background-color: #fff !important;
	}
</style>
<body>
	<!-- Navbar burger on large screens items right-->
<nav class="navbar navbar navbar-light bg-light scrolling-navbar fixed-top">
	<div class="d-flex justify-content-start">
		<img src="images/logo-pwc.jpg" class="img-fluid rounded mr-2 ml-3" width="80" height="auto">
		<a class="navbar-brand ml-2 my-2" href="#" alt="">&nbsp;|&nbsp;Lex&nbsp;Legislacion&nbsp; Express</a>
	</div>
	<!-- Search form -->
	<form class="form-inline d-flex justify-content-center md-form form-md my-2">
		<i class="fas  fa-search" aria-hidden="true"></i>
		<input class="form-control form-control-lg ml-3 w-75" type="text" placeholder="Buscar"
			aria-label="Search">
	</form>
	<!-- Form -->
	<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		<span class="hoverme">Menu</span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">

		<ul class="navbar-nav ml-auto">
			<li class="nav-item ml-auto mr-3">
				<a class="nav-link hoverme" href="index">Inicio <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item dropdown ml-auto mr-3">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Quienes somos
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item hoverme" href="quienes-somos">Lex - Legislacion express</a>
				</div>
			</li>
			<li class="nav-item dropdown ml-auto mr-3">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Servicios legales
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item hoverme" href="tax-litigation">Tax litigation</a>
					<a class="dropdown-item hoverme" href="Compliance-societario-integral">Compliance societario integral</a>
					<a class="dropdown-item hoverme" href="Servicio-de-informacion-normativa-y-capacitacion">Servicio de informacion normativa y capacitacion</a>
					<a class="dropdown-item hoverme" href="Consultoria-laboral-y-de-seguridad-social">Consultoria laboral y de seguridad social</a>
					<a class="dropdown-item hoverme" href="LEX-legislacion-express">LEX - legislacion express</a>
					<a class="dropdown-item hoverme" href="Asignaciones-internacionales">Asignaciones internacionales</a>
				</div>
			</li>
			<li class="nav-item ml-auto mr-3">
				<a class="nav-link hoverme" href="https://www.pwc.com/bo/es.html" target="blank">PWC - Bolivia</a>
			</li>
			<li class="nav-item ml-auto mr-3">
				<a class="nav-link hoverme" href="https://www.pwc.com/bo/es/servicios/asesoramiento-tributario.html" target="blank">PWC - Tax & Legal</a>
			</li>
			<li class="nav-item ml-auto mr-3">
				<a class="nav-link hoverme" href="#">Nuestro equipo</a>
			</li>
			<li class="nav-item dropdown ml-auto mr-3">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Contactos
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item hoverme" href="ubicacion-la-paz">Ubicacion La Paz</a>
					<a class="dropdown-item hoverme" href="ubicacion-santa-cruz">Ubicacion Santa Cruz</a>
				</div>
			</li>
		</ul>
	</div>
</nav>
	<!-- Navbar burger on large screens right -->
<section class="fondo banner">
	<div class="row">
		<div class="align-items-center mt-4 bienvenida">
			<div class="col-lg-12 col-md-12 col-sm-12 ">
				<h3 class="display-5 font-weight-bold mb-2 text-center animated infinite pulse delay-2s slower">Tax Litigation </h3>
			</div>
		</div>
	</div>
</section>

<?php
	$sql = "SELECT * FROM tax_alert ORDER BY (id) ASC";
	$query = $db->Execute($sql);
	//while ($reg = $query->FetchRow()) {

	$row = $query->FetchRow();
?>

<div class="jumbotron suscripcion card card-image text-center">
	<div class="row d-flex justify-content-center">
		<div class="card-deck">
			<div class="card">
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="admin/modulo/taxAlert/img/<?=$row['imagen']?>" class="d-block w-100" alt="...">
						</div>
						<!-- <div class="carousel-item">
							<img src="images/3.jpg" class="d-block w-100" alt="...">
						</div> -->
					</div>
					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>

				<div class="card-body">
					<h5 class="card-title"><?=$row['titulo']?></h5>
					<div class="card-text"><?=$row['resumen'];?></div>
					<button type="button" class="btn btn-dark btn-sm">Mas detalle</button>
				</div>
			</div>
			<?php
				$row = $query->FetchRow();
			?>
			<div class="card">
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
					<div class="carousel-item active">
							<img src="admin/modulo/taxAlert/img/<?=$row['imagen']?>" class="d-block w-100" alt="...">
						</div>
						<!-- <div class="carousel-item">
							<img src="images/3.jpg" class="d-block w-100" alt="...">
						</div> -->
					</div>
					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>

				<div class="card-body">
					<h5 class="card-title"><?=$row['titulo']?></h5>
					<div class="card-text"><?=$row['resumen'];?></div>
					<button type="button" class="btn btn-dark btn-sm">Mas detalle</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Jumbotron -->
<div class="jumbotron suscripcion card card-image text-center">
	<!-- Title -->
	<h2 class="card-title titulo">LEGISLACION EXPRESS</h2>
	<!-- Grid row -->
	<div class="row d-flex justify-content-center">
		<!-- Grid column -->
		<div class="col-xl-7 pb-2">
			<p class="card-text" style="color: #fff;">SUSCRIBETE Y ADQUIERE TODOS NUESTROS BENEFICIOS</p>
		</div>
		<!-- Grid column -->
	</div>
	<!-- Grid row -->
	<div class="pt-2">
		<a href="suscripcion.html" type="button" class="btn btn-blue waves-effect">Suscribete <span class="fas  fa-gem ml-1"></span></a>
	</div>
</div>
<!-- Jumbotron -->
<!-- Footer -->
<footer class="page-footer font-small pt-4">
	<!-- Footer Links -->
	<div class="container text-center text-md-left">
			<!-- Grid row -->
			<div class="row">
					<!-- Grid column -->
					<div class="col-md-4 mx-auto">
							<!-- Content -->
							<h5 class="font-weight-bold text-uppercase mt-3 mb-4">
									Oficinas
							</h5>
							<p>
									La Paz: Edif. Ana Maria, Piso 1,2 y 3, Pasaje Villegas N° 383, San Jorge.
							</p>
							<p>
									Santa Cruz:Calle Dr. Viador Pinto esquina calle I Equipetrol Edificio Omnia Dei - Primer Piso
							</p>
					</div>
					<!-- Grid column -->
					<hr class="clearfix w-100 d-md-none">
							<!-- Grid column -->
							<div class="col-md-4">
									<!-- Links -->
									<h5 class="font-weight-bold text-uppercase mt-3 mb-4">
											Siguenos en
									</h5>
									<!-- Social buttons -->
									<ul class="list-unstyled list-inline">
											<li class="list-inline-item">
													<a class="btn-floating mx-1">
															<img class="img-fluid" height="25" src="images/facebook.png" width="25">
															</img>
													</a>
											</li>
											<li class="list-inline-item">
													<a class="btn-floating mx-1">
															<img class="img-fluid" height="25" src="images/twitter.png" width="25">
															</img>
													</a>
											</li>
											<li class="list-inline-item">
													<a class="btn-floating mx-1">
															<img class="img-fluid" height="25" src="images/google_mas.png" width="25">
															</img>
													</a>
											</li>
											<li class="list-inline-item">
													<a class="btn-floating mx-1">
															<img class="img-fluid" height="25" src="images/likedin.png" width="25">
															</img>
													</a>
											</li>
											<li class="list-inline-item">
													<a class="btn-floating mx-1">
															<img class="img-fluid" height="25" src="images/mundo.png" width="25">
															</img>
													</a>
											</li>
									</ul>
									<!-- Social buttons -->
							</div>
							<!-- Grid column -->
							<hr class="clearfix w-100 d-md-none">
									<!-- Grid column -->
									<div class="col-md-4 mx-auto">
											<!-- Links -->
											<h5 class="font-weight-bold text-uppercase mt-3 mb-4">
													Escribenos
											</h5>
											<p><a href="" class="btn btn-sm btn-success btn-rounded" data-toggle="modal" data-target="#modalLoginForm">Ingresar</a></p>
											<p><button class="btn btn-sm btn-primary">Mapa del sitio</button></p>
									</div>
									<!-- Grid column -->
							</hr>
					</hr>
			</div>
			<!-- Grid row -->
	</div>
	<!-- Footer Links -->
	<hr>
			<div class="mx-3">
					<p>
							© 2017 - 2021 PwC. Todos los derechos reservados. No se permite la distribución adicional sin autorización de PwC. “PwC” hace referencia a la red de firmas miembros de PricewaterhouseCoopers International Limited (PwCIL) o, según cada caso concreto, a firmas miembros individuales de la red PwC. Cada firma miembro es una entidad jurídica independiente y no actúa como agente de PwCIL ni de ninguna otra firma miembro. PwCIL no presta servicios a clientes. PwCIL no se responsabiliza ni responde de los actos u omisiones de ninguna de sus firmas miembros, ni del contenido profesional de sus trabajos ni puede vincularlas u obligarlas en forma alguna. De igual manera, ninguna de las firmas miembro son responsables por los actos u omisiones del resto de las firmas miembros ni del contenido profesional de sus trabajos, ni pueden vincular u obligar ni a dichas firmas miembros ni a PwCIL en forma alguna.
					</p>
					<div class="row text-center mb-3">
							<div class="col-lg-3">
									<a href="">
											Política de Privacidad
									</a>
							</div>
							<div class="col-lg-3">
									<a href="">
											Información sobre cookies
									</a>
							</div>
							<div class="col-lg-3">
									<a href="">
											Términos Legales
									</a>
							</div>
							<div class="col-lg-3">
									<a href="">
											Acerca del proveedor de este sitio
									</a>
							</div>
					</div>
			</div>
			<!-- modal login -->
			<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="modalLoginForm" role="dialog" tabindex="-1">
					<div class="modal-dialog" role="document">
							<div class="modal-content">
									<div class="modal-header text-center">
											<h4 class="modal-title w-100 font-weight-bold" style="color: #000;">
													Ingresar
											</h4>
											<button aria-label="Close" class="close" data-dismiss="modal" type="button">
													<span aria-hidden="true">
															×
													</span>
											</button>
									</div>
									<div class="modal-body mx-3">
											<div class="md-form mb-5">
													<i class="fas  fa-user prefix grey-text">
													</i>
													<input class="form-control validate" id="defaultForm-email" type="email">
															<label data-error="wrong" data-success="right" for="defaultForm-email">
																	Usuario
															</label>
													</input>
											</div>
											<div class="md-form mb-4">
													<i class="fas  fa-lock prefix grey-text">
													</i>
													<input class="form-control validate" id="defaultForm-pass" type="password">
															<label data-error="wrong" data-success="right" for="defaultForm-pass">
																	Contraseña
															</label>
													</input>
											</div>
									</div>
									<div class="modal-footer d-flex justify-content-center">
											<button class="btn btn-sm btn-secondary">
													Ingresar
											</button>
									</div>
							</div>
					</div>
			</div>
			<!-- modal login -->
			<!-- Copyright -->
			<div class="footer-copyright text-center py-3">
					© 2021 Copyright:
					<a href="http://www.technosoft-bolivia.com">
							TechnoSoft
					</a>
			</div>
			<!-- Copyright -->
	</hr>
</footer>
<!-- Footer -->
<?php
		include "chat.php";
?>
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="js/responsiveslides.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/mdb.js"></script>
		<!-- <script>
			// Material Select Initialization
		$(document).ready(function() {
			$('.mdb-select').materialSelect();
		});
		</script>
		<script>
			$(document).ready(function() {
				$('.datepicker').datepicker()
		});
	</script>-->
		<script type="text/javascript">
			$(document).ready(function(){
				/* $('.mdb-select').materialSelect();
				$('.datepicker').datepicker() */

				$("#hide").on('click', function() {
					$("#element").hide();
					return false;
				});

				$("#show").on('click', function() {
					$("#element").show(3000);
					return false;
				});
			});
		</script>

</body>
</html>
