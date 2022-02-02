<?php
	include '../../inc/conexion.php';
    include '../../inc/function.php';

    $op = new cnFunction();
	
	require_once '../../PHPThumb/ThumbLib.inc.php';
	/** id inicio de session del administrador */
	$idAdmin = 651;
	$idAdminTipo = "ADMIN";

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
			<div class="card card-chat overflow-hidden">
				<div class="card-body d-flex p-0 h-100">
					<div class="chat-sidebar">
						<div class="contacts-list bg-white scrollbar">
							<div class="nav nav-tabs border-0 flex-column" role="tablist" aria-orientation="vertical">
								<?php
									$sql = "SELECT *, SUBSTRING_INDEX(SUBSTRING_INDEX(timestamp, ' ', 1), ' ', -1) AS Fecha FROM loginClient ORDER BY user_id DESC";
									$query = $db->Execute($sql);

									$string = "SELECT MAX(user_id) AS LastId FROM loginClient";
									$querySql = $db->Execute($string);
									$reg = $querySql->FetchRow();


									while($row = $query->FetchRow()){
										$r = ($reg[0] == $row['user_id']) ? 'active' : '';

										//$fechaI = explode(" ", $reg['timestamp']);
										//$fechaI = strftime("%A, %d de %B de %Y", strtotime($row['Fecha']));
										$date1 = utf8_encode(strftime("%A", strtotime($row['Fecha'])));
										$dateString = $op->ToDayString($date1);

										/** Ultimo Mensaje */
										$sumId = $idAdmin + $row['user_id'];

										$sqlMess = "SELECT * FROM chat_message ";
										$sqlMess.= "WHERE chat_id = ".$sumId."  ORDER BY chat_message_id DESC LIMIT 1";
										$queryMessage = $db->Execute($sqlMess);
										$messageLast = $queryMessage->FetchRow();
										if($messageLast['to_user_id'] != $idAdmin){
											$msjLast = "Tu: ".$messageLast['chat_message'];
										}else{
											$msjLast = $messageLast['chat_message'];
											}

								?>

								<div class="hover-actions-trigger chat-contact <?=$r;?>">
									<div class="d-md-none d-lg-block">
										<div class="dropdown dropdown-active-trigger dropdown-chat">
											<button class="hover-actions btn btn-link btn-sm text-400 dropdown-caret-none dropdown-toggle right-0 fs-0 mt-4 mr-1 bg-white z-index-1 pb-2 mb-n2" type="button" data-boundary="viewport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="fas fa-cog" data-fa-transform="shrink-3 down-4"></span></button>
											<div class="dropdown-menu dropdown-menu-right border py-2 rounded-lg">
												<a class="dropdown-item" href="#!">Eliminar</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="#!">Ignore Mensajes</a>
												<a class="dropdown-item" href="#!">Bloquear Mensajes</a>
											</div>
										</div>
									</div>
									<div class="d-flex p-3 w-100" id="chat-link-<?=$row['user_id'];?>" data-toggle="tab" data-target="#chat-<?=$row['user_id'];?>" role="tab" aria-controls="chat-<?=$row['user_id'];?>" aria-selected="true">
										<div class="avatar avatar-xl">
											<img class="rounded-circle" src="../../assets/img/team/profile.png" alt="" />
										</div>
										<div class="flex-1 chat-contact-body ml-2 d-md-none d-lg-block">
											<div class="d-flex justify-content-between">
												<h6 class="mb-0 chat-contact-title"><?=$row['name'];?></h6>
												<span class="message-time fs--2"><?=$dateString;?></span>
											</div>
											<div class="min-w-0">
												<div class="chat-contact-content pr-3"><?=$msjLast;?></div>
												<div class="position-absolute bottom-0 right-0 hover-hide">
													<span class="fas fa-check text-success" data-fa-transform="shrink-5 down-4"></span>
												</div>
											</div>
										</div>
									</div>
								</div>

								<?php
								}
								?>

							</div>
						</div>
						<!-- <form class="contacts-search-wrapper">
							<div class="form-group mb-0 position-relative d-md-none d-lg-block w-100 h-100">
								<input class="form-control form-control-sm chat-contacts-search border-0 h-100" type="text" placeholder="Search contacts ..." />
									<span class="fas fa-search contacts-search-icon"></span>
							</div>
								<button class="btn btn-sm btn-transparent d-none d-md-inline-block d-lg-none"><span class="fas fa-search fs--1"></span></button>
						</form> -->
					</div>
				<div class="tab-content card-chat-content">
					<?php
						$sql = "SELECT * FROM loginClient ORDER BY user_id DESC";
						$query = $db->Execute($sql);

						$Query = $query;

						while($row = $Query->FetchRow()){
							$r = ($reg[0] == $row['user_id']) ? 'active' : '';

							$sumId = $idAdmin + $row['user_id'];

							$fechaCliente = 0;
					?>
					<div class="tab-pane card-chat-pane <?=$r;?>" id="chat-<?=$row['user_id'];?>" role="tabpanel" aria-labelledby="chat-link-<?=$row['user_id'];?>">
						<input type="hidden" name="idCliente" id="idCliente" value="<?=$row['user_id'];?>">
						<div class="chat-content-header">
							<div class="row flex-between-center">
								<div class="col-6 col-sm-8 d-flex align-items-center">
									<a class="pr-3 text-700 d-md-none contacts-list-show" href="#!">
										<div class="fas fa-chevron-left"></div>
									</a>
									<div class="min-w-0">
										<h5 class="mb-0 text-truncate fs-0"><?=$row['name'];?></h5>
										<div class="fs--2 text-400">Activo en el chat</div>
									</div>
								</div>
								<div class="col-auto">
									<!-- <button class="btn btn-sm btn-falcon-primary mr-2" type="button" data-index="1" data-toggle="tooltip" data-placement="top" title="Start a Call">
										<span class="fas fa-phone"></span>
									</button>
									<button class="btn btn-sm btn-falcon-primary mr-2" type="button" data-index="1" data-toggle="tooltip" data-placement="top" title="Start a Video Call">
										<span class="fas fa-video"></span>
									</button>
									<button class="btn btn-sm btn-falcon-primary btn-info" type="button" data-index="1" data-toggle="tooltip" data-placement="top" title="Conversation Information">
										<span class="fas fa-info"></span>
									</button>-->
								</div>
							</div>
						</div>
						<div class="chat-content-body" style="display: inherit;">
							<div class="chat-content-scroll-area scrollbar perfect-scrollbar chatMsj">
								<?php
								$sqlMes = "SELECT *, SUBSTRING_INDEX(SUBSTRING_INDEX(timestamp, ' ', 1), ' ', -1) AS Fecha, ";
								$sqlMes.= "SUBSTRING_INDEX(SUBSTRING_INDEX(timestamp, ' ', -1), ' ', -1) AS Hora FROM chat_message ";
								$sqlMes.= "WHERE chat_id = ".$sumId."  ORDER BY chat_message_id ASC";
								$queryMes = $db->Execute($sqlMes);


								while($reg = $queryMes->FetchRow()){
									$fecha = explode("-", $reg['Fecha']);
									$hora = explode(":", $reg['Hora']);
									if( $reg['Fecha'] > $fechaCliente){
								?>
										<div class="dateCenter text-center fs--2 text-500">
											<span> <?=$op->ToMonth($fecha[1]).' '.$fecha[2].', '.$fecha[0].', '.$hora[0].':'.$hora[1];?></span>
										</div>
								<?php
									}
									$fechaCliente = $reg['Fecha'];

									if( $idAdmin == $reg['to_user_id']){
								?>
										<div class="d-flex p-3">
											<div class="avatar avatar-l mr-2">
												<img class="rounded-circle" src="../../assets/img/team/profile.png" alt="" />
											</div>
											<div class="flex-1">
												<div class="w-xxl-75">
													<div class="hover-actions-trigger d-flex align-items-center">
														<div class="chat-message bg-200 p-2 rounded-lg"><?=$reg['chat_message'];?></div>
															<!-- <ul class="hover-actions position-relative list-inline mb-0 text-400 ml-2">
																<li class="list-inline-item"><a class="chat-option" href="#!" data-toggle="tooltip" data-placement="top" title="Forward"><span class="fas fa-share"></span></a></li>
																<li class="list-inline-item"><a class="chat-option" href="#!" data-toggle="tooltip" data-placement="top" title="Archive"><span class="fas fa-archive"></span></a></li>
																<li class="list-inline-item"><a class="chat-option" href="#!" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fas fa-edit"></span></a></li>
																<li class="list-inline-item"><a class="chat-option" href="#!" data-toggle="tooltip" data-placement="top" title="Remove"><span class="fas fa-trash-alt"></span></a></li>
															</ul> -->
													</div>
													<div class="text-400 fs--2"><span class="font-weight-semi-bold mr-2">Usuario</span><span><?=$hora[0].':'.$hora[1];?></span></div>
												</div>
											</div>
										</div>
									<?php
									}else{
									?>
										<div class="d-flex p-3">
											<div class="flex-1 d-flex justify-content-end">
												<div class="w-100 w-xxl-75">
													<div class="hover-actions-trigger d-flex flex-end-center">
														<!-- <ul class="hover-actions position-relative list-inline mb-0 text-400 mr-2">
															<li class="list-inline-item"><a class="chat-option" href="#!" data-toggle="tooltip" data-placement="top" title="Forward"><span class="fas fa-share"></span></a></li>
															<li class="list-inline-item"><a class="chat-option" href="#!" data-toggle="tooltip" data-placement="top" title="Archive"><span class="fas fa-archive"></span></a></li>
															<li class="list-inline-item"><a class="chat-option" href="#!" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fas fa-edit"></span></a></li>
															<li class="list-inline-item"><a class="chat-option" href="#!" data-toggle="tooltip" data-placement="top" title="Remove"><span class="fas fa-trash-alt"></span></a></li>
														</ul> -->
														<div class="bg-primary text-white p-2 rounded-lg chat-message"><?=$reg['chat_message'];?></div>
													</div>
													<div class="text-400 fs--2 text-right"><?=$hora[0].':'.$hora[1];?><span class="fas fa-check ml-2"></span></div>
												</div>
											</div>
										</div>
									<?php
									}
								}
								?>
							</div>
						</div>
					</div>
					<?php
					}
					?>
					<form id="adminChat" class="chat-editor-area">
						<!-- <input class="d-none" type="file" id="chat-file-upload" />
						<label class="mb-0 p-1 chat-file-upload cursor-pointer" for="chat-file-upload">
							<span class="fas fa-paperclip"></span>
						</label> -->
						<div class="btn btn-link p-0 emoji-icon" data-emoji-button="data-emoji-button">
							<span class="far fa-laugh-beam"></span>
						</div>
						<div id="chatMessage" class="emojiarea-editor outline-none scrollbar" contenteditable="true"></div>
						<button class="btn btn-sm btn-send" type="submit">Enviar</button>
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

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

	<script>
        $('ul#chat').addClass('show');
        $('ul li a#chatAdmin').addClass('active');


		var pusher = new Pusher('771af8d70dee299e131f');
		var canal = pusher.subscribe('canal_local');

		dias 	= ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"];
		meses 	= ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

		$(document).ready(function () {
			/** desde aqui codigo del chat */
			canal.bind('nuevo_mensaje', function(respuesta){
				sendMessage(respuesta);
			});

			$('form#adminChat').submit(function (e) {
				e.preventDefault();
				idCliente = $('.tab-content').find('.active').find('#idCliente').val();
				$.post('ajaxAdmin.php', {
					userFrom: <?=$idAdmin;?>, //inicio de session del administrador
					userTo: idCliente,
					msj: $('#chatMessage').html(),
					socket_id: pusher.connection.socket_id
					},
					function(data){
						//$('#chatbox').append('<div class="chatbox__body__message chatbox__body__message--right"><img src="img/user.png" alt="Picture"><p>'+ data.mensaje+'</p></div>');
						sendSubmit(data);
					}, 'json')
					.always(function(data) {
						$('#chatMessage').html('');
					});
					//return false;
			});

		})

