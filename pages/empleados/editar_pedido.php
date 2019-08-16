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
  <script>
  $(document).ready( function() {
    var now = new Date();
    var month = (now.getMonth() + 1);
    var day = now.getDate();
    if (month < 10)
        month = "0" + month;
    if (day < 10)
        day = "0" + day;
    var today = now.getFullYear() + '-' + month + '-' + day;
    $('#fecha_entrega').val(today);
});
  </script>
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
      <h1><i class="glyphicon glyphicon-inbox"></i>Actualizar Pedido</h1>
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
            <h3 class="box-title"><i class="glyphicon glyphicon-list"></i> Actualizar pedido</h3>
          	<div class="box-tools pull-right">
            	<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i>
              	</button>
          	</div>
        </div>
        <?php
        include '../../controller/empleados/pedidos.php';
        $pedidos = new pedidos();
        $cod_pedido = $_GET['clave']; // importante saber a quíen vamos a modificar por eso se toma la clave
        $pedido = $pedidos->seleccionar_pedido($cod_pedido);
        $listastatus = $pedidos->listar_status();
        $month = date('m');
        $day = date('d');
        $year = date('Y');
        $today = $year . '-' . $month . '-' . $day;
        //aqui saco los pedidos del objeto que devuelve pdo y los asigno a variables
        foreach ($pedido as $datos_consultados)
        {
          $id_status = $datos_consultados['id_status'];
          $progreso = $datos_consultados['progreso'];
        }
        ?>
        <div class="container">
          <div class="form-group">
            <div class="col-lg-3 text-center">
              <div class="form">
              <label>Código del pedido a actualizar: <?php echo $cod_pedido;?></label></br>
                <form action="../../controller/empleados/funcion_editar_pedido.php" method="post" id="contactFrm" name="contactFrm">
                <input type="hidden" name="cod_pedido" value="<?php echo $cod_pedido;?>">
                <!--ESTE ES EL CAMPO QUE GUARDA EL ID DEL EMPLEADO, TOMA EL VALOR DE value -->
                <input type="hidden" name="id_empleado" value="1">
                <label>Actualizar estado</label>
                <select type="text" class="form-control" name="id_status" required>
                	<?php
                		foreach ($listastatus as $datos)
                		{
                      if($id_status === $datos['id_status'])
                      {
                        echo '<option value="'.$datos['id_status'].'" selected>'.$datos['descripcion'].'</option>';
                      }
                      else
                      {
                        echo '<option value="'.$datos['id_status'].'">'.$datos['descripcion'].'</option>';
                      }
                		}
                	?>
                </select><br>
                <label>Actualizar progreso (%)</label>
                <input type="number" class="form-control"  min="0" max="100" required value="<?php echo $progreso; ?>" name="progreso" class="txt"></br>
                <label>Establecer fecha de entrega</label>
                <input type="date" id="fecha_entrega" class="form-control" name="fecha_entrega" required value="<?php echo $today;?>"></br>
                <input type="submit" value="Guardar cambios" name="submit" class="button"></br>
                </br>
              </form>
              </div>
            </div>
          </div>
        </div>
        </section>
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
<script type="text/javascript" src="../../js/fechas.js"></script>
</body>
</html>
