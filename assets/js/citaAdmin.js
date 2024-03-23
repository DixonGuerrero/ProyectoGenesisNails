document.addEventListener("DOMContentLoaded", function () {
  // Selecciona el contenedor de la tabla
  const contenedorTabla = document.querySelector("#tablaDatos");

  // Delega el evento click a los botones editar que se encuentren dentro del contenedor de la tabla
  contenedorTabla.addEventListener("click", function (event) {
    // Comprueba si el elemento clickeado es un botón editar
    if (event.target.closest(".boton-editar")) {
      // Previene el comportamiento por defecto del botón (si es necesario)
      event.preventDefault();

      // Encuentra la fila (tr) más cercana al botón clickeado
      const fila = event.target.closest("tr");

      const cita = fila.cells[0].textContent; // Asume que el id de la cita está en la primera celda
      const servicio = fila.cells[2].textContent; // Asume que el tipo de servicio está en la tercera celda

      const fecha = fila.cells[4].textContent; // Asume que la fecha está en la quinta celda

      const hora12 = fila.cells[5].textContent;

     // Asume que la hora está en la sexta celda
      // Convertir a formato de 24 horas
      let [hora, minutos, meridiano] = hora12
        .match(/(\d+):(\d+) (\w+)/)
        .slice(1);
      hora = parseInt(hora, 10);

      // Convertir "12:00 am" a "00:00" y "12:00 pm" a "12:00"
      if (meridiano.toLowerCase() === "am" && hora === 12) {
        hora = 0; // Medianoche
      } else if (meridiano.toLowerCase() === "pm" && hora < 12) {
        hora += 12; // Convertir a formato 24 horas
      }

      // Asegurar que la hora tenga dos dígitos
      hora = hora.toString().padStart(2, "0");

      // Formar el valor final en formato 24 horas
      let hora24 = `${hora}:${minutos}`;

      const modal = document.querySelector(".modal_update");

      const servicioSelect = modal.querySelector("#servicio");

      // Iterar sobre las opciones del select para encontrar y seleccionar el servicio correcto
      Array.from(servicioSelect.options).forEach(function (option) {
        if (option.text === servicio) {
          servicioSelect.value = option.value;
        }
      });


      //Inyectar el id
        const idInput = modal.querySelector("#id_cita");

        idInput.value = cita;

      // Inyectar la fecha
      const fechaInput = modal.querySelector("#fecha");

      fechaInput.value = fecha;

      // Inyectar la hora

      const horaInput = modal.querySelector("#hora");

      horaInput.value = hora24;

      //Mostrar el modal

      modal.classList.add("modal--show");

      //Cerrar el modal
      const cerrarModal = modal.querySelector(".modal_close");
      cerrarModal.addEventListener("click", function () {
        modal.classList.remove("modal--show");
      });
    }
  });
});
