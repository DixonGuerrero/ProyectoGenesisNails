<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Genesis Nails</title>
    <link rel="stylesheet" href="./assets/css/Formulario.css">
    <script src="<?php echo APP_URL ?>/assets/js/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="container-form login ">
        <div class="information">
            <div class="info-childs">
                <h2>¡¡Bienvenido nuevamente!!</h2>
                <p>Para ingresar al sistema, llene los datos</p>
                <input type="button" value="Registrarse" id="sign-up">
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Iniciar Sesión</h2>

                <p>Por favor llene los datos a continuacion</p>
                <form class="form form-login FormularioAjax" method="POST" action="<?php echo APP_URL;?>login/iniciarSesion">
                    <div>
                        <label>
                            <i class='bx bx-user'></i>
                            <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario" required />
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" name="password" id="password" placeholder="Password" required />
                        </label>
                    </div>
                    <input type="submit" value="Iniciar Sesión">
                    <div class="alerta-error">Todos los campos son obligatorios</div>
                    <div class="alerta-exito">Te registraste correctamente</div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-form register hide">
        <div class="information">
            <div class="info-childs">
                <h2>Bienvenido</h2>
                <p>Para unirte a nuestra comunidad por favor Registre sus datos</p>
                <input type="button" value="Iniciar Sesión" id="sign-in">
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Crear una Cuenta</h2>

                <p>Por favor ingrese los datos aqui abajo</p>
                <form class="form form-register FormularioAjax" method="POST" action="<?php echo APP_URL;?>formulario/nuevoUsuario">
                    <div>
                        <label>
                            <i class='bx bxs-user-circle'></i>
                            <input type="text" placeholder="Nombre" name="nombres">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-user'></i>
                            <input type="text" placeholder="Nombre Usuario" name="usuario">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-envelope'></i>
                            <input type="email" placeholder="Correo Electronico" name="email">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bxs-phone-call'></i> <input type="number" placeholder="Telefono" name="telefono">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" placeholder="Contraseña" name="clave1">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" placeholder="Confirmar Contraseña" name="clave2">
                        </label>
                    </div>

                    <input type="submit" value="Registrarse">

                </form>
            </div>
        </div>
    </div>

    <script src="<?= APP_URL ?>assets/js/formulario.js"></script>
</body>
<script src="<?php echo APP_URL ?>assets/js/ajax.js"></script>

</html>