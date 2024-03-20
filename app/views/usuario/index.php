<?php
require_once 'app/views/template/parteSuperiorAdmin.php';

$tabla = $this->d['tablaUsuarios'];
?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Usuarios</h1>
</div>

<div class="tabla">

    <?php echo $tabla ?>

</div>

<section class="modal ">
    <div class="modal_container">
        <div class="encabezado">
            <h1>Usuario</h1>
            <a href="#" class="modal_close">X</a>
        </div>

        <img src="<?php echo APP_URL; ?>assets/images/user_add.png" class="modal_img" alt="">
        <h2 class="modal_title">Creando Usuario</h2>

        <p class="modal_text">
            Por favor, complete el siguiente formulario para crear un usuario.
        </p>
        <form action="" method="POST" class="form">

            <!--  datos de usuario -->
            <div class="datos-basicos">
            <h2 class="titulo-section-form">Datos Basicos</h2>
            <div class="form_group">
                <label for="nombres">Nombres</label>
                <input type="text" name="nombres" id="nombres" class="form__input" required>
            </div>

            <div class="form_group">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" id="apellidos" class="form__input">
            </div>
            <div class="form_group">
                <label for="apellidos">Email</label>
                <input type="text" name="apellidos" id="apellidos" class="form__input" required>
            </div>

            <div class="form_group">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" id="telefono" class="form__input">
            </div>

            <div class="form_group">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" class="form__input" required>
            </div>
            </div>

            <div class="passwords">
            <h2 class="titulo-section-form">Password</h2>
            <!-- password -->
            <div class="form_group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form__input" required>
            </div>

            <div class="form_group">
                <label for="password">Confirmar Contraseña</label>
                <input type="password" name="password" id="password" class="form__input" required>

            </div>
            </div>

            <div class="form_group">
                <label for="rol">Rol</label>
                <select name="rol" id="rol" class="form_input">
                    <option value="cliente">Cliente</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>





            <div class="foto-perfil">

                <h2 class="titulo-section-form">Foto Perfil</h2>
                <p>La foto de Perfil no es obligatoria,si no se provee una el sistema lo hara por usted</p>

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
require_once 'app/views/template/parteInferiorAdmin.php'
?>