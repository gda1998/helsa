<?php
    include 'pedidos.php';
    $pedidos = new pedidos();
    $cod_pedido = $_POST['cod_pedido'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $id_status = $_POST['id_status'];
    $progreso = $_POST['progreso'];
    $id_empleado = $_POST['id_empleado'];
    if($id_status == 2){
      $pedidos->editar_pedido_con_empleado($cod_pedido, $fecha_entrega, $id_status, $progreso, $id_empleado);
    }
    else{
      $pedidos->editar_pedido($cod_pedido, $fecha_entrega, $id_status, $progreso);
    }
    header("Location: ../../pages/empleados/pedidos.php");
?>
