document.addEventListener("DOMContentLoaded", function () {
   const contenedorTabla = document.querySelector("#tablaDatos");
 
   contenedorTabla.addEventListener("click", function (event) {
     if (event.target.closest(".boton-editar")) {
       event.preventDefault();
 
       const fila = event.target.closest("tr");
 
       const servicio = fila.cells[0].textContent;
       const nombre = fila.cells[2].textContent;
       const descripcion = fila.cells[3].textContent;
 
       const modal = document.querySelector(".modal_update");
 
       const idInput = modal.querySelector("#id_servicio");
       idInput.value = servicio;
 
       const nombreInput = modal.querySelector("#nombre");
       nombreInput.value = nombre;
 
       const descripcionInput = modal.querySelector("#descripcion");
       descripcionInput.value = descripcion;
 
 
       modal.classList.add("modal--show");
 
       //Cerrar el modal
       const cerrarModal = modal.querySelector(".modal_close");
       cerrarModal.addEventListener("click", function () {
         modal.classList.remove("modal--show");
       });
     }
   });
 });
 