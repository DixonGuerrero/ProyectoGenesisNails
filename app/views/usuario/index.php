<?php
require_once 'app/views/template/parteSuperiorAdmin.php';

$tabla = $this->d['tablaUsuarios'];
?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Usuarios</h1>
</div>

<div class="tabla">
    
        <?php echo $tabla?>
 
</div>

<?php
require_once 'app/views/template/parteInferiorAdmin.php'
?>