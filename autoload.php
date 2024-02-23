<?php 
     spl_autoload_register(function($clase){
        //Almacenamos la ruta
        $archivo = __DIR__."/".$clase.".php";
 
        //Invertimos archivos para evitar conflictos
        $archivo = str_replace("\\","/",$archivo);
 
        //Validamos que el archivo exista
        if(is_file($archivo)){
             require_once($archivo);
        }
    }); 
?>