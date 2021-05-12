<!DOCTYPE html>
<html lang="en-US" dir="ltr">
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
              navbarTopCombo.remove(navbarTopCombo);
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
          	<div class="card">
		  		<div class="card-header">
                  	<h5 class="mb-0" data-anchor="data-anchor">Empleados</h5>
                </div>
            <div class="card-body bg-light">
				<div id="verLista">
					<div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
						<div class="col-12 col-sm-auto text-center">
							<button class="btn btn-primary" id="btnNuevo"><i class="fa fa-file"></i> Nuevo</button>
						</div>
					</div>
					<table id="tblEmpleado" class="table table-striped table-bordered table-condensed table-hover" cellspacing="0" cellpadding="0" width="100%">
                    <thead>
                        <tr>
                        	<th>#</th>
                            <th>Nombre</th>
                            <th>Tipo Doc.</th>
                            <th># Doc.</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Login</th>
                            <th>Foto</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Apellidos</th>
                            <th>Documento</th>
                            <th>Num. Documento</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Login</th>
                            <th>Foto</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>

                    <tbody id="empleado">

                    </tbody>
                </table>
				</div>
				<div class=""  id="VerForm">
					<form role="form" name="frmEmpleado" id="frmEmpleado" enctype="multipart/form-data" class="needs-validation" novalidate="">
						<div class="row">
							<div class="col-lg-12 left">
								<div class="row">
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
										<label>Los campos con (*) son olbigatorios</label>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group has-success">
											<input id="txtIdEmpleado" type="hidden" maxlength="50" class="form-control" name="txtIdEmpleado" placeholder="" autofocus="" />
											<label>Apellido Paterno (*):</label>
											<input id="txtApellidos" type="text" maxlength="40" name="txtApellidos" required class="form-control" placeholder="Apellidos" autofocus="" />
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group has-success">
											<label>Nombre (*):</label>
											<input id="txtNombre" type="text" maxlength="20" name="txtNombre" required="" class="form-control" placeholder="Nombre" autofocus="" />
										</div>
									</div>
								</div>

							</div>
							<div class="col-lg-12 left">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group has-success">
											<label>Tipo Documento (*):</label>
											<select id="cboTipo_Documento" required="" name="cboTipo_Documento" class="form-control">

											</select>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group has-success">
											<label>Documento (*):</label>
											<input id="txtNum_Documento" type="text" maxlength="20" name="txtNum_Documento" required="" class="form-control" placeholder="Número de documento" autofocus="" />
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 left">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group has-success">
											<label>Dirección:</label>
											<input id="txtDireccion" type="text" maxlength="100" name="txtDireccion" placeholder="Ingrese la dirección" class="form-control" autofocus="" />
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 left">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div id="mapa" class="form-group"></div><!--End mapa-->
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="row">
											<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
												<div class="form-group has-success">
													<label>Buscar en Google Maps:</label>
													<input id="buscar" name="buscar" type="text" placeholder="Buscar en Google Maps" value="" class="form-control" autocomplete="off"/>
												</div>
											</div>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12  form-group">
												<button type="button" id="search" class="btn btn-primary" style="margin-top: 25px;" >
													<i class="fa fa-search" aria-hidden="true"></i>
													<span>Buscar</span>
												</button>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group has-success">
													<input id="cx" name="cx" type="text" placeholder="Latitud" value="" readonly class="form-control" data-validation="required"/>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group has-success">
													<input id="cy" name="cy" type="text" placeholder="Longitud" value="" readonly class="form-control" data-validation="required"/>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12  form-group">
												<button type="button" class="btn btn-primary" onclick="initMap();" >
													<i class="fa fa-refresh" aria-hidden="true"></i>
													<span>Cargar Mapa</span>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 left">
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<div class="form-group has-success">
											<label>Teléfono:</label>
											<input id="txtTelefono" type="text" maxlength="20" name="txtTelefono" class="form-control" placeholder="Ingrese el teléfono" autofocus="" />
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<div class="form-group has-success">
											<label>Email:</label>
											<input id="txtEmail" type="text" maxlength="70" name="txtEmail"  class="form-control" placeholder="Ingrese el email" autofocus="" />
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-12 left">
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<div class="form-group has-success">
											<label>Fecha Nacimiento:</label>
											<input id="txtFecha_Nacimiento" type="date" name="txtFecha_Nacimiento" class="form-control" autofocus="" />
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<div class="form-group has-success">
											<label>Foto (*):</label>
											<input id="imagenEmp" type="file" class="form-control" name="imagenEmp" autofocus="" />
										<input id="txtRutaImgEmp" type="text" class="form-control" name="txtRutaImgEmp" autofocus="" />
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<div class="form-group has-success">
											<label>Estado (*):</label>
											<select class="form-control" required="" name="txtEstado" id="txtEstado">
											<option value="A">Activado</option>
											<option value="C">Cancelado</option>
											<option value="S">SuperAdmin</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">
										<div class="form-group has-success">
											<label>Login (*):</label>
											<input id="txtLogin" type="text" class="form-control" required="" maxlength="50" name="txtLogin" autofocus="" />

										</div>
									</div>

									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">
										<div class="form-group">
											<div class="form-group has-success">
												<label>Clave (*):</label>
												<input id="txtClave" type="text" required="" class="form-control" maxlength="32" name="txtClave" autofocus="" />
												<input id="txtClaveOtro" type="text" class="form-control" maxlength="32" name="txtClaveOtro" autofocus="" />
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
						<div class="row">

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
									<h5></h5>
									<button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Registrar</button>
									<a href="Empleado.php" class="btn btn-primary" ><i class="fa fa-remove"></i> Cancelar</a>
									<hr>
									<span class="lead text-primary"></span>


							</div>
						</div>
					</form>
				</div>
            </div>
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
        <div class="modal fade modal-fixed-right modal-theme overflow-hidden" id="settings-modal" tabindex="-1" role="dialog" aria-labelledby="settings-modal-label" aria-hidden="true" data-options='{"autoShow":true,"autoShowDelay":3000,"showOnce":true}'>
          <div class="modal-dialog modal-dialog-vertical" role="document">
            <div class="modal-content border-0 vh-100 scrollbar">
              <div class="modal-header modal-header-settings">
                <div class="z-index-1 py-1">
                  <h5 class="text-white" id="settings-modal-label"> <span class="fas fa-palette mr-2 fs-0"></span>Settings</h5>
                  <p class="mb-0 fs--1 text-white opacity-75"> Set your own customized style</p>
                </div><button class="btn-close btn-close-white z-index-1 mt-0" type="button" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body px-card">
                <div class="d-flex justify-content-between">
                  <div class="d-flex align-items-start"><img class="mr-2" src="../../assets/img/icons/left-arrow-from-left.svg" width="20" alt="" />
                    <div class="flex-1">
                      <h5 class="fs-0">RTL Mode</h5>
                      <p class="fs--1 mb-0">Switch your language direction </p>
                    </div>
                  </div>
                  <div class="form-check form-switch"><input class="form-check-input ml-0" id="mode-rtl" type="checkbox" /></div>
                </div>
                <hr />
                <div class="d-flex justify-content-between">
                  <div class="d-flex align-items-start"><img class="mr-2" src="../../assets/img/icons/arrows-h.svg" width="20" alt="" />
                    <div class="flex-1">
                      <h5 class="fs-0">Fluid Layout</h5>
                      <p class="fs--1 mb-0">Toggle container layout system </p>
                    </div>
                  </div>
                  <div class="form-check form-switch"><input class="form-check-input ml-0" id="mode-fluid" type="checkbox" /></div>
                </div>
                <hr />
                <div class="d-flex align-items-start"><img class="mr-2" src="../../assets/img/icons/paragraph.svg" width="20" alt="" />
                  <div class="flex-1">
                    <h5 class="fs-0 d-flex align-items-center">Navigation Position </h5>
                    <p class="fs--1 mb-2">Select a suitable navigation system for your web application </p>
                    <div class="form-check form-check-inline"><input class="form-check-input" id="option-navbar-vertical" type="radio" name="navbar" value="vertical" checked="checked" /><label class="form-check-label" for="option-navbar-vertical">Vertical</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" id="option-navbar-top" type="radio" name="navbar" value="top" /><label class="form-check-label" for="option-navbar-top">Top</label></div>
                    <div class="form-check form-check-inline mr-0"><input class="form-check-input" id="option-navbar-combo" type="radio" name="navbar" value="combo" /><label class="form-check-label" for="option-navbar-combo">Combo</label></div>
                  </div>
                </div>
                <hr />
                <h5 class="fs-0 d-flex align-items-center">Vertical Navbar Style</h5>
                <p class="fs--1">Switch between styles for your vertical navbar </p>
                <div class="btn-group btn-block btn-group-navbar-style">
                  <div class="row gx-2">
                    <div class="col-6"><input class="btn-check" id="navbar-style-transparent" type="radio" name="navbarStyle" value="transparent" /><label class="btn btn-block btn-navbar-style fs--1" for="navbar-style-transparent"> <img class="img-fluid img-prototype" src="../../assets/img/generic/default.png" alt="" /><span class="label-text"> Transparent</span></label></div>
                    <div class="col-6"><input class="btn-check" id="navbar-style-inverted" type="radio" name="navbarStyle" value="inverted" /><label class="btn btn-block btn-navbar-style fs--1" for="navbar-style-inverted"> <img class="img-fluid img-prototype" src="../../assets/img/generic/inverted.png" alt="" /><span class="label-text"> Inverted</span></label></div>
                    <div class="col-6"><input class="btn-check" id="navbar-style-card" type="radio" name="navbarStyle" value="card" /><label class="btn btn-block btn-navbar-style fs--1" for="navbar-style-card"> <img class="img-fluid img-prototype" src="../../assets/img/generic/card.png" alt="" /><span class="label-text"> Card</span></label></div>
                    <div class="col-6"><input class="btn-check" id="navbar-style-vibrant" type="radio" name="navbarStyle" value="vibrant" /><label class="btn btn-block btn-navbar-style fs--1" for="navbar-style-vibrant"> <img class="img-fluid img-prototype" src="../../assets/img/generic/vibrant.png" alt="" /><span class="label-text"> Vibrant</span></label></div>
                  </div>
                </div>
                <div class="text-center mt-5"><img class="mb-4" src="../../assets/img/illustrations/settings.png" alt="" width="120" />
                  <h5>Like What You See?</h5>
                  <p class="fs--1">Get Falcon now and create beautiful dashboards with hundreds of widgets.</p><a class="btn btn-primary" href="https://themes.getbootstrap.com/product/falcon-admin-dashboard-webapp-template/" target="_blank">Purchase</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="authentication-modal" tabindex="-1" role="dialog" aria-labelledby="authentication-modal-label" aria-hidden="true">
          <div class="modal-dialog mt-6" role="document">
            <div class="modal-content border-0">
              <div class="modal-header px-5 text-white position-relative modal-shape-header">
                <div class="position-relative z-index-1">
                  <h4 class="mb-0 text-white" id="authentication-modal-label">Register</h4>
                  <p class="fs--1 mb-0">Please create your free Falcon account</p>
                </div><button class="btn-close btn-close-white position-absolute top-0 right-0 mt-2 mr-2" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body py-4 px-5">
                <form>
                  <div class="mb-3"><label class="form-label" for="modal-auth-name">Name</label><input class="form-control" type="text" id="modal-auth-name" /></div>
                  <div class="mb-3"><label class="form-label" for="modal-auth-email">Email address</label><input class="form-control" type="email" id="modal-auth-email" /></div>
                  <div class="row gx-3">
                    <div class="mb-3 col-sm-6"><label class="form-label" for="modal-auth-password">Password</label><input class="form-control" type="password" id="modal-auth-password" /></div>
                    <div class="mb-3 col-sm-6"><label class="form-label" for="modal-auth-confirm-password">Confirm Password</label><input class="form-control" type="password" id="modal-auth-confirm-password" /></div>
                  </div>
                  <div class="form-check"><input class="form-check-input" type="checkbox" id="modal-auth-register-checkbox" /><label class="form-label" for="modal-auth-register-checkbox">I accept the <a href="#!">terms </a>and <a href="#!">privacy policy</a></label></div>
                  <div class="mb-3"><button class="btn btn-primary btn-block mt-3" type="submit" name="submit">Register</button></div>
                </form>
                <div class="position-relative mt-5">
                  <hr class="bg-300" />
                  <div class="position-absolute top-50 left-50 translate-middle px-3 bg-white font-sans-serif fs--1 text-500 text-nowrap">or register with</div>
                </div>
                <div class="row g-2 mt-2">
                  <div class="col-sm-6"><a class="btn btn-outline-google-plus btn-sm btn-block" href="#"><span class="fab fa-google-plus-g mr-2" data-fa-transform="grow-8"></span> google</a></div>
                  <div class="col-sm-6"><a class="btn btn-outline-facebook btn-sm btn-block" href="#"><span class="fab fa-facebook-square mr-2" data-fa-transform="grow-8"></span> facebook</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
	<script type="text/javascript" src="../../assets/js/scripts/employe.js"></script>
	
	<script>
		(function () {
          'use strict'
          //alert('entra');
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.querySelectorAll('.needs-validation')			
          // Loop over them and prevent submission
          Array.prototype.slice.call(forms)
            .forEach(function (form) {				
              form.addEventListener('submit', function (event) {				
                if (!form.checkValidity()) {
                  event.preventDefault()
                  event.stopPropagation()
                }

                form.classList.add('was-validated')
              }, false)
            })
        })()
	</script>
  </body>

</html>