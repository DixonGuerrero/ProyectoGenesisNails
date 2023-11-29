<?php
//Destruimos la session y redireccionamos hacia el home

    session_destroy();


    //Redireccionamos
        if(headers_sent()):
            //con JS
            echo "<script> window.location.href='index.php?vista=home'<script/>";
        else:
            //con PHP
            header("Location: index.php?vista=home");
        endif;


?>