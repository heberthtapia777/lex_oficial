<?php 
    include '../../inc/conexion.php';
    include '../../inc/function.php';

    $op = new cnFunction();
    
    require '../../lib/Pusher.php';
    
    date_default_timezone_set("America/La_Paz" );    

    $mensaje    = $_POST['msj'];
    $idCliente  = $_POST['userTo'];
    $idAdmin    = $_POST['userFrom'];

    //$pusher = PusherInstance::get_pusher();

    $intID = $idCliente + $idAdmin;

    $query = "SELECT * FROM chat_message WHERE chat_id = $intID order by chat_message_id DESC limit 1";
    $sqlQuery = $db->Execute($query);
    $row = $sqlQuery->FetchRow();

    $fechaAnt = $row['timestamp'];
    $datos = explode(" ", $fechaAnt);
    $fechaAnt = $datos[0];
	$horaAnt = $datos[1];
    
	if($intID != 0){
		$sql = "INSERT INTO chat_message(chat_id, to_user_id, from_user_id, chat_message) VALUES('$intID', '$idCliente', '$idAdmin', '$mensaje')";
		$resp = $db->Execute($sql);
	}	

    $fecha = date( 'Y-m-d' );		
	$hora = date('H:i:s');			

    $options = array(
		//'encrypted' => true
	);

    $pusher = new Pusher(
        '771af8d70dee299e131f',
        '496b6c4c1b00ae9adb21',
        '306677',
        $options
     );

    $pusher->trigger(
        'canal_local',
        'nuevo_mensaje',
        array('mensaje' => $mensaje, 'idCliente' => $idCliente, 'idAdmin' => $idAdmin, 'fecha' => $fecha, 'hora' => $hora, 'fechaAnt' => $fechaAnt, 'horaAnt' => $horaAnt),
        $_POST['socket_id']
    );

    echo json_encode(array('mensaje' => $mensaje, 'idCliente' => $idCliente, 'idAdmin' => $idAdmin, 'fecha' => $fecha, 'hora' => $hora, 'fechaAnt' => $fechaAnt, 'horaAnt' => $horaAnt));
?>