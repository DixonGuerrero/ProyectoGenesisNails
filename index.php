<?php
    error_reporting(E_ALL);
    ini_set('ignore_repeated_errores', TRUE);
    ini_set('display_errors', FALSE);
    ini_set('log_errors', TRUE);
    ini_set('error_log', 'C:\laragon\www\Proyectos\ProyectoGenesisNails2\php-errors.log');
    error_log('Inicio de la aplicacion');

    //Incluimos algunos archivos
    require_once 'vendor/autoload.php';
    require_once 'loadenv.php';
      

    require_once APP_URL.'$libs/api.php'; 
    require_once APP_URL.'php/utils.php';
    require_once APP_URL.'classes/session.php';
    require_once APP_URL.'libs/controller.php';
    require_once APP_URL.'classes/sessionController.php';
    require_once APP_URL.'classes/infomensajes.php';
    require_once APP_URL.'classes/errormensajes.php';
    require_once APP_URL.'classes/exitomensajes.php';
    require_once APP_URL.'classes/alertas.php';
   
    require_once APP_URL.'libs/model.php';
    require_once APP_URL.'libs/view.php';
    require_once APP_URL.'libs/app.php';
    require_once APP_URL.'libs/IModel.php';

    require_once APP_URL.'config/config.php';

    //Incluimos los modelos y controladores
    require_once APP_URL.'app/models/usuarioModel.php';
    require_once APP_URL.'app/models/categoriaModel.php';
    require_once APP_URL.'app/models/marcaModel.php';
    require_once APP_URL.'app/models/citaAdminModel.php';
    require_once APP_URL.'app/controllers/categoria.php';
    require_once APP_URL.'app/controllers/marca.php';
    require_once APP_URL.'app/controllers/citaAdmin.php';
    require_once APP_URL.'app/models/usuarioModel.php';
    require_once APP_URL.'app/controllers/usuario.php';
    require_once APP_URL.'app/models/productoModel.php';
    require_once APP_URL.'app/controllers/producto.php';
    require_once APP_URL.'app/models/proveedorModel.php';
    require_once APP_URL.'app/controllers/proveedor.php';
    require_once APP_URL.'app/models/servicioModel.php';


    //Iniciamos la aplicacion GO!!
    $app = new App();

