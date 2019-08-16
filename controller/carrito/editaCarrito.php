<?php
    $cadena = "false";
    //Aca se incluye el archivo que contiene las variables para la desencriptacion de datos
    include '../config/variablesEncriptacion.php';
    //Aca se incluye el archivo que contiene el metodo para dar formato a los precios
    include '../config/formatosNumeros.php';
    //Si las variables que necesito para editar el carrito no existen se manda un error
    //de que debe ingresar las variables
    if(!isset($_POST['cod_producto']) || !isset($_POST['cantidad'])){
        echo '<b>Error </b>: Ingrese las variables correspondientes.';
        return;
    }
    if(openssl_decrypt($_POST['cod_producto'],COD,KEY) == ""){
        echo '<b>Error </b>: El código del producto es inválido.';
        return;
    }
    $cantidad = $_POST['cantidad'];
    if(is_numeric($cantidad)){
        $cantidad = (int)$cantidad;
        if($cantidad == 0){
            echo $cadena;
            return;
        }
        if($cantidad<0){
            $cantidad = $cantidad * -1;
        }
    }
    //Si la condicion no se cumple, se manda un error diciendo que el valor de cantidad es invalido
    else{
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
    foreach($_SESSION['carrito'] as &$elemento){
        if($elemento['cod_producto'] == $_POST['cod_producto']){
            $_SESSION['cantidadCarrito'] = $_SESSION['cantidadCarrito'] - $elemento['cantidad'];
            $_SESSION['totalCompra'] = $_SESSION['totalCompra'] - (int)openssl_decrypt($elemento['precio'],COD,KEY) * $elemento['cantidad'];
            $elemento['cantidad'] = $cantidad;
            $_SESSION['cantidadCarrito'] = $_SESSION['cantidadCarrito'] + $cantidad;
            $_SESSION['totalCompra'] = $_SESSION['totalCompra'] + (int)openssl_decrypt($elemento['precio'],COD,KEY) * $elemento['cantidad'];
            $subTotalActual = formatoNumero( (int)openssl_decrypt($elemento['precio'],COD,KEY) * $elemento['cantidad']);
            $cadena = '$'.$subTotalActual.' MXN';
            break;
        }
    }
    $totalCompraString = formatoNumero($_SESSION['totalCompra']);
    $resultado = $cadena.'||'.$_SESSION['cantidadCarrito'].'||'.'$'.$totalCompraString.' MXN';
    echo $resultado;
?>