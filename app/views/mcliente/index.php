<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genesis Nails</title>
    <link rel="stylesheet" href="./assets/css/MCliente.css">
</head>
<body>
    
    <!--Incluimos el header de Cliente------>
    <?php
            include"./inc/menuCliente.php";
        ?>

    <main>
        <section class="menu_lateral">
            <ul>
                <li><a href="#" id="menu_agendar">Agendar nueva cita</a></li>
                <li><a href="#" id="menu_modificar">Modificar cita</a></li>
                <li><a href="#" id="menu_eliminar">Eliminar cita</a></li>
            </ul>
        </section>

        <section id="agenda" class="menu">
            <div class="div_titulo">
                <h1 class="titulo">Agendar cita</h1>
            </div>
            <form action="#">
                <label for="Servicio" class="menu_subtitulo">Seleccionar servicio:</label>
                <select name="Servicio" class="menu_seleccionar">
                    <option selected>Selecciona un servicio</option>
                    <option>Cepillado y alisado</option>
                    <option>Uñas en acrílico</option>
                    <option>Uñas semipermanente</option>
                    <option>Manicure y pedicure</option>
                    <option>Diseño de cejas</option>
                    <option>Extensión de pestañas</option>
                </select>
                <label for="ADate" class="menu_subtitulo">Selecciona la fecha:</label>
                <input type="date" name="ADate" class="menu_input" min="" max="">
                <label for="ATime" class="menu_subtitulo">Selecciona la hora:</label>
                <select name="ATime" class="menu_seleccionar"></select>
                <div class="botones">
                    <input type="button" value="Aceptar" id="aceptarAgenda" class="boton b_aceptar">
                    <input type="reset" value="Limpiar" class="boton b_limpiar">
                </div>
            </form>
        </section>

        <section id="modificar" class="menu">
            <div class="div_titulo">
                <h1 class="titulo">Modificar cita</h1>
            </div>
            <form action="#">
                <label for="M_seleccionar_cita" class="menu_subtitulo">Seleccionar cita</label>
                <select name="M_seleccionar_cita" class="menu_seleccionar">
                    <option selected>Selecciona una cita</option>
                </select>
                <label for="modificar_servicio" class="menu_subtitulo">Modificar servicio</label>
                <select name="modificar_servicio" class="menu_seleccionar">
                    <option selected>Selecciona un servicio</option>
                    <option>Cepillado y alisado</option>
                    <option>Uñas en acrílico</option>
                    <option>Uñas semipermanente</option>
                    <option>Manicure y pedicure</option>
                    <option>Diseño de cejas</option>
                    <option>Extensión de pestañas</option>
                </select>
                <label for="MDate" class="menu_subtitulo">Selecciona la fecha y la hora:</label>
                <input type="date" name="MDate" class="menu_input" min="" max="">
                <label for="MTime" class="menu_subtitulo">Selecciona la hora:</label>
                <select name="MTime" class="menu_seleccionar"></select>
                <div class="botones">
                    <input type="button" value="Aceptar" id="aceptarModificar" class="boton b_aceptar">
                    <input type="reset" value="Limpiar" class="boton b_limpiar">
                </div>
            </form>
        </section>

        <section id="eliminar" class="menu">
            <div class="div_titulo">
                <h1 class="titulo">Eliminar cita</h1>
            </div>
            <div class="E_text">
                <p>El plazo máximo para eliminar una cita es de 2 horas antes de la misma.</p>
            </div>
            <form action="#">
                <label for="E_seleccionar_cita" class="menu_subtitulo">Seleccionar cita</label>
                <select name="E_seleccionar_cita" class="menu_seleccionar">
                    <option selected>Selecciona una cita</option>
                </select>
                <div class="botones">
                    <input type="button" value="Aceptar" id="aceptarEliminar" class="boton b_aceptar">
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

    <script src="./assets/js/MCliente.js"></script>



</body>
</html>