<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="../../dist/img/Helsa/favicon.ICO" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pedidos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- SweetAlert -->
  <link rel="stylesheet" href="../../plugins/New_SweetAlert/dist/sweetalert.css">
  <script type="text/javascript" src="../../plugins/New_SweetAlert/dist/sweetalert.js"></script>
  <script type="text/javascript" src="../../plugins/New_SweetAlert/dist/sweetalert.min.js"></script>
  <!--Estilos-->
  <link rel="stylesheet" href="../../css/EstilosPersonales.css">
  <link rel="stylesheet" href="../../css/clientes/productos.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">

  <!--Header-->
  <?php
    include '../../views/header.php';
    echo $header;
  ?>

  <!--Aside-->
  <?php
    include '../../views/asideEmpleado.php';
    echo $aside;
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="glyphicon glyphicon-inbox"></i> Pedidos</h1>
      <ol class="breadcrumb">
        <li><a href="inicio.php"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li class="active"><i class="glyphicon glyphicon-tags"></i> Productos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div id="divAlert" class="alert alert-danger alert-dismissible" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="fa fa-remove"></i> ¡Error!</h4>
        <p id="pAlert"></p>
    </div>
      <!-- Default box -->
      <div class="box box-helsa">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="glyphicon glyphicon-list"></i> Lista de pedidos</h3>
          	<div class="box-tools pull-right">
            	<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i>
              	</button>
          	</div>
        </div>
          <div id="divResultados"></div>
          <table class="table">
          <tr>
            <th>Codigo</th>
            <th>Fecha de registro</th>
            <th>Fecha de entrega</th>
            <th>Estado</th>
            <th>Progreso</th>
            <th>Cliente</th>
            <th>Empleado</th>
            <th>Actualizar</th>
            <div id='divTabla'>
            </div>
          </tr>
          <?php
          require_once '../../controller/empleados/pedidos.php';
          $pedidos = new pedidos();
          $tablaPedidos = $pedidos->listar_pedidos();
          foreach($tablaPedidos as $datos){
              echo '<tr>';
              echo '<td>'.$datos['cod_pedido'].'</td>';
              echo '<td>'.$datos['fecha_registro'].'</td>';
              echo '<td>'.$datos['fecha_entrega'].'</td>';
              echo '<td>'.$datos['estado'].'</td>';
              echo '<td>'.$datos['progreso'].' %</td>';
              echo '<td>'.$datos['cliente'].'</td>';
              echo '<td>'.$datos['empleado'].'</td>';
              echo '<td><a href="editar_pedido.php? clave='.$datos['cod_pedido'].'" class="ion ion-android-create"></a></td>';
              echo '</tr>';
            }
          ?>
          </table>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!--Footer-->
  <?php
    include '../../views/footer.php';
    echo $footer;
  ?>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="../../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!--jPaginate-->
<script src="../../plugins/jPaginate/jQuery.paginate.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!--Scripts Propios-->
<script type="text/javascript" src="../../js/clientes/productos.js"></script>
<script type="text/javascript" src="../../js/acciones.js"></script>
</body>
</html>
