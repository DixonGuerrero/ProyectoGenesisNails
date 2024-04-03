<!-- Lamamos a los archivos que necesitamos
 -->
<?php
require_once 'app/views/template/parteSuperiorAdmin.php';

$categorias  = $this->d['categorias'];
?>
<div class="barra-superior">
    <h1 class="titulo-pagina">Categorias</h1>
</div>

<section class="header-categorias">

    <div class="barra-busqueda">
        <input type="text" class="busqueda" placeholder="Buscar">
        <button class="btn-buscar"><ion-icon name="search-circle"></ion-icon></button>
    </div>
    <button id="add-new" class="btn-agregar">
        <ion-icon name="add-circle"></ion-icon>
        Nueva
    </button>

</section>

<section class="contenedor-categorias">
    <?php echo $categorias;?>
</section>

<section class="modal ">
    <div class="modal_container">
        <div class="encabezado">
            <h1>Categoria</h1>
            <a href="#" class="modal_close">X</a>
        </div>

        <img src="<?php echo APP_URL; ?>assets/images/categoria_add.png" class="modal_img" alt="">
        <h2 class="modal_title">Creando Categoria</h2>

        <p class="modal_text">
            Por favor, complete el siguiente formulario para crear una marca.
        </p>
        <form action="<?php echo APP_URL; ?>categoria/guardar" method="POST" class="form FormularioAjax">

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
            <h1>Categoria</h1>
            <a href="#" class="modal_close">X</a>
        </div>

        <img src="<?php echo APP_URL; ?>assets/images/categoria_edit.png" class="modal_img" alt="">
        <h2 class="modal_title">Actualizando Categoria</h2>

        <p class="modal_text">
            Modifique los datos de la marca que desea actualizar.
        </p>
        <form action="<?php echo APP_URL; ?>categoria/actualizar" method="POST" class="form FormularioAjax">

            <!--  datos de usuario -->
            <div class="datos-basicos">
                <h2 class="titulo-section-form">Datos Basicos</h2>
                <div class="form_group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form__input" required>
                </div>
            </div>

            <input type="hidden" name="id_categoria" id="id_categoria" value="">

            <button type="submit" class="enviar">
                Actualizar
            </button>
        </form>

    </div>
</section



<!-- Agregamos el JS donde tenemos la logica
 -->
<script src="<?php echo APP_URL?>assets/js/categoria.js"></script>
<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>