<?php
    //Aca se incluyen el archivo de la conexion a la BD
    include '../config/conexion.php';
    //Aca se incluyen el archivo que contiene las variables para la encriptacion de datos
    include '../config/variablesEncriptacion.php';
    //Si la conexion es nula se regresa al archivo js
    if($conexion==null){
        return;
    }
    //Si las variables que necesito para la consulta en la parte de where no existe se mando un error
    //de que debe ingresar las variables
    if(!isset($_POST['txtProductos']) || !isset($_POST['idCategoria'])){
        echo '<b>Error </b>: Ingrese las variables correspondientes';
        return;
    }
    //Si txtProductos que se utiliza para una de la condiciones de la consulta esta vacio o solo tiene como
    //valor una cadena con puros espacios se manda un error de que no se agregó valor a la busqueda
    if($_POST['txtProductos'] == "" || ctype_space($_POST['txtProductos'])){
        echo '<b>Error </b>: No se agregó ningun valor para la búsqueda';
        return;
    }
    //Si idCategoria que se utiliza para una de la condiciones de la consulta al momento de desencriptar esta vacio
    //(que es el id de categoria) se manda un error de que el valor es invalido
    if(openssl_decrypt($_POST['idCategoria'],COD,KEY) == ""){
        echo '<b>Error </b>: El valor de categoría es inválido.';
        return;
    }
    //Obtengo las variables que necesito para la consulta de una manera segura
    $txtProductos = $conexion->real_escape_string(htmlentities($_POST['txtProductos']));
    $idCategoria = $conexion->real_escape_string(htmlentities($_POST['idCategoria']));
    $idCategoria = openssl_decrypt($idCategoria,COD,KEY);
    //Hago un select del codigo, la descripcion y la imagen de los productos filtrando a aquellos
    //en donde la descripcion tenga el patron que se mando desde js
    $query = "SELECT cod_producto, descripcion, imagen from Producto WHERE descripcion LIKE '%".$txtProductos."%'";
    //Si el id de categoria es diferente de 0 tambien se filtrara a aquellos productos que tengan
    //una categoria en especifico (El filtro se hace mediante id_categoria)
    if($idCategoria!="0"){
        $query = $query." AND id_categoria=".$idCategoria;
    }
    //Por ultimo se agrega a la consulta esta condicion para limitar la busqueda a 5 resultados
    $query = $query." LIMIT 5";
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
    //los posibles resultados de la busqueda mediante una lista
    $cadena = "<ul>";
    //Se declara la variable $x, que sirve para llevar el conteo de los posibles resultados
    $x = 0;
    //Llenado de la variable cadena con los valores del query
    while($datos=$resultado->fetch_assoc()){
        $cadena = $cadena.'<li><button type="button" onclick="resultadosProductos('.$datos['cod_producto'].');">
        <img src="'.$datos['imagen'].'">'.$datos['descripcion'].'</button></li>';
        $x++;
    }
    //Si los posibles resultados son mayores a cero, se agrega a la cadena el cierre de la lista
    if($x>0){
        $cadena = $cadena.'</ul>';
    }
    //De lo contrario, se vacia la cadena, para dar a entender que no hay posibles resultados de la busqueda
    else{
        $cadena = "";
    }
    //Cierra la conexion a la BD
    $conexion->close();
    //Regresa la variable cadena
    echo $cadena;
?>
