// Metodo onLoad que se ejecuta cuando carga la pagina
$(document).ready(function(){
});

//Arreglo que contiene los posibles errores de PHP
const arregloErrores = ["<b>Notice","<b>Parse","<b>Warning","<b>Error","<b>Fatal"];

//Metodo para mostrar el error provocado en PHP en un Alert
function atrapaErrores(resu){
    //Declaro la variable booleano que sirve para comprobar los errores de PHP
    //Si booleano se queda en true significa que no se detecto ningun error
    let booleano = true;
    //Este ciclo for es para recorrer la lista con los posibles errores de PHP
    for(var x=0;x<arregloErrores.length;x++){
        //Se busca en la cadena que se recibio como parametro que coincidan con algunos de
        //los errores del arreglo
        if(resu.indexOf(arregloErrores[x])!=-1){
            //Si la comparación es diferente de -1, significa que se encontro un error y se mostrara
            //dicho error en un alert de bootstrap
            resu = resu.replace("<br />", "");
            $("#divAlert").attr("style","display:block");
            $("#pAlert").html(resu);
            //Rompemos el ciclo y devolvemos un false
            return false;
        }
    }
    //Si no se encontro ningun error devolvemos error que es true
    return booleano;
}

//Metodo para validar un formulario o un campo en especifico
function validaForm(nombreDiv){
    //Se utiliza la variable 'div' para sacar a todos los input que se encuentre dentro de un div
    //Y que se guarden en un arreglo
    let div = $("#"+nombreDiv+" .form-control");
    //Se declara la variable resu que servira para decir si todos los elementos del arreglo div
    //no esten vacios, si resu es true, significa que ningun input esta vacio
    let resu = true;
    //Se hace el recorrido de los elementos input
    for(var x=0;x<div.length;x++){
        //La primera condicion que se hace es si el elemento no es nulo, si es asi, sigue la siguiente condicion
        if($(div[x]).val()!= null){
            //Asigno a la variable valor el elemento en turno
            let valor = $(div[x]).val();
            //Se pregunta que el tamanio de valor sea cero o que el valor solo conste de espacios en blanco
            //de ser asi, se rompe el ciclo y se pone resu igual a false
            if(valor.length==0 || /^\s+$/.test(valor)){
                resu = false;
                x= div.length;
            }
        }
        //De lo contrario, si la condicion es nula se rompe el ciclo y se pone resu igual a false 
        else{
            resu = false;
            x= div.length;
        }
    }
    //Regresamos resu
    return resu;
}

// Metodo para que un input number no acepte signos de operadores (+-.)
function caracteresEspecificos(e) {
    //Se declara la variable tecla para guardar la tecla presionada
    let tecla = e.keyCode;
    //Si la tecla es un punto, regreso un false y no permito que escriba el caracter
	if (tecla == 110 || tecla == 190) {
		return false;
	} else {
        //Si la tecla es un signo de resta, regreso un false y no permito que escriba el caracter
		if (tecla == 109 || tecla == 189) {
			return false;
		} else {
            //Si la tecla es un signo de suma, regreso un false y no permito que escriba el caracter
			if (tecla == 107 || tecla == 187) {
				return false;
			} else {
            //Si ninguna de las condiciones es verdadera se regresa un true y permito que se escriba
            //el caracter
				return true;
			}
		}
	}
}

// Metodo para que un input number solo acepte acepte cantidades mayores a 0
function sinCeros(input,valor) {
    //Declaro la variable arregloCadena en el cual convierte la cadena valor en un arreglo
    let arregloCadena= Array.from(valor);
    //Se pregunta si en la posicion cero de la cadena tiene como valor uno si es asi
    //se entra a la otra condicion, de lo contrario se termina el metodo
	if (arregloCadena[0] == '0') {
        //Preguntamos el tamaño de la cadena, si el tamaño es de solo un caracter, osea que el valor
        //solo es '0' le ponemos como valor '1' y se termina el metodo
		if (valor.length == 1) {
			$(input).val('1');
        } 
        //De lo contrario le quitamos a la cadena el primer cero que encuentre y simulamos la recursividad
        //Todo esto se hara hasta que ya no existan ceros y termine la condicion
        else {
			valor = valor.substring(1)
			$(input).val(valor);
			sinCeros(input,valor);
		}
	}
}