<?php
require_once 'app/views/template/parteSuperior.php';
    $citas = $this->d['citas'];
    $servicioSemana = $this->d['servicioSemana'];
    $formularioCita = $this->d['formularioCita'];
?>

<div class="barra-superior">
    <h1 class="titulo-pagina">Principal</h1>
</div>

<section class="servicios-semana">


    <h2 class="titulo-sesion">
        <ion-icon name="storefront"></ion-icon>
        Servicios Populares
    </h2>

    <div class="contenedor-servicios">
        <?php echo $servicioSemana?>
    </div>

</section>


<section class="citas-reservadas">
    <?php echo $citas?>
</section>

<section class="agendar-cita">


    <div class="contenedor-agendar-cita">
            <h2 class="titulo-sesion-actual">¿Aun no tienes una cita?</h2>
            
        <div class="contenedor-tarjetas-beneficios">

            <div class="beneficios uno">
                <div class="tarjeta-beneficio">
                    <h2 class="titulo">Atención Personalizada</h2>
                    <p>Disfruta de servicios diseñados específicamente para ti, con atención detallada a tus preferencias y necesidades.</p>
                </div>
            </div>
            <div class="beneficios dos">
                <div class="tarjeta-beneficio">
                    <h2 class="titulo">Productos de Alta Calidad</h2>
                    <p>Utilizamos exclusivamente productos premium para asegurar resultados duraderos y cuidado supremo de tu belleza.</p>
                </div>
            </div>
    
            <div class="beneficios tres ">
                <div class="tarjeta-beneficio">
                    <h2 class="titulo">Ambiente muy  Relajante</h2>
                    <p>Vive una experiencia única en un ambiente tranquilo y acogedor, perfecto para tu momento de cuidado personal.</p>
                </div>
            </div>
        </div>

        <div class="contenedor-agendar">
            <a href="<?php echo APP_URL ?>cita" class="agendar add-new">
                <ion-icon name="calendar"></ion-icon>
                <span>Agendar Cita</span>
            </a>
        </div>
    </div>

</section>

<section class="modal ">
    <?php echo $formularioCita?>
</section>

<section class="redes">
    <h2 class="titulo-sesion">
        <ion-icon name="layers"></ion-icon>
        Redes Sociales
    </h2>

    <div class="contenedor-redes">
        <a class="redes-link facebook" href="#">
            <ion-icon name="logo-facebook"></ion-icon>
        </a>
        <a class="redes-link instagram" href="#">
            <ion-icon name="logo-instagram"></ion-icon>
        </a>
        <a class="redes-link twitter" href="#">
            <ion-icon name="logo-twitter"></ion-icon>
        </a>

        <a class="redes-link whatsapp" href="#">
            <ion-icon name="logo-whatsapp"></ion-icon>
        </a>

        <a class="redes-link tiktok" href="#">
            <ion-icon name="logo-tiktok"></ion-icon>
        </a>

    </div>

</section>

<?php
require_once 'app/views/template/parteInferior.php';
?>