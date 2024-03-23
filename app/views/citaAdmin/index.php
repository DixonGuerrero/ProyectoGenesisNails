<?php
require_once 'app/views/template/parteSuperiorAdmin.php';
    $tabla = $this->d['tablaCitas'];
    $formularioCita = $this->d['formularioCita'];
    $formularioActualizarCita = $this->d['formularioActualizarCita'];

?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Citas Admin</h1>
</div>


<div class="tabla">

    <?php echo $tabla ?>

</div>




<section class="modal">
   <?php echo $formularioCita; ?>
</section>

<section class="modal modal_update">
    <?php echo $formularioActualizarCita?>
</section>


<script src="<?php echo APP_URL?>assets/js/citaAdmin.js"></script>

<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>