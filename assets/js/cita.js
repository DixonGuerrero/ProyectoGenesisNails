document.addEventListener("DOMContentLoaded", function () {
  const tarjetas_citas = document.querySelectorAll(".tarjeta-cita");

  console.log("tarjetas_citas", tarjetas_citas);
  // Itera sobre cada tarjeta de cita
  tarjetas_citas.forEach(function (tarjeta) {
    // Busca el botón de editar dentro de la tarjeta
    const botonEditar = tarjeta.querySelector(".boton-editar");

    if (botonEditar) {
      botonEditar.addEventListener("click", function (e) {
        e.preventDefault();
        

        // Extraer el servicio
        const servicio = tarjeta.querySelector(".servicio").innerText;
        console.log("servicio", servicio);

        const fecha = tarjeta.querySelector(".fecha").innerText.split(': ')[1].trim(); // Si el texto es "Fecha: 2024-03-22"
        const horaCompleta = tarjeta.querySelector(".hora").value; // "17:00:00.000Z"
        const hora = horaCompleta.substring(0, 5); 

        console.log("hora", hora);
        console.log("horaCompleta", horaCompleta);
        console.log("fecha", fecha);

        // Extraer el id
        const id = tarjeta.querySelector(".id_cita").value;


        /*                 Vamos a inyectar los valores al formulario
         */

        const formulario = document.querySelector(".modal_update");


        const servicioSelect = formulario.querySelector("#servicio");

        // Iterar sobre las opciones del select para encontrar y seleccionar el servicio correcto
        Array.from(servicioSelect.options).forEach(function (option) {
          if (option.text === servicio) {
            servicioSelect.value = option.value;

          }
        });

        // Inyectar la fecha
        const fechaInput = formulario.querySelector("#fecha");

        fechaInput.value = fecha;

        // Inyectar la hora

        const horaInput = formulario.querySelector("#hora"); 

        horaInput.value = hora;

        //Vamos a inyectar el id
        const idInput = formulario.querySelector("#id_cita");

        idInput.value = id;

        //Mostrar el modal
        const modal = document.querySelector(".modal_update");

        modal.classList.add("modal--show");

        //Cerrar el modal
        const cerrarModal = modal.querySelector(".modal_close");
        cerrarModal.addEventListener("click", function () {
          modal.classList.remove("modal--show");
          
        });
      });
    }
  });
});
