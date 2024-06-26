/* Enviar formularios via AJAX */


document.addEventListener('DOMContentLoaded', function() {
  const formularios_ajax = document.querySelectorAll(".FormularioAjax");
  console.log("formularios_ajax", formularios_ajax);
  
  formularios_ajax.forEach((formularios) => {
    document.body.addEventListener('submit', function(e) {
      if (e.target && e.target.matches('.FormularioAjax')) {
          e.preventDefault();
          console.log('Formulario interceptado con delegación:', e.target);
          Swal.fire({
            title: "¿Estás seguro?",
            text: "Quieres realizar la acción solicitada",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, realizar",
            cancelButtonText: "No, cancelar",
          }).then((result) => {
            if (result.isConfirmed) {
              let data = new FormData(e.target); // Modificado aquí
              let method = e.target.getAttribute("method"); // Modificado aquí
              let action = e.target.getAttribute("action"); // Modificado aquí
      
      
              let encabezados = new Headers();
      
              let config = {
                method: method,
                headers: encabezados,
                mode: "cors",
                cache: "no-cache",
                body: data,
              };
      
              fetch(action, config)
                .then((respuesta) => respuesta.text()) // Obtenemos la respuesta como texto
                .then((texto) => {
                  try {
                    // Intentamos parsear el texto como JSON
                    const datos = JSON.parse(texto);
                    return alertas_ajax(datos); // Procesamos los datos con alertas_ajax
                  } catch (error) {
                    // Si el parseo falla o la respuesta está vacía, mostramos un error por defecto
                    throw new Error("Problemas al procesar la respuesta del servidor o respuesta vacía");
                  }
                })
                .catch((error) => {
                  console.log("Error procesando la respuesta:", error);
                  // Aquí manejas el error mostrando una alerta de error al usuario
                  Swal.fire({
                    icon: 'error',
                    title: 'Error del servidor',
                    text: 'Ha ocurrido un problema con el servidor',
                  });
                });
            }
          });
      }
  });
  
  });
});

function alertas_ajax(alerta) {
  if (alerta.tipo == "simple") {
    console.log("alerta", alerta);

    Swal.fire({
      icon: alerta.icono,
      title: alerta.titulo,
      text: alerta.texto,
      confirmButtonText: "Aceptar",
    });
  } else if (alerta.tipo == "recargar") {
    Swal.fire({
      icon: alerta.icono,
      title: alerta.titulo,
      text: alerta.texto,
      confirmButtonText: "Aceptar",
    }).then((result) => {
      if (result.isConfirmed) {
        location.reload();
      }
    });
  } else if (alerta.tipo == "redireccionar") {
    
    Swal.fire({
      icon: alerta.icono,
      title: alerta.titulo,
      text: alerta.texto,
      confirmButtonText: "Aceptar",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = alerta.url;
      }else{
        window.location.href = alerta.url;
      }
    });
  }
}
