<?php
require_once 'app/views/template/parteSuperior.php';

    $tarjetasServicios = $this->d['servicios'];
?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Servicios</h1>
</div>

<h2 class="titulo-sesion">
    <ion-icon name="bag-handle"></ion-icon>
    Servicios
</h2>

<section class="nuestros-servicios">


    <div class="contenedor-nuestros-servicios">
        <?php echo $tarjetasServicios?>
    </div>
</section>


<?php
require_once 'app/views/template/parteInferior.php';
?>