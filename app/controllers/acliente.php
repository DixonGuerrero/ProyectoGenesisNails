<?php 
    class ACliente extends Controller{
        function __construct(){
            parent::__construct();
            error_log('ACliente::construct -> Inicio de ACliente');
        }

        public function render(){
            $this->view->render('acliente/index');
        }
    }

?>