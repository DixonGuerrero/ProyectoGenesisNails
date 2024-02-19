<?php 
    class MCliente extends Controller{
        function __construct(){
            parent::__construct();
            error_log('MCliente::construct -> Inicio de MCliente');
        }

        public function render(){
            $this->view->render('mcliente/index');
        }
    }
?>