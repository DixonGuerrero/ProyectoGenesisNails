<?php 
    class ServicioAdminModel extends Model implements IModel{

        private $id_servicio;
        private $tipo_servicio;
        private $imagen;
        private $descripcion_servicio;

        function __construct(){
            error_log('CAdministrador::construct -> Inicio de CAdministrador');

            parent::__construct();

            $this->id_servicio = 0;
            $this->tipo_servicio = '';
            $this->imagen = '';
            $this->descripcion_servicio = '';

        }

        public function guardar(){
            try {
                $data = [
                    'tipo_servicio' => $this->tipo_servicio,
                    'imagen' => $this->imagen,
                    'descripcion_servicio' => $this->descripcion_servicio
                ];

                $respuesta =  $this->api->crear('servicio',$data);

                return $respuesta;

            } catch (Exception $e) {
                error_log('ServicioAdminModel::guardar -> ERROR: ' . $e);
                return false;

            }
        }
        public function obtenerTodo(){
            $datos = [];
            try {

                $respuesta = $this->api->obtenerTodo('servicio');

                error_log('ServicioAdminModel::obtenerTodo -> respuesta: ' . json_encode($respuesta));
                
                foreach($respuesta['response'] as $row){
                    $item = new ServicioAdminModel();
                    $item->asignarDatos($row);
                    array_push($datos, $item);
                }
                

                return $datos;

            } catch (Exception $e) {
                error_log('ServicioAdminModel::obtenerTodo -> ERROR: ' . $e);
                return [];
            }
        }
        public function obtenerUno($id){
            try {
                $data = $this->api->obtenerUno('servicio',$id);
                $this->asignarDatos($data['response']);
                return $this;
            } catch (Exception $e) {
                error_log('ServicioAdminModel::obtenerUno -> ERROR: ' . $e);
                return [];
            }
        }
        public function eliminar($id){
            try {
                $respuesta = $this->api->eliminar('servicio',$id);
                return $respuesta;
            } catch (Exception $e) {
                error_log('ServicioAdminModel::eliminar -> ERROR: ' . $e);
                return false;
            }
        }
        public function actualizar(){
            try {
                $data = [
                    'id_servicio' => $this->id_servicio,
                    'tipo_servicio' => $this->tipo_servicio,
                    'imagen' => $this->imagen,
                    'descripcion_servicio' => $this->descripcion_servicio
                ];
                $respuesta =  $this->api->actualizar('servicio',$data,$this->id_servicio);
                return $respuesta;
            } catch (Exception $e) {
                error_log('ServicioAdminModel::actualizar -> ERROR: ' . $e);
                return false;
            }
        }
        public function asignarDatos($datos){
            $this->setIdServicio($datos['id_servicio']);
            $this->setTipoServicio($datos['tipo_servicio']);
            $this->setImagen($datos['imagen']);
    
            $this->setDescripcionServicio($datos['descripcion_servicio']);
            
        }

        //Getters
        public function getIdServicio(){
            return $this->id_servicio;
        }
        public function getTipoServicio(){
            return $this->tipo_servicio;
        }
        public function getImagen(){
            return $this->imagen;
        }
        public function getDescripcionServicio(){
            return $this->descripcion_servicio;
        }


        //Setters
        public function setIdServicio($id_servicio){
            $this->id_servicio = $id_servicio;
        }
        public function setTipoServicio($tipo_servicio){
            $this->tipo_servicio = $tipo_servicio;
        }
        public function setImagen($imagen){
            // Asigna 'default.png' si $imagen está vacío o es null.
            $imagen = empty($imagen) ? 'default.png' : $imagen;
            $this->imagen = $imagen;
        }
        
        public function setDescripcionServicio($descripcion_servicio){
            $this->descripcion_servicio = $descripcion_servicio;
        }



    }
    
?>