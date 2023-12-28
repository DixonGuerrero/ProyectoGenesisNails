<?php
    namespace app\models;
    class viewsModel{
        protected function obtenerVistaModelo($vista){
            
            
            $vistas = [
        'ACliente',
        'CAdministrador',
        'Formulario',
        'home',
        'Login',
        'MCliente',
        'PAdministrador'
    ];

            if(in_array(strtolower($vista), array_map('strtolower', $vistas))):
                if(is_file("./app/views/".$vista.".php")){
                    $contenido = "./app/views/".$vista.".php";
                 }else{
                    $contenido="404";
                }
            elseif($vista=="login"):
                $contenido="login";
            else:
                $contenido= "404";
            endif;


            return $contenido;
        }
    }


?>
