<?php
    //Aca se incluyen el archivo de la conexion a la BD
    include '../config/conexion.php';
    //Aca se incluyen el archivo que contiene las variables para la encriptacion de datos
    include '../config/variablesEncriptacion.php';
    //Si la conexion es nula se regresa al archivo js
    if($conexion == null){
        return;
    }
    //Si la variable que necesito para la consulta en la parte de where no existe se mando un error
    //de que debe ingresar la variable
    if(!isset($_POST['condicion'])){
        echo '<b>Error </b>: Ingrese la variable correspondientes';
        return;
    }
    //Si la variable que se utiliza para la consulta esta vacio o solo tiene como
    //valor una cadena con puros espacios se manda un error de que no se agregó valor a la busqueda
    if($_POST['condicion'] == "" || ctype_space($_POST['condicion'])){
        echo '<b>Error </b>: No se agregó ningun valor para la búsqueda';
        return;
    }
    //Obtengo la variable que necesito para la consulta de una manera segura y la guardo en $condicion
    $condicion = $conexion->real_escape_string(htmlentities($_POST['condicion']));
    //Hago un select con toda la informacion de los productos
    $query = "SELECT cod_producto,imagen,producto.descripcion AS descripcion,categoria.descripcion AS categoria, precio
                FROM producto JOIN categoria
                ON producto.id_categoria=categoria.id_categoria";
    //Aca se pregunta el tipo de variable de $condicion, si es de tipo numerico, la consulta se filtrara por el
    //codigo del producto
    if(is_numeric($condicion)){
        $query = $query." WHERE cod_producto=".$condicion;
    }
    //De lo contrario, la consulta se filtrara por el patron de caracteres que tenga descripcion
    else{
        $query = $query." WHERE producto.descripcion LIKE '%".$condicion."%'";
    }
    //Esta iinea de codigo es para que la consulta regrese con el formato de teclado utf-8
    $acentos = $conexion->query("SET NAMES 'utf8'");
    //Si la consulta falla se manda en un alert de bootstrap la notificacion del por que sucedio este error
    if(!$resultado = $conexion->query($query)){
        echo '
        <script>
            $("#divAlert").attr("style","display:block");
            $("#pAlert").html("<span>'.$conexion->error.'</span>");
        </script>';
        return;
    }
    //Si la consulta fue exitosa declaro la variable cadena que es la que voy a regresa al archivo js para mostrar
    //los resultados de la busqueda mediante cards y encriptando los datos de los productos
    $cadena = "";
    //Llenado de la variable cadena con los valores del query
    while($datos = $resultado->fetch_assoc()){
        $cadena = $cadena.'<div class="col-md-4 col-sm-6 pagination__item">
        <div class="card">
          <img src="'.$datos['imagen'].'">
          <h4><b>'.$datos['descripcion'].'</b></h4>
          <div class="card-container">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Categoría: '.$datos['categoria'].'</li>
            <li class="list-group-item">Precio: $'.$datos['precio'].' MXN</li>
            <li class="list-group-item" style="margin-bottom:-15px;">
              <div class="form-group row">
                <label class="col-sm-3 labelCard">Nuevo precio</label>
                <div class="col-sm-9">
                <input id="txtPrecio" type="text" class="form-control"
                  min="1" onkeydown="return soloNumeros(event);"
                  onkeyup="sinCeros(this,this.value);">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <button id="'.openssl_encrypt($datos['cod_producto'],COD,KEY).'" onclick="ActualizarPrecio(this);"
              class="btn btn-primary"><i class="ion ion-android-refresh"></i> Actualizar precio</button>
            </li>
          </ul>
          <form id="formProducto'.openssl_encrypt($datos['cod_producto'],COD,KEY).'" style="display:none;">
              <input name="cod_producto" class="input" type="hidden" value="'.openssl_encrypt($datos['cod_producto'],COD,KEY).'">
              <input name="descripcion" class="input" type="hidden" value="'.openssl_encrypt($datos['descripcion'],COD,KEY).'">
              <input name="precio" class="input" type="hidden" value="'.openssl_encrypt($datos['precio'],COD,KEY).'">
              <input name="imagen" class="input" type="hidden" value="'.openssl_encrypt($datos['imagen'],COD,KEY).'">
              <input name="categoria" class="input" type="hidden" value="'.openssl_encrypt($datos['categoria'],COD,KEY).'">
          </form>
          </div>
        </div>
      </div>';
    }
    $cadena = $cadena.'<div class="col-md-12 col-sm-12 pagination__controls"></div>';
    //Cierra la conexion a la BD
    $conexion->close();
    //Regresa la variable cadena
    echo $cadena;
?>
