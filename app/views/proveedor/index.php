<?php
require_once 'app/views/template/parteSuperiorAdmin.php';
$listaProveedores = $this->d['listaProveedores'];
?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Proveedores</h1>
</div>

<div class="tabla">
    <?php echo $listaProveedores ?>
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
        <form action="<?php echo APP_URL ?>proveedor/nuevoProveedor" method="POST" class="form FormularioAjax">

            <!--  datos de usuario -->
            <div class="datos-basicos">
                <h2 class="titulo-section-form">Datos Basicos</h2>
                <div class="form_group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form__input" required>
                </div>

                <div class="form_group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form__input" required>
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

<section class="modal modal_update">
    <div class="modal_container">
        <div class="encabezado">
            <h1>Proveedor</h1>
            <a href="#" class="modal_close">X</a>
        </div>

        <img src="<?php echo APP_URL; ?>assets/images/proveedor_add.png" class="modal_img" alt="">
        <h2 class="modal_title">Actulizando Proveedor</h2>

        <p class="modal_text">
            Modifique los datos del proveedor, que desea actualizar.
        </p>
        <form action="<?php echo APP_URL ?>proveedor/actualizar" method="POST" class="form FormularioAjax">

            <!--  datos de usuario -->
            <div class="datos-basicos">
                <h2 class="titulo-section-form">Datos Basicos</h2>
                <div class="form_group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form__input" required>
                </div>

                <div class="form_group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form__input" required>
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

            <input type="hidden" name="id_proveedor" id="id_proveedor" class="form__input" required>



            <button type="submit" class="enviar">
                Actualizar
            </button>
        </form>

    </div>
</section>


<script src="<?php echo APP_URL?>assets/js/proveedor.js"></script>

<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>