<?php 
    class InfoMensajes{
        public function __construct(){
            error_log('InfoMensajes::construct -> Inicio de InfoMensajes');
        }

        static function encriptarMensaje($mensaje){
            return base64_encode($mensaje);
        }

        static function desencriptarMensaje($mensaje){
            return base64_decode($mensaje);
        }

        
    }
?>