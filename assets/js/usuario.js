document.addEventListener("DOMContentLoaded", function () {
    const contenedorTabla = document.querySelector("#tablaDatos");
  
    contenedorTabla.addEventListener("click", function (event) {
      if (event.target.closest(".boton-editar")) {
        event.preventDefault();
  
        const fila = event.target.closest("tr");
  
        const id_usuario = fila.cells[0].textContent;
        const nombre = fila.cells[2].textContent;
        const apellido = fila.cells[3].textContent;
        const correo = fila.cells[4].textContent;
        const telefono = fila.cells[5].textContent;
        const rol = fila.cells[6].textContent;
        //Transformar la primera letra del rol a mayúscula
        const rolMayuscula = rol.charAt(0).toUpperCase() + rol.slice(1);

        const usuario = fila.cells[7].textContent;

        const modal = document.querySelector(".modal_update");

        const nombreInput = modal.querySelector("#nombres");
        nombreInput.value = nombre;

        const apellidoInput = modal.querySelector("#apellidos");
        apellidoInput.value = apellido;

        const correoInput = modal.querySelector("#email");
        correoInput.value = correo;

        const telefonoInput = modal.querySelector("#telefono");
        telefonoInput.value = telefono;

        const usuarioInput = modal.querySelector("#usuario");
        usuarioInput.value = usuario;


        const rolSelect = modal.querySelector("#rol");

        // Iterar sobre las opciones del select para encontrar y seleccionar el servicio correcto
        Array.from(rolSelect.options).forEach(function (option) {
          if (option.text == rolMayuscula) {
            rolSelect.value = option.value;

          }
        });


        //Vamos a inyectar el id
        const idInput = modal.querySelector("#id_usuario");
        idInput.value = id_usuario;


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
  