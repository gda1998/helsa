<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="../../dist/img/Helsa/favicon.ICO" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Agregar Clientes</title>
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
  <!--Estilos-->
  <link rel="stylesheet" href="../../css/EstilosPersonales.css">
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
    include '../../views/asideAdministrador.php';
    echo $aside;
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="glyphicon glyphicon-user"></i> Clientes
      </h1>
      <ol class="breadcrumb">
        <li><a href="indexAdm.php"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li><i class="glyphicon glyphicon-open"></i> Nuevo</li>
        <li class="active"><i class="glyphicon glyphicon-user"></i> Clientes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div id="divAlert" class="alert callout-helsa alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="glyphicon glyphicon-info-sign"></i> Mensaje del Sistema</h4>
        <p id="pAlert">Completar toda la información del formulario es indispensable para la empresa.</p>
    </div>

      <!-- Default box -->
      <div class="box box-helsa">
        <div class="box-header with-border">
          <h3 class="box-title">Agregar Clientes</h3>
        </div>
        <div class="box-body">
            <div id="formNuevoCliente" class="form-row">
              <div class="form-group col-md-12">
                <label for="inputAddress">Nombre de la Empresa Cliente:</label>
                <input type="text" class="form-control" id="nomemp" placeholder="Mercury.EXE">
              </div>
              <div class="form-group col-md-12">
                <label for="inputAddress">Nombre del Representante de la Empresa:</label>
                <input type="text" class="form-control" id="nomrep" placeholder="Maria Fernanda Rojas Paz">
              </div>
              <div class="form-group col-md-6">
                <label for="inputEmail4">Usuario:</label>
                <input type="text" class="form-control" id="user" placeholder="mercury">
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Contraseña</label>
                <input type="password" class="form-control" id="pass" placeholder="sic0923">
              </div>
              <div class="form-group col-md-8">
                <label for="inputEmail4">Correo Electronico:</label>
                <input type="email" class="form-control" id="correo" placeholder="mercury@gmal">
              </div>
              <div class="form-group col-md-4">
                <label for="inputZip">Telefono</label>
                <input type="text" class="form-control" id="tel" placeholder="555 555 555">
              </div>
              <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary" onclick="nuevo()">
                  <i class="glyphicon glyphicon-floppy-disk"></i> Registrar
                </button>
              </div>

            </div>    
        </div>
   
  
        <!-- /.box-body -->
        <div class="box-footer"></div>
        <!-- /.box-footer-->
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
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!--Scripts Personales-->
<script src="../../js/administrador/funciones.js"></script>
<script src="../../js/acciones.js"></script>
</body>
</html>