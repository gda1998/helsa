<?php
        //Estas dos lineas de codigo, es para indicar que se van a trabajar con variables de sesion
        session_start();
        ob_start();
        //Se pregunta si no existe la variable de sesion 'carrito', de ser asi, se redirecciona a la
        //pagina de inicio
        if(isset($_SESSION['carrito'])){
          if($_SESSION['carrito'] == []){
            return header('Location: inicio.php');
            exit();
          }
        }
        else{
          return header('Location: inicio.php');
          exit();
        }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="../../dist/img/Helsa/favicon.ICO" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Confirmar Compra</title>
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
  <link rel="stylesheet" href="../../css/clientes/confirmacion.css">
  <link rel="stylesheet" href="../../css/clientes/estilosCarrito.css">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice"></section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="../../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!--Scripts Propios-->
<script type="text/javascript" src="../../js/acciones.js"></script>
<script type="text/javascript" src="../../js/clientes/confirmacion.js"></script>
</body>
</html>