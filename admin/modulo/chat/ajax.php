<?php
    session_start();

    require '../../lib/Pusher.php';

    include '../../inc/conexion.php';
    include '../../inc/function.php';

    $op = new cnFunction();

    date_default_timezone_set("America/La_Paz" );

    $mensaje    = $_POST['msj'];
    $idCliente  = $_POST['idCliente'];
    $idAdmin    = $_POST['idAdmin'];

    $username = $_SESSION['userName'];
    $email    = $_SESSION['email'];
    $date     = $_SESSION['date'];

    //$pusher = PusherInstance::get_pusher();

	$intID = $idCliente + $idAdmin;

    $query = "SELECT * FROM chat_message WHERE chat_id = $intID order by chat_message_id DESC limit 1";
    $sqlQuery = $db->Execute($query);

    $row = $sqlQuery->FetchRow();

    if($row){
        $fechaAnt = $row['timestamp'];
        $datos = explode(" ", $fechaAnt);
        $fechaAnt = $datos[0];
        $horaAnt = $datos[1];
    }else{
        $fechaAnt = 0;
        $horaAnt = 0;
    }

	if($intID != 0){
		$sql = "INSERT INTO chat_message(chat_id, to_user_id, from_user_id, chat_message) VALUES('$intID', '$idAdmin', '$idCliente', '$mensaje')";
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
        array('mensaje' => $mensaje, 'idCliente' => $idCliente, 'idAdmin' => $idAdmin, 'username' => $username, 'email' => $email, 'date' => $date, 'fecha' => $fecha, 'hora' => $hora, 'fechaAnt' => $fechaAnt, 'horaAnt' => $horaAnt),
        $_POST['socket_id']
    );

    echo json_encode(array('mensaje' => $mensaje, 'idCliente' => $idCliente, 'idAdmin' => $idAdmin, 'username' => $username, 'email' => $email, 'date' => $date, 'fecha' => $fecha, 'hora' => $hora, 'fechaAnt' => $fechaAnt, 'horaAnt' => $horaAnt));
?>