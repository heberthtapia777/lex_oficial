<?php
session_start();

include "conexion.php";
include "function.php";

$op = new cnFunction();

date_default_timezone_set("America/La_Paz" ) ;
// Establecer tiempo de vida de la sesión en segundos

?>
