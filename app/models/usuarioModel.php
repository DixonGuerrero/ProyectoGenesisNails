<?php 
    class UsuarioModel extends Model{

        private $id;
        private $nombres;
        private $apellidos;
        private $email;
        private $telefono;
        private $role;
        private $imagen;
        private $cargo;
        private $usuario;
        private $password;

        
        public function __construct(){
            parent::__construct(); 

            $this->nombres = '';
            $this->apellidos = '';
            $this->email = '';
            $this->telefono = '';
            $this->role = '';
            $this->imagen = '';
            $this->cargo = '';
            $this->usuario = '';
            $this->password = '';
            

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
                    'cargo' => $this->cargo,
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
            $data = [];
            try {
                $data = $this->api->obtenerTodo('personas');

                foreach ($data as $item) {
                    $user = new UsuarioModel();
                    $user->setId($item['id']);
                    $user->setNombres($item['nombres']);
                    $user->setApellidos($item['apellidos']);
                    $user->setEmail($item['email']);
                    $user->setTelefono($item['telefono']);
                    $user->setImagen($item['imagen']);
                    $user->setRole($item['rol']);
                    $user->setCargo($item['cargo']);
                    $user->setUsuario($item['usuario']);
                    $user->setPassword($item['password']);
                    array_push($data,$user);
                }

                return $data;
                
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
                $this->api->eliminar('persona',$id);
                return true;
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
                    'email' => $this->email,
                    'telefono' => $this->telefono,
                    'imagen' => $this->imagen,
                    'rol' => $this->role,
                    'cargo' => $this->cargo,
                    'usuario' => $this->usuario,
                    'password' => $this->password
                ];

                $data = json_encode($data);
                $this->api->actualizar('persona',$data,$this->id);

                $datosA = $this->obtenerUno($this->id);
                $user = new UsuarioModel();

                $user->setId($datosA->getId());
                $user->setNombres($datosA->getNombres());
                $user->setApellidos($datosA->getApellidos());
                $user->setEmail($datosA->getEmail());
                $user->setTelefono($datosA->getTelefono());
                $user->setRole($datosA->getRole());
                $user->setImagen($datosA->getImagen());
                $user->setCargo($datosA->getCargo());
                $user->setUsuario($datosA->getUsuario());
                $user->setPassword($datosA->getPassword());


                return true;
            } catch (Exception $e) {
                error_log('UserModel::actualizar -> ERROR: ' . $e);
                return false;
            }
        }

        public function asignarDatos($data){
            $this->setId($data['id_persona']);
            $this->setNombres($data['nombres']);
            $this->setApellidos($data['apellidos']);
            $this->setEmail($data['correo']);
            $this->setTelefono($data['telefono']);
            $this->setRole($data['rol']);
            $this->setImagen($data['imagen']);

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

        public function getCargo(){ return $this->cargo;
        }

        public function getUsuario(){ return $this->usuario;
        }

        public function getPassword(){ return $this->password;
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

        public function setImagen($imagen){ $this->imagen = $imagen;
        }

        public function setCargo($cargo){ $this->cargo = $cargo;
        }

        public function setUsuario($usuario){ $this->usuario = $usuario;
        }

        public function setPassword($password){ $this->password = $password;
        }




        
    }
?>