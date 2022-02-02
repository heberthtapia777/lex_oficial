<?php
    session_start();
    date_default_timezone_set("America/La_Paz" );

    // Establecer tiempo de vida de la sesión en segundos
    $inactividad = 600;
    // Comprobar si $_SESSION["timeout"] está establecida
    if(isset($_SESSION["timeout"]) || $_SESSION["timeout"] == ''){
        // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
       //echo ('<br>');
        if($sessionTTL > $inactividad){
            session_destroy();
            echo 0;
        }else{
            $_SESSION["timeout"] = time();
            echo 1;
        }
    }else{
        $_SESSION["timeout"] = time();
        echo 1;
    }
    // El siguiente key se crea cuando se inicia sesión
    //$_SESSION["timeout"] = time();
?>
