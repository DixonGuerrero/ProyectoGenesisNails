document.addEventListener("DOMContentLoaded", function () {
  const contenedorTabla = document.querySelector("#tablaDatos");

  contenedorTabla.addEventListener("click", function (event) {
    if (event.target.closest(".boton-editar")) {
      event.preventDefault();

      const fila = event.target.closest("tr");

      const cita = fila.cells[0].textContent;
      const servicio = fila.cells[2].textContent;

      const fecha = fila.cells[4].textContent;

      const hora12 = fila.cells[5].textContent;

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

      Array.from(servicioSelect.options).forEach(function (option) {
        if (option.text === servicio) {
          servicioSelect.value = option.value;
        }
      });

      const idInput = modal.querySelector("#id_cita");

      idInput.value = cita;

      const fechaInput = modal.querySelector("#fecha");

      fechaInput.value = fecha;

      const horaInput = modal.querySelector("#hora");

      horaInput.value = hora24;

      modal.classList.add("modal--show");

      //Cerrar el modal
      const cerrarModal = modal.querySelector(".modal_close");
      cerrarModal.addEventListener("click", function () {
        modal.classList.remove("modal--show");
      });
    }
  });
});
