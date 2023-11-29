<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="./assets/images/logo .ico" />

   
    
    
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!---Agregamos link para los estilos de cada pagina---------->  

      <!--Importamos el array--->
      <?php

        require_once"./inc/listaVistas.php";


      /*Validamos la vista actual, si no esta en la lista de vistas
      entonces vamos a cargar los estilos de la vista 404, ya en el index
      hacemos la validacion y mostramos la vista 404 si no esta la vista 
      que pongamos en la url */
      if(in_array(strtolower($_GET['vista']), array_map('strtolower', $vistas))):
        echo '<link rel="stylesheet" href="./assets/css/' . $_GET['vista'] . '.css">';
      else:
        
        echo '<link rel="stylesheet" href="./assets/css/404.css">';
        echo '<link rel="stylesheet" href="./assets/css/bulma.min.css">';
      endif;
      ?>

    <title>Génesis Nails</title>