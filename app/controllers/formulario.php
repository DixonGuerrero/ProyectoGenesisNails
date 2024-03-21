<?php 


    class Formulario extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('Formulario::construct -> Inicio de Formulario');
        }

        public function render(){
            $this->view->render('formulario/index',[]);
        }

        function nuevoUsuario(){
            error_log('Formulario::nuevoUsuario -> inicio de nuevoUsuario');
            
                if($this->existeParametrosPost(['nombres','apellidos','telefono','email','usuario','clave1','clave2'])){

                    error_log('Formulario::nuevoUsuario -> Existen parametros POST');

                    $nombres = limpiarCadena($this->obtenerPost('nombres'));
                    $apellidos = limpiarCadena($this->obtenerPost('apellidos'));
                    $telefono = limpiarCadena($this->obtenerPost('telefono'));
                    $correo = limpiarCadena($this->obtenerPost('email'));
                    $usuario = limpiarCadena($this->obtenerPost('usuario'));
                    $contrasena = limpiarCadena($this->obtenerPost('clave1'));
                    $contrasena2 = limpiarCadena($this->obtenerPost('clave2'));

                    if($nombres == '' || $apellidos == '' || $telefono == '' || $correo == '' || $usuario == '' || $contrasena == '' || $contrasena2 == ''){
                        $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');

                        http_response_code(400);
                        echo $this->alerta->simple()->error()->getAlerta();
                        exit();
                    }

                    if($contrasena != $contrasena2){
                        $this->alerta = new Alertas('ERROR', 'Las contraseñas no coinciden');

                        http_response_code(400);
                        echo $this->alerta->simple()->error()->getAlerta();
                        exit();
                    }

                    $user = new UsuarioModel();
                    $user->setNombres($nombres);
                    $user->setApellidos($apellidos);
                    $user->setTelefono($telefono);
                    $user->setEmail($correo);
                    $user->setUsuario($usuario);
                    $user->setPassword($contrasena);

                    $respuesta = $user->registrar();
                    error_log('Formulario::nuevoUsuario -> respuesta: ' . json_encode($respuesta));
                    if($respuesta['status'] != 200){
                        $msg = $respuesta['response']['message'];
                        $this->alerta = new Alertas('ERROR', $msg);
                        http_response_code(400);
                        echo $this->alerta->simple()->error()->getAlerta();
                        exit();
                    }

                    if($respuesta['status'] == 200){
                        //Redireccionamos al login
                        $this->alerta = new Alertas('EXITO', 'Usuario creado correctamente, ahora puedes iniciar sesion');
                        http_response_code(200);
                        
                        echo $this->alerta->redireccionar('login')->exito()->getAlerta();

                        exit();
                    }


                }else{
                    error_log('Formulario::nuevoUsuario -> No existen parametros POST');
                    $this->redireccionar('formulario', ['error' => ErrorMensajes::ERROR_FORMULARIO_NUEVOUSUARIO]);
                }

        }


    }
?>