/**
Funcion envia mensaje al hacer click sobre boton
 */

function sendSubmit(data){

	mensaje = data.mensaje;
	idCliente = data.idCliente;
	idAdmin = data.idAdmin;

	var hoy = new Date();

	if($('#inputMessage').val() != ''){
		userFrom = $('input#userFrom').val();
		r = $('div#chat-'+idCliente+' div.w-xxl-75:last').hasClass( "flex-end-center" ).toString();

		var fecha = hoy.getDate() + '-' + hoy.getMonth() + '-' + hoy.getFullYear();
		//var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
		//var fecha = hoy.getDate() + '-' + hoy.getMonth() + '-' + hoy.getFullYear();

		var hora = hoy.getHours();
		var minutos = hoy.getMinutes();

		if (hora < 10) hora = "0" + hora;
		if (minutos < 10) minutos = "0" + minutos;
		//if (segundos < 10) segundos = "0" + segundos;

		hora = hora+':'+minutos;

		if( r != 'true'){

			if(data.fecha > data.fechaAnt){
				$('#chat-'+data.idCliente).find('div.chatMsj').append(`
					<div class="dateCenter text-center fs--2 text-500">
						<span>`+meses[hoy.getMonth()]+` `+hoy.getDate()+`, `+hoy.getFullYear()+` `+hora+`</span>
					</div>
				`);
			}

			$('#chat-'+data.idCliente).find('div.chatMsj').append(`

				<div class="d-flex p-3">
					<div class="flex-1 d-flex justify-content-end">
						<div class="w-100 w-xxl-75">
							<div class="hover-actions-trigger d-flex flex-end-center">
								<div class="bg-primary text-white p-2 rounded-lg chat-message">`+data.mensaje+`</div>
							</div>
							<div class="text-400 fs--2 text-right">`+hora+`<span class="fas fa-check ml-2"></span></div>
						</div>
					</div>
				</div>
			`);

		}else{
			if(data.fecha > data.fechaAnt){
				$('#chat-'+data.idCliente).find('div.chatMsj').append(`
					<div class="dateCenter text-center fs--2 text-500">
						<span>`+meses[hoy.getMonth()]+` `+hoy.getDate()+`, `+hoy.getFullYear()+` `+hora+`</span>
					</div>
				`);
			}
			$('#chat-'+data.idCliente).find('div.chatMsj').append(`

				<div class="d-flex p-3">
					<div class="avatar avatar-l mr-2">
						<img class="rounded-circle" src="../../assets/img/team/profile.png" alt="" />
					</div>
					<div class="flex-1">
						<div class="w-xxl-75">
							<div class="hover-actions-trigger d-flex align-items-center">
								<div class="chat-message bg-200 p-2 rounded-lg">`+data.mensaje+`</div>
							</div>
								<div class="text-400 fs--2"><span class="font-weight-semi-bold mr-2">Usuario</span><span>`+hora+`</span></div>
						</div>
					</div>
				</div>
			`);
		}
	}else{
		alert('No puede enviar mensajes vacios.')
	}
	$('.chat-content-scroll-area').animate({ scrollTop: $('.chat-content-scroll-area').scrollHeight}, 1000);
}

