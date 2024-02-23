<?php 

    class PAdministrador extends SessionController{

        function __construct(){
            parent::__construct();
            error_log('PAdministrador::construct -> Inicio de PAdministrador');

        }

        function render(){
            $this->view->render('padministrador/index');
        }
    }
?>