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
      

    require_once 'libs/api.php'; 
    require_once 'php/utils.php';
    require_once 'classes/session.php';
    require_once 'libs/controller.php';
    require_once 'classes/sessionController.php';
    require_once 'classes/infomensajes.php';
    require_once 'classes/errormensajes.php';
    require_once 'classes/exitomensajes.php';
    require_once 'classes/alertas.php';
   
    require_once 'libs/model.php';
    require_once 'libs/view.php';
    require_once 'libs/app.php';
    require_once 'libs/IModel.php';

    require_once 'config/config.php';

    //Incluimos los modelos y controladores
    require_once 'app/models/usuarioModel.php';
    require_once 'app/models/categoriaModel.php';
    require_once 'app/models/marcaModel.php';
    require_once 'app/models/citaAdminModel.php';
    require_once 'app/controllers/categoria.php';
    require_once 'app/controllers/marca.php';
    require_once 'app/controllers/citaAdmin.php';
    require_once 'app/models/usuarioModel.php';
    require_once 'app/controllers/usuario.php';
    require_once 'app/models/productoModel.php';
    require_once 'app/controllers/producto.php';
    require_once 'app/models/proveedorModel.php';
    require_once 'app/controllers/proveedor.php';
    require_once 'app/models/servicioModel.php';


    //Iniciamos la aplicacion GO!!
    $app = new App();

