<?php 
    class Categoria extends SessionController{
        private $categoria;
        function __construct(){
            parent::__construct();
            $this->loadModel('CategoriaModel');
            $this->categoria = new CategoriaModel();
            error_log('Categoria::construct -> Inicio de Categoria');
        }

        //TODO: Implementar las funciónes para categoria
    }
?>