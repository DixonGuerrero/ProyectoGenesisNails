<?php 
    class UsuarioModel extends Model implements IModel{

        private $id;
        private $nombres;
        private $apellidos;
        private $email;
        private $telefono;
        private $role;
        private $imagen;

        private $usuario;
        private $password;
        private $id_cliente;

        
        public function __construct(){
            parent::__construct(); 

            $this->nombres = '';
            $this->apellidos = '';
            $this->email = '';
            $this->telefono = '';
            $this->role = '';
            $this->imagen = '';

            $this->usuario = '';
            $this->password = '';
            $this->id_cliente = 0;

        }

        //Funciones 

        public function guardar(){
            try {
                $data = [
                    'nombres' => $this->nombres,
                    'apellidos' => $this->apellidos,
                    'correo' => $this->email,
                    'telefono' => $this->telefono,
                    'imagen' => $this->imagen,
                    'rol' => $this->role,
                    'usuario' => $this->usuario,
                    'password' => $this->password
                ];

               
                
                $respuesta =  $this->api->crear('persona',$data);

                return $respuesta;
            } catch (Exception $e) {
                error_log('UserModel::guardar -> ERROR: ' . $e);
                return false;
            }
        }
        public function registrar(){
            try {
                $data = [
                    'nombres' => $this->nombres,
                    'apellidos' => $this->apellidos,
                    'correo' => $this->email,
                    'telefono' => $this->telefono,
                    'imagen' => $this->imagen,
                    'rol' => $this->role,
                    'usuario' => $this->usuario,
                    'password' => $this->password
                ];

               
                
                $respuesta =  $this->api->crear('register',$data);

                return $respuesta;
            } catch (Exception $e) {
                error_log('UserModel::guardar -> ERROR: ' . $e);
                return false;
            }
        }

        public function obtenerTodo(){
            $usuarios = [];
            try {
                $data = $this->api->obtenerTodo('persona');

                error_log('UserModel::obtenerTodo -> data: ' . json_encode($data));
                
                foreach ($data['response'] as $item) {
                    $user = new UsuarioModel();
                    $user->asignarDatos($item);
                    array_push($usuarios,$user);
                }

                return $usuarios;
                
            } catch (Exception $e) {
                error_log('UserModel::obtenerTodo -> ERROR: ' . $e);
                return false;
            }
        }

        public function obtenerUno($id){
            try {
                $persona = $this->api->obtenerUno('persona',$id);

               error_log('UserModel::obtenerUno -> persona: ' . json_encode($persona));

               

                $this->asignarDatos($persona['response']);

                return $this;



            } catch (Exception $e) {
                error_log('UserModel::obtenerUno -> ERROR: ' . $e);
                return false;
            }
        }

        

        public function eliminar($id){
            try {
                $respuesta = $this->api->eliminar('persona',$id);
                error_log('UserModel::eliminar -> respuesta: ' . json_encode($respuesta));
                return $respuesta;
            } catch (Exception $e) {
                error_log('UserModel::eliminar -> ERROR: ' . $e);
                return false;
            }
        }

        public function actualizar(){
            try {
                $data = [
                    'nombres' => $this->nombres,
                    'apellidos' => $this->apellidos,
                    'correo' => $this->email,
                    'telefono' => $this->telefono,
                    'imagen' => $this->imagen,
                    'rol' => $this->role,
                    'usuario' => $this->usuario
                ];

                
                $respuesta = $this->api->actualizar('persona',$data,$this->id);

                error_log('UserModel::actualizar -> data: ' . json_encode($respuesta));
 


                //TODO:Reasignar Datos al usuario actual


                return $respuesta;
            } catch (Exception $e) {
                error_log('UserModel::actualizar -> ERROR: ' . $e);
                return NULL;
            }
        }

        public function asignarDatos($data){
            $this->setId($data['id_persona']);
            $this->setNombres($data['nombres']);
            $this->setApellidos($data['apellidos']);
            $this->setUsuario($data['usuario']);
            $this->setPassword($data['password']);
            $this->setEmail($data['correo']);
            $this->setTelefono($data['telefono']);
            $this->setRole($data['rol']);
            $this->setImagen($this->validarImagen($data['imagen']));
            $this->setIdCliente($data['id_cliente']);
        }


        public function actualizarPassword(){
            try {

                $respuesta = $this->api->actualizar('persona',['password' => $this->password],$this->id);

                return $respuesta;

            } catch (Exception $e) {
                error_log('UserModel::actualizarPassword -> ERROR: ' . $e);
                return NULL;
            }
        }
        //Getters 
        public function getId(){ return $this->id;
        }

        public function getNombres(){ return $this->nombres;
        }

        public function getApellidos(){ return $this->apellidos;
        }

        public function getEmail(){ return $this->email;
        }

        public function getTelefono(){ return $this->telefono;
        }

        public function getRole(){ return strtolower($this->role);
        }

        public function getImagen(){ return $this->imagen;
        }



        public function getUsuario(){ return $this->usuario;
        }

        public function getPassword(){ return $this->password;
        }

        public function getIdCliente(){ return $this->id_cliente;
        }

        //Setters

        public function setId($id){ $this->id = $id;
        }

        public function setNombres($nombres){ $this->nombres = $nombres;
        }

        public function setApellidos($apellidos){ $this->apellidos = $apellidos;
        }

        public function setEmail($email){ $this->email = $email;
        }

        public function setTelefono($telefono){ $this->telefono = $telefono;
        }

        public function setRole($role){ $this->role = $role;
        }

        public function setImagen($imagen){ 

           $this->imagen = $imagen;
        }

        public function validarImagen($imagen) {
            error_log('UserModel::validarImagen -> imagen: ' . $imagen);
            
            // Ajusta la ruta según sea necesario para que coincida con la estructura de tu proyecto
            $directorio = __DIR__ . '/../../assets/images/usuario/' . $imagen;



            error_log('UserModel::validarImagen -> directorio: ' . $directorio);

            
        
            if ($imagen == '') {
                error_log('UserModel::validarImagen -> Imagen no especificada');
                return 'default.jpg';
            } else if (file_exists($directorio)) {
                error_log('UserModel::validarImagen -> Imagen existe: ' . $imagen);
                return $imagen;
            } else {
                error_log('UserModel::validarImagen -> Imagen no existe: ' . $imagen);
                return 'default.jpg';
            }
        }

        public function setUsuario($usuario){ $this->usuario = $usuario;
        }

        public function setPassword($password){ $this->password = $password;
        }

        public function setIdCliente($id_cliente){ $this->id_cliente = $id_cliente;
        }
      



        
    }
?>