<?php 
            $url = isset($_GET['url']) ? $_GET['url']: null;
            $url = rtrim($url, '/');
            $url = explode('/', $url);
            $usuario;
            if(isset($this->d)){
                $usuario = $this->d['usuario'];
            }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Genesis Nails</title>
    
    <link rel="stylesheet" href="assets/css/<?php echo $url[0];?>.css" />
    <link rel="stylesheet" href="assets/css/dashadmin.css" />
    <script src="<?php echo APP_URL?>/assets/js/sweetalert2.all.min.js"></script>
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
          <img id="logo" src="<?php echo APP_URL?>assets/images/logo2.ico" alt="Imagen" />
          <span>Genesis Nails</span>
        </div>
  
      </div>

      <nav class="navegacion">
        <ul>
          <li>
            <a id="inbox" href="dashadmin"
            class="<?php echo $url[0] == 'dashadmin' ? 'active' : ''; ?>"
            >
              <ion-icon name="home"></ion-icon>
              <span>Principal</span>
            </a>
          </li>
          <li>
            <a href="citaAdmin"  class="<?php echo $url[0] == 'citaAdmin' ? 'active' : ''; ?>">
              <ion-icon name="calendar"></ion-icon>
              <span>Citas</span>
            </a>
          </li>
          <li>
            <a href="usuario"  class="<?php echo $url[0] == 'usuario' ? 'active' : ''; ?>">
              <ion-icon name="people"></ion-icon>
              <span>Usuarios</span>
            </a>
          </li>
          <li>
            <a href="proveedor"  class="<?php echo $url[0] == 'proveedor' ? 'active' : ''; ?>">
              <ion-icon name="document-text"></ion-icon>
              <span>Proveedores</span>
            </a>
          </li>
          <li>
            <a href="servicioAdmin"  class="<?php echo $url[0] == 'servicioAdmin' ? 'active' : ''; ?>">
            <ion-icon name="storefront"></ion-icon>
              <span>Servicios</span>
            </a>
          </li>
          <li>
            <a href="producto"  class="<?php echo $url[0] == 'producto' ? 'active' : ''; ?>">
              <ion-icon name="bag-handle"></ion-icon>
              <span>Productos</span>
            </a>
          </li>
          <li>
            <a href="entrada"  class="<?php echo $url[0] == 'entrada' ? 'active' : ''; ?>">
              <ion-icon name="enter"></ion-icon>
              <span>Entrada</span>
            </a>
          </li>
          <li>
            <a href="salida"  class="<?php echo $url[0] == 'salida' ? 'active' : ''; ?>">
              <ion-icon name="exit"></ion-icon>
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
            <span class="modo">Oscuro</span>
          </div>
          <div class="switch">
            <div class="base">
              <div class="circulo"></div>
            </div>
          </div>
        </div>

        <div class="usuario">
        <img src="<?php echo APP_URL; ?>assets/images/usuario/<?php echo $usuario->getImagen();?>" alt="" />
          <div class="info-usuario">
            <div class="nombre-email">
              <span class="nombre"><?php echo $usuario->getUsuario();?></span>
              <span class="email">
                <?php echo $usuario->getEmail();?>
              </span>
            </div>
            <a class="configuracion" href="configuracionAdmin">
              <ion-icon name="settings-outline"></ion-icon>
            </a>
          </div>
        </div>
      </div>
    </div>
    <main>