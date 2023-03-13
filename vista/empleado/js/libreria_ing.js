function soloMayusculas(campo_id) 
{
	var cadena = document.getElementById(campo_id).value;
	var cadena2 = cadena.toUpperCase();
	document.getElementById(campo_id).value = cadena2;
}

function SoloNumeros(evt) 
{
	var nav4 = window.Event ? true : false;
	var key = nav4 ? evt.which : evt.keyCode;
	return (key <= 13 || (key >= 48 && key <= 57));
}

function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toString();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";//Se define todo el abecedario que se quiere que se muestre.
    especiales = [8, 37, 39, 46, 6]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial){
alert('Tecla no aceptada');
        return false;
      }
}

function revisa_form(form_id) 
{
	//Con esta función revisamos los elementos del formulario que se pasa por parámetro
	var formulario = document.getElementById(form_id);	
	var valido = true;
    for (var j=0; j<formulario.elements.length; j++)
    {
        elemento=formulario.elements[j];
        if (elemento.className != 'no_requerido') //Para diferenciar los campos no requeridos en el formulario
        {
	        valor = formulario.elements[j].value;
	        if (valor == null || valor.length == 0)
	        {
	        	alert('[ERROR] El campo '+ formulario.elements[j].name +' no debe estar vací­o');
	        	formulario.elements[j].style.border='1px solid red';
	        	formulario.elements[j].focus();
	        	valido = false;
	        	break;
	        }
    	}
    }
	
	return valido;
}

function validaCarrera(param)
{
	if (revisa_form("form_car"))
		enviaCarrera(param);
	else
		return false;
}

function enviaCarrera(param)
{
	var nombres=document.getElementById("nombres").value
	var apellidos=document.getElementById("apellidos").value
	var usuario=document.getElementById("usuario").value
	var clave=document.getElementById("clave").value
	var correo=document.getElementById("correo").value	
	var n_cedula=document.getElementById("n_cedula").value	
	var tipo_empleado_id_tipo_empleado=document.getElementById("tipo_empleado_id_tipo_empleado").value	
	var objAjax=new XMLHttpRequest(); 
	if (param=="incluir")
		objAjax.open("POST","../../controlador/empleado.php?accion=agregar_empleado&nombres="+nombres+"&apellidos="+apellidos+"&usuario="+usuario+
		"&clave="+clave+"&n_cedula="+n_cedula+"&correo="+correo+"&tipo_empleado_id_tipo_empleado="+tipo_empleado_id_tipo_empleado);
	else 
	{
		var id_empleado=document.getElementById("id_empleado").value;
		objAjax.open("POST","../../controlador/empleado.php?accion=modificar_empleado&nombres="+nombres+"&apellidos="+apellidos+"&n_cedula="+n_cedula+"&id_empleado="+id_empleado+"&correo="+correo+"&usuario="+usuario+
		"&clave="+clave+"&tipo_empleado_id_tipo_empleado="+tipo_empleado_id_tipo_empleado);
	}
	objAjax.onreadystatechange=function() 
	{
		if (objAjax.readyState==4 && objAjax.status==200)
		{
			var respuesta=objAjax.responseText; 
			var datos=respuesta.split("#"); 
			if (datos[0]!=0) 
			{				
				document.getElementById("mensaje").style.display="block";
				document.getElementById("mensaje").innerHTML=datos[1];
				window.setTimeout(function() {
					document.getElementById("mensaje").style.display="none";
					document.getElementById("mensaje").innerHTML="";
					}, 3000);
				if (param=="incluir")
				{
					document.getElementById("nombres").value="";
					document.getElementById("apellidos").value="";
					document.getElementById("usuario").value="";
					document.getElementById("clave").value="";
					document.getElementById("correo").value="";
					document.getElementById("n_cedula").value="";
					document.getElementById("tipo_empleado_id_tipo_empleado").value="";
				}

			}
			else
			{
				document.getElementById("mensaje").classList.remove('alert-success');
				document.getElementById("mensaje").classList.add('alert-danger');
				document.getElementById("mensaje").style.display="block";
				document.getElementById("mensaje").innerHTML=datos[1];
				window.setTimeout(function() {
					document.getElementById("mensaje").style.display="none";
					document.getElementById("mensaje").innerHTML="";
					document.getElementById("mensaje").classList.remove('alert-danger');
					document.getElementById("mensaje").classList.add('alert-success');
					}, 3000);
			}				
		}
	}
	objAjax.send(null);	
}

