<?php
require_once 'app/views/template/parteSuperiorAdmin.php';
$listaServicios = $this->d['listaServicios'];
?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Servicios Admin</h1>
</div>

<div class="tabla">
    <?php echo $listaServicios ?>
</div>


<section class="modal">
    <div class="modal_container">
        <div class="encabezado">
            <h1>Servicio</h1>
            <a href="#" class="modal_close">X</a>
        </div>

        <img src="<?php echo APP_URL; ?>assets/images/servicio_add.png" class="modal_img" alt="">
        <h2 class="modal_title">Creando Servicio</h2>

        <p class="modal_text">
            Por favor, complete el siguiente formulario para crear un Servicio.
        </p>
        <form action="<?php echo APP_URL?>servicioAdmin/nuevoServicio" method="POST" class="form FormularioAjax">

            <!--  datos de usuario -->
            <div class="datos-basicos">
                <h2 class="titulo-section-form">Datos Basicos</h2>
                <div class="form_group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form_input" required>
                </div>

                <div class="form_group">
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" class="form__input"></textarea>
                </div>


            </div>


            <div class="foto-perfil">

                <h2 class="titulo-section-form">Foto Servicio</h2>
                <p>La foto de Servicio no es obligatoria,si no se provee una el sistema lo hara por usted</p>

                <!-- Selector Imagen Perfil -->

                <div class="container_foto">


                    <input type="file" id="file-input-1" name="imagen">
                    <label for="file-input-1">
                        <ion-icon name="cloud-upload"></ion-icon>
                        Carga una foto
                    </label>

                    <div class="numero-archivos" id="num-of-files-1">No hay archivos Cargados</div>
                    <ul class="lista-archivos" id="files-list-1"></ul>
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
            <h1>Servicio</h1>
            <a href="#" class="modal_close">X</a>
        </div>

        <img src="<?php echo APP_URL; ?>assets/images/servicio_edit.png" class="modal_img" alt="">
        <h2 class="modal_title">Actualizando Servicio</h2>

        <p class="modal_text">
            Modifique los campos que crea necesarios
        </p>
        <form action="<?php echo APP_URL?>servicioAdmin/editarServicio" method="POST" class="form FormularioAjax">

            <!--  datos de usuario -->
            <div class="datos-basicos">
                <h2 class="titulo-section-form">Datos Basicos</h2>
                <div class="form_group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form_input" required>
                </div>

                <div class="form_group">
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" class="form__input"></textarea>
                </div>


            </div>

            <input type="hidden" name="id_servicio" id="id_servicio">

            <div class="foto-perfil">

                <h2 class="titulo-section-form">Foto Servicio</h2>
                <p>Carga una nuevo Foto!</p>

                <!-- Selector Imagen Perfil -->

                <div class="container_foto">


                    <input type="file" id="file-input-2" name="imagen">
                    <label for="file-input-2">
                        <ion-icon name="cloud-upload"></ion-icon>
                        Carga una foto
                    </label>

                    <div class="numero-archivos" id="num-of-files-2">No hay archivos Cargados</div>
                    <ul class="lista-archivos" id="files-list-2"></ul>
                </div>
            </div>



            <button type="submit" class="enviar">
                Actualizar
            </button>
        </form>

    </div>
</section>


     <script src="<?php echo APP_URL;?>assets/js/tabla.js"></script>
    <script src="<?php echo APP_URL?>assets/js/servicioAdmin.js"></script>
<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>