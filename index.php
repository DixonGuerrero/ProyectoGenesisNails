<!--Incluimos la session---------->
    <?php
        include"./inc/sessionStar.php";
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

    //Validacion para cargar vistas
        if(!isset($_GET['vista']) || $_GET['vista']==""):
            $_GET['vista']="login";
        endif;

        if(is_file("./app/views/".$_GET['vista'].".php") && $_GET['vista']!="Login" &&  $_GET['vista']!="404" ):
            

            
            //Cargamos la vista
            include "./app/views/".$_GET['vista'].".php";
            
            //Incluimos es scritp de JS
            include"./inc/script.php";
        else:
            if($_GET['vista']=="login"):
                include"./app/views/login.php";
            else:
                include"./app/views/404.php";
            endif;
        endif;
        

    ?>
</body>
</html>