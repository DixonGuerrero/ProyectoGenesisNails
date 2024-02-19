<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genesis Nails</title>
    <link rel="stylesheet" href="./assets/css/PAdministrador.css">
</head>
<body>
    
    <!--Incluimos el header de admin------>
    <?php
            include"./inc/menuAdmin.php";
        ?>

    <main>
        <section class="menu_lateral">
            <ul>
                <li><a href="#" id="menu_consultar">Consultas</a></li>
                <li><a href="#" id="menu_prodprov">Productos / Proveedores</a></li>
                <li><a href="#" id="menu_entsal">Entradas / Salidas</a></li>
            </ul>
        </section>

        <section id="consultas" class="consultas menu">
            <div class="div_titulo">
                <h1 class="titulo">Consultas</h1>
            </div>
            <form action="#">
                <select name="Consulta" class="menu_seleccionar" id="ConsultaMenu">
                    <option value="0" selected>¿Qué desea consultar?</option>
                    <option value="1">Productos</option>
                    <option value="2">Proveedores</option>
                    <option value="3">Entradas</option>
                    <option value="4">Salidas</option>
                </select>
                <div class="CProductos menu_oculto" id="CProductos">
                    <label for="CBuscar" class="menu_subtitulo">Buscar nombre del producto:</label>
                    <input type="text" name="CBuscar" class="menu_input" value="">
                    <label for="CInformacion" class="menu_subtitulo">Información sobre el producto:</label>
                    <input type="textarea" name="CInformacion" class="menu_output" value="">
                </div>
                <div class="CProveedor menu_oculto" id="CProveedor">
                    <label for="CBuscar" class="menu_subtitulo">Buscar nombre del proveedor:</label>
                    <input type="text" name="CBuscar" class="menu_input" value="">
                    <label for="CInformacion" class="menu_subtitulo">Información sobre el proveedor:</label>
                    <input type="textarea" name="CInformacion" class="menu_output" value="">
                </div>
                <div class="CEntrada menu_oculto" id="CEntrada">
                    <label for="CBuscar" class="menu_subtitulo">Buscar nombre del producto:</label>
                    <input type="text" name="CBuscar" class="menu_input" value="">
                    <label for="CFecha" class="menu_subtitulo">Seleccionar la fecha de la entrada:</label>
                    <input type="date" name="CFecha" class="menu_date" max="" min="">
                    <label for="CInformacion" class="menu_subtitulo">Información sobre la entrada del producto:</label>
                    <input type="textarea" name="CInformacion" class="menu_output" value="">
                </div>
                <div class="CSalida menu_oculto" id="CSalida">
                    <label for="CBuscar" class="menu_subtitulo">Buscar nombre del producto:</label>
                    <input type="text" name="CBuscar" class="menu_input" value="">
                    <label for="CFecha" class="menu_subtitulo">Seleccionar la fecha de la salida:</label>
                    <input type="date" name="CFecha" class="menu_date" max="" min="">
                    <label for="CInformacion" class="menu_subtitulo">Información sobre la salida del producto:</label>
                    <input type="textarea" name="CInformacion" class="menu_output" value="">
                </div>
            </form>
        </section>

        <section id="prodprov" class="prodprov menu">
            <div class="div_titulo">
                <h1 class="titulo">Productos / Proveedores</h1>
            </div>
            <form action="#">
                <select name="Productos" class="menu_seleccionar" id="ProductosMenu">
                    <option value="0"  selected>¿Qué desea?</option>
                    <option value="1" >Registrar un nuevo producto</option>
                    <option value="2" >Registrar un nuevo proveedor</option>
                    <option value="3" >Modificar un producto</option>
                    <option value="4" >Modificar un proveedor</option>
                </select>
                <div class="RProducto menu_oculto" id="RProducto">
                    <label for="ProNombre" class="menu_subtitulo">Nombre del producto:</label>
                    <input type="text" name="ProNombre" class="menu_input" value="">
                    <label for="PID" class="menu_subtitulo">ID del producto:</label>
                    <input type="text" name="PID" class="menu_input" value="">
                    <label for="ProProveedor" class="menu_subtitulo">Buscar proveedor:</label>
                    <select name="ProProveedor" class="menu_seleccionar">
                        <option selected></option>
                    </select>
                    <div class="botones">
                        <input type="button" value="Registrar" id="registrarPro" class="boton b_aceptar">
                        <input type="reset" value="Limpiar" class="boton b_limpiar">
                    </div>
                </div>
                <div class="RProveedor menu_oculto" id="RProveedor">
                    <div>
                        <label for="ProNombre" class="menu_subtitulo">Nombre(s) del proveedor:</label>
                        <input type="text" name="ProNombre" class="menu_input" value="">
                    </div>
                    <div>
                        <label for="ProApellido" class="menu_subtitulo">Apellido(s) del proveedor:</label>
                        <input type="text" name="ProApellido" class="menu_input" value="">
                    </div>
                    <div>
                        <label for="ProID" class="menu_subtitulo">ID del proveedor:</label>
                        <input type="text" name="ProID" class="menu_input" value="">
                    </div>
                    <div>
                        <label for="ProNIT" class="menu_subtitulo">NIT del proveedor:</label>
                        <input type="text" name="ProNIT" class="menu_input" value="">
                    </div>
                    <div>
                        <label for="ProTelefono" class="menu_subtitulo">Teléfono del proveedor:</label>
                        <input type="text" name="ProTelefono" class="menu_input" value="">
                    </div>
                    <div>
                        <label for="ProEmail" class="menu_subtitulo">Correo electrónico del proveedor:</label>
                        <input type="text" name="ProEmail" class="menu_input" value="">
                    </div>
                    <div class="botones">
                        <input type="button" value="Registrar" id="registrarPro" class="boton b_aceptar">
                        <input type="reset" value="Limpiar" class="boton b_limpiar">
                    </div>
                </div>
                <div class="MProducto menu_oculto" id="MProducto">
                    <label for="ProNombre" class="menu_subtitulo">Nombre del producto:</label>
                    <input type="text" name="ProNombre" class="menu_input" value="XXXXXXX">
                    <label for="PID" class="menu_subtitulo">ID del producto:</label>
                    <input type="text" name="PID" class="menu_input" value="XXXXXXX">
                    <label for="ProProveedor" class="menu_subtitulo">Buscar proveedor:</label>
                    <select name="ProProveedor" class="menu_seleccionar">
                        <option selected></option>
                    </select>
                    <div class="botones">
                        <input type="button" value="Modificar" id="modificarProd" class="boton b_aceptar">
                        <input type="reset" value="Limpiar" class="boton b_limpiar">
                    </div>
                </div>
                <div class="MProveedor menu_oculto" id="MProveedor">
                    <div>
                        <label for="ProNombre" class="menu_subtitulo">Nombre(s) del proveedor:</label>
                        <input type="text" name="ProNombre" class="menu_input" value="XXXXXXXX">
                    </div>
                    <div>
                        <label for="ProApellido" class="menu_subtitulo">Apellido(s) del proveedor:</label>
                        <input type="text" name="ProApellido" class="menu_input" value="XXXXXXXXXX">
                    </div>
                    <div>
                        <label for="ProID" class="menu_subtitulo">ID del proveedor:</label>
                        <input type="text" name="ProID" class="menu_input" value="XXXXXXXXX">
                    </div>
                    <div>
                        <label for="ProNIT" class="menu_subtitulo">NIT del proveedor:</label>
                        <input type="text" name="ProNIT" class="menu_input" value="XXXXXXXXXX">
                    </div>
                    <div>
                        <label for="ProTelefono" class="menu_subtitulo">Teléfono del proveedor:</label>
                        <input type="text" name="ProTelefono" class="menu_input" value="XXXXXXXXX">
                    </div>
                    <div>
                        <label for="ProEmail" class="menu_subtitulo">Correo electrónico del proveedor:</label>
                        <input type="text" name="ProEmail" class="menu_input" value="XXXXXXXXX">
                    </div>
                    <div class="botones">
                        <input type="button" value="Modificar" id="modificarProv" class="boton b_aceptar">
                        <input type="reset" value="Limpiar" class="boton b_limpiar">
                    </div>
                </div>
            </form>
        </section>

        <section id="entsal" class="entsal menu">
            <div class="div_titulo">
                <h1 class="titulo">Entradas / Salidas</h1>
            </div>
            <form action="#">
                <select name="EntradaSalida" class="menu_seleccionar" id="EntradaSalidaMenu">
                    <option value="0" selected>¿Qué desea?</option>
                    <option value="1">Registrar entrada de producto</option>
                    <option value="2">Registrar salida de producto</option>
                </select>
                <div class="REntrada menu_oculto" id="REntrada">
                    <label for="ReNombreEnt" class="menu_subtitulo">Buscar producto:</label>
                    <input type="text" name="ReNombreEnt" class="menu_input" value="">
                    <label for="ReDateEnt" class="menu_subtitulo">Seleccionar la fecha y hora de la entrada:</label>
                    <input type="date" name="ReDateEnt" class="menu_date" max="" min="">
                    <label for="ReCantidadEnt" class="menu_subtitulo">Ingresar la cantidad de productos ingresados:</label>
                    <input type="text" name="ReCantidadEnt" class="menu_input" value="">
                    <div class="botones">
                        <input type="button" value="Registrar" id="registrarEnt" class="boton b_aceptar">
                        <input type="reset" value="Limpiar" class="boton b_limpiar">
                    </div>
                </div>
                <div class="RSalida menu_oculto" id="RSalida">
                    <label for="ReNombreSal" class="menu_subtitulo">Buscar producto:</label>
                    <input type="text" name="ReNombreSal" class="menu_input" value="">
                    <label for="ReDateSal" class="menu_subtitulo">Seleccionar la fecha y hora de la salida:</label>
                    <input type="date" name="ReDateSal" class="menu_date" max="" min="">
                    <label for="ReCantidadSal" class="menu_subtitulo">Ingresar la cantidad de productos retirados:</label>
                    <input type="text" name="ReCantidadSal" class="menu_input" value="">
                    <div class="botones">
                        <input type="button" value="Registrar" id="registrarSal" class="boton b_aceptar">
                        <input type="reset" value="Limpiar" class="boton b_limpiar">
                    </div>
                </div>
            </form>
        </section>

        <section id="confirmar">

            <!--Incluimos la alerta------>
            <?php
                include"./inc/alertaEnviado.php";
            ?>
            
        </section>
    </main>

    <footer>
        <div>
            <h2>&copySalón de Belleza Génesis Nails</h2>
        </div>
    </footer>

    <script src="./assets/js/PAdministrador.js"></script>


</body>
</html>