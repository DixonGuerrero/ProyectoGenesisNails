document.addEventListener("DOMContentLoaded", function () {
   const tarjeta_producto = document.querySelectorAll(".tarjeta-categoria");
 
   tarjeta_producto.forEach(function (tarjeta) {
     const botonEditar = tarjeta.querySelector(".btn-editar");
 
     if (botonEditar) {
       botonEditar.addEventListener("click", function (e) {
         e.preventDefault();
 
         

         //Obtener el id_marca del input oculto
         const id_categoria = tarjeta.querySelector("input[name='id_categoria']").value.trim();

         //Obtener el nombre de la marca del div nombre-marca
         const nombre_categoria = tarjeta.querySelector(".nombre-categoria").textContent.trim();

         //Seleccionar el modal
         const modal = document.querySelector(".modal_update");

         //Asignar el valor del nombre de la marca al input del modal
         const nombre_categoriaInput = modal.querySelector("#nombre");
         nombre_categoriaInput.value = nombre_categoria;

         //Asignar el valor del id_marca al input del modal
         const id_categoriaInput = modal.querySelector("#id_categoria");
         id_categoriaInput.value = id_categoria;

      
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
 