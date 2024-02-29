<?php 
    class Cita extends Controller{
        function __construct(){
            parent::__construct();
            error_log('Home::construct -> Inicio de Home');
        }

        public function render(){
            $this->view->render('cita/index');
        }


    }
?>