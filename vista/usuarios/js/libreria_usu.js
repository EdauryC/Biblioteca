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
	var formulario = document.getElementById(form_id);	
	var valido = true;
    for (var j=0; j<formulario.elements.length; j++)
    {
        elemento=formulario.elements[j];
        if (elemento.className != 'no_requerido')
        {
	        valor = formulario.elements[j].value;
	        if (valor == null || valor.length == 0)
	        {
	        	alert('[ERROR] El campo '+ formulario.elements[j].name +' no debe estar vac��o');
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
	var n_cedula=document.getElementById("n_cedula").value	
	var nombres=document.getElementById("nombres").value
	var apellidos=document.getElementById("apellidos").value
	var status=document.getElementById("status").value
	var usuario=document.getElementById("usuario").value
	var clave=document.getElementById("clave").value
	
	var objAjax=new XMLHttpRequest(); 
	if (param=="incluir")
		objAjax.open("POST","../../controlador/usuarios.php?accion=agregar_usuarios&n_cedula="+n_cedula+"&nombres="+nombres+"&apellidos="+apellidos+"&status="+status+
		"&usuario="+usuario+"&clave="+clave);
		else 
		{
			var id_usuario=document.getElementById("id_usuario").value;
			objAjax.open("POST","../../controlador/usuarios.php?accion=modificar_usuario&id_usuario="+id_usuario+"&n_cedula="+n_cedula+"&nombres="+nombres+"&apellidos="+apellidos+"&status="+status+
			"&usuario="+usuario+"&clave="+clave);
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
					document.getElementById("nombres").value="";
					document.getElementById("apellidos").value="";
					document.getElementById("status").value="";
					document.getElementById("usuario").value="";
					document.getElementById("clave").value="";
					document.getElementById("n_cedula").value="";
				}

				document.getElementById("usuario").focus();
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