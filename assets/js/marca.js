document.addEventListener("DOMContentLoaded", function () {
   const tarjeta_producto = document.querySelectorAll(".tarjeta-marca");
 
   tarjeta_producto.forEach(function (tarjeta) {
     const botonEditar = tarjeta.querySelector(".btn-editar");
 
     if (botonEditar) {
       botonEditar.addEventListener("click", function (e) {
         e.preventDefault();
 
         

         //Obtener el id_marca del input oculto
         const id_marca = tarjeta.querySelector("input[name='id_marca']").value.trim();

         //Obtener el nombre de la marca del div nombre-marca
         const nombre_marca = tarjeta.querySelector(".nombre-marca").textContent.trim();

         //Seleccionar el modal
         const modal = document.querySelector(".modal_update");

         //Asignar el valor del nombre de la marca al input del modal
         const nombre_marcaInput = modal.querySelector("#nombre");
         nombre_marcaInput.value = nombre_marca;

         //Asignar el valor del id_marca al input del modal
         const id_marcaInput = modal.querySelector("#id_marca");
         id_marcaInput.value = id_marca;

      
         // Mostrar el modal
         modal.classList.add("modal--show");

        // Cerrar el modal
         const cerrarModal = modal.querySelector(".modal_close");
         cerrarModal.addEventListener("click", function () {
           modal.classList.remove("modal--show"); 
         });
       });
     }
   });
 });
 