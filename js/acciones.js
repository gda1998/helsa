// Metodo onLoad que se ejecuta cuando carga la pagina
$(document).ready(function(){
});

//Arreglo que contiene los posibles errores de PHP
var arregloErrores = ["<b>Notice","<b>Parse","<b>Warning","<b>Error","<b>Fatal"];

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

//Metodo para validar un formulario o un campo en especifico
function validaForm(nombreDiv){
    var div = $("#"+nombreDiv+" .form-control");
    var resu = true;
    for(var x=0;x<div.length;x++){
        if($(div[x]).val()!= null){
            var valor = $(div[x]).val();
            if(valor.length==0 || /^\s+$/.test(valor)){
                resu = false;
                x= div.length;
            }
        }
        else{
            resu = false;
            x= div.length;
        }
    }
    return resu;
}

// Metodo para que un input number no acepte signos de operadores (+*-.)
function caracteresEspecificos(e) {
	var tecla = e.keyCode;
	if (tecla == 110 || tecla == 190) {
		return false;
	} else {
		if (tecla == 109 || tecla == 189) {
			return false;
		} else {
			if (tecla == 107 || tecla == 187) {
				return false;
			} else {
				return true;
			}
		}
	}
}

// Metodo para que un input number solo acepte acepte cantidades mayores a 0
function sinCeros(input,valor) {
    //localStorage.setItem('nombre','variable');
    var arregloCadena= Array.from(valor);
	if (arregloCadena[0] == '0') {
		if (valor.length == 1) {
			$(input).val('1');
		} else {
			valor = valor.substring(1)
			$(input).val(valor);
			sinCeros(input,valor);
		}
	}
}