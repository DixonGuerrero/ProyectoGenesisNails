<?php 
    class Errores extends Controller{

        function __construct(){
            parent::__construct();
            error_log('Errores::construct -> Inicio de Errores');
        }

        function render(){
            error_log('Errores::render -> Inicio de render');
            $this->view->render('errores/index');
        }   

        
    }
?>