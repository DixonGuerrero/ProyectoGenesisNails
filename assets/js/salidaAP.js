document.addEventListener("DOMContentLoaded", function () {
  const contenedorTabla = document.querySelector("#tablaDatos");

  contenedorTabla.addEventListener("click", function (event) {
    if (event.target.closest(".boton-editar")) {
      event.preventDefault();

      const fila = event.target.closest("tr");

      const id = fila.cells[0].textContent;

    
      const nombre = fila.cells[2].textContent;
      const cantidad = fila.cells[3].textContent;

      const modal = document.querySelector(".modal_update");

      const productoSelect = modal.querySelector("#producto");

      Array.from(productoSelect.options).forEach(function (option) {
        if (option.text === nombre) {
          productoSelect.value = option.value;
        }
      });

      const cantidadInput = modal.querySelector("#cantidad");
      cantidadInput.value = cantidad;

      const idInput = modal.querySelector("#id_producto");
      idInput.value = id;

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
