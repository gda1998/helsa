<?php
    //Aca se incluye el archivo que contiene las variables para la desencriptacion de datos
    include '../config/variablesEncriptacion.php';
    //Aca se incluye el archivo que contiene el metodo para dar formato a los precios
    include '../config/formatosNumeros.php';
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
    $cadena = '<table id="tblListadoCarrito" class="table table-hover DataTable">
                <thead class="thead-helsa">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Producto</th>
                        <th class="text-center">Descripción</th>
                        <th class="text-center">Categoría</th>
                        <th class="text-center">Precio Unitario</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Eliminar</th>
                        <th class="text-center">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="text-center">';
    $_SESSION['totalCompra'] = 0;
    $subTotalActual = "";
    $precioUnitario = "";
    $contadorProductos = 0;
    $totalCompraString = "";
    foreach($_SESSION['carrito'] as $elemento){
        $contadorProductos++;
        $precioUnitario = formatoNumero(openssl_decrypt($elemento['precio'],COD,KEY));
        $subTotalActual = formatoNumero( (int)openssl_decrypt($elemento['precio'],COD,KEY) * $elemento['cantidad']);
        $cadena = $cadena. '                
        <tr id="row'.$elemento['cod_producto'].'">
            <td>'.$contadorProductos.'</td>
            <td><img src="'.openssl_decrypt($elemento['imagen'],COD,KEY).'"></td>
            <td>'.openssl_decrypt($elemento['descripcion'],COD,KEY).'</td>
            <td>'.openssl_decrypt($elemento['categoria'],COD,KEY).'</td>
            <td class="right">$'.$precioUnitario.' MXN</td>
            <td>
                <form id="form'.$elemento['cod_producto'].'">
                    <input type="hidden" name="cod_producto" value="'.$elemento['cod_producto'].'">
                    <input type="number" name="cantidad" min="0" value="'.$elemento['cantidad'].'" 
                        onkeydown="return caracteresEspecificos(event);" onInput="editaProducto(this);">
                </form>
            </td>
            <td><button id="'.$elemento['cod_producto'].'" class="btn btn-danger" onclick="eliminaDelCarrito(this);"><i class="glyphicon glyphicon-remove"></i></button></td>
            <td id="subtotal'.$elemento['cod_producto'].'" class="right">$'.$subTotalActual.' MXN</td>
        </tr>';
        $_SESSION['totalCompra']= $_SESSION['totalCompra']+ ( (int)openssl_decrypt($elemento['precio'],COD,KEY) * $elemento['cantidad'] );
    }
    $totalCompraString = formatoNumero($_SESSION['totalCompra']);
    if($_SESSION['totalCompra'] == 0){
        $deshabilitado = 'disabled';
    }
    $cadena = $cadena.'
        </tbody>
        <tbody class="infoTotalCompra">
            <tr>
                <td colspan="7" class="right"><em><h2 class="lead">Total:</h2></em></td>
                <td class="right"><em><h2 id="tdTotalCompra" class="lead">$'.$totalCompraString.' MXN</h2></em></td>
            </tr>
            <tr>    
                <td>
                    <a href="productos.php" class="btn btn-default btn-lg btn-flat"><i class="glyphicon glyphicon-chevron-left"></i> Seguir Comprando</a>
                </td>
                <td colspan="7" class="right">
                <a href="confirmacion.php" class="btn btn-success btn-lg btn-flat">Ir a la Compra <i class="glyphicon glyphicon-chevron-right"></i></a>
                </td>
            </tr>
        </tbody>
    </table>';
    //Regresa la variable cadena
    echo $cadena;
?>