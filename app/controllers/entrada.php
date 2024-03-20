<?php 
    class Entrada extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('Entrada::construct -> Inicio de Entrada');
        }

        public function render(){
            $this->view->render('entrada/index',[
                'usuario' =>$this->usuario
            ]);
        }

        public function prueba(){
           
        }
    }
    {
        # code...
    }
?>