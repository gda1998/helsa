<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="dist/img/Helsa/favicon.ICO" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!--Estilos-->
  <link rel="stylesheet" href="dist/css/EstilosLogin.css">
  <!--Animate-->
  <link rel="stylesheet" href="dist/css/animate.css">
</head>
<body>
    <div id="contenedor" class="col-md-4 fadeInDown delay-1s animated">
        <div id="encabezado">
            <img id="logo" src="dist/img/Helsa/LogoHelsa.PNG">
            <p><em>Introduzca sus datos para comenzar.</em></p>
        </div>
        <form id="contenido">
            <div class="form-group">
                <label>Usuario</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="txtUser" type="text" class="form-control" placeholder="Usuario">
                </div>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input id="txtPass" type="password" class="form-control" placeholder="Contraseña">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn" onclick="tipo_textbox();">
                            <i id="icon_password" class="glyphicon glyphicon-eye-open"></i>
                        </button>
                    </span>
                </div>
            </div>
            <div class="form-group" style="float:right;">
                <button id="btnLogin" class="btn btn"><i class="glyphicon glyphicon-log-in"></i> Entrar</button>
            </div>
        </form>
    </div>
<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>