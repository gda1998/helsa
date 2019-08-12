<?php
    //Aca se incluyen el archivo de la conexion a la BD
    include '../config/conexion.php';
    //Aca se incluyen el archivo que contiene las variables para la encriptacion de datos
    include '../config/variablesEncriptacion.php';
    //Si la conexion es nula se regresa al archivo js
    if($conexion==null){
        return;
    }
    //Hago un select de las categorias de un producto para llenarlo en un select
    $query = "SELECT * FROM Categoria;";
    //Esta iinea de codigo es para que la consulta regrese con el formato de teclado utf-8
    $acentos = $conexion->query("SET NAMES 'utf8'");
    //Si la consulta falla se manda en un alert de bootstrap la notificacion del por que sucedio este error
    if(!$resultado = $conexion->query($query)){
        echo '
        <script>
            $("#divAlert").attr("style","display:block");
            $("#pAlert").html("'.$conexion->error.'");
        </script>';
        return;
    }
    //Si la consulta fue exitosa declaro la variable cadena que es la que voy a regresar al archivo js para llenar
    //el select encriptando el id de categoria
    $cadena = "<option value='".openssl_encrypt(0,COD,KEY)."'>Sin Filtros</option>";
    //Llenado de la variable cadena con los valores del query
    while($datos=$resultado->fetch_assoc()){
        $cadena = $cadena.'<option value="'.openssl_encrypt($datos['id_categoria'],COD,KEY).'">'.$datos['descripcion'].'</option>';
    }
    //Cierra la conexion a la BD
    $conexion->close();
    //Regresa la variable cadena
    echo $cadena;
?>