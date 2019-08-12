// Metodo onLoad que se ejecuta cuando carga la pagina
window.onload = function(){
    cmbCategoria();    
}

//Metodo que sirve para llenar el select de Categoria
function cmbCategoria(){
    //Llamamos al archivo php para cargar el select de categoria
    $.ajax({
        url:"../../controller/categoria/cmbCategoria.php",
        type: "GET",
        //Si no hubo ningun de error de servidor se procede a la parte de success
        success: function(resu){
            //Preguntamos si no hay ningun error de conexion o de query en php
            //Si hay un error salimos del metodo
            if(atrapaErrores(resu) == false){
                return;
            }
            //Se vacia el select de categoria
            $("#cmbCategoria").empty();
            //Se vuelve a llenar el select de categoria
            $("#cmbCategoria").append(resu);
            //Se le coloca al select de categoria el evento de onchange
            $("#cmbCategoria").attr("onchange","inputProductos();");
        },
        //Si hay un error de servidor se manda un mensaje de error
        error: function(mensaje){
            swal("Error " + mensaje.status, mensaje.statusText, "error");
        }
    });
}

//Metodo que se utiliza para hacer la busqueda de productos de una manera responsiva
function inputProductos(){
    //Vaciamos y ocultamos la lista #divBusqueda en donde se muestra
    //los posibles resultados de la busqueda de productos
    $("#divBusqueda").html("");
    $("#divBusqueda").attr("style","display:none;");
    //Se pregunta si #txtProductos esta vacio de ser asi se rompe el metodo
    if(validaForm('divTxtProductos') == false){
        return;
    }
    //Llamamos al archivo php para llenar #divBusqueda
    $.ajax({
        url: "../../controller/productos/busquedaProductosAJAX.php",
        type: "POST",
        //Se preparan los parametros de idCategoria y txtProductos para enviar al archivo php
        data: {"idCategoria": $("#cmbCategoria").val(), "txtProductos": $("#txtProductos").val()},
        success: function(resu){
            //Preguntamos si no hay ningun error de conexion o de query en php
            //Si hay un error salimos del metodo
            if(atrapaErrores(resu) == false){
                return;
            }
            //Si en la busqueda no se encuentra ningun posible resultado se rompe el metodo
            if(resu==""){
                return;
            }
            //Mostramos divBusqueda
            $("#divBusqueda").attr("style","display:block;");
            //Se llena divBusqueda
            $("#divBusqueda").html(resu);
        },
        //Si hay un error de servidor se manda un mensaje de error
        error: function(mensaje){
            swal("Error " + mensaje.status, mensaje.statusText, "error");
        }
    });
}

//Metodo para controlar las teclas que presiona el usuario en el #txtProductos
function tecladoTxtProductos(e){
    //Se declara la variable tecla para guardar la tecla presionada
    let tecla = e.keyCode;
    //Se pregunta que si la tecla que se presiono es una espacio y si el valor de #txtProductos
    //consta de solo espacios en blanco, de ser así se vacia la cadena que se encuentra dentro de
    //#txtProductos y se regresa un false
    if(tecla==32 && /^\s+$/.test($("#txtProductos").val())){
        $("#txtProductos").val("");
        return false;
    }
    //Si la condicion no se cumple se regresa un true el cual permite que se escriba el caracter
    else{
        //Se pregunta si la tecla presionada es un enter, de ser asi se ejecuta el metodo
        //resultadosProductos()
        if(tecla==13){
            resultadosProductos(0);
        }
        return true;
    }
}

//Metodo para comprar que txtProductos no este vacio y ademas que existan posibles resultados de la busqueda
function validaTxtProductos(){
    //Se declara la variable resu que sirve para validar txtProductos, si resu es true, significa que
    //txtProductos es valido
    let resu = true;
    //Se pregunta si txtProductos no este vacio y ademas que su valor no conste de espacios en blanco
    //De ser asi se procede a la siguiente condicion
    if($("#txtProductos").val()!="" && !/^\s+$/.test($("#txtProductos").val())){
        //Se pregunta si no se muestran posibles resultados de la busqueda de productos, de ser asi
        //se manda un sweet alert diciendo que no existen resultados de la busqueda
        //Y se pone resu igual a false, significando que txtProductos es invalido
        if($("#divBusqueda").attr("style")=="display:none;"){
            swal("Sin Resultados","No se encontraron resultados","info");
            resu = false;
        }
    }
    //Si la condicion no se cumple se manda un sweet alert diciendo que el campo esta vacio
    //Y se pone resu igual a false, significando que txtProductos es invalido
    else{
        swal("Campo Vacío","Llene el campo","warning");
        resu = false;
    }
    //Regresamos resu
    return resu;
}

