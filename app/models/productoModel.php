<?php 
    class ProductoModel extends Model{
        private $id_producto;
        private $nombre;
        private $codigo;
        private $stock;
        private $precio;
        private $imagen;
        private $proveedor;
        private $marca;
        private $categoria;

        public function __construct(){
            parent::__construct();

            $this->id_producto = 0;
            $this->nombre = '';
            $this->codigo = '';
            $this->stock = 0;
            $this->precio = 0;
            $this->proveedor = 0;
            $this->imagen = '';
            $this->marca = 0;
            $this->categoria = 0;

        }
        //Methods
        
        public function guardar(){
            try {
                $data = [
                    'nombre' => $this->nombre,
                    'codigo' => $this->codigo,
                    'cantidad' => $this->stock,
                    'precio' => $this->precio,
                    'proveedor' => $this->proveedor,
                    'id_marca' => $this->marca,
                    'id_categoria' => $this->categoria,
                    'imagen' => $this->imagen
                ];

               
                
                $respuesta =  $this->api->crear('producto',$data);

                return $respuesta;
            } catch (Exception $e) {
                error_log('ProductoModel::guardar -> ERROR: ' . $e);
                return false;
            }
        }

        public function obtenerTodo(){
            $productos = [];
            try {
                $data = $this->api->obtenerTodo('producto');

                foreach ($data['response'] as $item) {
                    $producto = new ProductoModel();
                    $producto->asignarDatos($item);
                    array_push($productos,$producto);
                }

               

                return $productos;
                
            } catch (Exception $e) {
                error_log('ProductoModel::obtenerTodo -> ERROR: ' . $e);
                return false;
            }
        }

        public function obtenerUno($id){
            try {
                $producto = $this->api->obtenerUno('producto',$id);

               error_log('ProductoModel::obtenerUno -> producto: ' . json_encode($producto));

                $this->asignarDatos($producto['response']);
               
                return $this;


            } catch (Exception $e) {
                error_log('ProductoModel::obtenerUno -> ERROR: ' . $e);
                return false;
            }
        }

        public function eliminar($id){
            try {
                $this->api->eliminar('producto',$id);
                return true;
            } catch (Exception $e) {
                error_log('ProductoModel::eliminar -> ERROR: ' . $e);
                return false;
            }
        }

        public function actualizar(){
            try {
                $data = [
                    'nombre' => $this->nombre,
                    'codigo' => $this->codigo,
                    'cantidad' => $this->stock,
                    'precio' => $this->precio,
                    'id_proveedor' => $this->proveedor,
                    'id_marca' => $this->marca,
                    'id_categoria' => $this->categoria,
                    'id_imagen' => $this->imagen,
                ];

                $data = json_encode($data);
                $this->api->actualizar('producto',$data,$this->id_producto);

                $datosA = $this->obtenerUno($this->id_producto);
                
                $producto = new ProductoModel();
                $producto->asignarDatos($datosA['response']);

                return true;
            } catch (Exception $e) {
                error_log('ProductoModel::actualizar -> ERROR: ' . $e);
                return false;
            }
        }

        public function asignarDatos($data){
            $this->setIdProducto($data['id_producto']);
            $this->setNombre($data['nombre']);
            $this->setCodigo($data['codigo']);
            $this->setStock($data['stock']);
            $this->setPrecio($data['precio']);
            $this->setProveedor($data['proveedor']);
            $this->setImagen($data['imagen']);
            $this->setMarca($data['marca']);
            $this->setCategoria($data['categoria']);
            return $this;

        }

        public function obtenerTodoProductoIdMarca($id_marca){
            $datos = [];

            try {

                $datos = $this->api->obtenerTodo('producto/marca/'.$id_marca);

                foreach ($datos as $item) {
                    $producto = new ProductoModel();
                    $producto->asignarDatos($item);
                    array_push($datos,$producto);
                }

                return $datos;

            } catch (Exception $e) {
                error_log('ProductoModel::obtenerTodoProductoIdMarca -> ERROR: ' . $e);
                return [];
            }


        }

        public function obtenerTodoProductoIdCategoria($id_categoria){
            $datos = [];

            try {

                $datos = $this->api->obtenerTodo('producto/categoria/'.$id_categoria);

                foreach ($datos as $item) {
                    $producto = new ProductoModel();
                    $producto->asignarDatos($item);
                    array_push($datos,$producto);
                }

                return $datos;

            } catch (Exception $e) {
                error_log('ProductoModel::obtenerTodoProductoIdCategoria -> ERROR: ' . $e);
                return [];
            }
        }

        public function obtenerTodoProductoIdProveedor($id_proveedor){
            $datos = [];

            try {

                $datos = $this->api->obtenerTodo('producto/proveedor/'.$id_proveedor);

                foreach ($datos as $item) {
                    $producto = new ProductoModel();
                    $producto->asignarDatos($item);
                    array_push($datos,$producto);
                }

                return $datos;

            } catch (Exception $e) {
                error_log('ProductoModel::obtenerTodoProductoIdProveedor -> ERROR: ' . $e);
                return [];
            }
        }


        //Setters and Getters
        public function setIdProducto($id_producto){
            $this->id_producto = $id_producto;
        }

        public function getIdProducto(){
            return $this->id_producto;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        public function getCodigo(){
            return $this->codigo;
        }

        public function setStock($stock){
            $this->stock = $stock;
        }

        public function getStock(){
            return $this->stock;
        }

        public function setPrecio($precio){
            $this->precio = $precio;
        }

        public function getPrecio(){
            return $this->precio;
        }

        public function setProveedor($proveedor){
            $this->proveedor = $proveedor;
        }

        public function getProveedor(){
            return $this->proveedor;
        }

        public function setMarca($id_marca){
            $this->marca = $id_marca;
        }

        public function getMarca(){
            return $this->marca;
        }

        public function setCategoria($id_categoria){
            $this->categoria = $id_categoria;
        }
        
        public function getCategoria(){
            return $this->categoria;
        }

        public function setImagen($imagen){
            $this->imagen = $imagen;
        }

        public function getImagen(){
            return $this->imagen;
        }

        


    }
?>