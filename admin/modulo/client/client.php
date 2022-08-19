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
							<h5 class="mb-2 mb-md-0">Clientes</h5>
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
									<table id="tblCliente" class="table table-striped table-bordered table-condensed table-hover" cellspacing="0" cellpadding="0" width="100%">
											<thead>
												<tr>
													<th>#</th>
													<th>Empresa</th>
													<th>NIT</th>
													<th>Plan</th>
													<th>Plan</th>
													<th>Licencias</th>
													<th>Habilitado</th>
													<th>F. Creación</th>
													<th>F. Modificaión</th>
													<th>Acciones</th>
												</tr>
											</thead>

											<tfoot>
												<tr>
													<th>#</th>
													<th>Empresa</th>
													<th>NIT</th>
													<th>Plan</th>
													<th>Plan</th>
													<th>Licencias</th>
													<th>Habilitado</th>
													<th>F. Creación</th>
													<th>F. Modificaión</th>
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
								<h5 class="mb-2 mb-md-0">Nuevo Cliente</h5>
							</div>
						</div>
					</div>
				</div>
				<form role="form" name="frmClient" id="frmClient" enctype="multipart/form-data">
					<div class="row g-0">
						<div class="col-lg-12">
							<div class="card mb-3">
								<div class="card-body bg-light">
									<div class="row gx-2">
										<div class="col-md-4 mb-3">
											<div class="form-group">
												<input id="client_id" type="hidden" maxlength="50" class="form-control" name="client_id" />
												<div class="form-group">
												<label>Nombre Cliente ó Empresa:</label>
													<input id="client_emp" type="text" class="form-control" name="client_emp" placeholder="Nombre Cliente ó Empresa" data-validation="required" />
											</div>
											</div>
										</div>
										<div class="col-md-4 mb-3">
											<div class="form-group">
												<div class="form-group">
												<label>NIT:</label>
													<input id="client_nit" type="text" class="form-control" name="client_nit" placeholder="NIT" />
											</div>
											</div>
										</div>
										<div class="col-md-4 mb-3">
											<div class="form-group">
												<div class="form-group">
												<label>Fecha de Creación:</label>
													<input id="client_date" type="text" class="form-control" name="client_date" readonly value="" />
											</div>
											</div>
										</div>
									</div>

									<div class="row gx-2">
										<div class="col-md-4 mb-3">
											<div class="form-group">
												<label>Correo Electronico:</label>
													<input id="client_email" type="text" class="form-control" name="client_email" placeholder="Correo Electronico" />
											</div>
										</div>
										<div class="col-md-4 mb-3">
											<div class="form-group">
												<label>Telefono:</label>
													<input id="client_fono" type="text" class="form-control" name="client_fono" placeholder="Telefono" />
											</div>
										</div>
										<div class="col-md-4 mb-3">
											<div class="form-group">
												<label>Fax:</label>
													<input id="client_fax" type="text" class="form-control" name="client_fax" placeholder="Fax" />
											</div>
										</div>
									</div>

									<div class="row gx-2">
										<div class="col-md-8 mb-3">
											<div class="form-group">
												<label>Dirección:</label>
													<input id="client_address" type="text" class="form-control" name="client_address" placeholder="Dirección" />
											</div>
										</div>
										<div class="col-md-4 mb-3">
											<div class="form-group">
												<label>Ciudad:</label>
													<input id="client_city" type="text" class="form-control" name="client_city" placeholder="Ciudad" />
											</div>
										</div>
									</div>

									<div class="row gx-2">
											<div class="col-md-7 mb-3">
												<div class="form-group">
													<label>Suscripción:</label>
													<input id="client_sus" type="text" class="form-control" name="client_sus" data-validation="required" placeholder="Suscripción" />
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="form-group">
													<label>Plan:</label>
													<select id="client_plan" name="client_plan" class="form-select form-control-sm" aria-label="Default select example" >
													</select>

												</div>
											</div>
											<div class="col-md-2 mb-3">
												<div class="form-group">
													<label>Licencias:</label>
														<input id="client_lic" type="number" class="form-control" name="client_lic" placeholder="Licencias" />
												</div>
											</div>
									</div>

									<div class="row gx-2">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 left">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" checked name="client_hab" id="client_hab" >
													<label class="form-check-label" for="client_hab">
													Habilitado
													</label>
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
	<script type="text/javascript" src="../../assets/js/scripts/client.js"></script>
	<script>
		$( document ).ready( function () {
			var validator = $("#frmUsuarios").submit(function() {
				// update underlying textarea before submit validation
			}).validate({
				ignore: "",
				rules: {
					txtEmpresa: "required",
					cboTypeUser: "required",
					txtEmail: {
						required: true,
						email: true
					},
					txtUser: "required",
					txtPassword: {
						required: true,
						minlength: 5
					},
					txtPasswordRep: {
						required: true,
						minlength: 5,
						equalTo: "#txtPassword"
					},
				},
				messages: {
					txtEmail: "Por favor, introduce una dirección de correo válida",
					txtPassword: {
						required: "Por favor ingrese una contraseña",
						minlength: "Tu contraseña debe tener al menos 5 caracteres"
					},
					txtPasswordRep: {
						required: "Por favor ingrese una contraseña",
						minlength: "Tu contraseña debe tener al menos 5 caracteres",
						equalTo: "La contraseña no es igual"
					}
				},
				errorElement: "em",
				errorPlacement: function(label, element) {
					// Add the `invalid-feedback` class to the label element
					label.addClass( "invalid-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						label.insertAfter( element.next() );
					} else {
						//label.insertAfter( element );
						// position label label after generated textarea
						if (element.is("textarea")) {
							label.insertAfter(element.next());
						} else {
							label.insertAfter(element)
						}
					}
				},
				highlight: function ( error, errorClass, validClass ) {
					$( error ).addClass( "is-invalid" ).removeClass( "is-valid" );
				},
				unhighlight: function (error, errorClass, validClass) {
					$( error ).addClass( "is-valid" ).removeClass( "is-invalid" );
				}

			});

		});
	</script>
  </body>

</html>