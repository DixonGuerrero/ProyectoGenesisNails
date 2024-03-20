<?php
require_once 'app/views/template/parteSuperiorAdmin.php';

    $productos = $this->d['productos'];
?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Productos</h1>
</div>

<div class="header-productos-main">
    <p>Productos</p>
    <div>
        <button class="add-new">
            <ion-icon name="add-circle"></ion-icon>
            Nuevo
        </button>
    </div>
</div>

<div class="tarjetas productos">

    <?php echo $productos;?>


</div>


<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>