<?php

    class Model{

        public $api;
        
        function __construct(){
            error_log('Model::construct -> Inicio de Model');
            $this->api = new API($_SESSION['token']);
        }

        
    }
?>