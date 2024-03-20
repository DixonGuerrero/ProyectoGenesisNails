<?php
require_once 'app/views/template/parteSuperiorAdmin.php';
    $tabla = $this->d['tablaCitas'];

?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Citas Admin</h1>
</div>


<div class="tabla">

    <?php echo $tabla ?>

</div>


<section class="modal ">
    <div class="modal_container">
        <div class="encabezado">
            <h1>Cita</h1>
            <a href="#" class="modal_close">X</a>
        </div>
        
        <img src="<?php echo APP_URL;?>assets/images/calendario_cita.png"  class="modal_img" alt="">
        <h2 class="modal_title">Configure su Cita</h2>
    
        <p class="modal_text">
            Por favor, complete el siguiente formulario para agendar su cita.
        </p>
        <form action="" method="POST" class="form">
            
            <input type="hidden" value="">
            <div class="form_group">
                <label for="servicio">Servicio</label>
                <select name="servicio" id="servicio" class="form_input" >
                    <option value="">Unas</option>
                    <option value="">Manicure</option>
                    <option value="">Cejas</option>
                    <option value="">Alisado y Cepillado</option>    
                </select>
            </div>

            <!-- <------Fecha y Hora------> 
            <div class="form_group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form__input">
            </div>

            <div class="form_group">
                <label for="hora">Hora</label>
                <input type="time" name="hora" id="hora" class="form__input">
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