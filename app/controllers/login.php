<?php

    class Login extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('Login::construct -> Inicio de Login');
        }

        public function render(){
            $this->view->render('login/index',[]);
        }

        public function iniciarSesion(){
            error_log('Login::iniciarSesion -> inicio de iniciarSesion');
            
            if($this->existeParametrosPost(['usuario','password'])){
                

                $usuario = limpiarCadena($this->obtenerPost('usuario'));
                $contrasena = limpiarCadena($this->obtenerPost('password'));

                if($usuario == '' || $contrasena == ''){
                    $this->redireccionar('login', ['error' => ErrorMensajes::ERROR_LOGIN_INICIARSESION_VACIO]);
                    return;
                }

                
                $respuesta = $this->model->iniciarSesion($usuario, $contrasena);


                if(!$respuesta['token']){
                    error_log('Login::iniciarSesion -> Error al iniciar sesion'. json_encode($respuesta));
                    $this->redireccionar('login', ['info' => InfoMensajes::encriptarMensaje($respuesta['message'])]);
                    return;
                }

                $token = $respuesta['token'];
                $this->model->api->setToken($token);
                error_log('Login::iniciarSesion -> Exito al iniciar sesion-> Actualizamos Token: ' . $token);


                $tokenId = $this->session->validacionToken($token);
                error_log('Login::iniciarSesion -> tokenId: ' . $tokenId);

                if($tokenId == NULL){
                    error_log('Login::iniciarSesion -> Error al iniciar sesion -> No hay id: ' . $tokenId);
                    $this->redireccionar('login', ['error' => ErrorMensajes::ERROR_LOGIN_INICIARSESION_500]);
                    return;
                }

                $persona = $this->model->obtenerPersona($tokenId);

                error_log('Login::iniciarSesion -> persona: ' . json_encode($persona));

                if($persona['message']){
                    error_log('Login::iniciarSesion -> Error al iniciar sesion -> No hay persona');
                    $this->redireccionar('login', ['error' => ErrorMensajes::ERROR_LOGIN_INICIARSESION_500]);
                    return;
                }

                 $user = new UserModel();
                 error_log('Login::iniciarSesion -> Nuevo Usuario');

                 $user->asignacion($persona);
                    error_log('Login::iniciarSesion -> Asignamos datos a nuevo Usuario: '. $user->getId());

                if($user->getId() == NULL){

                    error_log('Login::iniciarSesion -> Error al iniciar sesion -> No hay id');
                    $this->redireccionar('login', ['error' => ErrorMensajes::ERROR_LOGIN_INICIARSESION_500]);
                    return;
                }
                error_log('Login::iniciarSesion -> Iniciamos sesion'. json_encode($user). ' token: ' . $token);
                $this->initialize($user, $token);





                /*Despues de iniciar la session($this->initialize), debemos actualizar la api
                $this->model->api->setToken();*/



            }else{
                error_log('Login::iniciarSesion -> No existen parametros POST');
                $this->redireccionar('login', ['error' => ErrorMensajes::ERROR_LOGIN_INICIARSESION_VACIO]);
            }
        }

    }