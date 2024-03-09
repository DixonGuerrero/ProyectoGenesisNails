<?php
require_once 'app/views/template/parteSuperior.php';

    $citas = $this->d['citas'];
?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Cita</h1>
</div>

<h2 class="titulo-sesion">
    <ion-icon name="calendar"></ion-icon>
    Citas
</h2>

<section class="citas-reservadas">

    <div class="contenedor-cita">
        <?php echo $citas?>
    </div>
</section>

<section class="recomendacion-cita">
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

</section>


<?php
require_once 'app/views/template/parteInferior.php';
?>