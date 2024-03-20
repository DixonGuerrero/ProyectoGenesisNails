<?php 

    class EntradaModel extends Model{
        private $id_entrada;


        function __construct(){
            parent::__construct();
            error_log('EntradaModel::construct -> Inicio de EntradaModel');
        }


    }
?>