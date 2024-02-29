<?php 
require_once 'app/views/template/parteSuperiorAdmin.php';
?>

<div class="barra-superior">
        <h1 class="titulo-pagina">Principal</h1>
      </div>

      <div class="tarjetas">
        <div class="tarjeta primera">
          <div class="icono">
            <ion-icon name="person"></ion-icon>
            <h2>Usuarios</h2>
          </div>
          <div class="info">
            <p>102</p>
          </div>
        </div>

        <div class="tarjeta segunda">
          <div class="icono">
            <ion-icon name="calendar"></ion-icon>
            <h2>Citas</h2>
          </div>
          <div class="info">
            <p>16</p>
          </div>
        </div>

        <div class="tarjeta tercera">
          <div class="icono">
            <ion-icon name="bag-handle"></ion-icon>
            <h2>Productos</h2>
          </div>
          <div class="info">
            <p>25</p>
          </div>
        </div>

        <div class="tarjeta cuarta">
          <div class="icono">
            <ion-icon name="document-text"></ion-icon>
            <h2>Proveedores</h2>
          </div>
          <div class="info">
            <p>27</p>
          </div>
        </div>
      </div>

      <h2 class="titulo-sesion">
        <ion-icon name="bar-chart"></ion-icon>
        Estadisticas</h2>

      <div class="grafica">
        <h2 class="titulo-grafica">Grafica</h2>
      </div>

      <div class="estadisticas-max-min">
        <div class="tarjeta-estadistica">
          <div class="servicio max">
            <h2>Servicio mas reservado
                <ion-icon name="albums"></ion-icon>
            </h2>
            <div class="info">
              <p class="titulo">Manicure</p>
              <p class="estadistica">9</p>
            </div>
          </div>
        </div>

        <div class="tarjeta-estadistica">
          <div class="servicio min">
            <h2>Servicio menos reservado
                <ion-icon name="albums"></ion-icon>
            </h2>
            <div class="info">
              <p class="titulo">Cejas</p>
              <p class="estadistica">0</p>
            </div>
          </div>
        </div>

        <div class="tarjeta-estadistica">
          <div class="producto min">
            <h2>Producto menos Salidas
                <ion-icon name="bag-add"></ion-icon>
            </h2>
            <div class="info">
              <p class="titulo">Lima Uñas</p>
              <p class="estadistica">1</p>
            </div>
          </div>
        </div>

        <div class="tarjeta-estadistica">
          <div class="producto max">
            <h2>Producto mas Salidas
                <ion-icon name="bag-remove"></ion-icon>
            </h2>
            <div class="info">
              <p class="titulo">Shampo Savital</p>
              <p class="estadistica">14</p>
            </div>
          </div>
        </div>
      </div>

      <h2 class="titulo-sesion">
        <ion-icon name="cart"></ion-icon>
        Stock
    </h2>

      <div class="producto-max-min-stock">
        <div class="tarjeta-producto">
          <div class="producto max">
            <h2 class="titulo-producto">Producto con mas stock</h2>
            <div class="info">
               <img class="imagen-producto" src="<?php echo APP_URL?>assets/images/producto/default.png" alt="">
                <p class="titulo">Shampo Savital</p>
                <p class="estadistica">14</p>
          </div>
        </div>
      </div>
      <div class="tarjeta-producto">
        <div class="producto min">
          <h2 class="titulo-producto">Producto con menos stock</h2>
          <div class="info">
             <img class="imagen-producto" src="<?php echo APP_URL?>assets/images/producto/default.png" alt="">
              <p class="titulo">Lima Uñas</p>
              <p class="estadistica">14</p>
        </div>
      </div>
    </div>
      </div>

<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>