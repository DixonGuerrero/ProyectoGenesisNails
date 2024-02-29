<?php 
    class Entrada extends Controller{
        function __construct(){
            parent::__construct();
            error_log('Entrada::construct -> Inicio de Entrada');
        }

        public function render(){
            $this->view->render('entrada/index');
        }

        public function prueba(){
           
        }
    }
    {
        # code...
    }
?>