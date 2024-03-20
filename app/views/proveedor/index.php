<?php 
    require_once 'app/views/template/parteSuperiorAdmin.php';
    $listaProveedores = $this->d['listaProveedores'];
?>

<div class="barra-superior">
        <h1 class="titulo-pagina">Proveedores</h1>  
    </div>

    <div class="tabla">
        <?php echo $listaProveedores?>
    </div>

    <section class="modal ">
    <div class="modal_container">
        <div class="encabezado">
            <h1>Proveedor</h1>
            <a href="#" class="modal_close">X</a>
        </div>

        <img src="<?php echo APP_URL; ?>assets/images/proveedor_add.png" class="modal_img" alt="">
        <h2 class="modal_title">Creando Proveedor</h2>

        <p class="modal_text">
            Por favor, complete el siguiente formulario para crear un Proveedor.
        </p>
        <form action="" method="POST" class="form">

            <!--  datos de usuario -->
            <div class="datos-basicos">
            <h2 class="titulo-section-form">Datos Basicos</h2>
            <div class="form_group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form__input" required>
            </div>

            <div class="form_group">
                <label for="apellidos">Email</label>
                <input type="text" name="apellidos" id="apellidos" class="form__input" required>
            </div>

            <div class="form_group">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" id="telefono" class="form__input">
            </div>

            <div class="form_group">
                <label for="nit">Nit</label>
                <input type="text" name="nit" id="nit" class="form__input" required>
            </div>

            <div class="form_group">
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" id="direccion" class="form__input" required>
            </div>
            </div>



            <button type="submit" class="enviar">
                Registrar
            </button>
        </form>

    </div>
</section>

<?php 
    require_once 'app/views/template/parteInferiorAdmin.php';
?>