function eliminaCarrera(boton,id_empleado)
{
	if (confirm("¿Realmente Desea eliminar el empleado con el ID "+id_empleado+"?"))
	{
		var objAjax=new XMLHttpRequest();
		objAjax.open("POST","../../controlador/empleado.php?accion=eliminar_empleado&id_empleado="+id_empleado);
		objAjax.onreadystatechange=function()
		{
			if (objAjax.readyState==4 && objAjax.status==200)
			{
				var respuesta=objAjax.responseText;
				var datos=respuesta.split("#");
				if (datos[0]!=0)
				{
					document.getElementById("mensaje").style.display="block";
					document.getElementById("mensaje").innerHTML=datos[1];
					window.setTimeout(function() {
						document.getElementById("mensaje").style.display="none";
						document.getElementById("mensaje").innerHTML="";
						var fila = boton.parentNode.parentNode;
						fila.parentNode.removeChild(fila); 
						}, 3000);
				}
				else
				{
					document.getElementById("mensaje").classList.remove('alert-success');
					document.getElementById("mensaje").classList.add('alert-danger');
					document.getElementById("mensaje").style.display="block";
					document.getElementById("mensaje").innerHTML=datos[1];
					window.setTimeout(function() {
						document.getElementById("mensaje").style.display="none";
						document.getElementById("mensaje").innerHTML="";
						document.getElementById("mensaje").classList.remove('alert-danger');
						document.getElementById("mensaje").classList.add('alert-success');
						}, 3000);
				}
			}
		}
		objAjax.send(null);
	}
}

function validaMateria(param)
{
	if (revisa_form("form_esp"))
		enviaMateria(param);
	else
		return false;
}

function enviaMateria(param)
{
	var descripcion=document.getElementById("descripcion").value
	var unicred=document.getElementById("unicred").value	
	var objAjax=new XMLHttpRequest(); //Creo el objeto Ajax
	if (param=="incluir")
		objAjax.open("POST","../../controlador/materia.php?accion=agregar_materia&descripcion="+descripcion+"&unicred="+unicred);
	else //Modificar
	{
		var codigo=document.getElementById("codigo").value;
		objAjax.open("POST","../../controlador/materia.php?accion=modificar_materia&descripcion="+descripcion+"&unicred="+unicred+"&codigo="+codigo);
	}
	objAjax.onreadystatechange=function() //Aquí espera la respuesta
	{
		if (objAjax.readyState==4 && objAjax.status==200)
		{
			var respuesta=objAjax.responseText; //Recibo la respuesta del controlador
			var datos=respuesta.split("#"); //Rearmo el array recibido
			if (datos[0]!=0) //Posición del elemento 'exito' en la respuesta
			{				
				document.getElementById("mensaje").style.display="block";
				document.getElementById("mensaje").innerHTML=datos[1];
				window.setTimeout(function() {
					document.getElementById("mensaje").style.display="none";
					document.getElementById("mensaje").innerHTML="";
					}, 3000);
				if (param=="incluir")
				{
					document.getElementById("descripcion").value="";
					document.getElementById("unicred").value="";					
				}
				document.getElementById("descripcion").focus();
			}
			else
			{
				document.getElementById("mensaje").classList.remove('mensaje_ok');
				document.getElementById("mensaje").classList.add('mensaje_error');
				document.getElementById("mensaje").style.display="block";
				document.getElementById("mensaje").innerHTML=datos[1];
				window.setTimeout(function() {
					document.getElementById("mensaje").style.display="none";
					document.getElementById("mensaje").innerHTML="";
					document.getElementById("mensaje").classList.remove('mensaje_error');
					document.getElementById("mensaje").classList.add('mensaje_ok');
					}, 3000);
			}				
		}
	}
	objAjax.send(null);	
}

function login(param)
{
	var usuario=document.getElementById("usuario").value
	var clave=document.getElementById("clave").value
	var objAjax=new XMLHttpRequest(); 
	if (param=="incluir"){
	objAjax.open("POST","../../controlador/usuarios.php?accion=iniciar_sesion&usuario="+usuario+"&clave="+clave);
	} 
	objAjax.onreadystatechange=function() 
	{
		if (objAjax.readyState==4 && objAjax.status==200)
		{
			var respuesta=objAjax.responseText; 
			console.log(respuesta);
			var datos=respuesta.split("#"); 
			if (datos[0]!=0) 
			{				
				document.getElementById("mensaje").style.display="block";
				document.getElementById("mensaje").innerHTML=datos[1];
				window.setTimeout(function() {
					document.getElementById("mensaje").style.display="none";
					document.getElementById("mensaje").innerHTML="";
					}, 3000);
				if (param=="incluir")
				{
					document.getElementById("usuario").value="";
					document.getElementById("clave").value="";
					document.getElementById("nombres").value="";
					document.getElementById("apellidos").value="";
				}

				document.getElementById("usuario").focus();
			}
			else
			{
				document.getElementById("mensaje").classList.remove('mensaje_ok');
				document.getElementById("mensaje").classList.add('mensaje_error');
				document.getElementById("mensaje").style.display="block";
				document.getElementById("mensaje").innerHTML=datos[1];
				window.setTimeout(function() {
					document.getElementById("mensaje").style.display="none";
					document.getElementById("mensaje").innerHTML="";
					document.getElementById("mensaje").classList.remove('mensaje_error');
					document.getElementById("mensaje").classList.add('mensaje_ok');
					}, 3000);
			}				
		}
	}
	objAjax.send(null);	
}