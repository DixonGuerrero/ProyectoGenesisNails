<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genesis Nails</title>
    <link rel="stylesheet" href="./assets/css/Formulario.css">
    <script src="<?php echo APP_URL?>/assets/js/sweetalert2.all.min.js"></script>
</head>

<body>

<?php $this->mostrarMensajes();?>

    <header>

        <a href="#" class="logo">

            <img src="./assets/images/logo.png" alt="">

        </a>

        <nav>
            <a href="Home" class="hero_btn">Inicio</a>

        </nav>

    </header>


    <section>

        <article class="formulario_de_registro">

            <h1 class="titulo-formulario">Formulario de Registro</h1>

            <div class="formulario-registro" class="row">

                <form action="<?php echo APP_URL;?>formulario/nuevoUsuario"   method="POST">

                    <fieldset float="left" width="48%">
                        <legend>Datos personales</legend>

                        <div>
                            <label for="nombres">Nombres</label>
                            <input type="text" id="nombres" pattern="[a-zA-Z\s']{2,30}" name="nombres" />
                        </div>



                        <div>
                            <label for="apellidos">Apellidos</label>
                            <input type="text" id="apellidos" pattern="[a-zA-Z\s']{2,30}" name="apellidos" />
                        </div>


                        <div>
                            <label for="telefono">Telefono</label>
                            <input type="text" id="telefono" pattern="[0-9\s+]+" name="telefono" />
                        </div>

                        <div>
                            <label for="usuario">Usuario</label>
                            <input type="text" id="usuario" pattern="[a-zA-Z0-9]{3,20}" name="usuario" />
                        </div>

                        <div>
                            <label for="email">Correo Electronico</label>
                            <input type="text" id="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,50}" name="email" />
                        </div>

                        <div>
                            <label for="id">Contraseña</label>
                            <input type="text" id="clave1" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,20}" name="clave1" />
                        </div>



                        <div>
                            <label>Confirmar Contraseña</label>
                            <input type="text" id="clave2" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,20}" name="clave2" />
                        </div>

                    </fieldset>
                    <input type="submit" value="Iniciar sesión" />
                </form>


               



            </div>

        </article>



    </section>
    <footer>

        <h3 class="pieDePagina"> By Salón de Belleza Génesis Nails</h3>

    </footer>




</body>

</html>