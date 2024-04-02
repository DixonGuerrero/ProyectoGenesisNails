<?php
require_once 'app/controllers/errores.php';

class App{

    function __construct(){

        $url = isset($_GET['url']) ? $_GET['url']: null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        // cuando se ingresa sin definir controlador
        if(empty($url[0])){
            $archivoController = 'app/controllers/home.php';
            require_once $archivoController;
            $controller = new Home();
            $controller->loadModel('home');
            $controller->render();
            return false;
        }
        $archivoController = 'app/controllers/' . $url[0] . '.php';

        if(file_exists($archivoController)){
            error_log('App::construct -> controlador encontrado: ' . $archivoController);
            require_once $archivoController;

            // inicializar controlador
            $controller = new $url[0];
            error_log('App::construct -> controlador cargado: ' . $url[0]);
            $controller->loadModel($url[0]);

            // si hay un método que se requiere cargar
            if(isset($url[1])){
                error_log('App::construct -> metodo encontrado: ' . json_encode($url));
                if(method_exists($controller, $url[1])){
                    if(isset($url[2])){
                        //el método tiene parámetros
                        //sacamos e # de parametros
                        $nparam = sizeof($url) - 2;
                        //crear un arreglo con los parametros
                        $params = [];
                        //iterar
                        for($i = 0; $i < $nparam; $i++){
                            array_push($params, $url[$i + 2]);
                        }
                        //pasarlos al metodo   
                        $controller->{$url[1]}($params);
                    }else{
                        $controller->{$url[1]}();    
                    }
                }else{
                    $controller = new Errores();
                    $controller->render();
                }
            }else{
                $controller->render();
            }
        }else{
            $controller = new Errores();
            $controller->render();  
        }
    }
}

?>