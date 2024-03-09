<?php 
    require_once 'app/views/template/parteSuperiorAdmin.php';
    $listaProveedores = $this->d['listaProveedores'];
?>

<div class="barra-superior">
        <h1 class="titulo-pagina">Proveedores</h1>  
    </div>

    <div class="tabla">
        <?php echo $listaProveedores?>
    </div>

<?php 
    require_once 'app/views/template/parteInferiorAdmin.php';
?>