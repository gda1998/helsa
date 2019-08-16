// Metodo onLoad que se ejecuta cuando carga la pagina
$(document).ready(function(){
    tablaCarrito(0);
});

function tablaCarrito(paginaInicio){
    $.ajax({
        type: "GET",
        url: "../../controller/carrito/listadoCarrito.php",
        success: function(resu){
            if(atrapaErrores(resu) == false){
                $("#divAlert").attr("style","display:block");
                $("#pAlert").html("<span>"+resu+"</span>");
                return;
            }
            $("#divListadoCarrito").empty();
            $("#divListadoCarrito").append(resu);
            $("#tblListadoCarrito").DataTable({
                language: {
                    url : "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                "iDisplayStart": paginaInicio
            });
        },
        error: function(mensaje){
            swal("Error " + mensaje.status, mensaje.statusText, "error");
        }
    });
}

function la_fila(elemento){
    let variable = $(elemento).parent().attr("id");
    //alert($(variable).attr("id"));
    let id = variable.replace("form","");
    id = "row"+id;
    document.getElementById(id).innerHTML = "";
    //$(id).empty();
    let cadena = '<tr> <td>1</td> <td>2</td> <td>3</td> <td>4</td> <td>5</td> <td>6</td> <td>7</td> <td>8</td></tr>';
    //$(id).append(cadena);
    document.getElementById(id).innerHTML = cadena;
}

function editaProducto(input){
    let idFormulario = $(input).parent().attr("id");
    let formulario = document.getElementById(idFormulario);
    $.ajax({
        type: "POST",
        url: "../../controller/carrito/editaCarrito.php",
        data: { cod_producto: $(formulario[0]).val(), cantidad: $(formulario[1]).val() },
        success: function(resu){
            //Preguntamos si no hay ningun error de conexion o de query en php
            //Si hay un error salimos del metodo
            if(atrapaErrores(resu) == false){
                return;
            }
            if(resu == "false"){
                eliminaDelCarrito(formulario[0]);
                return;
            }
            if(resu!=""){
                resu = resu.split("||");
                let subtotal = document.getElementById( idFormulario.replace("form","subtotal") );
                $(subtotal).html(resu[0]);
                $("#spanCarrito").html(resu[1]);
                $("#tdTotalCompra").html(resu[2]);
            }
        },
        error: function(mensaje){
            swal("Error " + mensaje.status, mensaje.statusText, "error");
        }
    });
}

function eliminaDelCarrito(elemento){
    let codProducto = $(elemento).attr("id");
    if(codProducto==undefined){
        codProducto = $(elemento).val();
    }
    let row = document.getElementById( "row"+codProducto );
    let numColumn = row.cells[0].innerHTML;
    $.ajax({
        type: "POST",
        url: "../../controller/carrito/eliminaCarrito.php",
        data: {cod_producto: codProducto},
        success: function(resu){
            //Preguntamos si no hay ningun error de conexion o de query en php
            //Si hay un error salimos del metodo
            if(atrapaErrores(resu) == false){
                return;
            }
            if(resu != $("#spanCarrito").html()){
                if(resu == "0"){
                    $("#spanCarrito").html("");
                }
                numColumn = parseInt(numColumn) -1;
                tablaCarrito(numColumn);
            }
            else{
                swal("¡Error!","Ocurrió un error al intentar eliminar el producto.","error");
            }
        },
        error: function(mensaje){
            swal("Error " + mensaje.status, mensaje.statusText, "error");
        }
    })
}