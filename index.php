<?php
    error_reporting(E_ALL);
    ini_set('ignore_repeated_errores', TRUE);
    ini_set('display_errors', FALSE);
    ini_set('log_errors', TRUE);
    ini_set('error_log', 'C:\laragon\www\Proyectos\ProyectoGenesisNails2\php-errors.log');
    error_log('Inicio de la aplicacion');

    //Incluimos algunos archivos
    require_once (BASE_PATH.'vendor/autoload.php');
    require_once (BASE_PATH.'loadenv.php');
      
  
    require_once(BASE_PATH.'libs/api.php'); 
    require_once (BASE_PATH.'php/utils.php');
    require_once (BASE_PATH.'classes/session.php');
    require_once (BASE_PATH.'libs/controller.php');
    require_once (BASE_PATH.'classes/sessionController.php');
    require_once (BASE_PATH.'classes/infomensajes.php');
    require_once (BASE_PATH.'classes/errormensajes.php');
    require_once (BASE_PATH.'classes/exitomensajes.php');
    require_once (BASE_PATH.'classes/alertas.php');
   
    require_once (BASE_PATH.'libs/model.php');
    require_once (BASE_PATH.'libs/view.php');
    require_once (BASE_PATH.'libs/app.php');
    require_once (BASE_PATH.'libs/IModel.php');

    require_once (BASE_PATH.'config/config.php');

    //Incluimos los modelos y controladores
    require_once (BASE_PATH.'app/models/usuarioModel.php');
    require_once (BASE_PATH.'app/models/categoriaModel.php');
    require_once (BASE_PATH.'app/models/marcaModel.php');
    require_once (BASE_PATH.'app/models/citaAdminModel.php');
    require_once (BASE_PATH.'app/controllers/categoria.php');
    require_once (BASE_PATH.'app/controllers/marca.php');
    require_once (BASE_PATH.'app/controllers/citaAdmin.php');
    require_once (BASE_PATH.'app/models/usuarioModel.php');
    require_once (BASE_PATH.'app/controllers/usuario.php');
    require_once (BASE_PATH.'app/models/productoModel.php');
    require_once (BASE_PATH.'app/controllers/producto.php');
    require_once (BASE_PATH.'app/models/proveedorModel.php');
    require_once (BASE_PATH.'app/controllers/proveedor.php');
    require_once (BASE_PATH.'app/models/servicioModel.php');


    //Iniciamos la aplicacion GO!!
    $app = new App();

