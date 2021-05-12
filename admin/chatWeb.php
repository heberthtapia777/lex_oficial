<?php 
    include 'inc/sessionControl.php';
    require_once 'PHPThumb/ThumbLib.inc.php';

    $userFrom = 0;//$_POST['userFrom'];
    $userTo   = 0;//$_POST['userTo'];
    $num      = 0;//$_POST['num'];
    $right    = 0;//$_POST['right'];

?>
<!DOCTYPE html>
<html>
<head>
<title>Chat Box</title>
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="modulo/chat/css/fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
<link href="modulo/chat/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link href="modulo/chat/css/chatboxw.css" rel="stylesheet">
</head>
<body>

<aside id="iconChat" class="animation-target">
	<a href="#" onclick="openChat();">
		<div>
			<img src="modulo/chat/img/chat3.png" width="45">
		</div>
	</a>
</aside>

<aside id="chatBox" class="tabbed_sidebar ng-scope chat_sidebar animation-target1">
    
	<div id="chatMessage">
        <div class="popup-head">
            <div>
                <div class="popup-head-left float-left">
                    <a title="Mi Nombre<?=0//$row['nombre'].' '.$row['apP'].' '.$row['apM']?>" onclick="minimizar()">
                    <?php
                        try
                        {
                            $thumb = PhpThumbFactory::create("modulo/chat/img/abatar.jpeg");
                        }
                        catch (Exception $e)
                        {
                            // handle error here however you'd like
                        }
                        
                        $thumb->adaptiveResize(150, 150);
                        //$thumb->show();
                        $thumb->save("modulo/chat/img/thumbnail/abatar.jpeg");                
                    ?>
                        <img class="thumb md-user-image" src="modulo/chat/img/thumbnail/abatar.jpeg" alt="">

                        <h6>Hola, ¿qué tal? ...</h6><small><br> <i class="bi bi-briefcase-fill"></i> Soporte Tecnico</small>
                    </a>
                </div>            
                <div class="popup-head-right float-right">
                    <button class="btn chat-header-button" onclick="closeChat()"><i class="bi bi-chevron-compact-down"></i></button>
                </div>
            </div>
        </div>
        <div id="chat_box_message" class="chat_box_wrapper chat_box_small chat_box_active" style="opacity: 1; display: block; transform: translateX(0px);"> 
            <div class="chat_box touchscroll chat_box_colors_a mCustomScrollbar">
                <div class="chat_message_wrapper">
                    <div id="chat_form">
                        <h5>Por favor, preséntate a ti mismo:</h5>
                        <form id="formLogin" action="" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputName" placeholder="Tu nombre">
                            </div>
                            <div class="form-group">        
                                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Introduce tu email...">                                
                            </div>                            
                            <button type="submit" class="btn btn-primary btn-block">Entrar al chat</button>
                        </form>                        
                    </div>
                    <ul class="chat_message ocultar">
                        <li><p>¡Hola! Si necesita ayuda, estoy aquí a su disposición </p></li>
                    </ul>
                </div>            
            </div>
        </div>
    </div>
</div>
	<div class="chat_submit_box">
		<div class="uk-input-group">
			<form id="formChat" method="POST">
				<div class="gurdeep-chat-box">
					<input type="text" placeholder="Escriba mensaje" id="inputMessage" name="inputMessage" onclick="limpNMessaje()" class="form-control md-input chatMessage" autocomplete="off" >
                    <input type="hidden" name="idCliente" id="idCliente" value="">
				</div>
				<div class="uk-input-group-addon">
					<a href="#" id="send" onclick="sendSubmit()" ><i class="fas fa-paper-plane"></i></a>
                </div>
			</form>
		</div>
	</div>
</div>

</aside>


<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js" ></script>
<script>
    var pusher = new Pusher('771af8d70dee299e131f');
    var canal = pusher.subscribe('canal_local');

    var idAdmin   = 651;

(function($) {
    $(document).ready(function() {
        
        $('#formLogin').on('submit', function(e) {
            e.preventDefault();            
            /* Codigo agregado */
            $.post('loginChat.php', { 
                username: $('#inputName').val(),
                email: $('#inputEmail').val()
            }, 
            function(data){
                $('#idCliente').val(data.lastId);
                $('#chat_form').css({
                    display: 'none'
                });
                $('.chat_submit_box').css({
                    display: 'block'
                });
                $('.chat_message').removeClass('ocultar');
                $('#chat_box_message').attr('id', 'chat_box_message'+data.lastId );
                $('.chat_box').attr('id', 'chat_box_'+data.lastId );
                $('aside#chatBox').attr('id', 'chatBox_'+data.lastId );
            }, 'json');
        });
               
        canal.bind('nuevo_mensaje', function(respuesta){
            //$('#chatbox').append('<div class="chatbox__body__message chatbox__body__message--right"><img src="modulo/chat/img/user.png" alt="Picture"><p>'+ respuesta.mensaje+'</p></div>');
            sendMessage(respuesta);
        });        

        $('#formChat').submit(function (e) { 
            e.preventDefault();
            sendSubmit();        
        });
    });
})(jQuery);

