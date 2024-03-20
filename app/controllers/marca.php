<?php 
    class Marca extends SessionController{
        private $marca;
        function __construct(){
            parent::__construct();
            $this->loadModel('MarcaModel');
            $this->marca = new MarcaModel();
            error_log('Marca::construct -> Inicio de Marca');
        }

        //TODO: Implementar la función para marca

    }

?>