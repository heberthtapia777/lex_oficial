<?php
	require '../../inc/sessionControl.php';
	//require_once '../../PHPThumb/ThumbLib.inc.php';

	setlocale(LC_TIME, "spanish");
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
	<?PHP
		include '../../inc/header.php';
	?>
</head>
	<body>
		<!-- ===============================================-->
		<!--    Main Content-->
		<!-- ===============================================-->
		<main class="main" id="top">
		<div class="container" data-layout="container">
			<script>
			var isFluid = JSON.parse(localStorage.getItem('isFluid'));
			if (isFluid) {
				var container = document.querySelector('[data-layout]');
				container.classList.remove('container');
				container.classList.add('container-fluid');
			}
			</script>
				<?PHP
					include '../../inc/menu.php';
				?>
			<div class="content">
			<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand" style="display: none;">
				<button class="btn navbar-toggler-humburger-icon navbar-toggler mr-1 mr-sm-3" type="button" data-toggle="collapse" data-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
				<a class="navbar-brand mr-1 mr-sm-3" href="../index-2.html">
				<div class="d-flex align-items-center"><img class="mr-2" src="../../../images/logo_pwc.png" alt="" width="40" /><span class="font-sans-serif">LEX</span></div>
				</a>
					<?PHP
						include '../../inc/search.php';
						include '../../inc/menuTop.php';
					?>
			</nav>
			<script>
				var navbarPosition = localStorage.getItem('navbarPosition');
				var navbarVertical = document.querySelector('.navbar-vertical');
				var navbarTopVertical = document.querySelector('.content .navbar-top');
				var navbarTop = document.querySelector('[data-layout] .navbar-top');
				var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');

				if (navbarPosition === 'top') {
				navbarTop.removeAttribute('style');
				navbarTopVertical.remove(navbarTopVertical);
				navbarVertical.remove(navbarVertical);
				//navbarTopCombo.remove(navbarTopCombo);
				} else if (navbarPosition === 'combo') {
				navbarVertical.removeAttribute('style');
				navbarTopCombo.removeAttribute('style');
				navbarTop.remove(navbarTop);
				navbarTopVertical.remove(navbarTopVertical);
				} else {
				navbarVertical.removeAttribute('style');
				navbarTopVertical.removeAttribute('style');
				navbarTop.remove(navbarTop);
				//navbarTopCombo.remove(navbarTopCombo);
				}
			</script>
			<div class="card mb-3">
				<div class="card-body">
					<div class="row flex-between-center">
						<div class="col-md">
							<h5 class="mb-2 mb-md-0">Gestor Indice</h5>
						</div>
						<div class="col-auto">
							<button class="btn btn-outline-primary btn-sm" id="btnNuevo"><i class="fas fa-plus"></i> Nuevo</button>
							<button class="btn btn-outline-danger btn-sm" id="btnCancel" onclick="ocultarForm()"><i class="fas fa-window-close"></i> Cancelar</button>
						</div>
					</div>
				</div>
			</div>
			<div id="verLista">

				<div class="row g-0">
					<div class="col-lg-12">
						<div class="card mb-3">
							<div class="card-body bg-light">
								<div class="row gx-2">
									<table id="tblIndice" class="table table-striped table-bordered table-condensed table-hover" cellspacing="0" cellpadding="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Indice</th>
												<th>Acciones</th>
											</tr>
										</thead>

										<tfoot>
											<tr>
												<th>#</th>
												<th>Indice</th>
												<th>Acciones</th>
											</tr>
										</tfoot>

										<tbody id="">

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div id="verForm">
				<div class="card mb-3">
					<div class="card-body">
						<div class="row flex-between-center">
							<div class="col-md">
								<h5 class="mb-2 mb-md-0">Nuevo Indice</h5>
							</div>

						</div>
					</div>
				</div>
				<form role="form" name="frmIndice" id="frmIndice" enctype="multipart/form-data" class="cmxform">
				<div class="row g-0">
					<div class="col-lg-12 pr-lg-2">
						<div class="card mb-3">
							<div class="card-body bg-light">
								<div class="row gx-2">
									<div class="col-12 mb-3">
										<input id="indice_id" type="hidden" name="indice_id" />
										<label class="form-label" for="indice_title">Indice</label>
										<input class="form-control" id="indice_title" name="indice_title" type="text" placeholder="Titulo" />
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

				<div class="card mt-3">
					<div class="card-body">
						<div class="row justify-content-between align-items-center">
							<div class="col-auto">
								<button type="submit" class="btn btn-outline-success btn-sm mr-2"><i class="fas fa-save"></i> Guardar</button>
								<button class="btn btn-outline-danger btn-sm" onclick="ocultarForm()"><i class="fas fa-window-close"></i> Cancelar</button>
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
			<footer>
				<div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
				<div class="col-12 col-sm-auto text-center">
					<p class="mb-0 text-600">Thank you for creating with Falcon <span class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> 2020 &copy; <a href="https://themewagon.com/">Themewagon</a></p>
				</div>
				<div class="col-12 col-sm-auto text-center">
					<p class="mb-0 text-600">v3.0.0-alpha9</p>
				</div>
				</div>
			</footer>
			</div>

			<!-- Modal Empresas-->
			<div class="modal fade" id="modalBuscaBoletin" tabindex="-1" role="dialog" aria-labelledby="modalBuscaBoletinLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalBuscaBoletinLabel">Buscar boletin</h5><button class="btn-close" type="button" data-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body" id="busBol">
							<form role="form" name="frmSearch" id="frmSearch" enctype="multipart/form-data">
								<div class="row mb-3">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
										<div class="form-group">
											<label>Nro. boletin:</label>
											<input id="idCon" type="hidden" name="idCon" value="" />
											<input id="idNam" type="hidden" name="idNam" value="" />
											<input id="idBol" type="text" class="form-control" name="idBol" placeholder="Nro. boletin" />
										</div>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
										<div class="form-group">
											<label>Tipo:</label>
											<select id="tipo" name="tipo" class="form-select" aria-label="Default select example" data-validation="required" >

											</select>
										</div>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
										<div class="form-group">
											<label>Palabras:</label>
											<input id="text" type="text" class="form-control" name="text" placeholder="Nro. boletin" />
										</div>
									</div>
								</div>
								<div class="row mb-3">
									<div class="form-group">
										<button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Buscar</button>
									</div>
								</div>
							</form>
							<div class="row mb-3">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left" id="resSearch">

								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
			<?php
				include "../../inc/modalConfig.php";
			?>

		</div>
		</main><!-- ===============================================-->
		<!--    End of Main Content-->
		<!-- ===============================================-->



		<!-- ===============================================-->
		<!--    JavaScripts-->
		<!-- ===============================================-->
		<!-- <script src="../vendors/popper/popper.min.js"></script>
		<script src="../vendors/bootstrap/bootstrap.min.js"></script>
		<script src="../vendors/anchorjs/anchor.min.js"></script>
		<script src="../vendors/is/is.min.js"></script>
		<script src="../vendors/choices/choices.min.js"></script>
		<script src="../assets/js/flatpickr.js"></script>
		<script src="../vendors/dropzone/dropzone.min.js"></script>
		<script src="../vendors/fontawesome/all.min.js"></script>
		<script src="../vendors/lodash/lodash.min.js"></script>
		<script src="../../../../polyfill.io/v3/polyfill.min58be.js?features=window.scroll"></script>
		<script src="../vendors/list.js/list.min.js"></script>
		<script src="../assets/js/theme.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet"> -->

		<?PHP
			include '../../inc/footer.php'
		?>

		<script src="../../assets/js/scripts/indice.js"></script>

	</body>
</html>