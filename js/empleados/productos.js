// Metodo onLoad que se ejecuta cuando carga la pagina
window.onload = function(){
    cmbCategoria();
}

//Metodo que sirve para llenar el select de Categoria
function cmbCategoria(){
    $.ajax({
        url:"../../controller/categoria/cmbCategoria.php",
        type: "GET",
        success: function(resu){
            if(atrapaErrores(resu) == false){
                return;
            }
            $("#cmbCategoria").empty();
            $("#cmbCategoria").append(resu);
            $("#cmbCategoria").attr("onchange","inputProductos();");
        },
        error: function(mensaje){
            swal("Error " + mensaje.status, mensaje.statusText, "error");
        }
    });
}

//Metodo que se utiliza para hacer la busqueda de productos de una manera responsiva
function inputProductos(){
    $("#divBusqueda").html("");
    $("#divBusqueda").attr("style","display:none;");
    if(validaForm('divTxtProductos') == false){
        return;
    }
    $.ajax({
        url: "../../controller/empleados/busquedaProductosAJAX.php",
        type: "POST",
        data: {"idCategoria": $("#cmbCategoria").val(), "txtProductos": $("#txtProductos").val()},
        success: function(resu){
            if(atrapaErrores(resu) == false){
                return;
            }
            if(resu==""){
                return;
            }
            $("#divBusqueda").attr("style","display:block;");
            $("#divBusqueda").html(resu);
        },
        error: function(mensaje){
            swal("Error " + mensaje.status, mensaje.statusText, "error");
        }
    });
}

//Metodo para controlar las teclas que presiona el usuario en el #txtProductos
function tecladoTxtProductos(e){
    var tecla = e.keyCode;
    if(tecla==32 && /^\s+$/.test($("#txtProductos").val())){
        $("#txtProductos").val("");
        return false;
    }
    else{
        if(tecla==13){
            resultadosProductos(0);
        }
        return true;
    }
}

//Metodo para comprar que txtProductos no este vacio y ademas que existan posibles resultados de la búsqueda
function validaTxtProductos(){
    var resu = true;
    if($("#txtProductos").val()!="" && !/^\s+$/.test($("#txtProductos").val())){
        if($("#divBusqueda").attr("style")=="display:none;"){
            swal("Sin Resultados","No se encontraron resultados","info");
            resu = false;
        }
    }
    else{
        swal("Campo Vacío","Llene el campo","warning");
        resu = false;
    }
    return resu;
}

//Metodo para mostrar los productos que se encontraron en la busqueda y se muestre en las cards
function resultadosProductos(codProducto){
    if(validaTxtProductos()==false){
        $("#txtProductos").focus();
        $("#divResultados").html("");
        return;
    }
    var condicion;
    if(codProducto == 0){
        condicion = $("#txtProductos").val();
    }
    else{
        condicion = codProducto;
    }
    $.ajax({
        url : "../../controller/empleados/resultadosProductosAJAX.php",
        type: "POST",
        data: "condicion="+condicion,
        success: function(resu){
            if(atrapaErrores(resu) == false){
                return;
            }
            $("#txtProductos").val('');
            $("#divBusqueda").attr("style","display:none;");
            $("#divResultados").html(resu);
            $("#divResultados").paginate({
                items_per_page: 9,
                prev_next: true,
                prev_text: '&laquo;',
                next_text: '&raquo;'
            });
        },
        error: function(mensaje){
            swal("Error " + mensaje.status, mensaje.statusText, "error");
        }
    });
}

function ActualizarPrecio(button){
  var codProducto = $(button).attr("id");
  var txtPrecio = document.getElementById("txtPrecio").value;
  $.ajax({
      url : "../../controller/empleados/actualizarProductoAJAX.php",
      type: "POST",
      data: {"id": codProducto, "txtPrecio": txtPrecio},
      success: function(resu){
          if(atrapaErrores(resu) == false){
              return;
          }
          alert("Producto actualiazado con éxito");
          var div = document.getElementById('divResultados');
          while(div.firstChild){
            div.removeChild(div.firstChild);
          }
      },
      error: function(mensaje){
          swal("Error " + mensaje.status, mensaje.statusText, "error");
      }
  });

}

//Metodo para agregar al carrito
