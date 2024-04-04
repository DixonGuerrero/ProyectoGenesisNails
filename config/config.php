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
    date_default_timezone_set("America/Bogota");