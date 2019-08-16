<?php
    //Aca se incluyen el archivo de la conexion a la BD
    include '../config/conexion.php';
    //Aca se incluye el archivo que contiene las variables para la desencriptacion de datos
    include '../config/variablesEncriptacion.php';
    //Aca se incluye el archivo que contiene el metodo para dar formato a los precios
    include '../config/formatosNumeros.php';
    //Si la conexion es nula se regresa al archivo js
    if($conexion==null){
        return;
    }
    //Estas dos lineas de codigo, es para indicar que se van a trabajar con variables de sesion
    session_start();
    ob_start();
    //Se pregunta si no existe la variable de sesion 'carrito', de ser asi, se declara y se inicializa
    //la variable de sesion 'carrito'
    if(!isset($_SESSION['carrito'])){
        $_SESSION['carrito'] = [];
    }
    //Se pregunta si no existe la variable de sesion 'cantidadCarrito', de ser asi, se declara y se inicializa
    //la variable de sesion 'cantidadCarrito'
    if(!isset($_SESSION['cantidadCarrito'])){
        $_SESSION['cantidadCarrito'] = 0;
    }
    //Se pregunta si no existe la variable de sesion 'totalCompra', de ser asi, se declara y se inicializa
    //la variable de sesion 'totalCompra'
    if(!isset($_SESSION['totalCompra'])){
        $_SESSION['totalCompra']= 0;
    }
    $query = "INSERT INTO Pedido (fecha_registro, id_status, progreso, id_cliente, id_empleado) VALUES
        ((SELECT CURDATE()), 1, 0, 1, 1);";
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
    $query = "SELECT MAX(cod_pedido) AS cod_pedido FROM Pedido WHERE id_cliente=1";
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
    $codPedido = 0;
    while($datos=$resultado->fetch_assoc()){
        $codPedido = (int)$datos['cod_pedido'];
    }
    $query = "INSERT INTO orden_pedido (cod_producto, cod_pedido, cantidad) VALUES ";
    $numeroProductos = count($_SESSION['carrito']);
    $contador = 0;
    foreach($_SESSION['carrito'] as $elemento){
        $query = $query."(".(int) openssl_decrypt($elemento['cod_producto'],COD,KEY).", ".$codPedido.", ".(int) openssl_decrypt($elemento['precio'],COD,KEY).")";
        if($contador == $numeroProductos - 1){
            $query = $query.";";
        }
        else{
            $query = $query.",";
        }
        $contador++;
    }
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
    $query = "SELECT DATE_FORMAT(fecha_registro,'%d/%m/%Y') AS fecha_registro, status.descripcion AS status, progreso 
        FROM pedido JOIN status on pedido.id_status=status.id_status WHERE cod_pedido=".$codPedido.";";
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
    $cadena = "";
    while($datos=$resultado->fetch_assoc()){
        $cadena = $cadena.'Datos del Pedido
        <address>
          <strong>Pedido No. '.$codPedido.'</strong><br>
          Fecha de Registro: '.$datos['fecha_registro'].'<br>
          Status: '.$datos['status'].'<br>
          Progreso: '.$datos['progreso'].' %
        </address>';
    }
    $_SESSION['carrito'] = [];
    $_SESSION['cantidadCarrito'] = 0;
    $_SESSION['totalCompra'] = 0;
    //Cierra la conexion a la BD
    $conexion->close();
    //Regresa la variable cadena
    echo $cadena;
?>