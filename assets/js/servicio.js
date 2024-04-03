document.addEventListener("DOMContentLoaded", function () {
    const tarjeta_servicio = document.querySelectorAll(".tarjeta-servicio");
  
    console.log("tarjetas_citas", tarjeta_servicio);
    // Itera sobre cada tarjeta de cita
    tarjeta_servicio.forEach(function (tarjeta) {
      // Busca el botón de editar dentro de la tarjeta
      const botonAgendar = tarjeta.querySelector(".boton-agendar-servicio");
  
      if (botonAgendar) {
        botonAgendar.addEventListener("click", function (e) {
          e.preventDefault();
  
          // Extraer el servicio
          const servicio = tarjeta.querySelector(".servicio").innerText;
          console.log("servicio", servicio);

  
          const servicioSelect = document.querySelector("#servicio");

          console.log("servicioSelect", servicioSelect);
  
          // Iterar sobre las opciones del select para encontrar y seleccionar el servicio correcto
          Array.from(servicioSelect.options).forEach(function (option) {
            if (option.text === servicio) {
              servicioSelect.value = option.value;
  
            }
          });
  

  
          //Mostrar el modal
          const modal = document.querySelector(".modal");
  
          modal.classList.add("modal--show");
   

        });
      }
    });
  });
  