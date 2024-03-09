<?php 
    class Salida extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('Salida::construct -> Inicio de Salida');
        }
        function render(){
            $this->view->render('salida/index',[
                'usuario' =>$this->usuario
            ]);
        }
    }
?>