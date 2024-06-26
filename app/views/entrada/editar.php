<?php

require_once 'app/views/template/parteSuperiorAdmin.php';


$formularioActualizarProducto = $this->d['formularioActualizarProducto'];
$tabla = $this->d['productos'];
$formularioActualizarProveedor = $this->d['formularioActualizarProveedor'];
?>


<div class="barra-superior-nuevaEntrada">
   <a href="<?php echo APP_URL; ?>entrada" class="btn-regresar">
      <ion-icon name="arrow-back-outline" role="img" class="md hydrated" aria-label="arrow-back-outline"></ion-icon>
   </a>
   <div class="titulo-contenedor">
       <h1 class="titulo-pagina">Editar Entrada</h1>
   </div>
   <div class="espaciador"></div> <!-- Espaciador para empujar el título al centro -->
</div>


<!-- Contenido pagina
 -->

 <div class="tabla">
 <div class="table-header">
                <p>Lista Productos</p>
               
            </div>
    <?php echo $tabla ?>

</div>

<?php
   $posicion = strpos($tabla, '<div class="contenedor-productos">');
   
if (!is_numeric($posicion)):

?>

   <section class="acciones-entrada">
      <form action="<?php echo APP_URL?>entrada/actualizar" class="FormularioAjax">
         <button class="btn-guardar">
            <ion-icon name="save"></ion-icon>
            Actualizar
         </button>
      </form>
            

         <form action="<?php echo APP_URL?>entrada/eliminarProductosAgregados" class="Form FormularioAjax">

         <button type="submit" class="btn-cancelar">
         <ion-icon name="close-circle"></ion-icon>
            Cancelar

         </form>

   </section>

<?php endif;?>

 <!--  Modal Agregar Producto -->


<section class="modal modal_update">
      <?php echo $formularioActualizarProducto;?>
</section>



<section class="modal modal_update_proveedor">
      <?php echo $formularioActualizarProveedor;?>
</section>
 

<!-- Llamamos a el script para la tabla
 -->
 <script src="<?php echo APP_URL?>assets/js/movimientos.js"></script>
<script src="<?php echo APP_URL;?>assets/js/tabla2.js"></script>
<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>