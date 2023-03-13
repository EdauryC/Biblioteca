function soloMayusculas(campo_id) {
  var cadena = document.getElementById(campo_id).value;
  var cadena2 = cadena.toUpperCase();
  document.getElementById(campo_id).value = cadena2;
}

function SoloNumeros(evt) {
  var nav4 = window.Event ? true : false;
  var key = nav4 ? evt.which : evt.keyCode;
  return key <= 13 || (key >= 48 && key <= 57);
}

function revisa_form(form_id) {
  var formulario = document.getElementById(form_id);
  var valido = true;
  for (var j = 0; j < formulario.elements.length; j++) {
    elemento = formulario.elements[j];
    if (elemento.className != "no_requerido") {
      valor = formulario.elements[j].value;
      if (valor == null || valor.length == 0) {
        alert(
          "[ERROR] El campo " +
            formulario.elements[j].name +
            " no debe estar vací­o"
        );
        formulario.elements[j].style.border = "1px solid red";
        formulario.elements[j].focus();
        valido = false;
        break;
      }
    }
  }

  return valido;
}

function validaCarrera(param) {
  if (param == "modificar_prestamo") {
    enviaCarrera(param);
  } else {
    if (revisa_form("form_car")) enviaCarrera(param);
    else return false;
  }
}

function enviaCarrera(param) {
  var objAjax = new XMLHttpRequest();
  if (param == "incluir") {
    var codigo_ejemplar = document.getElementById("codigo_ejemplar").value;
    var fecha_prestamo = document.getElementById("fecha_prestamo").value;
    var fecha_vencimiento = document.getElementById("fecha_vencimiento").value;
    var libro_id_libro = document.getElementById("libro_id_libro").value;
    var usuario_id_usuario = document.getElementById(
      "estudiante_id_estudiante"
    ).value;
    var empleado_id_empleado = document.getElementById(
      "empleado_id_empleado"
    ).value;
    objAjax.open(
      "POST",
      "../../controlador/prestamo.php?accion=agregar_prestamo&fecha_prestamo=" +
        fecha_prestamo +
        "&codigo_ejemplar=" +
        codigo_ejemplar +
        "&fecha_vencimiento=" +
        fecha_vencimiento +
        "&libro_id_libro=" +
        libro_id_libro +
        "&usuario_id_usuario=" +
        usuario_id_usuario +
        "&empleado_id_empleado=" +
        empleado_id_empleado
    );
  } else {
    var libro_id_libro = document.getElementById("libro_id_libro").value;
    var idEstudiante = document.getElementById("idEstudiante").value;
    var idPrestamo = document.getElementById("idPrestamo").value;
    var codigo_ejemplar = document.getElementById("codigo_ejemplar").value;
    var fecha_inicio = document.getElementById("fecha_inicio").value;
    var fecha_fin = document.getElementById("fecha_fin").value;

    if(fecha_inicio == ""){
      fecha_inicio = "na";
    }
    if(fecha_fin == ""){
      fecha_fin = "na";
    }
    
    objAjax.open(
      "POST",
      "../../controlador/prestamo.php?accion=modificar_prestamo&libro_id_libro=" +
        libro_id_libro +
        "&idEstudiante=" +
        idEstudiante +
        "&idPrestamo=" +
        idPrestamo +
        "&codigo_ejemplar=" +
        codigo_ejemplar +
        "&fecha_fin=" +
        fecha_fin  +
        "&fecha_inicio=" +
        fecha_inicio 
    );
  }
  objAjax.onreadystatechange = function () {
    if (objAjax.readyState == 4 && objAjax.status == 200) {
      var respuesta = objAjax.responseText;
      var datos = respuesta.split("#");
      if (datos[0] != 0) {
        document.getElementById("mensaje").style.display = "block";
        document.getElementById("mensaje").innerHTML = datos[1];
        window.setTimeout(function () {
          document.getElementById("mensaje").style.display = "none";
          document.getElementById("mensaje").innerHTML = "";
        }, 3000);
      } else {
        document.getElementById("mensaje").classList.remove("mensaje_ok");
        document.getElementById("mensaje").classList.add("mensaje_error");
        document.getElementById("mensaje").style.display = "block";
        document.getElementById("mensaje").innerHTML = datos[1];
        window.setTimeout(function () {
          document.getElementById("mensaje").style.display = "none";
          document.getElementById("mensaje").innerHTML = "";
          document.getElementById("mensaje").classList.remove("mensaje_error");
          document.getElementById("mensaje").classList.add("mensaje_ok");
        }, 3000);
      }
    }
  };
  objAjax.send(null);
}

function eliminaCarrera(boton, id_prestamo) {
  if (
    confirm(
      "¿Realmente Desea eliminar el prestamo con el ID " + id_prestamo + "?"
    )
  ) {
    var objAjax = new XMLHttpRequest();
    objAjax.open(
      "POST",
      "../../controlador/prestamo.php?accion=eliminar_prestamo&id_prestamo=" +
        id_prestamo
    );
    objAjax.onreadystatechange = function () {
      if (objAjax.readyState == 4 && objAjax.status == 200) {
        var respuesta = objAjax.responseText;
        var datos = respuesta.split("#");
        if (datos[0] != 0) {
          document.getElementById("mensaje").style.display = "block";
          document.getElementById("mensaje").innerHTML = datos[1];
          window.setTimeout(function () {
            document.getElementById("mensaje").style.display = "none";
            document.getElementById("mensaje").innerHTML = "";
            var fila = boton.parentNode.parentNode;
            fila.parentNode.removeChild(fila);
          }, 3000);
        } else {
          document.getElementById("mensaje").classList.remove("alert-success");
          document.getElementById("mensaje").classList.add("alert-danger");
          document.getElementById("mensaje").style.display = "block";
          document.getElementById("mensaje").innerHTML = datos[1];
          window.setTimeout(function () {
            document.getElementById("mensaje").style.display = "none";
            document.getElementById("mensaje").innerHTML = "";
            document.getElementById("mensaje").classList.remove("alert-danger");
            document.getElementById("mensaje").classList.add("alert-success");
          }, 3000);
        }
      }
    };
    objAjax.send(null);
  }
}
