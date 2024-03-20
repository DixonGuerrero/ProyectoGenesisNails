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
        <form action="" method="POST" class="form">

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


                    <input type="file" id="file-input">
                    <label for="file-input">
                        <ion-icon name="cloud-upload"></ion-icon>
                        Carga una foto
                    </label>

                    <div id="num-of-files">No hay archivos Cargados</div>
                    <ul id="files-list"></ul>
                </div>
            </div>



            <button type="submit" class="enviar">
                Registrar
            </button>
        </form>

    </div>
</section>
<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>