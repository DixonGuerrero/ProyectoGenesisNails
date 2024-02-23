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
                        $this->redireccionar('formulario', ['error' => ErrorMensajes::ERROR_FORMULARIO_NUEVOUSUARIO_VACIO]);
                        return;
                    }

                    if($contrasena != $contrasena2){
                        $this->redireccionar('formulario', ['error' => ErrorMensajes::ERROR_FORMULARIO_NUEVOUSUARIO_PASSWORDS]);
                        return;
                    }

                    $user = new UserModel();
                    $user->setNombres($nombres);
                    $user->setApellidos($apellidos);
                    $user->setTelefono($telefono);
                    $user->setEmail($correo);
                    $user->setUsuario($usuario);
                    $user->setPassword($contrasena);

                    $respuesta = $user->guardar();
                    error_log('Formulario::nuevoUsuario -> respuesta: ' . json_encode($respuesta));
                    if($respuesta['message']){
                        $this->redireccionar('formulario', ['info' => InfoMensajes::encriptarMensaje($respuesta['message'])]);
                    }

                    if($respuesta['token']){
                        error_log('Formulario::nuevoUsuario -> Exito al crear el usuario');
                        $this->redireccionar('login', ['exito' => ExitoMensajes::EXITO_FORMULARIO_NUEVOUSUARIO]);                
                    }


                }else{
                    error_log('Formulario::nuevoUsuario -> No existen parametros POST');
                    $this->redireccionar('formulario', ['error' => ErrorMensajes::ERROR_FORMULARIO_NUEVOUSUARIO]);
                }

        }


    }
?>