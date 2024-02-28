<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Génesis Nails</title>
    <link rel="stylesheet" href="./assets/css/CAdministrador.css">
    <link rel="stylesheet" href="./assets/css/sweetalert2.min.css">
  <script src="<?php echo APP_URL?>/assets/js/sweetalert2.all.min.js"></script>
</head>
<body>

    
    <!--Incluimos el header de admin------>
    <?php
            include "./inc/menuAdmin.php";
        ?>
<p><?php $this->mostrarMensajes();?></p>
    <main>
        <section class="menu_lateral">
            <ul>
                <li><a href="#" id="menu_clientes">Clientes</a></li>
                <li><a href="#" id="menu_citas">Citas</a></li>
                <li><a href="#" id="menu_agendar">Agendar cita</a></li>
                <li><a href="#" id="menu_modificar">Modificar cita</a></li>
                <li><a href="#" id="menu_eliminar">Eliminar cita</a></li>
            </ul>
        </section>
        
        <section id="clientes" class="clientes menu">
            <div class="div_titulo">
                <h1 class="titulo">Registro de clientes</h1>
            </div>
            <form action="#">
                <label for="ClBuscar" class="menu_subtitulo">Buscar nombre del cliente:</label>
                <input type="text" name="ClBuscar" class="menu_input" value="">
                <label for="ClInformacion" class="menu_subtitulo">Información sobre el cliente:</label>
                <input type="textarea" name="ClInformacion" class="menu_output" value="">
            </form>
        </section>

        <section id="citas" class="citas menu">
            <div class="div_titulo">
                <h1 class="titulo">Registro de citas</h1>
            </div>
            <form action="#">
                <label for="CiDate" class="menu_subtitulo">Seleccionar fecha:</label>
                <input type="date" name="CiDate" class="menu_input" max="" min="">
                <label for="CiCita" class="menu_subtitulo">Seleccionar cita:</label>
                <select name="CiCita" class="menu_seleccionar"></select>
                <label for="CiInformacion" class="menu_subtitulo">Información sobre la cita:</label>
                <input type="textarea" name="CiInformacion" class="menu_output" value="">
            </form>
        </section>

        <section id="Acitas" class="Acitas menu">
            <div class="div_titulo">
                <h1 class="titulo">Agendar cita</h1>
            </div>
            <form action="#">
                <label for="ABuscar" class="menu_subtitulo">Buscar cliente:</label>
                <input type="text" name="ABuscar" class="menu_input" value="">
                <label for="AServicio" class="menu_subtitulo">Seleccionar servicio:</label>
                <select name="AServicio" class="menu_seleccionar">
                    <option selected>Selecciona un servicio</option>
                    <option>Cepillado y alisado</option>
                    <option>Uñas en acrílico</option>
                    <option>Uñas semipermanente</option>
                    <option>Manicure y pedicure</option>
                    <option>Diseño de cejas</option>
                    <option>Extensión de pestañas</option>
                </select>
                <label for="ADate" class="menu_subtitulo">Seleccionar fecha:</label>
                <input type="date" name="ADate" class="menu_input" min="" max="">
                <label for="ATime" class="menu_subtitulo">Seleccionar hora:</label>
                <select name="ATime" class="menu_seleccionar"></select>
                <div class="botones">
                    <input type="button" value="Agendar" id="agendarCi" class="boton b_aceptar">
                    <input type="reset" value="Limpiar" class="boton b_limpiar">
                </div>
            </form>
        </section>

        <section id="Mcitas" class="Mcitas menu">
            <div class="div_titulo">
                <h1 class="titulo">Modificar cita</h1>
            </div>
            <form action="#">
                <label for="MBuscar" class="menu_subtitulo">Buscar cliente:</label>
                <input type="text" name="MBuscar" class="menu_input" value="">
                <label for="MCita" class="menu_subtitulo">Seleccionar cita:</label>
                <select name="MCita" class="menu_seleccionar"></select>
                <label for="MServicio" class="menu_subtitulo">Modificar servicio:</label>
                <select name="MServicio" class="menu_seleccionar">
                    <option selected>Seleccionar servicio</option>
                    <option>Cepillado y alisado</option>
                    <option>Uñas en acrílico</option>
                    <option>Uñas semipermanente</option>
                    <option>Manicure y pedicure</option>
                    <option>Diseño de cejas</option>
                    <option>Extensión de pestañas</option>
                </select>
                <label for="MDate" class="menu_subtitulo">Modificar fecha:</label>
                <input type="date" name="MDate" class="menu_input" min="" max="">
                <label for="MTime" class="menu_subtitulo">Seleccionar hora:</label>
                <select name="MTime" class="menu_seleccionar"></select>
                <div class="botones">
                    <input type="button" value="Modificar" id="modificarCi" class="boton b_aceptar">
                    <input type="reset" value="Limpiar" class="boton b_limpiar">
                </div>
            </form>
        </section>

        <section id="Ecitas" class="Ecitas menu">
            <div class="div_titulo">
                <h1 class="titulo">Eliminar cita</h1>
            </div>
            <form action="#">
                <label for="EBuscar" class="menu_subtitulo">Buscar cliente:</label>
                <input type="text" name="EBuscar" class="menu_input" value="">
                <label for="ECita" class="menu_subtitulo">Seleccionar cita:</label>
                <select name="ECita" class="menu_seleccionar"></select>
                <div class="botones">
                    <input type="button" value="Eliminar" id="eliminarCi" class="boton b_aceptar">
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

    <script src="./assets/js/CAdministrador.js"></script>


</body>
</html>