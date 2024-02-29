<?php 
    class DashAdmin extends Controller{
        function __construct(){
            parent::__construct();
            error_log('Home::construct -> Inicio de Home');
        }

        public function render(){
            $this->view->render('dashadmin/index');
        }


    }
?>