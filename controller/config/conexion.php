<?php
    //Aca se le dice que tipo de errores quiero que me notifique (Solo funciona en la conexion.php)
    error_reporting(E_ALL ^ E_WARNING);
    //Paso los valores para hacer la conexion
    $conexion = new mysqli("localhost","root","","bd_helsa");
    //Si la conexion no se logra se manda en un alert de bootstrap la notificacion del error
    if($conexion->connect_error){
        //die('Error de conexión: ' . $conexion->connect_error);
        echo '
            <script>
                $("#divAlert").attr("style","display:block");
                $("#pAlert").html("'.$conexion->connect_error.'");
            </script>';
        //Pongo que la conexion sea nula porque la voy a usar en otros archivos php
        $conexion=null;
    }
    //Regreso la conexion
    return $conexion;
?>