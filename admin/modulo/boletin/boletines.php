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
							<h5 class="mb-2 mb-md-0">Boletines</h5>
						</div>
						<div class="col-auto">
							<button class="btn btn-outline-primary btn-sm" id="btnNuevo"><i class="fas fa-plus"></i> Nuevo</button>
							<button class="btn btn-outline-danger btn-sm" id="btnCancel" onclick="cancelar()"><i class="fas fa-window-close"></i> Cancelar</button>
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
										<div class="row mb-3">
											<div class="col-md-4">
												<div class="input-group mb-3">
													<input type="text" id="buscar" class="form-control" placeholder="Buscar..." aria-label="Buscar" aria-describedby="button-addon2">
													<div class="input-group-append">
														<button class="btn btn-outline-secondary" type="button" id="button-addon2">Buscar</button>
													</div>
												</div>
											</div>
										</div>
										<table id="tblBoletin" class="table table-striped table-bordered table-condensed table-hover" cellspacing="0" cellpadding="0" width="100%">
											<thead>
												<tr>
													<th>#</th>
													<th>Boletin</th>
													<th>Asunto</th>
													<th>Índice</th>
													<th>Temas</th>
													<th>Fecha Creación</th>
													<th>Fecha Publicacion</th>
													<th>Visto</th>
													<th>Publicado</th>
													<th>Acciones</th>
												</tr>
											</thead>

											<tfoot>
												<tr>
													<th>#</th>
													<th>Boletin</th>
													<th>Asunto</th>
													<th>Índice</th>
													<th>Temas</th>
													<th>Fecha Creación</th>
													<th>Fecha Publicacion</th>
													<th>Visto</th>
													<th>Publicado</th>
													<th>Acciones</th>
												</tr>
											</tfoot>

											<tbody id="usuario">

											</tbody>
										</table>
										<style>
											div.dataTables_wrapper div.dataTables_processing {
												position: fixed;
												top: 15%;
												left: 50%;
												width: 200px;
												margin-left: -100px;
												margin-top: -26px;
												text-align: center;
												padding: 1em 0;
												z-index: 100;
												color: #fff;
												background-color: #f3681a;
												background-image: var(--bs-gradient);
												border-color: #f2600e;
											}
											div#tblBoletin_filter{
												display:none
											}
										</style>
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>

			<div id="verForm" style="display:none">
				<div class="card mb-3" >
					<div class="card-body">
						<div class="row flex-between-center">
							<div class="col-md">
								<h5 class="mb-2 mb-md-0">Nuevo Boletin</h5>
							</div>
						</div>
					</div>
				</div>
				<form role="form" name="frmBoletin" id="frmBoletin" enctype="multipart/form-data" class="cmxform" novalidate="novalidate">
					<div class="row g-0">
						<div class="col-lg-12 pr-lg-2">
							<div class="card mb-3">
								<div class="card-body bg-light">
									<div class="row gx-2">
										<div class="col-12 mb-3">
											<table class="table table-hover">
													<thead>
														<tr>
															<th scope="col" width="70%">CONTENIDO</th>
															<th scope="col"> </th>
															<th scope="col">CONCORDANCIAS</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
																		<div class="row mb-3">
																			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">
																				<input id="idBoletin" type="hidden" name="idBoletin" />
																				<div class="form-group">
																					<label>Nro. de refencia:</label>
																					<input id="nroRef" type="text" class="form-control form-control-sm" name="nroRef" placeholder="Nro. de referencia" />
																				</div>
																			</div>
																			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">
																				<!-- <div class="form-group">
																					<label>F. de publicación de la norma para impresión:</label>
																					<input id="dateImpresion" type="text" class="form-control form-control-sm" name="dateImpresion" placeholder="Fecha de publicación" />
																				</div> -->
																			</div>
																		</div>
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
																				<div class="form-group">
																					<label>Elija una imagen ...</label>
																					<input class="form-control form-control-sm" id="imgBol" name="imgBol" type="file">
																				</div>

																			</div>
																		</div>
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
																				<div class="form-group">
																					<label>Pie de imagen:</label>
																					<input id="pieImg" type="text" class="form-control form-control-sm" name="pieImg" placeholder="Pie de imagen" />
																				</div>
																			</div>
																		</div>
																		<div class="row mb-3">
																			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 left">
																				<div class="form-group">
																					<label>Indice:</label>
																					<select id="cboIndice" name="cboIndice" class="form-select form-control-sm" >

																					</select>
																				</div>
																			</div>
																		</div>
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
																			<label>Tema:</label>
																				<div id="checkTema">
																				</div>
																				<label id="er"></label>
																			</div>
																		</div>
																		<div class="row mb-3">
																			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">
																				<div class="form-group">
																					<label>F. de publicación de la norma:</label>
																					<input id="datePubli" type="text" class="form-control form-control-sm" name="datePubli" placeholder="Fecha de publicación" />
																				</div>
																			</div>
																		</div>
																		<div class="row mb-3">
																			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">
																				<div class="form-group">
																					<label>F. de publicación del boletin:</label>
																					<input id="dateBoletin" type="text" class="form-control form-control-sm" name="dateBoletin" placeholder="Fecha de publicación" />
																				</div>
																			</div>
																		</div>
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
																				<div class="form-group">
																					<label>Asunto:</label>
																					<input id="asunto" type="text" class="form-control form-control-sm" name="asunto" placeholder="Asunto" />
																				</div>
																			</div>
																		</div>
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
																				<div class="form-group">
																					<label>Sintesis:</label>
																					<textarea class="form-control form-control-sm" id="intro" name="intro" rows="3"></textarea><br>

																				</div>
																				<div id="ter"></div>
																			</div>
																		</div>
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
																				<div class="form-group">
																					<label>Disposición:</label>
																					<textarea class="form-control form-control-sm" id="cont" name="cont" rows="3"></textarea>
																				</div>
																			</div>
																		</div>
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
																				<div class="form-group">
																					<label>Información adicional:</label>
																					<input id="info" type="text" class="form-control form-control-sm" name="info" placeholder="Información adicional" />
																				</div>
																			</div>
																		</div>
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
																				<div class="form-group">
																					<label>Nota:</label>
																					<input id="nota" type="text" class="form-control form-control-sm" name="nota" placeholder="Nota" />
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</td>
															<td></td>
															<td>
																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
																		<h6>Anteriores</h6>
																	</div>
																</div>
																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
																				<button type="button" class="btn btn-secondary btn-sm btn-block btn-rigth" id="1" name="abrg" >
																					Abrogada por
																				</button>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="check1">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
																				<button type="button" class="btn btn-secondary btn-sm btn-block btn-rigth" id="2" name="drg" >
																					Derogada por
																				</button>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="check2">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
																				<button type="button" class="btn btn-secondary btn-sm btn-block btn-rigth" id="3" name="mdf" >
																					Modificada por
																				</button>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="check3">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
																				<button type="button" class="btn btn-secondary btn-sm btn-block btn-rigth" id="4" name="rgl" >
																					Reglamentada por
																				</button>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="check4">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
																				<button type="button" class="btn btn-secondary btn-sm btn-block btn-rigth" id="5" name="cmpl" >
																					Complementada por
																				</button>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="check5">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
																				<button type="button" class="btn btn-secondary btn-sm btn-block btn-rigth" id="6" name="mcd" >
																					Mencionada por
																				</button>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="check6">
																			</div>
																		</div>
																	</div>
																</div>

																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
																		<h6>Posteriores</h6>
																	</div>
																</div>
																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
																				<button type="button" class="btn btn-secondary btn-sm btn-block btn-rigth" id="7" name="pabrg" >
																					Abrogada a
																				</button>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="check7">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
																				<button type="button" class="btn btn-secondary btn-sm btn-block btn-rigth" id="8" name="pdrg" >
																					Derogada a
																				</button>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="check8">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
																				<button type="button" class="btn btn-secondary btn-sm btn-block btn-rigth" id="9" name="pmdf" >
																					Modificada a
																				</button>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="check9">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
																				<button type="button" class="btn btn-secondary btn-sm btn-block btn-rigth" id="10" name="prgl" >
																					Reglamentada a
																				</button>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="check10">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
																				<button type="button" class="btn btn-secondary btn-sm btn-block btn-rigth" id="11" name="pcmpl" >
																					Complementada a
																				</button>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="check11">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row mb-3">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																		<div class="row mb-3">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
																				<button type="button" class="btn btn-secondary btn-sm btn-block btn-rigth" id="12" name="pmcd" >
																					Mencionada a
																				</button>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="check12">
																			</div>
																		</div>
																	</div>
																</div>
															</td>
														</tr>
													</tbody>
													<tfoot>
														<tr>
															<th col-span="3">
																<div class="row mb-3">
																	<div class="form-group">
																		<button type="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-save"></i> Guardar</button>
																		<button type="button" class="btn btn-outline-danger btn-sm" onclick="cancelar()"><i class="fas fa-window-close"></i> Cancelar</button>
																	</div>
																</div>
															</th>
														</tr>
													</tfoot>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
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
    <?PHP
        include '../../inc/footer.php'
    ?>
	<script type="text/javascript" src="../../assets/js/scripts/boletin.js"></script>

  </body>

</html>