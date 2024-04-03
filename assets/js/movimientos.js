document.addEventListener("DOMContentLoaded", function () {
  const contenedorTabla = document.querySelector("#tablaDatos");
  const contenedorProveedor = document.querySelector(".proveedor");

  contenedorTabla.addEventListener("click", function (event) {
    if (event.target.closest(".boton-editar")) {
      event.preventDefault();

      const fila = event.target.closest("tr");

      const id = fila.cells[0].textContent;

    
      const nombre = fila.cells[2].textContent;
      const cantidad = fila.cells[3].textContent;
      let precio = null;
// Obtener el contenido de la celda como texto
let contenidoTexto = fila.cells[4].textContent.trim();

// Primero, asegurarse de que el contenido no esté vacío
if (contenidoTexto !== "") {
    // Convertir el contenido de la celda a número
    let contenidoCelda = Number(contenidoTexto);

    // Validar que el contenido convertido sea un número
    if (!isNaN(contenidoCelda)) {
        precio = contenidoCelda;
    }
}

      

      console.log('Precio::',fila.cells[4].textContent);
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

      if(precio !== null){
        const precioInput = modal.querySelector("#precio");
        precioInput.value = precio;
      }

      //Mostrar el modal
      modal.classList.add("modal--show");

      //Cerrar el modal
      const cerrarModal = modal.querySelector(".modal_close");
      cerrarModal.addEventListener("click", function () {
        modal.classList.remove("modal--show");
      });
    }
  });

  contenedorProveedor.addEventListener("click", function (event) {
    if (event.target.closest(".boton-editar")) {
      event.preventDefault();

      const id_proveedor = contenedorProveedor.querySelector("input[name='id_proveedor']").value;
      const nombreProveedor = contenedorProveedor.querySelector("h3").textContent;

      const modal = document.querySelector(".modal_update_proveedor");

      const proveedorSelect = modal.querySelector("#proveedor");

      Array.from(proveedorSelect.options).forEach(function (option) {
        if (option.text === nombreProveedor) {
          proveedorSelect.value = option.value;
        }
      });

      // Aquí puedes continuar con la lógica para mostrar y manejar el modal
      // Suponiendo que ya tienes una referencia al modal que quieres mostrar
      modal.classList.add("modal--show");

      //Cerrar el modal
      const cerrarModal = modal.querySelector(".modal_close");
      cerrarModal.addEventListener("click", function () {
        modal.classList.remove("modal--show");
      });
    }
});


});
