<?php
    error_reporting(E_ALL);
    ini_set('ignore_repeated_errores', TRUE);
    ini_set('display_errors', FALSE);
    ini_set('log_errors', TRUE);
    ini_set('error_log', 'C:\laragon\www\Proyectos\ProyectoGenesisNails2\php-errors.log');
    error_log('Inicio de la aplicacion');

    define('APP_URL',__DIR__.'/');

    require_once (__DIR__.'/loadenv.php');
    require_once (__DIR__.'/config/config.php');
    //Incluimos algunos archivos
    require_once (__DIR__.'/vendor/autoload.php');
    
      

    require_once (__DIR__.'/libs/api.php'); 
    require_once (__DIR__.'/php/utils.php');
    require_once (__DIR__.'/classes/session.php');
    require_once (__DIR__.'/libs/controller.php');
    require_once (__DIR__.'/classes/sessionController.php');
    require_once (__DIR__.'/classes/infomensajes.php');
    require_once (__DIR__.'/classes/errormensajes.php');
    require_once (__DIR__.'/classes/exitomensajes.php');
    require_once (__DIR__.'/classes/alertas.php');
   
    require_once (__DIR__.'/libs/model.php');
    require_once (__DIR__.'/libs/view.php');
    require_once (__DIR__.'/libs/app.php');
    require_once (__DIR__.'/libs/IModel.php');

   

    //Incluimos los modelos y controladores
    require_once (__DIR__.'/app/models/usuarioModel.php');
    require_once (__DIR__.'/app/models/categoriaModel.php');
    require_once (__DIR__.'/app/models/marcaModel.php');
    require_once (__DIR__.'/app/models/citaAdminModel.php');
    require_once (__DIR__.'/app/controllers/categoria.php');
    require_once (__DIR__.'/app/controllers/marca.php');
    require_once (__DIR__.'/app/controllers/citaAdmin.php');
    require_once (__DIR__.'/app/models/usuarioModel.php');
    require_once (__DIR__.'/app/controllers/usuario.php');
    require_once (__DIR__.'/app/models/productoModel.php');
    require_once (__DIR__.'/app/controllers/producto.php');
    require_once (__DIR__.'/app/models/proveedorModel.php');
    require_once (__DIR__.'/app/controllers/proveedor.php');
    require_once (__DIR__.'/app/models/servicioModel.php');


    //Iniciamos la aplicacion GO!!
    $app = new App();

