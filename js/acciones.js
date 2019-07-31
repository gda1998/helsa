//Metodo onload
$(document).ready(function(){
    $(".select2").select2({
        placeholder : "Seleccione una opción"
    });
});

//Arreglo que contiene los posibles errores de PHP
var arregloErrores = ["<b>Notice","</b>Parse","<b>Warning","<b>Error","<b>Fatal"];

//Metodo para mostrar el error provocado en PHP en un Alert
function atrapaErrores(resu){
    var booleano = true;
    for(var x=0;x<arregloErrores.length;x++){
        if(resu.indexOf(arregloErrores[x])!=-1){
            resu = resu.replace("<br />", "");
            $("#divAlert").attr("style","display:block");
            $("#pAlert").html(resu);
            return false;
        }
    }
    return booleano;
}