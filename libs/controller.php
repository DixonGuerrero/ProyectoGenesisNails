<?php 
    class Controller{
       public $view;
       public $model;

        function __construct(){
            error_log('Controller::construct -> Inicio de Controller');
            $this->view = new View();
        }

        public function loadModel($model){
            $url = 'models/' . $model . 'model.php';

            if(file_exists($url)){
                require $url;

                $modelName = $model . 'Model';
                $this->model = new $modelName();
            }
        }
    }

?>