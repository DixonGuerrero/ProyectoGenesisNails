<?php
require_once 'app/views/template/parteSuperiorAdmin.php';

$numCitas = $this->d['num_citas'];
$numUsuarios = $this->d['num_usuarios'];
$numProductos = $this->d['num_productos'];
$numProveedores = $this->d['num_proveedores'];
$productoMaxStock = $this->d['producto_max_stock'];
$productoMinStock = $this->d['producto_min_stock'];

?>

<div class="barra-superior">
  <h1 class="titulo-pagina">Principal</h1>
</div>

<div class="tarjetas">
  <div class="tarjeta primera">
    <a href="<?php echo APP_URL ?>usuario">
      <div class="icono">
        <ion-icon name="person"></ion-icon>
        <h2>Usuarios</h2>
      </div>
      <div class="info">
        <p><?php echo $numUsuarios; ?></p>
      </div>
      </a>
  </div>

  <div class="tarjeta segunda">
  <a href="<?php echo APP_URL?>citaAdmin">
    <div class="icono">
      <ion-icon name="calendar"></ion-icon>
      <h2>Citas</h2>
    </div>
    <div class="info">
      <p><?php echo $numCitas ?></p>
    </div>
    </a>
  </div>

  <div class="tarjeta tercera">
  <a href="<?php echo APP_URL?>producto">
    <div class="icono">
      <ion-icon name="bag-handle"></ion-icon>
      <h2>Productos</h2>
    </div>
    <div class="info">
      <p><?php echo $numProductos ?></p>
    </div>
    </a>
  </div>

  <div class="tarjeta cuarta">
  <a href="<?php echo APP_URL?>proveedor">
    <div class="icono">
      <ion-icon name="document-text"></ion-icon>
      <h2>Proveedores</h2>
    </div>
    <div class="info">
      <p><?php echo $numProveedores ?></p>
    </div>
    </a>
  </div>
</div>

<!-- <h2 class="titulo-sesion">
  <ion-icon name="bar-chart"></ion-icon>
  Estadisticas
</h2> -->

<!-- <div class="grafica">
  <h2 class="titulo-grafica">Grafica</h2>
</div> -->

<!-- <div class="estadisticas-max-min">
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
</div> -->

<h2 class="titulo-sesion">
  <ion-icon name="cart"></ion-icon>
  Stock
</h2>

<div class="producto-max-min-stock">
  <div class="tarjeta-producto">
    <div class="producto max">
      <h2 class="titulo-producto">Producto con mas stock</h2>
      <div class="info">
        <img class="imagen-producto" src="<?php echo APP_URL ?>assets/images/producto/<?php echo $productoMaxStock->getImagen(); ?>" alt="">
        <p class="titulo">
          <?php echo $productoMaxStock->getNombre(); ?>
        </p>
        <p class="estadistica">
          <?php echo $productoMaxStock->getStock(); ?>
        </p>
      </div>
    </div>
  </div>
  <div class="tarjeta-producto">
    <div class="producto min">
      <h2 class="titulo-producto">Producto con menos stock</h2>
      <div class="info">
        <img class="imagen-producto" src="<?php echo APP_URL ?>assets/images/producto/<?php echo $productoMinStock->getImagen(); ?>" alt="">
        <p class="titulo">
          <?php echo $productoMinStock->getNombre(); ?>
        </p>
        <p class="estadistica">
          <?php echo $productoMinStock->getStock(); ?>
        </p>
      </div>
    </div>
  </div>
</div>

<?php
require_once 'app/views/template/parteInferiorAdmin.php';
?>