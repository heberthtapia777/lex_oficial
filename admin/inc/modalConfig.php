<!-- MODAL DE CONFIGURACION -->
<div class="modal fade modal-fixed-right modal-theme overflow-hidden" id="settings-modal" tabindex="-1" role="dialog" aria-labelledby="settings-modal-label" aria-hidden="true" data-options='{"autoShow":false,"autoShowDelay":3000,"showOnce":false}'>
	<div class="modal-dialog modal-dialog-vertical" role="document">
		<div class="modal-content border-0 vh-100 scrollbar">
			<div class="modal-header modal-header-settings">
				<div class="z-index-1 py-1">
					<h5 class="text-white" id="settings-modal-label"> 
						<span class="fas fa-palette mr-2 fs-0"></span>Configuracion
					</h5>
					<p class="mb-0 fs--1 text-white opacity-75"> Establece tu propio estilo personalizado</p>
				</div>
				<button class="btn-close btn-close-white z-index-1 mt-0" type="button" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body px-card">
				<div class="d-flex justify-content-between">
					<div class="d-flex align-items-start"><img class="mr-2" src="../../assets/img/icons/left-arrow-from-left.svg" width="20" alt="" />
						<div class="flex-1">
							<h5 class="fs-0">Modo RTL</h5>
							<p class="fs--1 mb-0">Cambia la dirección de tu idioma </p>
						</div>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input ml-0" id="mode-rtl" type="checkbox" />
					</div>
				</div>
				<hr />
				<div class="d-flex justify-content-between">
					<div class="d-flex align-items-start">
						<img class="mr-2" src="../../assets/img/icons/arrows-h.svg" width="20" alt="" />
						<div class="flex-1">
							<h5 class="fs-0">Diseño fluido</h5>
							<p class="fs--1 mb-0">Alternar sistema de diseño de contenedores </p>
						</div>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input ml-0" id="mode-fluid" type="checkbox" />
					</div>
				</div>
				<hr />
				<div class="d-flex align-items-start">
					<img class="mr-2" src="../../assets/img/icons/paragraph.svg" width="20" alt="" />
					<div class="flex-1">
						<h5 class="fs-0 d-flex align-items-center">Posición del menu </h5>
						<p class="fs--1 mb-2">Seleccione un sistema de navegación adecuado para su aplicación web</p>
						<div class="form-check form-check-inline">
							<input class="form-check-input" id="option-navbar-vertical" type="radio" name="navbar" value="vertical" checked="checked" />
							<label class="form-check-label" for="option-navbar-vertical">Vertical</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" id="option-navbar-top" type="radio" name="navbar" value="top" />
							<label class="form-check-label" for="option-navbar-top">Arriba</label>
						</div>			
					</div>
				</div>
				<hr />
				<h5 class="fs-0 d-flex align-items-center">Estilo de barra de navegación vertical</h5>
				<p class="fs--1">Cambiar entre estilos para su barra de navegación vertical </p>
				<div class="btn-group btn-block btn-group-navbar-style">
					<div class="row gx-2">
						<div class="col-6">
							<input class="btn-check" id="navbar-style-transparent" type="radio" name="navbarStyle" value="transparent" />
							<label class="btn btn-block btn-navbar-style fs--1" for="navbar-style-transparent"> 
								<img class="img-fluid img-prototype" src="../../assets/img/generic/default.png" alt="" />
								<span class="label-text"> Transparente</span>
							</label>
						</div>
					<div class="col-6">
						<input class="btn-check" id="navbar-style-inverted" type="radio" name="navbarStyle" value="inverted" />
						<label class="btn btn-block btn-navbar-style fs--1" for="navbar-style-inverted"> 
							<img class="img-fluid img-prototype" src="../../assets/img/generic/inverted.png" alt="" />
							<span class="label-text"> Invertido</span>
						</label>
					</div>
					<div class="col-6">
						<input class="btn-check" id="navbar-style-card" type="radio" name="navbarStyle" value="card" />
						<label class="btn btn-block btn-navbar-style fs--1" for="navbar-style-card"> 
							<img class="img-fluid img-prototype" src="../../assets/img/generic/card.png" alt="" />
							<span class="label-text"> Tarjeta</span>
						</label>
					</div>
					<div class="col-6">
						<input class="btn-check" id="navbar-style-vibrant" type="radio" name="navbarStyle" value="vibrant" />
						<label class="btn btn-block btn-navbar-style fs--1" for="navbar-style-vibrant"> 
							<img class="img-fluid img-prototype" src="../../assets/img/generic/vibrant.png" alt="" />
							<span class="label-text">  	Vibrante</span>
						</label>
					</div>
				</div>
			</div>			
		</div>
	</div>
	</div>
</div>