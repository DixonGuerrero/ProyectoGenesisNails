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
        <form action="<?php echo APP_URL;?>/usuario/guardar" method="POST" class="form FormularioAjax">

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
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form__input" required>
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
                <label for="clave1">Contraseña</label>
                <input type="password" name="clave1" id="clave1" class="form__input" required>
            </div>

            <div class="form_group">
                <label for="clave2">Confirmar Contraseña</label>
                <input type="password" name="clave2" id="clave2" class="form__input" required>

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


                    <input type="file" id="file-input" name="imagen">
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

<section class="modal modal_update ">
    <div class="modal_container">
        <div class="encabezado">
            <h1>Usuario</h1>
            <a href="#" class="modal_close">X</a>
        </div>

        <img src="<?php echo APP_URL; ?>assets/images/user_edit.png" class="modal_img" alt="">
        <h2 class="modal_title">Actualizando Usuario</h2>

        <p class="modal_text">
            Modifique los campos que crea necesarios
        </p>
        <form action="<?php echo APP_URL;?>usuario/actualizarUsuarioAdmin" method="POST" class="form FormularioAjax">

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
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form__input" required>
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
                <label for="clave1">Contraseña Actual</label>
                <input type="password" name="clave0" id="password" class="form__input" >
            </div>
            <div class="form_group">
                <label for="clave1">Contraseña nueva</label>
                <input type="password" name="clave1" id="password_new" class="form__input" >
            </div>

            <div class="form_group">
                <label for="clave2">Confirmar Contraseña</label>
                <input type="password" name="clave2" id="password_new_confir" class="form__input" >

            </div>
            </div>

            <div class="form_group">
                <label for="rol">Rol</label>
                <select name="rol" id="rol" class="form_input">
                    <option value="cliente">Cliente</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>



            <input type="hidden" name="id_usuario" id="id_usuario" value="">

            <div class="foto-perfil">

                <h2 class="titulo-section-form">Foto Perfil</h2>
                <p>Cambia tu foto de perfil</p>

                <!-- Selector Imagen Perfil -->

                <div class="container_foto">


                    <input type="file" id="file-input" name="imagen">
                    <label for="file-input">
                        <ion-icon name="cloud-upload"></ion-icon>
                        Carga una foto
                    </label>

                    <div id="num-of-files">No hay archivos Cargados</div>
                    <ul id="files-list"></ul>
                </div>
            </div>



            <button type="submit" class="enviar">
                Actualizar
            </button>
        </form>

    </div>
</section>

<script src="<?php APP_URL?>assets/js/usuario.js"></script>

<?php
require_once 'app/views/template/parteInferiorAdmin.php'
?>