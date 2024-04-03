<?php 
require_once 'app/views/template/parteSuperiorAdmin.php';

    $marcas = $this->d['marcas'];

?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Marcas</h1>
</div>


<section class="header-marcas">

        <div class="barra-busqueda">
            <input type="text" class="busqueda" placeholder="Buscar">
            <button class="btn-buscar"><ion-icon name="search-circle"></ion-icon></button>
        </div>
            <button id="add-new" class="btn-agregar-marca">
            <ion-icon name="add-circle"></ion-icon>    
            Nueva
            </button>

</section>

<section class="contenedor-marcas">

    <?php echo $marcas;?>
    
</section>


<section class="modal ">
    <div class="modal_container">
        <div class="encabezado">
            <h1>Marca</h1>
            <a href="#" class="modal_close">X</a>
        </div>

        <img src="<?php echo APP_URL; ?>assets/images/marca_add.png" class="modal_img" alt="">
        <h2 class="modal_title">Creando Marca</h2>

        <p class="modal_text">
            Por favor, complete el siguiente formulario para crear una marca.
        </p>
        <form action="<?php echo APP_URL; ?>/marca/guardar" method="POST" class="form FormularioAjax">

            <!--  datos de usuario -->
            <div class="datos-basicos">
                <h2 class="titulo-section-form">Datos Basicos</h2>
                <div class="form_group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form__input" required>
                </div>

            </div>
            <button type="submit" class="enviar">
                Registrar
            </button>
        </form>

    </div>
</section>

<section class="modal modal_update">
    <div class="modal_container">
        <div class="encabezado">
            <h1>Marca</h1>
            <a href="#" class="modal_close">X</a>
        </div>

        <img src="<?php echo APP_URL; ?>assets/images/marca_edit.png" class="modal_img" alt="">
        <h2 class="modal_title">Actualizando Marca</h2>

        <p class="modal_text">
            Modifique los datos de la marca que desea actualizar.
        </p>
        <form action="<?php echo APP_URL; ?>marca/actualizar" method="POST" class="form FormularioAjax">

            <!--  datos de usuario -->
            <div class="datos-basicos">
                <h2 class="titulo-section-form">Datos Basicos</h2>
                <div class="form_group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form__input" required>
                </div>
            </div>

            <input type="hidden" name="id_marca" id="id_marca" value="">

            <button type="submit" class="enviar">
                Actualizar
            </button>
        </form>

    </div>
</section>

<!-- Agregamos el script donde hacemos la logica para editar los datos de la marca:
 --> 
<script src="<?php echo APP_URL; ?>assets/js/marca.js"></script>   
<?php 
require_once 'app/views/template/parteInferiorAdmin.php';
?>