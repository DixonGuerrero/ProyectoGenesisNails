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
                
                error_log('Login::iniciarSesion -> Existen parametros POST');

                $usuario = limpiarCadena($this->obtenerPost('usuario'));
                $contrasena = limpiarCadena($this->obtenerPost('password'));

                if($usuario == '' || $contrasena == ''){
                   $this->alerta = new Alertas('ERROR','Todos los campos son obligatorios');

                    http_response_code(400);

                    header('Content-Type: application/json');

                    // Envía la respuesta
                    echo $this->alerta->simple()->error()->getAlerta();

                    // Termina la ejecución del script
                    exit();
                }

                //TODO: Validar password y usuario

                
                $respuesta = $this->model->iniciarSesion($usuario, $contrasena);

                error_log('Login::iniciarSesion -> respuesta: ' . json_encode($respuesta));

                if ($respuesta['status'] != 200) {
                    $msg = $respuesta['response']['message'];
                    $this->alerta = new Alertas('ERROR', $msg);

                    http_response_code(400);
                
                    header('Content-Type: application/json');
                
                    // Envía la respuesta
                    echo $this->alerta->simple()->error()->getAlerta();
                
                    // Termina la ejecución del script
                    exit();
                }

                $token = $respuesta['response']['token'];
                $this->model->api->setToken($token);
                error_log('Login::iniciarSesion -> Exito al iniciar sesion-> Actualizamos Token: ' . $token);


                $tokenId = $this->session->validacionToken($token);
                error_log('Login::iniciarSesion -> tokenId: ' . $tokenId);

                if($tokenId == NULL){
                    $this->alerta = new Alertas('ERROR', ErrorMensajes::ERROR_LOGIN_INICIARSESION_500);
                    $this->alerta->simple()->error()->getAlerta();
                    
                    http_response_code(500);

                    header('Content-Type: application/json');

                    // Envía la respuesta
                    echo $this->alerta->simple()->error()->getAlerta();

                    // Termina la ejecución del script

                    exit();

                }

                $persona = $this->model->obtenerPersona($tokenId);

                error_log('Login::iniciarSesion -> persona: ' . json_encode($persona));

                if($persona['status'] != 200){
                    $this->alerta = new Alertas('ERROR', ErrorMensajes::ERROR_LOGIN_INICIARSESION_500);
                    $this->alerta->simple()->error()->getAlerta();
                    
                    http_response_code(500);

                    header('Content-Type: application/json');

                    // Envía la respuesta
                    echo $this->alerta->simple()->error()->getAlerta();

                    // Termina la ejecución del script

                    exit();


                }

                $persona = (array)$persona['response'];



                 $user = new UsuarioModel();
                 error_log('Login::iniciarSesion -> Nuevo Usuario');

                 $user->asignarDatos($persona);
                    error_log('Login::iniciarSesion -> Asignamos datos a nuevo Usuario: '. $user->getId());

                if($user->getId() == NULL){
                    $this->alerta = new Alertas('ERROR', ErrorMensajes::ERROR_LOGIN_INICIARSESION_500);
                    $this->alerta->simple()->error()->getAlerta();
                    
                    http_response_code(500);

                    header('Content-Type: application/json');

                    // Envía la respuesta
                    echo $this->alerta->simple()->error()->getAlerta();

                    // Termina la ejecución del script

                    exit();
                    
                }

                $this->initialize($user, $token);

               
            }else{
                $this->alerta = new Alertas('ERROR', ErrorMensajes::ERROR_LOGIN_INICIARSESION_VACIO);
                $this->alerta->simple()->error()->getAlerta();
                
                http_response_code(400);

                header('Content-Type: application/json');

                // Envía la respuesta
                echo $this->alerta;

                // Termina la ejecución del script

                exit();
            }
        }

        public function cerrarSesion(){
            error_log('Login::cerrarSesion -> inicio de cerrarSesion');

            $this->logout();
            
            $this->alerta = new Alertas('Exito', 'Sesión cerrada');
            
            echo $this->alerta->recargar()->exito()->getAlerta();
            
            exit();

        }

    }