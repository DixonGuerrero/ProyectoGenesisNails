<?php 
    class CAdministrador extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('CAdministrador::construct -> Inicio de CAdministrador');
        }

        public function render(){
            $this->view->render('cadministrador/index',[]);
        }
    }   
?>  