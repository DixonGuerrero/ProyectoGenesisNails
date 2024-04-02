<?php

require_once 'app/views/template/parteSuperiorAdmin.php';
$salidas =  $this->d['salidas'];
?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Salidas</h1>
</div>

<section class="header-salida">

    <div class="barra-busqueda">
        <input type="text" class="busqueda" placeholder="Buscar">
        <button class="btn-buscar"><ion-icon name="search-circle" role="img" class="md hydrated"></ion-icon></button>
    </div>
    <a href="<?php echo APP_URL; ?>salida/nuevaSalida" id="" class="btn-agregar-salida">
        <ion-icon name="add-circle" role="img" class="md hydrated"></ion-icon>
        Nueva
    </a>


</section>

<section class="contenedor-salidas">
    <?php echo $salidas; ?>
</section>


<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>