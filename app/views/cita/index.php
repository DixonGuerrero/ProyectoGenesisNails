<?php
require_once 'app/views/template/parteSuperior.php';

$citas = $this->d['citas'];
$formularioActualizarCita = $this->d['formularioActualizarCita'];
$formularioAgendarCita = $this->d['formularioCita'];
?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Cita</h1>
</div>

<div class="header-sesion">

    <h2 class="titulo-sesion">
        <ion-icon name="calendar"></ion-icon>
        Citas
    </h2>

    <button class="boton-agendar-cita add-new">
        Agendar cita
        <ion-icon name="arrow-forward-circle"></ion-icon>
    </button>
</div>


<section class="citas-reservadas">

    <div class="contenedor-cita">
        <?php echo $citas ?>
    </div>
</section>

<section class="modal " id="modalAgendarCita">
    <?= $formularioAgendarCita; ?>
</section>

<section class="modal modal_update" id="modalEditarCita">
    <?= $formularioActualizarCita; ?>
</section>




<!-- <section class="recomendacion-cita">
    <img src="<?php echo APP_URL ?>assets/images/logo.png" alt="" class="logo-fondo-rc">
    <h2 class="titulo-servicio-recomendacion">
        Servicios recomendados
        <ion-icon name="star"></ion-icon>

    </h2>
    <div class="contener-tarjetas">
        <div class="tarjeta-servicio-recomendacion">
            <h2>Manicure
                <ion-icon name="bag-handle"></ion-icon>
            </h2>
            <img src="<?php echo APP_URL ?>assets/images/Manicure Pedicure 2.jpg" alt="">
            <p>Manicure profesional con los mejores productos del mercado</p>
            <a href="#" class="boton boton-primario">
                Agendar cita
                <ion-icon name="arrow-forward-circle"></ion-icon>
            </a>

        </div>
        <div class="tarjeta-servicio-recomendacion">
            <h2>Manicure
                <ion-icon name="bag-handle"></ion-icon>
            </h2>
            <img src="<?php echo APP_URL ?>assets/images/Pesta;as.jpg" alt="">
            <p>Manicure profesional con los mejores productos del mercado</p>
            <a href="#" class="boton boton-primario">
                Agendar cita
                <ion-icon name="arrow-forward-circle"></ion-icon>
            </a>

        </div>
        <div class="tarjeta-servicio-recomendacion">
            <h2>Manicure
                <ion-icon name="bag-handle"></ion-icon>
            </h2>
            <img src="<?php echo APP_URL ?>assets/images/Cejas.jpg" alt="">
            <p>Manicure profesional con los mejores productos del mercado</p>
            <a href="#" class="boton boton-primario">
                Agendar cita
                <ion-icon name="arrow-forward-circle"></ion-icon>
            </a>

        </div>

    </div>

    <div class="contenedor-boton-vermas">
        <button class="boton-vermas">
            Ver más servicios
            <ion-icon name="arrow-forward-circle"></ion-icon>
        </button>
    </div>

</section> -->



<!-- Incluimos javascript para rellenar modal update
 -->

<script src="<?php echo APP_URL ?>assets/js/cita.js"></script>
<?php
require_once 'app/views/template/parteInferior.php';
?>