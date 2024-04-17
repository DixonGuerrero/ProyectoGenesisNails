<?php

require_once 'app/views/template/parteSuperiorAdmin.php';

$formularioAgregarProducto = $this->d['formularioProducto'];
$tabla = $this->d['productos'];
$formularioActualizarProducto = $this->d['formularioActualizarProducto'];
$formularioProveedor = $this->d['formularioProveedor'];
$existeProveedor = $this->d['existeProveedor'];
$formularioActualizarProveedor = $this->d['formularioActualizarProveedor'];
?>


<div class="barra-superior-nuevaEntrada">
   <a href="<?php echo APP_URL; ?>entrada" class="btn-regresar">
      <ion-icon name="arrow-back-outline" role="img" class="md hydrated" aria-label="arrow-back-outline"></ion-icon>
   </a>
   <div class="titulo-contenedor">
       <h1 class="titulo-pagina">Nueva Entrada</h1>
   </div>
   <div class="espaciador"></div> <!-- Espaciador para empujar el título al centro -->
</div>


<!-- Contenido pagina
 -->

 <div class="tabla">
 <div class="table-header">
                <p>Lista Productos</p>
               <?php if (!$existeProveedor):?>
                  <div>
                     <button class="add-new-proveedor btn-agregar">
                           <ion-icon name="add-circle"></ion-icon>
                           Proveedor
                     </button>
                  </div>

                  <?php endif;?>
                <div>
                    <button class="add-new btn-agregar">
                        <ion-icon name="add-circle"></ion-icon>
                        Nuevo
                    </button>
                </div>
            </div>
    <?php echo $tabla ?>

</div>

<?php
   $posicion = strpos($tabla, '<div class="contenedor-productos">');
   
if (!is_numeric($posicion)):

?>

   <section class="acciones-entrada">
      <form action="<?php echo APP_URL?>entrada/guardar" class="FormularioAjax">
         <button class="btn-guardar">
            <ion-icon name="save"></ion-icon>
            Guardar
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
<section class="modal">
      <?php echo $formularioAgregarProducto;?>
</section>

<section class="modal modal_update">
      <?php echo $formularioActualizarProducto;?>
</section>

<section class="modal modal_proveedor">
      <?php echo $formularioProveedor;?>
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