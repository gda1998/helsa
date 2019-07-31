<?php
    error_reporting(E_ALL ^ E_WARNING);
    $conexion = new mysqli("localhost","root","","bd_helsa");
    if($conexion->connect_error){
        //die('Error de conexión: ' . $conexion->connect_error);
        echo '
            <script>
                $("#divAlert").attr("style","display:block");
                $("#pAlert").html("'.$conexion->connect_error.'");
            </script>';
        $conexion=null;
    }
    return $conexion;
?>