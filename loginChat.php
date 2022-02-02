<?php
//error_reporting(E_ALL ^ E_WARNING);
//require 'lib/Pusher.php';

include 'admin/inc/conexion.php';
include 'admin/inc/function.php';

$op = new cnFunction();

session_start();

$username = $_POST['username'];
$email = $_POST['email'];

$sql = "INSERT INTO loginClient(name, email) VALUES('$username', '$email')";

$query = $db->Execute($sql);
$lastId = $db->insert_Id();

$date = $op->ToFormatToDay();

$_SESSION['idClient'] = $lastId;
$_SESSION['userName'] = $username;
$_SESSION['email'] = $email;
$_SESSION['date'] = $date;

echo json_encode([
    'lastId' => $lastId,
    'username' => $username,
    'email' => $email,
    'date' => $date,
]);
?>
