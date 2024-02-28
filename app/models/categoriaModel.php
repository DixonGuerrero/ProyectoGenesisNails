<?php 

    class CategoriaModel extends Model{
        private $id_categoria;
        private $nombre;
        private $tipo;

        public function __construct(){
            parent::__construct();
        }
        //Methods
        
        public function guardar(){
            try {
                $data = [
                    'nombre' => $this->nombre,
                    'tipo' => $this->tipo
                ];

               
                
                $respuesta =  $this->api->crear('categoria',$data);

                return $respuesta;
            } catch (Exception $e) {
                error_log('CategoriaModel::guardar -> ERROR: ' . $e);
                return false;
            }
        }

        public function obtenerTodo(){
            $data = [];
            try {
                $data = $this->api->obtenerTodo('categoria');

                foreach ($data as $item) {
                    $categoria = new CategoriaModel();
                    $categoria->setIdCategoria($item['id_categoria']);
                    $categoria->setNombre($item['nombre']);
                    $categoria->setTipo($item['tipo']);
                    array_push($data,$categoria);
                }

                return $data;
                
            } catch (Exception $e) {
                error_log('CategoriaModel::obtenerTodo -> ERROR: ' . $e);
                return [];
            }
        }

        public function obtenerUno($id){
            try {
                $data = $this->api->obtenerUno('categoria',$id);

               $this->asignarDatos($data);

                return $data;
                
            } catch (Exception $e) {
                error_log('CategoriaModel::obtenerUno -> ERROR: ' . $e);
                return [];
            }
        }

        public function actualizar(){
            try {
                $data = [
                    'nombre' => $this->nombre,
                    'tipo' => $this->tipo,
                ];
                
                $respuesta =  $this->api->actualizar('categoria',$this->id_categoria,$data);

                return $respuesta;
            } catch (Exception $e) {
                error_log('CategoriaModel::actualizar -> ERROR: '
                . $e);
                return false;
            }
        }

        public function eliminar($id){
            try {
                $respuesta =  $this->api->eliminar('categoria',$id);

                return $respuesta;
            } catch (Exception $e) {
                error_log('CategoriaModel::eliminar -> ERROR: ' . $e);
                return false;
            }
        }

        public function asignarDatos($data){
            $this->setIdCategoria($data['id_categoria']);
            $this->setNombre($data['nombre']);
            $this->setTipo($data['tipo']);
        }

        //Getters and Setters
        public function setIdCategoria($id_categoria){
            $this->id_categoria = $id_categoria;
        }

        public function getIdCategoria(){
            return $this->id_categoria;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function setTipo($tipo){
            $this->tipo = $tipo;
        }

        public function getTipo(){
            return $this->tipo;
        }


       
    }
?>