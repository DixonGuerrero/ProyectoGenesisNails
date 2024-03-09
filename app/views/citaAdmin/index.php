<?php
require_once 'app/views/template/parteSuperiorAdmin.php';
    $tabla = $this->d['tablaCitas'];

?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Citas Admin</h1>
</div>


<div class="tabla">

    <?php echo $tabla ?>

</div>

<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>