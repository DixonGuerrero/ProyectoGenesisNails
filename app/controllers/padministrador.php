<?php 
    class PAdministrador extends Controller{

        function __construct(){
            parent::__construct();
            error_log('PAdministrador::construct -> Inicio de PAdministrador');

        }

        function render(){
            $this->view->render('padministrador/index');
        }
    }
?>