<?php 

    class ProveedorModel extends Model implements IModel{
        private $id_proveedor;
        private $nombre;
        private $direccion;
        private $telefono;
        private $email;
        private $nit;

        public function __construct(){
            parent::__construct(); 

            $this->id_proveedor = '';
            $this->nombre = '';
            $this->direccion = '';
            $this->telefono = '';
            $this->email = '';
            $this->nit = '';

        }

        //Funciones
        public function obtenerTodo(){
            $proveedores = [];
            try {
                
                $data = $this->api->obtenerTodo('proveedor');
                
                foreach($data['response'] as $proveedor){
                    $item = new ProveedorModel();
                    $item->asignarDatos($proveedor);
                    array_push($proveedores, $item);
                }
                return $proveedores;

            } catch (Exception $e) {
                error_log('ProveedorModel::obtenerTodo -> ERROR: ' . $e);
                return [];
            }
        }
        public function obtenerUno($id){
            try {
                $data = $this->api->obtenerUno('proveedor',$id);
                $this->asignarDatos($data['response']);
                return $this;
            } catch (Exception $e) {
                error_log('ProveedorModel::obtenerUno -> ERROR: ' . $e);
                return [];
            }
        }
        public function guardar(){
            try {
                $data = [
                    'nombre' => $this->nombre,
                    'direccion' => $this->direccion,
                    'telefono' => $this->telefono,
                    'email' => $this->email,
                    'nit' => $this->nit
                ];
                $respuesta =  $this->api->crear('proveedor',$data);
                return $respuesta;
            } catch (Exception $e) {
                error_log('ProveedorModel::guardar -> ERROR: ' . $e);
                return false;
            }
        }
        public function actualizar(){
            try {
                $data = [
                    'id_proveedor' => $this->id_proveedor,
                    'nombre' => $this->nombre,
                    'direccion' => $this->direccion,
                    'telefono' => $this->telefono,
                    'email' => $this->email,
                    'nit' => $this->nit
                ];
                $respuesta =  $this->api->actualizar('proveedor',$data,$this->id_proveedor);
                return $respuesta;
            } catch (Exception $e) {
                error_log('ProveedorModel::actualizar -> ERROR: ' . $e);
                return false;
            }
        }
        public function eliminar($id){
            try {
                $response = $this->api->eliminar('proveedor',$id);
                return $response;
            } catch (Exception $e) {
                error_log('ProveedorModel::eliminar -> ERROR: ' . $e);
                return null;
            }

        }
        public function asignarDatos($datos){
            $this->setIdProveedor($datos['id_proveedor']);
            $this->setNombre($datos['nombre']);
            $this->setDireccion($datos['direccion']);
            $this->setTelefono($datos['telefono']);
            $this->setEmail($datos['email']);
            $this->setNit($datos['nit']);
            
        }

        //Getters
        public function getIdProveedor(){
            return $this->id_proveedor;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getDireccion(){
            return $this->direccion;
        }
        public function getTelefono(){
            return $this->telefono;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getNit(){
            return $this->nit;
        }
        
        //Setters
        public function setIdProveedor($id_proveedor){
            $this->id_proveedor = $id_proveedor;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setDireccion($direccion){
            $this->direccion = $direccion;
        }
        public function setTelefono($telefono){
            $this->telefono = $telefono;
        }
        public function setEmail($email){
            $this->email = $email;
        }
        public function setNit($nit){
            $this->nit = $nit;
        }

    }
?>