//Metodo para mostrar los productos que se encontraron en la busqueda y se muestre en las cards
function resultadosProductos(codProducto){
    //Invocamos el metodo validaTxtProductos para checar si txtProductos es valido, de no ser asi
    //se vacia #divResultados y se rompe el metodo
    if(validaTxtProductos()==false){
        $("#txtProductos").focus();
        $("#divResultados").html("");
        return;
    }
    //Declaramos la variable condicion que se enviara al servidor para hacer la consulta sql con un where
    let condicion;
    //Se pregunta el valor de codProducto, si el valor es igual a cero, se pone a la variable condicion
    //busqueda el valor de #txtProductos
    if(codProducto == 0){
        condicion = $("#txtProductos").val();
    }
    //De lo contrario, colocamos a la variable condicion el valor de codProducto
    else{
        condicion = codProducto;
    }
    //Llamamos al archivo php para llenar #divResultados
    $.ajax({
        url : "../../controller/productos/resultadosProductosAJAX.php",
        type: "POST",
        //Se preparan el parametro de condicion para enviar al archivo php
        data: "condicion="+condicion,
        success: function(resu){
            //Preguntamos si no hay ningun error de conexion o de query en php
            //Si hay un error salimos del metodo
            if(atrapaErrores(resu) == false){
                return;
            }
            //Vaciamos a #txtProductos
            $("#txtProductos").val('');
            //Ocultamos a #divBusqueda
            $("#divBusqueda").attr("style","display:none;");
            //Llenamos a #divResultados que en donde se mostraran los resultados de la busqueda
            $("#divResultados").html(resu);
            //Paginamos a #divResultados para que solo se vayan mostrando de a nueve resultados
            //en el div
            $("#divResultados").paginate({
                items_per_page: 9,
                prev_next: true,
                prev_text: '&laquo;',
                next_text: '&raquo;'
            });
        },
        //Si hay un error de servidor se manda un mensaje de error
        error: function(mensaje){
            swal("Error " + mensaje.status, mensaje.statusText, "error");
        }
    });
}

//Metodo para agregar al carrito
function AgregaAlCarrito(button){
    //Obtenemos el codigo del producto en base al id del boton de agregar al carrito de cada card
    let codProducto = $(button).attr("id");
    //Se declara txtCant para guardar la cantidad que se coloco para agregar al carrito
    //(Este elemento se obtiene a partir del input=number que se encuentra en la card del producto seleccionado)
    let txtCant = document.getElementById("txtCantProducto"+codProducto);
    //Se pregunta si txtCant esta vacio (Si el valor no es numero se pasa como cadena vacia)
    //de ser asi se manda un error de que el valor de #txtCantProducto + codProducto es invalido
    //y se sale del metodo
    if($(txtCant).val()==""){
        swal("¡Error!","El valor no es válido","error");
        return;
    }
    //Obtenemos el formulario de la card del producto seleccionado
    let formulario = document.getElementById("formProducto"+codProducto);
    //Otenemos todos los input que se encuentra dentro del elemento formulario y se guarda en un arreglo
    //Esto se hace para obtener los datos encriptados del producto que se encuentra en los input=hidden
    let inputs = formulario.getElementsByTagName("input");
    //Llamamos al archivo php para el producto al carrito
    $.ajax({
        url: "../../controller/carrito/agregaAlCarrito.php",
        type: "POST",
        //Se preparan los datos del producto para enviar al archivo php
        data: {
            cod_producto: $(inputs[0]).val(),
            descripcion: $(inputs[1]).val(),
            precio: $(inputs[2]).val(),
            imagen: $(inputs[3]).val(),
            categoria: $(inputs[4]).val(),
            cantidad: $(txtCant).val()
        },
        success: function(resu){
            //Preguntamos si no hay ningun error de conexion o de query en php
            //Si hay un error salimos del metodo
            if(atrapaErrores(resu) == false){
                $("#divAlert").attr("style","display:block");
                $("#pAlert").html("<span>"+resu+"</span>");
                return;
            }
            //Preguntamos si resu que es la cantidad total de elementos que existe en el carrito de compras
            //es diferente de cero, de ser asi, mostramos dicha cantidad en el #spanCarrito, y ademas se
            //muestra un sweet alert diciendole al usuario que se ha agregado con exito
            if(resu!="0"){
                $("#spanCarrito").html(resu);
                swal({
                    title: "¡Agregado al carrito! :D",
                    text: "Sigue checando nuestros productos",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Confirmar Compra",
                    cancelButtonText: "Seguir Comprando",
                    closeOnConfirm: true,
                    closeOnCancel: true
                  },
                  function(isConfirm) {
                    if (isConfirm) {
                      location.assign("mi_carrito.php");
                    }
                });
            }
            //De no ser asi, vaciamos #spanCarrito
            else{
                $("#spanCarrito").html('');
            }
        },
        //Si hay un error de servidor se manda un mensaje de error
        error: function(mensaje){
            swal("Error " + mensaje.status, mensaje.statusText, "error");
        }
    });
}