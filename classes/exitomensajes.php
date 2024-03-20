<?php 

    class ExitoMensajes {
        const EXITO_LOGIN_INICIARSESION = '1b310511b9a366989ea93f535ffc934c';
        const EXITO_LOGOUT = '243557aa3754fad98b66e366faad608c';
        const EXITO_FORMULARIO_NUEVOUSUARIO = 'e3b0c44298fc1c149afbf4c8996fb924';
        const EXITO_PRODUCTO_NUEVOPRODUCTO = 
        '43ASDb42BSfc1c149afbsdc8996fb3VC';

        private $listaExito = [];

        function __construct(){
            $this->listaExito = [
                self::EXITO_LOGIN_INICIARSESION => 'Bienvenido a la aplicación',
                self::EXITO_LOGOUT => 'Sesión cerrada',
                self::EXITO_FORMULARIO_NUEVOUSUARIO => 'Usuario creado con éxito',
                self::EXITO_PRODUCTO_NUEVOPRODUCTO => 'Producto creado con éxito'
            ];
        }

        public function obtenerMensaje($codigo){
            return $this->listaExito[$codigo];
        }

        public function existeClave($clave){
            if(array_key_exists($clave, $this->listaExito)){
                return true;
            }else{
                return false;
            }
        }
    }
?>