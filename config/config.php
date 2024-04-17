<?php 


/*Creacion de constantes que ayudaran a 
la navegacion del sitio */
    define('APP_URL',getenv('APP_URL'));

    define('APP_NAME',getenv('APP_NAME'));
    const APP_SESSION_NAME = "NAILS";
    const URL_API = "https://genesisnails.azurewebsites.net/api/";
    //const URL_API = "localhost:3000/api/";

    const KEY_TOKEN = 'prueba123';

    //Obtenemos zona horaria
    date_default_timezone_set("America/Bogota");// En un archivo de configuración inicial o en el index.php principal
    define('BASE_PATH', dirname(__DIR__)); // Esto sube un nivel desde la carpeta 'public'
    