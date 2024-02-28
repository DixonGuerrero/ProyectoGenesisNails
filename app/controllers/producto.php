<?php 
    class Producto extends SessionController{

        private $user;

        public function __construct(){
            parent::__construct();

            $this->user = $this->getUserSessionData();
        }

        public function render(){
            $this->view->render('producto/index',[
                'user' => $this->user
            ]);
        }

        public function nuevoProducto(){
            if(!$this->existeParametrosPost(['nombre','codigo','stock','precio','proveedor','marca','categoria'])){
                $this->redireccionar('dashboardE', ['error' => ErrorMensajes::ERROR_PRODUCTO_NUEVOPRODUCTO_VACIO]);
                return;
            }

            if($this->user == NULL){
                $this->redireccionar('dashboardE', ['error' => ErrorMensajes::ERROR_PRODUCTO_NUEVOPRODUCTO_500]);
                return;
            }

            $nombre = limpiarCadena($this->obtenerPost('nombre'));
            $codigo = limpiarCadena($this->obtenerPost('codigo'));
            $stock = limpiarCadena($this->obtenerPost('stock'));
            $precio = limpiarCadena($this->obtenerPost('precio'));
            $proveedor = limpiarCadena($this->obtenerPost('proveedor'));
            $marca = limpiarCadena($this->obtenerPost('marca'));
            $categoria = limpiarCadena($this->obtenerPost('categoria'));


            $producto = new ProductoModel();
            $producto->setNombre($nombre);
            $producto->setCodigo($codigo);
            $producto->setStock((integer)($stock));
            $producto->setPrecio((float)($precio));
            $producto->setProveedor($proveedor);
            $producto->setMarca((integer)($marca));
            $producto->setCategoria((integer)($categoria));


            $respuesta = $producto->guardar();

            if($respuesta['status'] != 200){
                $this->redireccionar('dashboardE', ['info' => InfoMensajes::encriptarMensaje($respuesta['message'])]);
            }

            $this->redireccionar('dashboardE', ['exito' => ExitoMensajes::EXITO_PRODUCTO_NUEVOPRODUCTO]);



        }

        public function crear (){
            $marcas = new MarcaModel();
            $proveedores = new ProveedorModel();
            $this->view->render('producto/crear',[
                'marcas' => $marcas->obtenerTodo(),
                'proveedores' => $proveedores->obtenerTodo(),
                'user' => $this->user
            ]);
        }

        
    }

?>