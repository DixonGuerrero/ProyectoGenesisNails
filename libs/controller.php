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
            $url = 'app/models/' . $model . 'model.php';

            if(file_exists($url)){
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
    }

?>