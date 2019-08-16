<?php
    $aside = ' 
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Alexander Pierce</p>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">Menú de Navegación</li>
          <li>
            <a href="indexAdm.php"><i class="glyphicon glyphicon-home"></i> <span>Inicio</span></a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-open"></i> <span>Nuevo</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="InsertCli.php"><i class="fa fa-circle-o"></i> Cliente</a></li>
            </ul>
            <ul class="treeview-menu">
              <li><a href="InsertEmp.php"><i class="fa fa-circle-o"></i> Empleado</a></li>
            </ul>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>';
?>