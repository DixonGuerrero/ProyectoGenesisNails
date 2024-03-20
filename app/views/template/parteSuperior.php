<?php
$url = isset($_GET['url']) ? $_GET['url'] : null;
$url = rtrim($url, '/');
$url = explode('/', $url);
$usuario;
if (isset($this->d['usuario'])) {
  $usuario = $this->d['usuario'];
}

if (isset($this->d['mensajeTiempo'])) {
  $mensajeTiempo = $this->d['mensajeTiempo'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Genesis Nails </title>
  <link rel="stylesheet" href="assets/css/dashadmin.css" />

  <link rel="stylesheet" href="assets/css/<?php echo $url[0]; ?>.css" />
  <script src="<?php echo APP_URL ?>/assets/js/sweetalert2.all.min.js"></script>
  <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
  <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
</head>

<body>
  <div class="menu">
    <ion-icon name="menu-outline"></ion-icon>
    <ion-icon name="close-outline"></ion-icon>
  </div>

  <div class="barra-lateral">
    <div>
      <div class="nombre-pagina">
        <img id="logo" src="<?php echo APP_URL ?>assets/images/logo2.ico" alt="Imagen" />
        <span>Genesis Nails</span>
      </div>
    </div>

    <div class="linea"></div>

    <span class="mensajeTiempo">
      <?php echo $mensajeTiempo ?>
    </span>
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
            <ion-icon name="storefront"></ion-icon>
            <span>Servicios</span>
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
        <img src="<?php echo APP_URL; ?>assets/images/usuario/<?php echo $usuario->getImagen(); ?>" alt="" />
        <div class="info-usuario">
          <div class="nombre-email">
            <span class="nombre">
              <?php echo $usuario->getUsuario(); ?>
            </span>
            <span class="email">
              <?php echo $usuario->getEmail(); ?>
            </span>
          </div>
          <a class="configuracion" href="configuracion">
            <ion-icon name="settings-outline"></ion-icon>
          </a>
        </div>
      </div>
    </div>
  </div>
  <main>