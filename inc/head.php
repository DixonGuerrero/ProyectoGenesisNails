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
// Incluye el archivo de lista de vistas
require_once "./inc/listaVistas.php";

// Verifica si no se ha establecido la clave 'vista' o si es diferente de "Login" y "404"
if (isset($_GET['views']) && $_GET['views']!="") {

    // Validamos la vista actual, si no está en la lista de vistas
    // cargamos los estilos de la vista 404
    if ( in_array(strtolower($_GET['views']), array_map('strtolower', $vistas))) {
        // Si la vista está en la lista, cargamos los estilos específicos de esa vista
        echo '<link rel="stylesheet" href="./assets/css/' . $_GET['views'] . '.css">';
    } else {
        
        // Si la vista no está en la lista, cargamos los estilos de la vista 404
        echo '<link rel="stylesheet" href="./assets/css/404.css">';
        echo '<link rel="stylesheet" href="./assets/css/bulma.min.css">';
    }

} elseif (empty($_GET['views'])) {
    // Si la clave 'vista' está establecida
    echo '<link rel="stylesheet" href="./assets/css/Home.css">';
} else {
    echo '<link rel="stylesheet" href="./assets/css/404.css">';
    echo '<link rel="stylesheet" href="./assets/css/bulma.min.css">';
    // Si no se cumplen las condiciones anteriores, cargamos los estilos de la vista Home
}
?>


    <title>Génesis Nails</title>