/**
    Recive respuesta y guarda mensaje en bd
 */
function sendMessage(data){

	var hoy = new Date();

	var fecha = hoy.getDate() + '-' + hoy.getMonth() + '-' + hoy.getFullYear();
	var hora = hoy.getHours();
	var minutos = hoy.getMinutes();

	if (hora < 10) hora = "0" + hora;
	if (minutos < 10) minutos = "0" + minutos;
	//if (segundos < 10) segundos = "0" + segundos;

	hora = hora+':'+minutos;

	if ( ($('#chat-link-'+data.idCliente).length) == 0 ) {
		// hacer algo aquí si el elemento existe
		$('.nav-tabs').prepend(`<div id="newTab-`+data.idCliente+`" class="hover-actions-trigger chat-contact unread-message">
			<div class="d-md-none d-lg-block">
				<div class="dropdown dropdown-active-trigger dropdown-chat">
					<button class="hover-actions btn btn-link btn-sm text-400 dropdown-caret-none dropdown-toggle right-0 fs-0 mt-4 mr-1 bg-white z-index-1 pb-2 mb-n2" type="button" data-boundary="viewport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="fas fa-cog" data-fa-transform="shrink-3 down-4"></span></button>
					<div class="dropdown-menu dropdown-menu-right border py-2 rounded-lg">
						<a class="dropdown-item" href="#!">Eliminar</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#!">Ignore Mensajes</a>
						<a class="dropdown-item" href="#!">Bloquear Mensajes</a>
					</div>
				</div>
			</div>
			<div class="d-flex p-3 w-100" id="chat-link-`+data.idCliente+`" data-toggle="tab" data-target="#chat-`+data.idCliente+`" role="tab" aria-controls="chat-`+data.idCliente+`" aria-selected="true">
				<div class="avatar avatar-xl status-online">
					<img class="rounded-circle" src="../../assets/img/team/profile.png" alt="" />
				</div>
				<div class="flex-1 chat-contact-body ml-2 d-md-none d-lg-block">
					<div class="d-flex justify-content-between">
						<h6 class="mb-0 chat-contact-title">`+data.username+`</h6>
						<span class="message-time fs--2">`+hora+`</span>
					</div>
					<div class="min-w-0">
						<div class="chat-contact-content pr-3">`+data.mensaje+`</div>
						<div class="position-absolute bottom-0 right-0 hover-hide">
							<span class="fas fa-check text-success" data-fa-transform="shrink-5 down-4"></span>
						</div>
					</div>
				</div>
			</div>
		</div>`);

		$('#newTab-'+data.idCliente).click(function(){
			$(this).removeClass('unread-message').addClass('active');
		});

		$('.tab-content').prepend(`
		<div class="tab-pane card-chat-pane" id="chat-`+data.idCliente+`" role="tabpanel" aria-labelledby="chat-link-`+data.idCliente+`">
			<input type="hidden" name="idCliente" id="idCliente" value="`+data.idCliente+`">
				<div class="chat-content-header">
					<div class="row flex-between-center">
						<div class="col-6 col-sm-8 d-flex align-items-center">
							<a class="pr-3 text-700 d-md-none contacts-list-show" href="#!">
								<div class="fas fa-chevron-left"></div>
							</a>
							<div class="min-w-0">
								<h5 class="mb-0 text-truncate fs-0">`+data.username+`</h5>
									<div class="fs--2 text-400">Activo en el chat</div>
							</div>
						</div>
						<div class="col-auto">
							<!-- <button class="btn btn-sm btn-falcon-primary mr-2" type="button" data-index="1" data-toggle="tooltip" data-placement="top" title="Start a Call">
							<span class="fas fa-phone"></span>
							</button>
							<button class="btn btn-sm btn-falcon-primary mr-2" type="button" data-index="1" data-toggle="tooltip" data-placement="top" title="Start a Video Call">
								<span class="fas fa-video"></span>
							</button>
							<button class="btn btn-sm btn-falcon-primary btn-info" type="button" data-index="1" data-toggle="tooltip" data-placement="top" title="Conversation Information">
								<span class="fas fa-info"></span>
							</button>-->
						</div>
					</div>
				</div>
			<div class="chat-content-body" style="display: inherit;">
				<div class="chat-content-scroll-area scrollbar perfect-scrollbar chatMsj"></div>
			</div>
		</div>
		`);
	}

	if(data.fecha > data.fechaAnt){
		$('#chat-'+data.idCliente).find('div.chatMsj').append(`
			<div class="dateCenter text-center fs--2 text-500">
				<span>`+meses[hoy.getMonth()]+` `+hoy.getDate()+`, `+hoy.getFullYear()+` `+hora+`</span>
			</div>
		`);
	}

	$('#chat-'+data.idCliente).find('div.chatMsj').append(`
		<div class="d-flex p-3">
			<div class="avatar avatar-l mr-2">
				<img class="rounded-circle" src="../../assets/img/team/profile.png" alt="" />
			</div>
			<div class="flex-1">
				<div class="w-xxl-75">
					<div class="hover-actions-trigger d-flex align-items-center">
						<div class="chat-message bg-200 p-2 rounded-lg">`+data.mensaje+`</div>
					</div>
					<div class="text-400 fs--2"><span class="font-weight-semi-bold mr-2">Usuario</span><span>`+hora+`</span></div>
				</div>
			</div>
		</div>
	`);
}
	</script>
  </body>
</html>