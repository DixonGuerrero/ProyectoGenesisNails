<?php 
    class SalidaModel extends Model{
        private $id_salida;
        private $id_admin;
        private $fecha;
        private $productos = [];
        public $producto;

        function __construct(){
            parent::__construct();
            $this->producto = new ProductoModel();
            error_log('SalidaModel::construct -> Inicio de SalidaModel');
        }

        public function obtenerTodo(){
            $salidas = [];
            try {
                $data = $this->api->obtenerTodo('salida');

                foreach ($data['response'] as $item) {
                    error_log('SalidaModel::obtenerTodo -> item: ' . json_encode($item));
                    $salida = new SalidaModel();
                    $salida->asignarDatos($item);
                    array_push($salidas, $salida);
                }
                return $salidas;
            } catch (Exception $e) {
                error_log('SalidaModel::obtenerTodo -> ERROR: ' . $e);
                return [];
            }
        }


        public function obtenerUno($id){
            try {
                $data = $this->api->obtenerUno('salida',$id);
                error_log('SalidaModel::obtenerUno -> data: ' . json_encode($data['response']));
                
                $salida = new SalidaModel();

                foreach ($data['response'] as $item) {
                    error_log('SalidaModel::obtenerTodo -> item: ' . json_encode($item));
                    
                    $salida->asignarDatos($item);
                    
                }
                return $salida;
            } catch (Exception $e) {
                error_log('SalidaModel::obtenerUno -> ERROR: ' . $e);
                return [];
            }
        }

        public function guardar(){
            try {
                $data = [
                    'id_admin' => $this->id_admin,
                    'productos' => $this->productos
                ];
                $respuesta =  $this->api->crear('salida',$data);
                return $respuesta;
            } catch (Exception $e) {
                error_log('SalidaModel::guardar -> ERROR: ' . $e);
                return false;
            }
        }

        public function actualizar(){
            try {
                $data = [
                    'productos' => $this->productos
                ];
                $respuesta =  $this->api->actualizar('salida',$data,$this->id_salida);
                error_log('SalidaModel::actualizar -> Respuesta: ' . $respuesta);
                return $respuesta;
            } catch (Exception $e) {
                error_log('SalidaModel::actualizar -> ERROR: ' . $e);
                return false;
            }
        }



        public function asignarDatos($data){
 
            $this->id_salida = $data['id_salida'];
            $this->fecha = $this->formatearFecha($data['created_at']);

            //Asignamos datos al array de productos
            foreach ($data['productos'] as $item):

                $this->producto = new ProductoModel();
                $this->producto->obtenerUno($item['id_producto']);
                $this->producto->setCodigo($item['codigo']);
                $this->producto->setCantidad($item['cantidad']);
                $this->producto->setPrecio($item['precio']);
                $this->producto->setMarca($item['id_marca']);
                $this->producto->setCategoria($item['id_categoria']);

                

                array_push($this->productos,$this->producto);
            endforeach;

            return $this;
        }

        public function formatearFecha($fecha){
            error_log('CitaModel::formatoFecha -> fecha: '.json_encode($fecha));
            $fecha = explode('T',$fecha);
           
            return $fecha[0];
        }

        //Getters
        public function getIdSalida(){
            return $this->id_salida;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function getProductos(){
            return $this->productos;
        }

        //Setters

        public function setIdSalida($id_salida){
            $this->id_salida = $id_salida;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        public function setProductos($productos){
            $this->productos = $productos;
        }

        public function setIdAdmin($id_admin){
            $this->id_admin = $id_admin;
        }
    }
    
?>