window.onload = function(){
    cmbCategoria();
}

function cmbCategoria(){
    $.ajax({
        url:"../../controller/categoria/selectCategoria.php",
        type: "GET",
        success: function(resu){
            if(atrapaErrores(resu) == false){
                return;
            }
            $("#cmbCategoria").empty();
            $("#cmbCategoria").append(resu);
        },
        error: function(mensaje){
            swal("¡Error!",mensaje,"error");
        }
    });
}