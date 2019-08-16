<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="../../dist/img/Helsa/favicon.ICO" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>En Proceso</title>
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
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">	
  <!--Estilos-->
  <link rel="stylesheet" href="../../css/EstilosPersonales.css">
  <link rel="stylesheet" href="../../css/clientes/estilosCarrito.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <!--Header-->
  <?php
    include '../../views/headerCliente.php';
    echo $header;
  ?>

  <!--Aside-->
  <?php
    include '../../views/asideCliente.php';
    echo $aside;
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="glyphicon glyphicon-inbox"></i> Pedidos</h1>
      <ol class="breadcrumb">
        <li><a href="inicio.php"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li class="active"><i class="fa fa-shopping-cart"></i> Mi Carrito</li>
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
            <h3><i class="glyphicon glyphicon-time"></i> Pedidos en Proceso</h3>
        </div>
        <div class="box-body"> 
          <div id="divListadoPedidos" class="table-responsive"></div>
        </div>
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
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!--Scripts Propios-->
<script type="text/javascript" src="../../js/acciones.js"></script>
<script type="text/javascript" src="../../js/clientes/pedidos_proceso.js"></script>
</body>
</html>