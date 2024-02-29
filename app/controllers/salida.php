<?php 
    class Salida extends Controller{
        function __construct(){
            parent::__construct();
            error_log('Salida::construct -> Inicio de Salida');
        }
        function render(){
            $this->view->render('salida/index');
        }
    }
?>