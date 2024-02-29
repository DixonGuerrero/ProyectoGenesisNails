<?php 
    require_once 'app/views/template/parteSuperiorAdmin.php';
?>

<div class="barra-superior">
        <h1 class="titulo-pagina">Configuracion</h1>  
    </div>

    <div class="configuraciones">
        <div class="foto-perfil">
            <img src="<?php echo APP_URL?>assets/images/usuario/default.jpg" alt="">
            <a class="cambiar-foto" href="#">
            <ion-icon name="camera-reverse-outline"></ion-icon> Cambiar foto
            </a>
        </div>

        <div class="sesion-sesion">

            <div class="titulo-cerrar-sesion">
                <h2>Sesion <ion-icon name="finger-print-outline"></ion-icon></h2>
    
                <div class="sesion">
                <a class="cerrar-sesion" href="#">
                <ion-icon name="exit-outline"></ion-icon>Cerrar Session
                </a>
                </div>   
            </div>
        </div>

        <div class="datos-basicos">
        <div class="formulario-datos-basicos">
            <div class="titulo-sesion-confi">
            <h2 >Informacion Personal <ion-icon name="document-text-outline"></ion-icon></h2>
            </div>
        
        <form action="">
            <div class="grupo">
                <label for="nombre">Nombres</label>
                <input type="text" id="nombre" name="nombre">
            </div>
            <div class="grupo">
                <label for="nombre">Apellidos</label>
                <input type="text" id="nombre" name="nombre">
            </div>
            <div class="grupo">
                <label for="nombre">Telefono</label>
                <input type="text" id="nombre" name="nombre">
            </div>
            <div class="grupo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="grupo">
                <label for="nombre">Usuario</label>
                <input type="text" id="nombre" name="nombre">
            </div>
            
            <a class="submit" href="">
            <ion-icon name="save-outline"></ion-icon>Guardar
            </a>

        </form>

        </div>
        </div>

       
    <div class="contrasenia">
    <div class="cambiar-contrasenia">
        <div class="titulo-sesion-confi">
        <h2 >Cambiar Contraseña <ion-icon name="document-lock-outline"></ion-icon></h2>
        </div>

        <form action="">
            <div class="grupo">
                <label for="nombre">Contraseña Actual</label>
                <input type="password" id="nombre" name="nombre">
            </div>
            <div class="grupo">
                <label for="nombre">Nueva Contraseña</label>
                <input type="password" id="nombre" name="nombre">
            </div>
            <div class="grupo">
                <label for="nombre">Confirmar Contraseña</label>
                <input type="password" id="nombre" name="nombre">
            </div>
            <a class="submit" href="">
            <ion-icon name="save-outline"></ion-icon>Guardar
            </a>
        </form>
    </div>
    </div>
        
    
       
 

   

        </div>

<?php 
    require_once 'app/views/template/parteInferiorAdmin.php';
?>