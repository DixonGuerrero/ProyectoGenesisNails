<?php
require_once 'app/views/template/parteSuperiorAdmin.php';
?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Configuracion</h1>
</div>

<div class="configuraciones">
    <div class="foto-perfil">
        <img src="<?php echo APP_URL; ?>assets/images/usuario/<?php echo $usuario->getImagen(); ?>" alt="" />
        <a class="actualizar cambiar-foto " >
            <ion-icon name="camera-reverse-outline"></ion-icon> Cambiar foto
        </a>
    </div>

    <div class="sesion-sesion">

        <div class="titulo-cerrar-sesion">
            <h2>Sesion <ion-icon name="finger-print-outline"></ion-icon></h2>

            <div class="sesion">
                <!-----------------Formulario para cerrar sesion----------------->
                <form class="FormularioAjax 1" action="<?php echo APP_URL; ?>login/cerrarSesion" method="POST">
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

            <form class="FormularioAjax 2" action="<?php echo APP_URL; ?>usuario/actualizarUsuario" method="POST">
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

            <form action="<?php echo APP_URL;?>usuario/actualizarPassword" class="FormularioAjax" method="POST"> 
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
                <button type="submit" class="submit">
                    <ion-icon name="save-outline"></ion-icon>Guardar
                </button>
            </form>
        </div>
    </div>







</div>

<section class="modal modal_update">
    <div class="modal_container">
        <div class="encabezado">
            <h1>Usuario</h1>
            <a href="#" class="modal_close">X</a>
        </div>

        <img src="<?php echo APP_URL; ?>assets/images/usuario/<?php echo $usuario->getImagen(); ?>" class="modal_img " alt="">


        <h2 class="modal_title">Actualizar Foto</h2>

 
        <form action="<?php echo APP_URL;?>/usuario/actualizarFoto" method="POST" class="form FormularioAjax">

        
            <div class="foto-perfil">

               
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
                Actualizar
            </button>
        </form>

    </div>
</section>

<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>