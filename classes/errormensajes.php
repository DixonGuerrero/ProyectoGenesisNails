<?php 

    class ErrorMensajes {
        /*ERROR_CONTROLADOR_METODO_ACCION -> CODIGO DE ERROR SE ENCRIPTA CON MD5 COGIENDO COMO BASE EL NOMBRE DEL CONTROLADOR, EL NOMBRE DEL METODO Y EL NOMBRE DE LA ACCION*/

        const ERROR_LOGIN_LOGIN = '214264208f79b5b205569a353fe740a8'; 
        const ERROR_LOGIN_LOGOUT = 
        '318903128c2cfa4e43e3b133a7b5b803';
        const ERROR_LOGIN_INICIARSESION_VACIO = '41a998abad41ec8b769e3fb46479deac';
        const ERROR_FORMULARIO_NUEVOUSUARIO_VACIO =  'c905445860ee7dcf27706f3f818c1735';
        const ERROR_FORMULARIO_NUEVOUSUARIO=
        'e3b0c44298fc1c149afbf4c8996fb924';
        const ERROR_FORMULARIO_NUEVOUSUARIO_PASSWORDS = 
        '595a42f7cd78dc2a3aba6821f738ecf8';
        const ERROR_LOGIN_INICIARSESION_500 = 
        'D360c45298fchc169afdf4c8996fb524';

        const ERROR_PRODUCTO_NUEVOPRODUCTO_VACIO = '3Cb26g4293fc1c1493fb5f4c8996fZT21';

        const ERROR_PRODUCTO_NUEVOPRODUCTO_500 = 'YcbH6gb2eNfc1ND493fb5f4c8be96fxT51';


        private $listaErrores = [];

        public function __construct(){
            $this->listaErrores = [
                self::ERROR_LOGIN_LOGIN => 'Usuario o contraseña incorrectos',
                self::ERROR_LOGIN_LOGOUT => 'Error al cerrar sesión',
                self::ERROR_LOGIN_INICIARSESION_VACIO => 'Usuario o contraseña vacios',
                self::ERROR_FORMULARIO_NUEVOUSUARIO_VACIO => 'Todos los campos son obligatorios',
                self::ERROR_FORMULARIO_NUEVOUSUARIO => 'Error al crear el usuario',
                self::ERROR_FORMULARIO_NUEVOUSUARIO_PASSWORDS => 'Las contraseñas no coinciden',
                self::ERROR_LOGIN_INICIARSESION_500 => 'Error al iniciar sesión',
                self::ERROR_PRODUCTO_NUEVOPRODUCTO_VACIO => 'Todos los campos son obligatorios',
                self::ERROR_PRODUCTO_NUEVOPRODUCTO_500 => 'Error al crear el producto'
            ];
        }  
        
        public function obtenerMensaje($codigo){
            return $this->listaErrores[$codigo];
        }

        public function existeClave($clave){
            if(array_key_exists($clave, $this->listaErrores)){
                return true;
            }else{
                return false;
            }
        }
    }
   
?>