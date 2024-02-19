<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Genesis Nails</title>
  <link rel="stylesheet" href="./assets/css/Login.css">
</head>
<body>
  
    <!--Login-->
    <div class="login">
      <div class="contendorLogin">
        <form action="" class="formulario_login" method="POST">
          <h1>Login</h1>
          <div class="input_box">
            <input
              type="text"
              name="nombre"
              placeholder="Nombre de usuario"
              pattern="[a-zA-Z0-9]{3,20}"
              required
            />
            <i class="bx bxs-user"></i>
          </div>
          <div class="input_box">
            <input
              type="password"
              name="nombre"
              placeholder="Password"
              pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,20}"
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
            <p>No tienes una cuenta? <a href="Formulario">Registrate</a></p>
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