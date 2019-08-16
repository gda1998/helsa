<?php
    //Aca se incluyen el archivo de la conexion a la BD
    include '../config/conexion.php';
    //Aca se incluyen el archivo que contiene las variables para la encriptacion de datos
    include '../config/variablesEncriptacion.php';
    //Si la conexion es nula se regresa al archivo js
    if($conexion==null){
        return;
    }
     //Hago un select de los pedidos que ha hecho un cliente y en el cual esten en proceso para llenar la tabla
     $query = "SELECT cod_pedido, DATE_FORMAT(fecha_registro, '%d/%m/%Y') as fecha_registro, 
     DATE_FORMAT(fecha_entrega, '%d/%m/%Y') as fecha_entrega, 
     status.descripcion as status, progreso
     FROM pedido JOIN status
     ON status.id_status=pedido.id_status
     WHERE status.id_status BETWEEN 1 AND 3 AND id_cliente=1;";
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
     $cadena = '<table id="tblListadoPedidos" class="table table-hover">
     <thead class="thead-helsa">
         <tr>
             <th class="text-center">Código</th>
             <th class="text-center">Fecha de Registro</th>
             <th class="text-center">Fecha de Entrega</th>
             <th class="text-center">Status</th>
             <th class="text-center">Progreso</th>
             <th class="text-center">Info</th>
             <th class="text-center">Cancelar</th>
         </tr>
     </thead>
     <tbody class="text-center">';
    //Llenado de la variable cadena con los valores del query
    while($datos=$resultado->fetch_assoc()){
        $cadena = $cadena.'<tr>
            <td>'.$datos['cod_pedido'].'</td>
            <td>'.$datos['fecha_registro'].'</td>
            <td>'.$datos['fecha_entrega'].'</td>
            <td>'.$datos['status'].'</td>
            <td>
                <div class="progress progress-xs progress-striped active">
                    <div class="progress-bar progress-bar-primary" style="width: '.(int) $datos['progreso'].'%"></div>
                </div>
            </td>
            <td>
                <button id="btnInfo'.openssl_encrypt($datos['cod_pedido'],COD,KEY).'" class="btn btn-info" onclick="detallesPedido(this);"><i class="glyphicon glyphicon-info-sign"></i></button>
            </td>
            <td>
                <button id="btnCancelar'.openssl_encrypt($datos['cod_pedido'],COD,KEY).'" class="btn btn-danger" onclick="cancelarPedido(this);"><i class="glyphicon glyphicon-remove"></i></button>
            </td>
        </tr>';
    }
    $cadena = $cadena.'</tbody></table>';
    //Cierra la conexion a la BD
    $conexion->close();
    //Regresa la variable cadena
    echo $cadena;
?>