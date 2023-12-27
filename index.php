<!--Incluimos la session---------->
    <?php
        require_once"./config/app.php";
        require_once"./autoload.php";
        include"./inc/sessionStar.php";

        //Validamos la vista actual si no existe lo enviamos a login
        if(isset($_GET['views'])){
            $url = explode("/",$_GET['views']);
        }else{
            $url = ["home"];
        }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
      //Incluimos el head
      include"./inc/head.php";
    ?>
</head>
<body>
    <!--Incluimos Barra de navegacion---------->
    <?php

    //Incluimos el controlador de las vista
        use app\controllers\viewsController;

        $viewsController =  new viewsController();
        $vista = $viewsController->obtenerVistaControlador($url[0]);

    //Incluimos la vista
        if($vista=="login" || $vista=="404"):
            require_once "./app/views/".$vista.".php";
        else:
            require_once $vista;
        endif;
        
       
        
     include"./inc/script.php";
    ?>
</body>
</html>