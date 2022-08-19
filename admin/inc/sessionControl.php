<?php
session_start();

include "conexion.php";
include "function.php";

$op = new cnFunction();

date_default_timezone_set("America/La_Paz" ) ;
// Establecer tiempo de vida de la sesión en segundos
$inactividad = 600;
// Comprobar si $_SESSION["timeout"] está establecida
if(isset($_SESSION["timeout"]) || $_SESSION["timeout"] == ''){
      // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
      $sessionTTL = time() - $_SESSION["timeout"];
      if($sessionTTL > $inactividad){
            session_destroy();
            header("location:../../index.html");
      }
}
// El siguiente key se crea cuando se inicia sesión
$_SESSION["timeout"] = time();
?>
