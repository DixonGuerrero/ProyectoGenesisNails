<?php 
    class Formulario extends Controller{
        function __construct(){
            parent::__construct();
            error_log('Formulario::construct -> Inicio de Formulario');
        }

        public function render(){
            $this->view->render('formulario/index');
        }
    }
?>