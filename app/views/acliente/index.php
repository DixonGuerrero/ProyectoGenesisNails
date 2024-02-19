<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Génesis Nails</title>
    <link rel="stylesheet" href="./assets/css/ACliente.css">
</head>
<body>

<!--Incluimos el header de Cliente------>
<?php
            include"./inc/menuCliente.php";
        ?>

    <main>
        <section class="formulario">
            <div>
                <h1>Actualizar datos del usuario</h1>
            </div>
            <form action="#">
                <div class="nombre">
                    <label for="Nombre">Nombre(s): *</label>
                    <input type="text" name="Nombre" id="">
                </div>
                <div class="apellido">
                    <label for="Apellido">Apellido(s): *</label>
                    <input type="text" name="Apellido" id="">
                </div>
                <div class="telefono">
                    <label for="Telefono">Telefono: *</label>
                    <input type="text" name="Telefono" id="">
                </div>
                <div class="email">
                    <label for="Correo Electrónico">Correo Electrónico: *</label>
                    <input type="text" name="Correo Electrónico" id="">
                </div>
                <div class="botones">
                    <input type="button" value="Actualizar" id="actualizar" class="boton b_aceptar">
                    <input type="reset" value="Limpiar" class="boton b_limpiar">
                </div>
            </form>
        </section>

        <section id="confirmar">
            
            <!--Incluimos la alerta------>
            <?php
                include "./inc/alertaEnviado.php";
            ?>
        </section>
    </main>

    <footer>
        <div>
            <h2>&copySalón de Belleza Génesis Nails</h2>
        </div>
    </footer>

    <script src="./assets/js/ACliente.js"></script>
    
</body>
</html>
    
