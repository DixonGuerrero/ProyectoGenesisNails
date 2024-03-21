<?php 

    class Controller{
       public $view;
       public $model;
       public $alerta; 

        function __construct(){
            error_log('Controller::construct -> Inicio de Controller');
            $this->view = new View();
        }

        public function loadModel($model){

            error_log('Controller::loadModel -> Cargando modelo: '.$model);
            $url = 'app/models/' . $model . 'Model.php';

            error_log('Controller::loadModel -> URL: '.$url);
            if(file_exists($url)){
                error_log('Controller::loadModel -> Existe el archivo: '.$url);

                require_once $url;

                $modelName = $model . 'Model';
                $this->model = new $modelName();
            }

           
        }

        function existeParametrosPost($params){
            foreach($params as $param){
                if(!isset($_POST[$param])){
                    error_log('Controller::existeParametro -> No existe el parametro: '.$param);
                    return false;
                }
            }

            error_log( "ExistPOST: Existen parámetros" );
            return true;
        }

        function existeParametrosGet($params){
            foreach($params as $param){
                if(!isset($_GET[$param])){
                    error_log('Controller::existeParametro -> No existe el parametro: '.$param);
                    return false;
                }
            }
        }

        function obtenerGet($name){
            return $_GET[$name];
        }

        function obtenerPost($name){
            return $_POST[$name];
        }

        function redireccionar($ruta,$mensajes = []){
            $data = [];
            $params = '';

            foreach ($mensajes as $key => $mensaje) {
                array_push($data, $key.'='.$mensaje);   
            }

            $params = join('&',$data);

            if($params != ''){
                $params = '?'.$params;
            }

            header('location:'.APP_URL.$ruta.$params);
        }

        public function cargarImagen($nombre ,$carpeta,$nombreFoto)
        {
            $directorioImagenes = $_SERVER['DOCUMENT_ROOT'] . '/Proyectos/ProyectoGenesisNails2/assets/images/'.$carpeta.'/';


            error_log('Controller::cargarImagen -> Directorio: '.$directorioImagenes);
    
            if (
                $_FILES[$nombreFoto]['name'] != "" &&
                $_FILES[$nombreFoto]['size'] > 0
            ) {
    
                //Validar Directorio
                if (!file_exists($directorioImagenes)) {
                    if (!mkdir($directorioImagenes, 0777)) {
                        $this->alerta = new Alertas('Error', 'No se pudo crear el directorio de imagenes');
    
                        http_response_code(400);
                        header('Content-Type: application/json');
                        echo $this->alerta->simple()->error()->getAlerta();
                        exit();
                    }
                }
    
                //Validar formato de la imagen
                #Verificando formato img#
                if (
                    mime_content_type($_FILES[$nombreFoto]['tmp_name']) != "image/jpeg" &&
                    mime_content_type($_FILES[$nombreFoto]['tmp_name']) != "image/png"
                ) {
                    $this->alerta = new Alertas('Error', 'Formato de imagen no permitido');
    
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }
    
                //Validar tamaño de la imagen
                #Verificando peso de la imagen#
                if (($_FILES[$nombreFoto]['size'] / 1024) > 5120) {
                    $this->alerta = new Alertas('Error', 'Tamaño de imagen no permitido');
    
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }
    
                //Crear Nombre de imagen
                $imagen = str_ireplace(" ", "_", $nombre);
                $imagen = $imagen . "_" . rand(0, 1000);
    
                #Extension de imagen#
                switch (mime_content_type($_FILES[$nombreFoto]['tmp_name'])) {
                    case "image/jpeg":
                        $imagen = $imagen . ".jpg";
                        break;
                    case "image/png":
                        $imagen = $imagen . ".png";
                        break;
                }
    
                chmod($directorioImagenes, 0777);
    
                #Moviendo imagenes al directorio#
                if (!move_uploaded_file(
                    $_FILES[$nombreFoto]['tmp_name'],
                    $directorioImagenes . $imagen
                )) {
                    $this->alerta = new Alertas('Error', 'No se pudo subir la imagen');
    
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }
    

    
    
                return $imagen;
            }
        }
    }

?>