/**
 * [openChat description] Abrir chat por medio del boton
 * @return {[type]} [description]
 */
function openChat(){
	$('#chatBox').css({
		display: 'block'
	});
	$('#iconChat').css({
		display: 'none'
	});	
}
/**
 * [minimizar description] minimiza cada chat
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
function minimizar(id){	
	$(".tabbed_sidebar").slideToggle();	
}
/**
 * [closeChat description] Cerrar chat por medio del boton
 * @return {[type]} [description]
 */
function closeChat(){
	$('.chat_sidebar').css({
		display: 'none'
	});
	$('#iconChat').css({
		display: 'block'
	});	
}
/**
Funcion envia mensaje al hacer click sobre boton
 */
function sendSubmit(){    
    mensaje = $('#inputMessage').val();
    idCliente = $('#idCliente').val(); 

	if($('#inputMessage').val() != ''){
        
		userFrom = $('input#userFrom').val();

		r = $('div#chat_box_'+idCliente+' div.chat_message_wrapper:last').hasClass( "chat_message_right" ).toString();

		if( r == 'true' ){
			$.post(
				'modulo/chat/ajax.php',
				{ 
                    msj : $('#inputMessage').val(), 
                    idCliente : idCliente,
                    idAdmin : idAdmin,
                    socket_id : pusher.connection.socket_id},
				function(data){
					$('div#chat_box_'+idCliente+' div.chat_message_wrapper:last').find('ul').append('<li id="effect"><p>'+data.mensaje+'</p></li>');  
				},'json')
				.always(function(data) {
					console.log("complete");
					$("#chat_box_"+idCliente).mCustomScrollbar('scrollTo','bottom');
					$('#inputMessage').val('');                    
				});
			return false;
		}else{
			$.post(
				'modulo/chat/ajax.php',
				{ 
                    msj : $('#inputMessage').val(), 
                    idCliente : idCliente,
                    idAdmin : idAdmin,
                    socket_id : pusher.connection.socket_id},
				function(data){                    
					t = '<div class="chat_message_wrapper chat_message_right">';					
					t+= '	<ul class="chat_message">';
					t+= '        <li>';
					t+= '            <p>'+data.mensaje+'</p>';
					t+= '        </li>';
					t+= '    </ul> </div>';                    
					$('div#chat_box_'+idCliente).find('div.mCSB_container').append(t);   
				},
				'json')
				.always(function(data) {
					console.log("complete");
					$("#chat_box_"+idCliente).mCustomScrollbar('scrollTo','bottom');
					$('#inputMessage').val('');                    
				});
			return false;
		}
        
	$("#chat_box_"+idCliente).mCustomScrollbar('scrollTo','bottom');

	}else{
		alert('No puede enviar mensajes vacios.')
	}
}
/**
    Recive respuesta y guarda mensaje en bd
 */
function sendMessage(data){	
    f = $('div#chat_box_'+data.idCliente+' div.chat_message_wrapper:last').hasClass( "chat_message_right" ).toString();
    
	if( f == 'true' ){
		t = '<div class="chat_message_wrapper">';		
		t+= '	<ul class="chat_message">';
		t+= '        <li>';
		t+= '            <p>'+data.mensaje+'</p>';
		t+= '        </li>';
		t+= '    </ul> </div>';
		$('div#chat_box_'+data.idCliente).find('div.mCSB_container').append(t);
		/* Alerta de Nuevo Mensaje */
		$('aside#chatBox_'+data.idCliente).find('div.popup-head').addClass('parpadea');
		$('aside#chatBox_'+data.idCliente).find('div.parpadea').removeClass('popup-head');
	}else{
		if( $('div#chat_box_'+data.idCliente).find('div.mCSB_container').is(':empty') ){
			t = '<div class="chat_message_wrapper chat_message_right">';			
			t+= '	<ul class="chat_message">';
			t+= '        <li>';
			t+= '            <p>'+data.mensaje+'</p>';
			t+= '        </li>';
			t+= '    </ul> </div>';
			$('div#chat_box_'+data.idCliente).find('div.mCSB_container').append(t);
			/* Alerta de Nuevo Mensaje */
			$('aside#chatBox_'+data.idCliente).find('div.popup-head').addClass('parpadea');
			$('aside#chatBox_'+data.idCliente).find('div.parpadea').removeClass('popup-head');
		}else{
			$('div#chat_box_'+data.idCliente+' div.chat_message_wrapper:last').find('ul').append('<li><p>'+data.mensaje+'</p></li>');
			/* Alerta de Nuevo Mensaje */
			$('aside#chatBox_'+data.idCliente).find('div.popup-head').addClass('parpadea');
			$('aside#chatBox_'+data.idCliente).find('div.parpadea').removeClass('popup-head')
		}
	}

    $("#chat_box_"+data.idCliente).mCustomScrollbar('scrollTo','bottom');
	    
}

function limpNMessaje(id){
	/* Alerta de Nuevo Mensaje */
	$('aside').find('div.parpadea').addClass('popup-head');
	$('aside').find('div.popup-head').removeClass('parpadea')
}
</script>
</body>
</html>