<?php 
    require_once 'app/views/template/parteSuperiorAdmin.php';
    $listaServicios = $this->d['listaServicios'];
?>

<div class="barra-superior">
        <h1 class="titulo-pagina">Servicios Admin</h1>  
    </div>

    <div class="tabla">
        <?php echo $listaServicios?>
    </div>

<?php 
    require_once 'app/views/template/parteInferiorAdmin.php';
?>