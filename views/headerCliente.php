<?php
    session_start();
    ob_start();
    $contadorCarrito;
    if(isset($_SESSION['cantidadCarrito']) && $_SESSION['cantidadCarrito']!=0){
      $contadorCarrito = $_SESSION['cantidadCarrito'];
    }
    else{
      $contadorCarrito = "";
    }
$header = '
<header class="main-header">
<!-- Logo -->
<div class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><img id="imagenChica" src="../../dist/img/Helsa/LogoChico.PNG"></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><img id="imagenGrande" src="../../dist/img/Helsa/LogoHelsa.PNG"></span>
</div>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">

    <!-- Notifications: style can be found in dropdown.less -->
    <li>
      <a href="mi_carrito.php">
        <i class="fa fa-shopping-cart"></i>
        <span id="spanCarrito" class="label label-danger">'.$contadorCarrito.'</span>
      </a>
    </li>
    
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
          <span class="hidden-xs">Alexander Pierce</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

            <p>
              Alexander Pierce - Web Developer
              <small>Member since Nov. 2012</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="#" class="btn btn btn-flat btnMenuFooter"><i class="glyphicon glyphicon-user"></i> Mi Cuenta</a>
            </div>
            <div class="pull-right">
              <a href="#" class="btn btn btn-flat btnMenuFooter"><i class="glyphicon glyphicon-log-out"></i> Salir</a>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
</header>'
?>