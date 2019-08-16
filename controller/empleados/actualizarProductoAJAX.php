<?php
    //Aca se incluyen el archivo de la conexion a la BD
    include '../config/conexion.php';
    //Si la conexion es nula se regresa al archivo js
		include '../config/variablesEncriptacion.php';
		//Si la conexion es nula se regresa al archivo js
    if($conexion==null){
        return;
    }
    //Obtengo las variables que necesito para la consulta de una manera segura
    $txtPrecio = $conexion->real_escape_string(htmlentities($_POST['txtPrecio']));
    $idProducto = $conexion->real_escape_string(htmlentities(openssl_decrypt($_POST['id'],COD,KEY)));

    //Hago un select del codigo, la descripcion y la imagen de los productos filtrando a aquellos
    //en donde la descripcion tenga el patron que se mando desde js
    $query = "UPDATE producto SET precio = '$txtPrecio' WHERE cod_producto = '$idProducto'";
    //Si el id de categoria es diferente de 0 tambien se filtrara a aquellos productos que tengan
    //Si la consulta falla se manda en un alert de bootstrap la notificacion del por que sucedio este error
    if(!$resultado = $conexion->query($query)){
        echo '
        <script>
            $("#divAlert").attr("style","display:block");
            $("#pAlert").html("<span>'.$conexion->error.'</span>");
        </script>';
        return;
    }
    //Cierra la conexion a la BD
    $conexion->close();
?>
