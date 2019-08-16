<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="../../dist/img/Helsa/favicon.ICO" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inicio</title>
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
  <!--EstilosPersonales-->
  <link rel="stylesheet" href="../../css/EstilosPersonales.css">
  <?php
  require_once '../../controller/empleados/estadisticas.php';
  $estadisticas = new estadisticas();
  ?>
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
      <h1><i class="glyphicon glyphicon-home"></i> Inicio</h1>
      <ol class="breadcrumb">
        <li class="active"><i class="glyphicon glyphicon-home"></i> Inicio</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <center><h2>Estadísticas de los pedidos</h2></center>
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box color-helsa">
            <div class="inner">
              <h3 id="counterCancel"><?php
              $registrados = $estadisticas->contar_registrados();
              foreach($registrados as $datos){
                  echo $datos['registrados'];
                }?></h3>
              <p>Pedidos registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-mail"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box color-helsa">
              <div class="inner">
                <h3 id="counterCancel"><?php
                $autorizados = $estadisticas->contar_autorizados();
                foreach($autorizados as $datos){
                    echo $datos['autorizados'];
                  }?></h3>
                <p>Pedidos autorizados</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-checkmark-circle"></i>
              </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box color-helsa">
              <div class="inner">
                <h3 id="counterCancel"><?php
                $en_proceso = $estadisticas->contar_en_proceso();
                foreach($en_proceso as $datos){
                    echo $datos['en_proceso'];
                  }?></h3>
                <p>Pedidos en proceso</p>
              </div>
              <div class="icon">
                <i class="ion ion-clock"></i>
              </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box color-helsa">
              <div class="inner">
                <h3 id="counterCancel"><?php
                $cancelados = $estadisticas->contar_cancelados();
                foreach($cancelados as $datos){
                    echo $datos['cancelados'];
                  }?></h3>
                <p>Pedidos cancelados</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-cancel"></i>
              </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box color-helsa">
              <div class="inner">
                <h3 id="counterCancel"><?php
                $rechazados = $estadisticas->contar_rechazados();
                foreach($rechazados as $datos){
                    echo $datos['rechazados'];
                  }?></h3>
                <p>Pedidos rechazados</p>
              </div>
              <div class="icon">
                <i class="ion ion-arrow-return-left"></i>
              </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box color-helsa">
              <div class="inner">
                <h3 id="counterCancel"><?php
                $entregados = $estadisticas->contar_entregados();
                foreach($entregados as $datos){
                    echo $datos['entregados'];
                  }?></h3>
                <p>Pedidos entregados</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-send"></i>
              </div>
            </div>
        </div>
      </div>
      <!-- /.row -->
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
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
