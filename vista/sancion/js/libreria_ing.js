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
	var status=document.getElementById("status").value
	var fecha_inicio=document.getElementById("fecha_inicio").value
	var fecha_fin=document.getElementById("fecha_fin").value
	var usuario_id_usuario=document.getElementById("usuario_id_usuario").value
	var objAjax=new XMLHttpRequest(); 
	if (param=="incluir")
		objAjax.open("POST","../../controlador/sancion.php?accion=agregar_sancion&status="+status+"&fecha_inicio="+fecha_inicio+
			"&fecha_fin="+fecha_fin+"&usuario_id_usuario="+usuario_id_usuario);
	else 
	{
		var id_sancion=document.getElementById("id_sancion").value;
		objAjax.open("POST","../../controlador/sancion.php?accion=modificar_sancion&id_sancion="+id_sancion+"&status="+status+"&fecha_inicio="+fecha_inicio+
		"&fecha_fin="+fecha_fin+"&usuario_id_usuario="+usuario_id_usuario);
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
					document.getElementById("status").value="";
					document.getElementById("fecha_inicio").value="";
					document.getElementById("fecha_fin").value="";
					document.getElementById("usuario_id_usuario").value="";
					
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

function eliminaCarrera(boton,id_sancion)
{
	if (confirm("¿Realmente Desea eliminar la sancion con el codigo "+id_sancion+"?"))
	{
		var objAjax=new XMLHttpRequest();
		objAjax.open("POST","../../controlador/sancion.php?accion=eliminar_sancion&id_sancion="+id_sancion);
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

function eliminaMateria(boton,codigo)
{
	if (confirm("¿Realmente desea eliminar la materia con el código "+codigo+"?"))
	{
		var objAjax=new XMLHttpRequest();
		objAjax.open("POST","../../controlador/materia.php?accion=eliminar_materia&codigo="+codigo);
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
						var fila = boton.parentNode.parentNode; //Obtiene el nodo padre (table) del nodo padre (tr) del botón
						fila.parentNode.removeChild(fila); //Borra la fila donde está el botón
						}, 3000);
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
}

function validaPensum()
{
	if (revisa_form("form_pen"))
		enviaMateriaPensum();
	else
		return false;
}

function enviaMateriaPensum()
{
	var carcod=document.getElementById("carcod").value
	var matcod=document.getElementById("matcod").value
	var trayecto=document.getElementById("trayecto").value
	var objAjax1=new XMLHttpRequest(); //Creo el objeto Ajax
	objAjax1.open("POST","../../controlador/pensum.php?accion=verificar_materia_carrera&carcod="+carcod+"&matcod="+matcod);
	objAjax1.onreadystatechange=function() //Aquí espera la respuesta
	{
		if (objAjax1.readyState==4 && objAjax1.status==200)
		{
			var respuesta1=objAjax1.responseText;
			if (respuesta1==0)
			{
				var objAjax=new XMLHttpRequest(); //Creo el objeto Ajax
				objAjax.open("POST","../../controlador/pensum.php?accion=agregar_materia_carrera&carcod="
					+carcod+"&matcod="+matcod+"&trayecto="+trayecto);
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
								document.getElementById("materias").innerHTML+='\n'+datos[2];
								}, 2000);
							document.getElementById("matcod").value="";
							document.getElementById("trayecto").value="";
							document.getElementById("btnGuardar").disabled=true;
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
								}, 2000);
						}				
					}
				}
				objAjax.send(null);
			}
			else
			{
				document.getElementById("mensaje").classList.remove('mensaje_ok');
				document.getElementById("mensaje").classList.add('mensaje_error');
				document.getElementById("mensaje").style.display="block";
				document.getElementById("mensaje").innerHTML="La materia ya fue agregada";
				window.setTimeout(function() {
					document.getElementById("mensaje").style.display="none";
					document.getElementById("mensaje").innerHTML="";
					document.getElementById("mensaje").classList.remove('mensaje_error');
					document.getElementById("mensaje").classList.add('mensaje_ok');
					}, 2000);
			}
		}
	}
	objAjax1.send(null);
}

function cargarListaMaterias(carcod)
{
	if (carcod !='' && carcod!=null)
	{
		var objAjax=new XMLHttpRequest(); //Creo el objeto Ajax
		objAjax.open("POST","../../controlador/pensum.php?accion=listar_materia_carrera&codigo="+carcod);
		objAjax.onreadystatechange=function() //Aquí espera la respuesta
		{
			if (objAjax.readyState==4 && objAjax.status==200)
			{
				var respuesta=objAjax.responseText; //Recibo la respuesta del controlador
				var datos=respuesta.split("#"); //Rearmo el array recibido
				if (datos[0]!=0) //Posición del elemento 'exito' en la respuesta
				{
					document.getElementById("materias").innerHTML=datos[2];
				}
				else
				{
					document.getElementById("materias").innerHTML="";
					document.getElementById("btnEliminar").disabled=true;
				}
			}
		}
		objAjax.send(null);
	}
	else
	{
		document.getElementById("materias").innerHTML="";
		document.getElementById("btnEliminar").disabled=true;
	}
}

function eliminaMateriaPensum()
{
	if (confirm("¿Realmente desea eliminar la materia del pensum?"))
	{
		var codigo=document.getElementById("materias").value;
		var objAjax=new XMLHttpRequest();
		objAjax.open("POST","../../controlador/pensum.php?accion=eliminar_materia_carrera&codigo="+codigo);
		objAjax.onreadystatechange=function()
		{
			if (objAjax.readyState==4 && objAjax.status==200)
			{
				var respuesta=objAjax.responseText;
				var datos=respuesta.split("#");
				if (datos[0]!=0)
				{
					var materias = document.getElementById("materias");
					var seleccion = materias.options[materias.selectedIndex]; //Escoge el <option> seleccionado
					seleccion.parentNode.removeChild(seleccion); //Elimina el <option> seleccionado
					document.getElementById("btnEliminar").disabled=true;
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
						}, 2000);
				}
			}
		}
		objAjax.send(null);
	}
}

function desactivarControles()
{
	document.querySelector('#matcod').value="";
	document.querySelector('#trayecto').value="";
	document.querySelector('#btnGuardar').disabled=true;
	document.querySelector('#btnEliminar').disabled=true;
}