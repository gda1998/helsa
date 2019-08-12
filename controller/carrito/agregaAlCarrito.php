<?php
    //Aca se incluye el archivo que contiene las variables para la encriptacion de datos
    include '../config/variablesEncriptacion.php';
    //Si las variables que necesito para agregar al carrito no existen se manda un error
    //de que debe ingresar las variables
    if(!isset($_POST['cod_producto']) || !isset($_POST['descripcion']) || !isset($_POST['precio']) 
        || !isset($_POST['imagen']) || !isset($_POST['categoria']) || !isset($_POST['cantidad'])){
            echo '<b>Error </b>: Ingrese las variables correspondientes.';
            return;
    }
    //Se obtiene y desencripta las variables que se necesita para agregar al carrito
    $cod_producto = openssl_decrypt($_POST['cod_producto'], COD, KEY);
    $descripcion = openssl_decrypt($_POST['descripcion'],COD,KEY);
    $precio = openssl_decrypt($_POST['precio'],COD, KEY);
    $imagen = openssl_decrypt($_POST['imagen'], COD, KEY);
    $categoria = openssl_decrypt($_POST['categoria'],COD, KEY);
    $cantidad = $_POST['cantidad'];
    //Se agrega al arreglo producto todas las variables que se obtuvieron anteriormente 
    $producto = array('cod_producto'=>$cod_producto,'descripcion'=>$descripcion,'precio'=>$precio,
        'imagen'=>$imagen, 'categoria'=>$categoria, 'cantidad'=>$cantidad);
    //Se hace el recorrido de producto en un foreach para checar que ningun elemento del arreglo
    //tiene como valor una cadena vacia o una cadena con puros espacios blancos, de no ser asi
    //se manda un error de que hay campos vacios o los valores son invalidos
    foreach($producto as $elemento){
        if($elemento == "" || ctype_space($elemento)){
            echo '<b>Error </b>: Existen campos vacíos o los valores son inválidos.';
            return;
        }
    }
    //En esta condicion se pregunta si $cantidad adquirida de un producto es de tipo numerico, si es asi
    //se convierte a $cantidad a entero (eliminando puntos decimales) y se procede a la siguiente condicion
    if(is_numeric($cantidad)){
        $producto['cantidad'] = (int)$producto['cantidad'];
        //Se pregunta si cantidad es igual a cero, de ser asi, se manda un error diciendo que el valor de 
        //cantidad es invalido (Esto con el fin de evitar que agregue productos al carrito sin haber puesto una
        //cantidad)
        if($producto['cantidad'] == 0){
            echo '<b>Error </b>: El valor de cantidad es inválido.';
            return;
        }
        //Se pregunta si la cantidad es menor a cero, de ser asi, convertimos cantidad a positivo
        if($producto['cantidad']<0){
            $producto['cantidad'] = $producto['cantidad'] * -1;
        }
    }
    //Si la condicion no se cumple, se manda un error diciendo que el valor de cantidad es invalido
    else{
        echo '<b>Error </b>: El valor de cantidad es inválido.';
        return;
    }
    //Estas dos lineas de codigo, es para indicar que se van a trabajar con variables de sesion
    session_start();
    ob_start();
    //Se pregunta si no existe la variable de sesion 'carrito', de ser asi, se declara y se inicializa
    //la variable de sesion 'carrito'
    if(!isset($_SESSION['carrito'])){
        $_SESSION['carrito'] = [];
    }
    //Se pregunta si no existe la variable de sesion 'cantidadCarrito', de ser asi, se declara y se inicializa
    //la variable de sesion 'cantidadCarrito'
    if(!isset($_SESSION['cantidadCarrito'])){
        $_SESSION['cantidadCarrito'] = 0;
    }
    //Se declara la variable $encontrado, el cual se utilizara para checar si el producto ya esta
    //guardado en la variable de sesion
    $encontrado = false;
    //Se hace el recorrido de la variable de sesion carrito para checar sus elementos
    foreach($_SESSION['carrito'] as &$elemento){
        //En esta condicion se pregunta si cod_producto que se encuentra en $producto es igual a
        //uno de los cod_producto que se encuentra en 'carrito', de ser así, significa que ese producto
        //ya habia sido agregado con anterioridad y solo se procede a actualizar la cantidad agregada
        if(openssl_decrypt($elemento['cod_producto'],COD,KEY) == $producto['cod_producto']){
            $elemento['cantidad'] = $elemento['cantidad'] + $producto['cantidad'];
            $_SESSION['cantidadCarrito'] = $_SESSION['cantidadCarrito'] + $producto['cantidad'];
            //A $encontrado se le da el valor true para indicar que el producto ya esta guardado
            //en 'carrito'
            $encontrado = true;
            //Se rompre el foreach
            break;
        }
    }
    //Si $encotrado es igual a false significa que el producto no ha sido agregado a 'carrito'
    //y se procede a encriptar los valores y a agregar el producto a 'carrito' y se incrementa 'cantidadCarrito'
    if($encontrado == false){
        $producto = array('cod_producto'=>openssl_encrypt($cod_producto,COD,KEY),
        'descripcion'=>openssl_encrypt($descripcion,COD,KEY),
        'precio'=>openssl_encrypt($precio,COD,KEY),
        'imagen'=>openssl_encrypt($imagen,COD,KEY),
        'categoria'=>openssl_encrypt($categoria,COD,KEY),
        'cantidad'=>$cantidad);
        array_push($_SESSION['carrito'],$producto);
        $_SESSION['cantidadCarrito'] = $_SESSION['cantidadCarrito'] + $producto['cantidad'];
    }
    //Se pregunta si 'cantidadCarrito' es igual o menor a cero, de ser asi, significa que no hay
    //productos en el carrito y se reinializa 'carrito'
    if($_SESSION['cantidadCarrito']<=0){
        $_SESSION['carrito'] = [];
    }
    //Regresa la variable 'cantidadCarrito'
    echo $_SESSION['cantidadCarrito'];
?>