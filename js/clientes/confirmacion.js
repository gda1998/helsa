window.onload = function(){
    cargaConfirmacion();
}

function cargaConfirmacion(){
    $.ajax({
        type : "GET",
        url: "../../controller/pedidos/confirmacionPedido.php",
        success: function(resu){
            $(".invoice").html(resu);
        },
        error: function(mensaje){
            swal("¡Error "+mensaje.status, mensaje.statusText, "error");
        }
    });
}

function confirmarCompra(){
    swal({
        title: "¿Desea realizar la compra?",
        text: "Una vez realizada la compra, ya no se podrá modificar.",
        type: "info",
        showCancelButton: true,
        confirmButtonClass: "btn-primary",
        confirmButtonText: "Confirmar Compra",
        cancelButtonText: "Cancelar",
        closeOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm) {
        if (isConfirm) {
          nuevoPedido();
        }
    });
}

function nuevoPedido(){
    $.ajax({
        type: "POST",
        url: "../../controller/pedidos/nuevoPedido.php",
        success: function(resu){
            //Preguntamos si no hay ningun error de conexion o de query en php
            //Si hay un error salimos del metodo
            if(atrapaErrores(resu) == false){
                return;
            }
            $("#spanEncabezado").html("Detalles del Pedido");
            $("#infoPedido").html(resu);
            imprimeCompra();
        },
        error: function(mensaje){
            swal("¡Error "+mensaje.status, mensaje.statusText, "error");
        }
    });
}

function imprimeCompra(){
    let encabezado = document.getElementById("encabezado").innerHTML;
    let infoCliente = document.getElementById("infoCliente").innerHTML;
    let cuerpo = document.getElementById("cuerpo").innerHTML;
    let divTotal = document.getElementById("divTotal").innerHTML;
    let originalContents = document.body.innerHTML;
    document.body.innerHTML = encabezado + infoCliente + cuerpo + divTotal;
    window.print();
    document.body.innerHTML = originalContents;
    swal("¡Gracias por tu Compra!","En unos dias se te notificará sobre la autorización de tu pedido","success");
    setTimeout(function(){
        window.location="pedidos_proceso.php";
    },5000);
}