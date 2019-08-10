$(document).ready(function(){

});

function validacionCarrito(){
    var carrito = JSON.parse(localStorage.getItem("carrito"));
    if(carrito == null){
        return;
    }
    $.ajax({
        url: "",
        type: "POST",
        data: carrito,
        success: function(resu){
            localStorage.setItem("carrito",JSON.stringify(resu));
            //metodo
        },
        error: function(mensaje){
            swal("Error " + mensaje.status, mensaje.statusText, "error");
        }
    });
}

function contadorCarrito(){
    var carrito 
}