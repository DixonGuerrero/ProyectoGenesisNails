<?php 
            $url = isset($_GET['url']) ? $_GET['url']: null;
            $url = rtrim($url, '/');
            $url = explode('/', $url);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Genesis Nails </title>
    <link rel="stylesheet" href="assets/css/dashadmin.css" />

    <link rel="stylesheet" href="assets/css/<?php echo $url[0];?>.css" />
  </head>
  <body>
    <div class="menu">
      <ion-icon name="menu-outline"></ion-icon>
      <ion-icon name="close-outline"></ion-icon>
    </div>

    <div class="barra-lateral">
      <div>
        <div class="nombre-pagina">
          <img id="logo" src="<?php echo APP_URL?>assets/images/logo2.ico" alt="Imagen" />
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
            <a id="inbox" href="dashboard">
              <ion-icon name="home-outline"></ion-icon>
              <span>Principal</span>
            </a>
          </li>
          <li>
            <a href="cita">
              <ion-icon name="calendar-outline"></ion-icon>
              <span>Citas</span>
            </a>
          </li>
          <li>
            <a href="servicio">
              <ion-icon name="people-outline"></ion-icon>
              <span>servicios</span>
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
          <img src="<?php echo APP_URL; ?>assets/images/usuario/default.jpg" alt="" />
          <div class="info-usuario">
            <div class="nombre-email">
              <span class="nombre">Usuario</span>
              <span class="email">usuario@gmail.com</span>
            </div>
            <a class="configuracion" href="configuracion">
              <ion-icon name="settings-outline"></ion-icon>
            </a>
          </div>
        </div>
      </div>
    </div>
    <main>