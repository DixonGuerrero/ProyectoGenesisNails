<?php 

    class EntradaModel extends Model{
        private $id_entrada;
        private $fecha;
        private $id_proveedor;
        private $productos = [];
        public $producto ;
        


        function __construct(){
            parent::__construct();
            $this->producto = new ProductoModel();
            error_log('EntradaModel::construct -> Inicio de EntradaModel');
        }

        public function obtenerTodo(){
            $entradas = [];
            try {
                $data = $this->api->obtenerTodo('entrada');

                foreach ($data['response'] as $item) {
                    $entrada = new EntradaModel();
                    $entrada->asignarDatos($item);
                    array_push($entradas, $entrada);
                }
                return $entradas;
            } catch (Exception $e) {
                error_log('EntradaModel::obtenerTodo -> ERROR: ' . $e);
                return [];
            }
        }

        public function obtenerUno($id){
            try {
                $data = $this->api->obtenerUno('entrada',$id);
                $this->asignarDatos($data['response']);
                return $this;
            } catch (Exception $e) {
                error_log('EntradaModel::obtenerUno -> ERROR: ' . $e);
                return [];
            }
        }

        public function guardar(){
            try {
                $data = [
                    'fecha' => $this->fecha,
                    'id_proveedor' => $this->id_proveedor,
                    'productos' => $this->productos
                ];
                $respuesta =  $this->api->crear('entrada',$data);
                return $respuesta;
            } catch (Exception $e) {
                error_log('EntradaModel::guardar -> ERROR: ' . $e);
                return false;
            }
        }

        public function actualizar(){
            try {
                $data = [
                    'productos' => $this->productos
                ];
                $respuesta =  $this->api->actualizar('entrada',$data,$this->id_entrada);
                return $respuesta;
            } catch (Exception $e) {
                error_log('EntradaModel::actualizar -> ERROR: ' . $e);
                return false;
            }
        }


        public function asignarDatos(Array $datos){
            $this->id_entrada = $datos['id_entrada'];
            $this->fecha = $this->formatearFecha($datos['created_at']);
            $this->id_proveedor = $datos['proveedor'];
            $this->productos = [];
        
            foreach($datos['productos'] as $productoDatos){
                // Crear una nueva instancia de producto para cada producto en el array
                $producto = new ProductoModel();
                $producto->obtenerUno($productoDatos['id_producto']);
                $producto->setCantidad($productoDatos['cantidad_entrada']);
        
                array_push($this->productos, $producto);
            }   
        
            return $this;
        }
        


        public function formatearFecha($fecha){
            error_log('CitaModel::formatoFecha -> fecha: '.json_encode($fecha));
            $fecha = explode('T',$fecha);
           
            return $fecha[0];
        }

        //Getters
        public function getIdEntrada(){
            return $this->id_entrada;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function getIdProveedor(){
            return $this->id_proveedor;
        }

        public function getProductos(){
            return $this->productos;
        }

        //Setters

        public function setIdEntrada($id_entrada){
            $this->id_entrada = $id_entrada;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        public function setIdProveedor($id_proveedor){
            $this->id_proveedor = $id_proveedor;
        }

        public function setProductos($productos){
            $this->productos = $productos;
        }



    }
?>