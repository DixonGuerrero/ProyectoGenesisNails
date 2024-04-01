<?php
require_once 'app/views/template/parteSuperiorAdmin.php';
$entradas = $this->d['entradas'];
?>


<div class="barra-superior">
    <h1 class="titulo-pagina">Entradas</h1>
</div>

<section class="header-entrada">

        <div class="barra-busqueda">
            <input type="text" class="busqueda" placeholder="Buscar">
            <button class="btn-buscar"><ion-icon name="search-circle"></ion-icon></button>
        </div>
            <button id="add-new" class="btn-agregar-entrada">
            <ion-icon name="add-circle"></ion-icon>    
            Nueva
            </button>

</section>


<section class="contenedor-entradas">
    <?php echo $entradas?>
</section>


<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>