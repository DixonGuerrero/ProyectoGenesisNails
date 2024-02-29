<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Prueba</title>
    <link rel="stylesheet" href="./css/dashadmin.css" />
  </head>
  <body>
    <div class="menu">
      <ion-icon name="menu-outline"></ion-icon>
      <ion-icon name="close-outline"></ion-icon>
    </div>

    <div class="barra-lateral">
      <div>
        <div class="nombre-pagina">
          <img id="logo" src="./images/logo2.ico" alt="Imagen" />
          <span>Genesis Nails</span>
        </div>
        <button class="boton">
          <ion-icon name="add-outline"></ion-icon>
          <span>Nuevo</span>
        </button>
      </div>

      <nav class="navegacion">
        <ul>
          <li>
            <a id="inbox" href="principal">
              <ion-icon name="home-outline"></ion-icon>
              <span>Principal</span>
            </a>
          </li>
          <li>
            <a href="citas">
              <ion-icon name="calendar-outline"></ion-icon>
              <span>Citas</span>
            </a>
          </li>
          <li>
            <a href="usuarios">
              <ion-icon name="people-outline"></ion-icon>
              <span>Usuarios</span>
            </a>
          </li>
          <li>
            <a href="proveedores">
              <ion-icon name="document-text-outline"></ion-icon>
              <span>Proveedores</span>
            </a>
          </li>
          <li>
            <a href="productos">
              <ion-icon name="bag-handle-outline"></ion-icon>
              <span>Productos</span>
            </a>
          </li>
          <li>
            <a href="entrada">
              <ion-icon name="enter-outline"></ion-icon>
              <span>Entrada</span>
            </a>
          </li>
          <li>
            <a href="Salida">
              <ion-icon name="exit-outline"></ion-icon>
              <span>Salida</span>
            </a>
          </li>
        </ul>
      </nav>

      <div>
        <div class="linea"></div>

        <div class="modo-oscuro">
          <div class="info">
            <ion-icon name="moon-outline"></ion-icon>
            <span>Oscuro</span>
          </div>
          <div class="switch">
            <div class="base">
              <div class="circulo"></div>
            </div>
          </div>
        </div>

        <div class="usuario">
          <img src="images/36.jpg" alt="" />
          <div class="info-usuario">
            <div class="nombre-email">
              <span class="nombre">Usuario</span>
              <span class="email">usuario@gmail.com</span>
            </div>
            <a class="configuracion" href="configuraciones">
              <ion-icon name="settings-outline"></ion-icon>
            </a>
          </div>
        </div>
      </div>
    </div>
    <main>
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
               <img class="imagen-producto" src="/images/36.jpg" alt="">
                <p class="titulo">Shampo Savital</p>
                <p class="estadistica">14</p>
          </div>
        </div>
      </div>
      <div class="tarjeta-producto">
        <div class="producto min">
          <h2 class="titulo-producto">Producto con menos stock</h2>
          <div class="info">
             <img class="imagen-producto" src="/images/36.jpg" alt="">
              <p class="titulo">Lima Uñas</p>
              <p class="estadistica">14</p>
        </div>
      </div>
    </div>
      </div>
    </main>
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
    <script src="./js/barraLateral.js"></script>
  </body>
</html>
