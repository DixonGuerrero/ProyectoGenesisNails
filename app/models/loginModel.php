<?php 
    class LoginModel extends Model{
        function __construct(){
            parent::__construct();
            error_log('LoginModel::construct -> Inicio de LoginModel');
        }

        function iniciarSesion($usuario, $password){
            try {
               
                $respuesta = $this->api->login([
                    'usuario' => $usuario,
                    'password' => $password
                ]);

                if($respuesta['token']){
                    error_log('LoginModel::iniciarSesion -> Exito al iniciar sesion');
                    return $respuesta;
                }
                error_log('LoginModel::iniciarSesion -> Error al iniciar sesion');
                return $respuesta;

                

            } catch (Exception $e) {
                error_log('LoginModel::iniciarSesion -> ERROR: ' . $e);
            }
        }

        function obtenerPersona($id){
            try {
                $respuesta = $this->api->obtenerUno('persona',$id);

                return $respuesta;
            } catch (Exception $e) {
                error_log('LoginModel::obtenerPersona -> ERROR: ' . $e);
            }
        }


    }
    
?>