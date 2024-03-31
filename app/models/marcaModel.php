<?php 

    class MarcaModel extends Model implements IModel{

        private $id_marca;
        private $nombre;

        public function __construct(){
            parent::__construct();
            
            $this->id_marca = 0;
            $this->nombre = '';
        }

        public function obtenerTodo(){
            $marcas = [];
            try {
                $data = $this->api->obtenerTodo('marca');

                foreach ($data['response'] as $item) {
                    $marca = new MarcaModel();
                    $marca->asignarDatos($item);
                    array_push($marcas, $marca);
                }
                return $marcas;
            } catch (Exception $e) {
                error_log('MarcaModel::obtenerTodo -> ERROR: ' . $e);
                return [];
            }
        }
        public function obtenerUno($id){
            try {
                $data = $this->api->obtenerUno('marca',$id);
                $this->asignarDatos($data['response']);
                return $this;
            } catch (Exception $e) {
                error_log('MarcaModel::obtenerUno -> ERROR: ' . $e);
                return [];
            }
        }
        public function guardar(){
            try {
                $data = [
                    'nombre' => $this->nombre
                ];
                $respuesta =  $this->api->crear('marca',$data);
                return $respuesta;
            } catch (Exception $e) {
                error_log('MarcaModel::guardar -> ERROR: ' . $e);
                return false;
            }
        }
        public function actualizar(){
            try {
                $data = [
                    'id_marca' => $this->id_marca,
                    'nombre' => $this->nombre
                ];
                $respuesta =  $this->api->actualizar('marca',$data,$this->id_marca);
                error_log('MarcaModel::actualizar -> Respuesta: ' . $respuesta);
                return $respuesta;
            } catch (Exception $e) {
                error_log('MarcaModel::actualizar -> ERROR: ' . $e);
                return false;
            }
        }
        public function eliminar($id){
            try {
                $respuesta = $this->api->eliminar('marca',$id);
                return $respuesta;
            } catch (Exception $e) {
                error_log('MarcaModel::eliminar -> ERROR: ' . $e);
                return null;
            }
        }
        public function asignarDatos($datos)
        {
            $this->setIdMarca($datos['id_marca']);
            $this->setNombre($datos['nombre']);
        }

        //Getters 
        public function getIdMarca(){
            return $this->id_marca;
        }
        public function getNombre(){
            return $this->nombre;
        }
        
        //Setters

        public function setIdMarca($id_marca){
            $this->id_marca = $id_marca;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
    }
?>