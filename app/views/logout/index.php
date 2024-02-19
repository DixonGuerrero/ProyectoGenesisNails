<?php
//Destruimos la session y redireccionamos hacia el home

    session_destroy();


    //Redireccionamos
        if(headers_sent()):
            //con JS
            echo "<script> window.location.href='Home'<script/>";
        else:
            //con PHP
            header("Location: Home");
        endif;


?>