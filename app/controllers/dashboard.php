<?php 
    class Dashboard extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('Dashboard::construct -> Inicio de Dashboard');
        }

        public function render(){
            $this->view->render('dashboard/index');
        }


    } 

?>