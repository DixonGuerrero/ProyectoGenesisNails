document.addEventListener("DOMContentLoaded", function () {
    const contenedorTabla = document.querySelector("#tablaDatos");
  
    contenedorTabla.addEventListener("click", function (event) {
      if (event.target.closest(".boton-editar")) {
        event.preventDefault();
  
        const fila = event.target.closest("tr");
  
        const proveedor = fila.cells[0].textContent;
        const nombre = fila.cells[1].textContent;
        const telefono = fila.cells[2].textContent;
        const email = fila.cells[3].textContent;
        const nit = fila.cells[4].textContent;
        const direccion = fila.cells[5].textContent;
  
        const modal = document.querySelector(".modal_update");
  
        const idInput = modal.querySelector("#id_proveedor");
        idInput.value = proveedor;
  
        const nombreInput = modal.querySelector("#nombre");
        nombreInput.value = nombre;
  
        const telefonoInput = modal.querySelector("#telefono");
        telefonoInput.value = telefono;
  
        const emailInput = modal.querySelector("#email");
        emailInput.value = email;
  
        const nitInput = modal.querySelector("#nit");
        nitInput.value = nit;
  
        const direccionInput = modal.querySelector("#direccion");
        direccionInput.value = direccion;
  
        modal.classList.add("modal--show");
  
        //Cerrar el modal
        const cerrarModal = modal.querySelector(".modal_close");
        cerrarModal.addEventListener("click", function () {
          modal.classList.remove("modal--show");
        });
      }
    });
  });
  