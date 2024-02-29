<?php
require_once 'app/views/template/parteSuperiorAdmin.php';
?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Productos</h1>
</div>

<div class="titulo citas">
    <h2>Productos</h2>
    <a class="boton" href="#">
        <ion-icon name="add-outline"></ion-icon>
        <span>Nuevo</span>
    </a>
</div>

<div class="tarjetas productos">

    <div class="producto first">
        <img class="imagen" src="<?php echo APP_URL; ?>assets/images/producto/default.png" alt="">
        <div class="nombre">
            <span class="nombre">Lima Uñas</span>
        </div>
        <div class="precio">
            <span class="precio">Precio: $2500</span>
        </div>
        <div class="acciones">
            <a class="editar" href="#">
                <ion-icon name="create-outline"></ion-icon>
            </a>
            <a class="eliminar" href="#">
                <ion-icon name="trash-outline"></ion-icon>
            </a>
        </div>
    </div>


</div>


<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>