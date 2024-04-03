document.addEventListener("DOMContentLoaded", function () {
   const tarjeta_producto = document.querySelectorAll(".producto");
 
   tarjeta_producto.forEach(function (tarjeta) {
     const botonEditar = tarjeta.querySelector(".boton-editar");
 
     if (botonEditar) {
       botonEditar.addEventListener("click", function (e) {
         e.preventDefault();
 
         const nombre = tarjeta.querySelector(".nombre span").textContent.trim();
         // Asegurándose de limpiar y convertir el precio a un valor numérico válido
         const precio = parseFloat(tarjeta.querySelector(".precio span").textContent.trim().replace(/[^\d.-]/g, ''));
         // Asegurándose de limpiar y convertir el stock a un valor numérico válido
         const stock = parseInt(tarjeta.querySelector(".stock span").textContent.trim(), 10);
         const id_producto = tarjeta.querySelector("input[name='id_producto']").value.trim();
         const codigo = tarjeta.querySelector("input[name='codigo']").value.trim();
         // Aquí es donde se asignan los valores a los select, asegúrate de que los valores coincidan exactamente con los value de las opciones
         const proveedor = tarjeta.querySelector("input[name='proveedor']").value.trim();
         const marca = tarjeta.querySelector("input[name='marca']").value.trim();
         const categoria = tarjeta.querySelector("input[name='categoria']").value.trim();

         console.log("proveedor", proveedor);
         console.log("marca", marca);
         console.log("categoria", categoria);
 
         const formulario = document.querySelector("#formulario-actualizar-producto");
 
         formulario.querySelector("#id_producto").value = id_producto;
         formulario.querySelector("#codigo").value = codigo;
         formulario.querySelector("#nombre").value = nombre;
         formulario.querySelector("#precio").value = precio;
         formulario.querySelector("#stock").value = stock;

         const marcaOptions = formulario.querySelector("#marca");

         Array.from(marcaOptions.options).forEach(function (option) {
           if (option.text === marca) {
             marcaOptions.value = option.value;
 
           }
         });

         const categoriaOptions = formulario.querySelector("#categoria");

         Array.from(categoriaOptions.options).forEach(function (option) {
             if (option.text === categoria) {
                categoriaOptions.value = option.value;
    
             }
          });

         const proveedorOptions = formulario.querySelector("#proveedor");

         Array.from(proveedorOptions.options).forEach(function (option) {
               if (option.text === proveedor) {
                  proveedorOptions.value = option.value;
      
               }
            });
 
         // Mostrar el modal
         const modal = document.querySelector(".modal_update");
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
 