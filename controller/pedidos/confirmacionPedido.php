<?php
    //Aca se incluyen el archivo de la conexion a la BD
    include '../config/conexion.php';
    //Aca se incluye el archivo que contiene las variables para la desencriptacion de datos
    include '../config/variablesEncriptacion.php';
    //Aca se incluye el archivo que contiene el metodo para dar formato a los precios
    include '../config/formatosNumeros.php';
    //Estas dos lineas de codigo, es para indicar que se van a trabajar con variables de sesion
    session_start();
    ob_start();
    //Si la conexion es nula se regresa al archivo js
    if($conexion==null){
        return;
    }
    //Hago un select de la informacion del cliente llenarlo en un div
    $query = "SELECT nombre, representante, telefono, correo FROM Cliente WHERE id_cliente=1;";
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
    $fecha = date("d").'/'.date("m").'/'.date("y");
    $cadena = '<div id="divAlert" class="alert alert-danger alert-dismissible" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="fa fa-remove"></i> ¡Error!</h4>
      <p id="pAlert"></p>
    </div>';
    $cadena = $cadena.'<div id="encabezado" class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <img id="logoHelsa" src="../../dist/img/Helsa/LogoHelsa.png"> 
        <span id="spanEncabezado">Confirmación de la Compra</span>
        <small id="fechaCompra" class="pull-right">Fecha: '.$fecha.'</small>
      </h2>
    </div>
  </div>';
    while($datos=$resultado->fetch_assoc()){
        $cadena = $cadena.'<div id="infoCliente" class="row invoice-info">
        <div class="col-sm-6 invoice-col">
          Datos del Cliente
          <address>
            <strong>'.$datos['nombre'].'</strong><br>
            Representante: '.$datos['representante'].'<br>
            Teléfono: '.$datos['telefono'].'<br>
            Correo: '.$datos['correo'].'
          </address>
        </div>
        <div id="infoPedido" class="col-sm-6 invoice-col"></div>
      </div>';
    }
    $cadena = $cadena.'<div id="cuerpo" class="row">
    <div class="col-xs-12 table-responsive">
      <table id="tblListadoCarrito" class="table table-striped">
        <thead>
          <tr>
              <th class="text-center">#</th>
              <th class="text-center">Producto</th>
              <th class="text-center">Descripción</th>
              <th class="text-center">Categoría</th>
              <th class="text-center">Precio Unitario</th>
              <th class="text-center">Cantidad</th>
              <th class="text-center">Subtotal</th>
          </tr>
        </thead>
        <tbody class="text-center">';
    $contadorProductos = 0;
    foreach($_SESSION['carrito'] as $elemento){
        $contadorProductos++;
        $precioUnitario = formatoNumero(openssl_decrypt($elemento['precio'],COD,KEY));
        $subTotalActual = formatoNumero( (int)openssl_decrypt($elemento['precio'],COD,KEY) * $elemento['cantidad']);
        $cadena = $cadena. '<tr>
                <td>'.$contadorProductos.'</td>
                <td><img src="'.openssl_decrypt($elemento['imagen'],COD,KEY).'"></td>
                <td>'.openssl_decrypt($elemento['descripcion'],COD,KEY).'</td>
                <td>'.openssl_decrypt($elemento['categoria'],COD,KEY).'</td>
                <td class="right">$'.$precioUnitario.' MXN</td>
                <td>'.$elemento['cantidad'].'</td>
                <td class="right">$'.$subTotalActual.' MXN</td>
            </tr>';
    }
    $cadena = $cadena.'</tbody>
                </table>
            </div>
        </div>';
    $totalCompraString = formatoNumero($_SESSION['totalCompra']);
    $cadena = $cadena.'<div id="pie" class="row">
    <div id="divTotal" class="col-xs-12">
      <em class="footer-right"><p class="lead">Total: <span id="spanTotal">$'.$totalCompraString.' MXN</span> </p></em>
    </div>
    <div class="col-xs-12">
      <a href="mi_carrito.php" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Regresar al Carrito </a>
      <div id="botonesDerecha" class="footer-right">
        <button class="btn btn-success" onclick="confirmarCompra();"><i class="glyphicon glyphicon-ok"></i> Realizar Compra</button>
      </div>
    </div>
    </div>';
    //Regresa la variable cadena
    echo $cadena;
?>