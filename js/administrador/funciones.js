function nuevo(){
	var nombre = document.getElementById('nomemp').value;
	var username = document.getElementById('user').value;
	var password = document.getElementById('pass').value;
	var correo = document.getElementById('correo').value;
	var telefono = document.getElementById('tel').value;
	var representante = document.getElementById('nomrep').value;
	
    Func = "NuevoCliente";
		$.ajax({
			url : '../../controller/Administrador/ConsultasAdm.php',
			type : 'POST',
			//dataType : 'html',
			data : {
				nom: nombre, 
				user: username, 
				pass: password, 
				cor: correo, 
				tel: telefono, 
				rep: representante, 
				func: Func
			},
			
			success: function(resultado){
				$("#msj").html(resultado);
				alert(resultado);
				vaciaForm("formNuevoCliente");
				
			},
			error: function(mensaje){
				alert("¡Error "+mensaje.status+"!\n "+mensaje.statusText);
			}
		});
		/*.done(function(resultado){
			$("#msj").html(resultado);
		})*/	
	}

function empleado(){
	var nombre = document.getElementById('nombre').value;
	var app = document.getElementById('app').value;
	var apm= document.getElementById('apm').value;
	var sueldo = document.getElementById('sueldo').value;
	var userE = document.getElementById('userE').value;
	var passE = document.getElementById('passE').value;
	var tipoE = document.getElementById('inputEmpleado').value;

    Func = "NuevoEmpleado";
		$.ajax({
			url : '../../controller/Administrador/ConsultasAdm.php',
			type : 'POST',
			//dataType : 'html',
			data : {nom: nombre, 
				app: app, 
				apm: apm, 
				suel: sueldo, 
				use: userE, 
				pass: passE, 
				tip: tipoE,
				func: Func
			},
			success: function(resultado){
				$("#msj").html(resultado);
				alert(resultado);
				vaciaForm("formNuevoEmpleado");
				
			},
			error: function(mensaje){
				alert("¡Error "+mensaje.status+"!\n "+mensaje.statusText);
			}
		});
		/*
		.done(function(resultado){
			$("#msj").html(resultado);
		})
		alert("Se ha agregado una Institución");*/
		
	}
