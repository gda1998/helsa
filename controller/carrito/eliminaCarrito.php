<?php
    //Aca se incluye el archivo que contiene las variables para la desencriptacion de datos
    include '../config/variablesEncriptacion.php';
    if(!isset($_POST['cod_producto'])){
        echo '<b>Error </b>: Ingrese un código del producto.';
        return;
    }
    if(openssl_decrypt($_POST['cod_producto'],COD,KEY) == ""){
        echo '<b>Error </b>: El código del producto es inválido.';
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
        $_SESSION['totalCompra'] = 0;
    }
    $contador = 0;
    foreach($_SESSION['carrito'] as &$elemento){
        if($elemento['cod_producto'] == $_POST['cod_producto']){
            $_SESSION['cantidadCarrito'] = $_SESSION['cantidadCarrito'] - $elemento['cantidad'];
            $_SESSION['totalCompra'] = $_SESSION['totalCompra'] - (int)openssl_decrypt($elemento['precio'],COD,KEY) * $elemento['cantidad'];
            array_splice($_SESSION['carrito'],$contador,1);
            $resultado = "true";
            break;
        }
        $contador++;
    }
    echo $_SESSION['cantidadCarrito'];
?>