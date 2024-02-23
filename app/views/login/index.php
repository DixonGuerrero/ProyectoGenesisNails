<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Genesis Nails</title>
  <link rel="stylesheet" href="./assets/css/Login.css">
  <link rel="stylesheet" href="./assets/css/sweetalert2.min.css">
  <script src="<?php echo APP_URL?>/assets/js/sweetalert2.all.min.js"></script>
</head>
<body>
  <p><?php $this->mostrarMensajes();?></p>
    <!--Login-->
    <div class="login">
      <div class="contendorLogin">
        <form action="<?php echo APP_URL;?>login/iniciarSesion" class="formulario_login" method="POST">
          <h1>Login</h1>
          <div class="input_box">
            <input
              type="text"
              name="usuario"
              id="usuario"
              placeholder="Nombre de usuario"
             
              required
            />
            <i class="bx bxs-user"></i>
          </div>
          <div class="input_box">
            <input
              type="password"
              name="password"
              id="password"
              placeholder="Password"
             
              required
            />
            <i class="bx bxs-lock-alt"></i>
          </div>

          <div class="remember-forgot">
            <label><input type="checkbox" />Recuerdame</label>
            <a href="#"> Has olvidado tu contraseña?</a>
          </div>

          <button type="submit" class="btn">Login</button>

          <div class="register_link">
            <p>No tienes una cuenta? <a href="formulario">Registrate</a></p>
          </div>
        </form>

        <div class="contenedorImagen">
          <figure>
            <img src="./assets/images/logo3.png" alt="" />
          </figure>
        </div>
      </div>
    </div>


</body>
</html>