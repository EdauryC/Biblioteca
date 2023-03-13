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
	var codigo=document.getElementById("codigo").value
	var nombre=document.getElementById("nombre").value
	var autor=document.getElementById("autor").value
	var descripcion=document.getElementById("descripcion").value
	var n_ejemplares=document.getElementById("n_ejemplares").value
	var status=document.getElementById("status").value
	var ISNB=document.getElementById("ISNB").value
	var categoria_libro_id_categoria_libro=document.getElementById("categoria_libro_id_categoria_libro").value  
	var objAjax=new XMLHttpRequest(); 
	if (param=="incluir")
		objAjax.open("POST","../../controlador/libro.php?accion=agregar_libro&codigo="+codigo+"&nombre="+nombre+
			"&autor="+autor+"&descripcion="+descripcion+"&n_ejemplares="+n_ejemplares+"&status="+status+"&ISNB="+ISNB+"&categoria_libro_id_categoria_libro="+categoria_libro_id_categoria_libro);
	else 
	{
		var id_libro=document.getElementById("id_libro").value;
		objAjax.open("POST","../../controlador/libro.php?accion=modificar_libro&id_libro="+id_libro+"&codigo="+codigo+"&nombre="+nombre+"&autor="+autor+"&descripcion="+descripcion+
			"&n_ejemplares="+n_ejemplares+"&status="+status+"&ISNB="+ISNB+"&categoria_libro_id_categoria_libro="+categoria_libro_id_categoria_libro);
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
					document.getElementById("codigo").value="";
					document.getElementById("nombre").value="";
					document.getElementById("autor").value="";
					document.getElementById("descripcion").value="";
					document.getElementById("n_ejemplares").value="";
					document.getElementById("ISNB").value="";
					document.getElementById("categoria_libro_id_categoria_libro").value="";
				}

				document.getElementById("codigo").focus();
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

function eliminaCarrera(boton,id_libro)
{
	if (confirm("¿Realmente Desea eliminar el libro con el ID:"+id_libro+"?"))
	{
		var objAjax=new XMLHttpRequest();
		objAjax.open("POST","../../controlador/libro.php?accion=eliminar_libro&id_libro="+id_libro);
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
