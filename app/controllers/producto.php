<?php 
    class Producto extends sessionController{
        private $marca;
        private $proveedor;
        private $categoria;

        public function __construct(){
            parent::__construct();
           $this->loadModel('producto');
        }

        public function render(){
            $this->view->render('producto/index',[
                'usuario' =>$this->usuario,
                'productos' => $this->tarjetasProdutos(),
                'formularioProducto' => $this->formularioCrear()

            ]);
        }

        public function nuevoProducto(){
            
            if(!$this->existeParametrosPost(['nombre','codigo','stock','precio','proveedor','marca','categoria'])){
                $this->alerta = new Alertas('Error', 'No se han recibido los datos necesarios para crear un nuevo producto');

                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }   

            if($this->usuario == NULL){
                $this->alerta = new Alertas('Error', 'No se ha iniciado sesión');

                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            $nombre = limpiarCadena($this->obtenerPost('nombre'));
            $codigo = limpiarCadena($this->obtenerPost('codigo'));
            $stock = limpiarCadena($this->obtenerPost('stock'));
            $precio = limpiarCadena($this->obtenerPost('precio'));
            $proveedor = limpiarCadena($this->obtenerPost('proveedor'));
            $marca = limpiarCadena($this->obtenerPost('marca'));
            $categoria = limpiarCadena($this->obtenerPost('categoria'));


            
            $this->model->setNombre($nombre);
            $this->model->setCodigo($codigo);
            $this->model->setStock((integer)($stock));
            $this->model->setPrecio((float)($precio));
            $this->model->setProveedor($proveedor);
            $this->model->setMarca((integer)($marca));
            $this->model->setCategoria((integer)($categoria));


            $respuesta = $this->model->guardar();

            if($respuesta['status'] != 200){
                $msg = $respuesta['response']['message'];
                $this->alerta = new Alertas('ERROR', $msg);
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            $this->alerta = new Alertas('Exito', 'Producto creado correctamente');
            echo $this->alerta->recargar()->exito()->getAlerta();

            exit();

        }

        public function actualizarProducto(){
            
            try {
                
                if(!$this->existeParametrosPost(['id_producto','nombre','codigo','stock','precio','proveedor','marca','categoria'])){
                    $this->alerta = new Alertas('Error', 'No se han recibido los datos necesarios para actualizar el producto');
    
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }   
    
                if($this->usuario == NULL){
                    $this->alerta = new Alertas('Error', 'No se ha iniciado sesión');
    
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }
    
                $id_producto = limpiarCadena($this->obtenerPost('id_producto'));
                $nombre = limpiarCadena($this->obtenerPost('nombre'));
                $codigo = limpiarCadena($this->obtenerPost('codigo'));
                $stock = limpiarCadena($this->obtenerPost('stock'));
                $precio = limpiarCadena($this->obtenerPost('precio'));
                $proveedor = limpiarCadena($this->obtenerPost('proveedor'));
                $marca = limpiarCadena($this->obtenerPost('marca'));
                $categoria = limpiarCadena($this->obtenerPost('categoria'));
    
                
                $this->model->setIdProducto($id_producto);
                $this->model->setNombre($nombre);
                $this->model->setCodigo($codigo);
                $this->model->setStock((integer)($stock));
                $this->model->setPrecio((float)($precio));
                $this->model->setProveedor($proveedor);
                $this->model->setMarca((integer)($marca));
                $this->model->setCategoria((integer)($categoria));
    
                $respuesta = $this->model->actualizar();
    
                if($respuesta['status'] != 200){
                    $msg = $respuesta['response']['message'];
                    $this->alerta = new Alertas('ERROR', $msg);
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }
    
                $this->alerta = new Alertas('Exito', 'Producto actualizado correctamente');
                echo $this->alerta->recargar()->exito()->getAlerta();
    
                exit();

            } catch (Exception $e) {
                error_log('Producto::actualizarProducto -> ERROR: ' . $e);
                return false;

            }
        }

        public function eliminarProducto(){
            
            try {

                if(!$this->existeParametrosPost(['id_producto'])){
                    $this->alerta = new Alertas('Error', 'No se han recibido los datos necesarios para eliminar el producto');
    
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }   
    
                if($this->usuario == NULL){
                    $this->alerta = new Alertas('Error', 'No se ha iniciado sesión');
    
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }
    
                $id_producto = limpiarCadena($this->obtenerPost('id_producto'));
    
                
                $respuesta = $this->model->eliminar($id_producto);
    
                if($respuesta['status'] != 200){
                    $msg = $respuesta['response']['message'];
                    $this->alerta = new Alertas('ERROR', $msg);
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }
    
                $this->alerta = new Alertas('Exito', 'Producto eliminado correctamente');
                echo $this->alerta->recargar()->exito()->getAlerta();
    
                exit();

            } catch (Exception $e) {
                error_log('Producto::eliminarProducto -> ERROR: ' . $e);
                return false;
            }
        }

        public function numProductos(){
            
            try {
               
                $productos = $this->model->obtenerTodo();

                error_log('Producto::numProductos -> productos: ' . json_encode($productos));

                if($productos){
                    $numProductos = count($productos);
                    error_log('Producto::numProductos -> numProductos: ' . $numProductos);
                    return $numProductos;
                }
                return 0;
            } catch (Exception $e) {
                error_log('Producto::numProductos -> ERROR: ' . $e);
                return false;
            }
        }

        public function productoMaxStock(){
           
            try {
                $productos = $this->model->obtenerTodo();
                $productoMax = new ProductoModel();
                if($productos){
                    $maxStock = -INF;
                    foreach ($productos as $producto) {
                        if($producto->getStock() > $maxStock){
                            $maxStock = $producto->getStock();
                            $productoMax = $producto;
                        }
                    }

                    return $productoMax;
                }
                return 0;
            } catch (Exception $e) {
                error_log('Producto::productoMaxStock -> ERROR: ' . $e);
                return 0;
            }
        }

        public function productoMinStock(){
          
            try {
                $productos = $this->model->obtenerTodo();
                $productoMin = new ProductoModel();
                if($productos){
                    $minStock = INF;
                    foreach ($productos as $producto) {
                        if($producto->getStock() < $minStock){
                            $minStock = $producto->getStock();
                            $productoMin = $producto;
                        }
                    }
                }

                 return $productoMin;
            } catch (Exception $e) {
                error_log('Producto::productoMinStock -> ERROR: ' . $e);
                return 0;
            }
        }

        public function tarjetasProdutos(){

            try {

                $productos = $this->model->obtenerTodo();

                //Validamos que si hayan datos
                if(!$productos){
                    $respuesta = '<div class="contenedor-usuarios">
                    <h3>No hay Productos Registradas</h3>
                    </div>';
    
                    return $respuesta;
                    exit();
                }

                //Creamos variable para almacenar Datos
                $tarjeta = '';

                //Empezamos a recorrer los datos
                foreach ($productos as $producto){
                    $tarjeta .='<div class="producto first">
                    <img class="imagen" src="'.APP_URL.'assets/images/producto/'.$producto->getImagen().'" alt="">
                    <div class="nombre">
                        <span class="nombre">'.$producto->getNombre().'</span>
                    </div>
                    <div class="precio">
                        <span class="precio">Precio: $'.$producto->getPrecio().'</span>
                    </div>
                    <div class="acciones">
                        <a class="editar" href="#">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                        <a class="eliminar" href="#">
                            <ion-icon name="trash-outline"></ion-icon>
                        </a>
                    </div>
                </div>';
                }

                return $tarjeta;

            } catch (Exception $e) {
                error_log('Producto::tarjetasProdutos -> ERROR: ' . $e);
                return false;
            }
        }



        /* public function crear (){
            $marcas = new MarcaModel();
            $proveedores = new ProveedorModel();
            $this->view->render('producto/crear',[
                'marcas' => $marcas->obtenerTodo(),
                'proveedores' => $proveedores->obtenerTodo(),
                'user' => $this->usuario
            ]);
        } */

        public function formularioCrear(){
            $marcas = [];
            $categorias = [];
            $proveedores = [];


            $this->marca = new marcaModel();
            $this->proveedor = new proveedorModel();
            $this->categoria = new categoriaModel();

            try {
                //Obteniendo Datos 
                $marcas = $this->marca->obtenerTodo();

                $proveedores = $this->proveedor->obtenerTodo();

                $categorias = $this->categoria->obtenerTodo();

                $respuesta = '
                <div class="modal_container">
                <div class="encabezado">
                    <h1>Producto</h1>
                    <a href="#" class="modal_close">X</a>
                </div>
        
                <img src="'.APP_URL.'assets/images/producto_add.png" class="modal_img" alt="">
                <h2 class="modal_title">Creando Producto</h2>
        
                <p class="modal_text">
                    Por favor, complete el siguiente formulario para crear un Producto.
                </p>
                <form action="" method="POST" class="form">
        
                    <h2 class="titulo-section-form">Datos Basicos</h2>
                    <div class="form_group">
                        <label for="codigo">Codigo</label>
                        <input type="text" name="codigo" id="codigo" class="form_input" required>
                    </div>
        
                    <div class="form_group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form_input" required>
                    </div>
        
        
                    <div class="form_group">
                        <label for="marca">Marca</label>
                        <select name="marca" id="marca" class="form_input">
                ';

                foreach($marcas as $marca){
                    $respuesta .= '<option value="'.$marca->getIdMarca().'">'.$marca->getNombre().'</option>';
                }

                $respuesta .= '
                        </select>
                    </div>
                    
                    
                    <div class="form_group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" class="form_input" required>
                </div>
    
                <div class="form_group">
                    <label for="categoria">Categoria</label>
                    <select name="categoria" id="categoria" class="form_input">    
                ';
        

                foreach($categorias as $categoria){
                    $respuesta .= '<option value="'.$categoria->getIdCategoria().'">'.$categoria->getNombre().'</option>';
                }

                $respuesta .= '
                    </select>
                </div> 
                
                <div class="form_group">
                <label for="precio">Precio</label>
                <input type="number" name="precio" id="precio" class="form_input" required>
            </div>

            <div class="form_group">
                <label for="marca">Proveedor</label>
                <select name="marca" id="marca" class="form_input">
                ';

                foreach ($proveedores  as $proveedor):
                    $respuesta .= '<option value="'.$proveedor->getIdProveedor().'">'.$proveedor->getNombre().'</option>';
                endforeach;
                    

                $respuesta .= '
                </select>
                </div>
    
                <div class="foto-perfil">
    
                    <h2 class="titulo-section-form">Foto Producto</h2>
                    <p>La foto de Producto no es obligatoria,si no se provee una el sistema lo hara por usted</p>
    
                    <!-- Selector Imagen Perfil -->
    
                    <div class="container_foto">
    
    
                        <input type="file" id="file-input">
                        <label for="file-input">
                            <ion-icon name="cloud-upload"></ion-icon>
                            Carga una foto
                        </label>
    
                        <div id="num-of-files">No hay archivos Cargados</div>
                        <ul id="files-list"></ul>
                    </div>
                </div>
    
    
    
                <button type="submit" class="enviar">
                    Registrar
                </button>
            </form>
    
        </div>
                ';


                return $respuesta;



            } catch (Exception $e) {
                error_log('Producto::formularioCrear -> ERROR: ' . $e);
                return '';

            }
        }
        
    }


?>