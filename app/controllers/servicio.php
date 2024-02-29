<?php 
    class ServicioAdmin extends Controller{
        function __construct(){
            parent::__construct();
            error_log('ServicioAdmin::construct -> Inicio de ServicioAdmin');
        }

        public function render(){
            $this->view->render('servicio/index');
        }

       
    } 
?>