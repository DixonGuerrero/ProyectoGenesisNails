<?php 
    class Entrada extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('Entrada::construct -> Inicio de Entrada');
        }

        public function render(){
            $this->view->render('entrada/index',[
                'usuario' =>$this->usuario,
                'entradas' => $this->listaEntradas()
            ]);
        }

        public function listaEntradas(){

            $entradas =  $this->model->obtenerTodo();

            $respuesta = '';

            foreach ($entradas as $entrada):
                $respuesta .= '
                <div class="tarjeta">
                <div class="tarjeta-header">
                    <h2 class="titulo-entrada">
                        Entrada #'.$entrada->getIdEntrada().'
                    </h2>
                </div>
        
                <div class="info-entrada">
                    <p class="info-fecha">Fecha: '.$entrada->getFecha().'</p>
                    <p class="info-proveedor">Proveedor: '.$this->nombreProveedor($entrada->getIdProveedor()).'</p>
                    <p class="cantidad">Cantidad:'.$this->cantidadProductos($entrada->getProductos()).'</p>
                </div>
        
                <div class="productos">
                    <h2 class="titulo-producto">Productos</h2>
                    <div class="contenedor-imagenes">
                ';

                    foreach ($entrada->getProductos() as $producto):
                        $respuesta .='
                        <img src="'.APP_URL.'assets/images/producto/'.$producto->getImagen().'" alt="">
                        ';
                    endforeach;

                    $respuesta .='
                    </div>
                    </div>
            
                    <div class="acciones">
                        <button class="btn-editar">Editar <ion-icon name="create"></ion-icon></button>
                    </div>
            
                </div>
                    ';
            endforeach;


            return $respuesta;
        }


        public function nombreProveedor($id){
            $proveedor = new ProveedorModel();

            $proveedor = $proveedor->obtenerUno($id);
            error_log('Entrada::nombreProveedor -> '.$proveedor->getIdProveedor());


            return $proveedor = isset($proveedor) ? $proveedor->getNombre() : 'No se ha encontrado el proveedor'; 
        }


        public function cantidadProductos($productos){
            $cantidad = 0;

            foreach ($productos as $producto):
                $cantidad += $producto->getCantidad();
            endforeach;

            return $cantidad;

        }
    }
?>