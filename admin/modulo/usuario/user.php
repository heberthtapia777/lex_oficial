<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
	<?PHP
		date_default_timezone_set("America/La_Paz" );
		include '../../inc/sessionControl.php';
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
			  <div class="d-flex align-items-center"><img class="mr-2" src="../../assets/img/illustrations/sstei.png" alt="" width="40" /><span class="font-sans-serif">SSTEI</span></div>
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
							<h5 class="mb-2 mb-md-0">Usuarios</h5>
						</div>
						<div class="col-auto">
							<button class="btn btn-outline-primary btn-sm" id="btnNuevo"><i class="fas fa-plus"></i> Nuevo</button>
							<button class="btn btn-outline-danger btn-sm" id="btnCancel" onclick="ocultarForm('','')"><i class="fas fa-window-close"></i> Cancelar</button>
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
									<table id="tblUsuarios" class="table table-striped table-bordered table-condensed table-hover" cellspacing="0" cellpadding="0" width="100%">
											<thead>
												<tr>
													<th>#</th>
													<th>Nombre</th>
													<th>Usuario</th>
													<th>Habilitado</th>
													<th>Tipo Usuario</th>
													<th>Email</th>
													<th>Fecha Registro</th>
													<th>Ultima Visita</th>
													<th>Acciones</th>
												</tr>
											</thead>

											<tfoot>
												<tr>
													<th>#</th>
													<th>Nombre</th>
													<th>Usuario</th>
													<th>Habilitado</th>
													<th>T. Usuario</th>
													<th>Email</th>
													<th>Fecha Registro</th>
													<th>Ultima Visita</th>
													<th>Acciones</th>
												</tr>
											</tfoot>

											<tbody id="usuario">

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
								<h5 class="mb-2 mb-md-0">Nuevo Usuario</h5>
							</div>
						</div>
					</div>
				</div>
				<form role="form" name="frmUser" id="frmUser" enctype="multipart/form-data">
				<div class="row g-0">
					<div class="col-lg-12">
						<div class="card mb-3">
							<div class="card-body bg-light">
								<div class="row gx-2">
									<div class="col-6 mb-3">
										<div class="form-group">
											<input id="txtIdUsuario" type="hidden" maxlength="50" class="form-control" name="txtIdUsuario" />
											<label>Empresa:</label>
											<input id="txtIdEmpresa" type="hidden" class="form-control" name="txtIdEmpresa" />
											<div class="input-group has-success">
												<input id="txtEmpresa" type="text" class="form-control" name="txtEmpresa" data-validation="required" placeholder="Seleccione una Empresa o Cliente" readonly/>
												<span class="input-group-btn" >
													<button type="button" class="btn btn-success" id="btnBuscarCliente"><i class='fa fa-search'></i>
														Buscar
													</button>
												</span>
											</div>
										</div>
									</div>
									<div class="col-6 mb-3">
										<div class="form-group">
											<label>Nombre Usuario:</label>
												<input id="txtUsuario" type="text" class="form-control" name="txtUsuario" placeholder="Nombre Usuario" />
										</div>
									</div>
								</div>

								<div class="row mb-3">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 left">
										<div class="form-group has-success">
											<label>Tipo de Usuario:</label>
											<select id="cboTypeUser" name="cboTypeUser" class="form-select form-control-sm" aria-label="Default select example" >

											</select>
										</div>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 left">
										<div class="form-group">
											<label>Correo Electronico:</label>
												<input id="txtEmail" type="text" class="form-control" name="txtEmail" placeholder="Correo Electronico" data-validation="required email" />
										</div>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 left">
										<div class="form-group">
											<label>Usuario:</label>
												<input id="txtUser" type="text" class="form-control" name="txtUser" data-validation="required" placeholder="Usuario" />
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 left">
										<div class="form-group">
											<label>Contraseña:</label>
												<input id="txtPassword" type="password" class="form-control" name="txtPassword" data-validation="required" placeholder="Contraseña"  />
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 left">
										<div class="form-group">
											<label>Repita contraseña:</label>
												<input id="txtPasswordRep" type="password" class="form-control" name="txtPasswordRep" data-validation="confirmation" data-validation-confirm="txtPassword" placeholder="Repita contraseña"  />
										</div>
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
								<button type="button" class="btn btn-outline-danger btn-sm" onclick="ocultarForm()"><i class="fas fa-window-close"></i> Cancelar</button>
							</div>
						</div>
					</div>
				</div>
				</form>
				</div>
			</div>
			<footer>
				<div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
				<div class="col-12 col-sm-auto text-center">
					<p class="mb-0 text-600">Todos los Derechos Reservados <span class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> 2020 &copy; <a href="https://technosoft-bolivia.com/">TechnoSoft</a></p>
				</div>
				<div class="col-12 col-sm-auto text-center">
					<p class="mb-0 text-600">v1.0.0</p>
				</div>
				</div>
			</footer>
		</div>

		<!-- Modal Empresas-->
		<div class="modal fade" id="modalListaEmpresa" tabindex="-1" role="dialog" aria-labelledby="modalListaEmpresaLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalListaEmpresaLabel">Lista de Clientes ó Empresas</h5><button class="btn-close" type="button" data-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<table id="tblEmpresa" class="table table-striped table-bordered table-condensed table-hover" cellspacing="0" cellpadding="0" width="100%">
							<thead>
								<tr>
									<th><i class="fas fa-check-circle"></i></th>
									<th>#</th>
									<th>Empresa</th>
									<th>NIT</th>
									<th>Email</th>
								</tr>
							</thead>

							<tfoot>
								<tr>
									<th><i class="fas fa-check-circle"></i></th>
									<th>#</th>
									<th>Empresa</th>
									<th>NIT</th>
									<th>Email</th>
								</tr>
							</tfoot>

							<tbody id="Trabajador">

							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cerrar</button>
						<button class="btn btn-primary btn-sm" type="button" id="btnAgregarEmpresa">Agregar</button></div>
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
	<?PHP
		include '../../inc/footer.php'
	?>
	<script type="text/javascript" src="../../assets/js/scripts/user.js"></script>
	<script>
		$( document ).ready( function () {


		});
	</script>
  </body>

</html>