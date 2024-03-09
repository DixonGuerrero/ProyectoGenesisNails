<?php
require_once 'app/views/template/parteSuperiorAdmin.php';
?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Configuracion</h1>
</div>

<div class="configuraciones">
    <div class="foto-perfil">
        <img src="<?php echo APP_URL; ?>assets/images/usuario/<?php echo $usuario->getImagen(); ?>" alt="" />
        <a class="cambiar-foto" href="#">
            <ion-icon name="camera-reverse-outline"></ion-icon> Cambiar foto
        </a>
    </div>

    <div class="sesion-sesion">

        <div class="titulo-cerrar-sesion">
            <h2>Sesion <ion-icon name="finger-print-outline"></ion-icon></h2>

            <div class="sesion">
                <!-----------------Formulario para cerrar sesion----------------->
                <form class="FormularioAjax" action="<?php echo APP_URL; ?>login/cerrarSesion" method="POST">
                    <button type="submit" class="cerrar-sesion">
                        <ion-icon name="exit-outline"></ion-icon>Cerrar Session
                    </button>

                </form>
            </div>
        </div>
    </div>

    <div class="datos-basicos">
        <div class="formulario-datos-basicos">
            <div class="titulo-sesion-confi">
                <h2>Informacion Personal <ion-icon name="document-text-outline"></ion-icon></h2>
            </div>

            <form class="FormularioAjax" action="<?php echo APP_URL; ?>usuario/actualizarUsuario" method="POST">
                <div class="grupo">
                    <label for="nombre">Nombres</label>
                    <input type="text" id="nombres" name="nombres" value="<?php echo $usuario->getNombres(); ?>
                ">
                </div>
                <div class="grupo">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" value="<?php echo $usuario->getApellidos(); ?>
                ">
                </div>
                <div class="grupo">
                    <label for="telefono">Telefono</label>
                    <input type="text" id="telefono" name="telefono" value="<?php echo $usuario->getTelefono(); ?>
                ">
                </div>
                <div class="grupo">
                    <label for="correo">Email</label>
                    <input type="email" id="correo" name="correo" value="<?php echo $usuario->getEmail(); ?>
                ">
                </div>
                <div class="grupo">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" value="<?php echo $usuario->getUsuario(); ?>
                ">
                </div>

                <button type="submit" class="submit">
                    <ion-icon name="save-outline"></ion-icon>Guardar
                </button>

            </form>

        </div>
    </div>


    <div class="contrasenia">
        <div class="cambiar-contrasenia">
            <div class="titulo-sesion-confi">
                <h2>Cambiar Contraseña <ion-icon name="document-lock-outline"></ion-icon></h2>
            </div>

            <form action="">
                <div class="grupo">
                    <label for="nombre">Contraseña Actual</label>
                    <input type="password" id="password" name="password" >
                </div>
                <div class="grupo">
                    <label for="nombre">Nueva Contraseña</label>
                    <input type="password" id="password_new" name="password_new">
                </div>
                <div class="grupo">
                    <label for="nombre">Confirmar Contraseña</label>
                    <input type="password" id="password_new" name="password_new">
                </div>
                <a class="submit">
                    <ion-icon name="save-outline"></ion-icon>Guardar
                </a>
            </form>
        </div>
    </div>







</div>

<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>