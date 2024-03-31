<?php 
    class Categoria extends SessionController{
        function __construct(){
            parent::__construct();
            $this->loadModel('CategoriaModel');
            error_log('Categoria::construct -> Inicio de Categoria');
        }

         public function render(){
            
            $this->view->render('categoria/index',[
                'usuario' =>$this->usuario,
                'categorias' => $this->lista()
            ]);
        } 

        public function guardar(){
            if ($this->existeParametrosPost(['nombre'])) {

                $nombre = limpiarCadena($this->obtenerPost('nombre'));

                if ($nombre == '') {

                    $this->alerta = new Alertas('error', 'El nombre y el tipo de la categoria no pueden estar vacíos');
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                $this->model = new CategoriaModel();
                $this->model->setNombre($nombre);

                $respuesta = $this->model->guardar();

                if ($respuesta['status'] > 300) {

                    $msg = $respuesta['response']['message'];

                    $this->alerta = new Alertas('error', $msg);
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                $this->alerta = new Alertas('success', 'Categoria guardada correctamente');
                http_response_code(200);
                echo $this->alerta->recargar()->exito()->getAlerta();

                exit();
            }
        }

        public function actualizar(){
            if ($this->existeParametrosPost(['id_categoria','nombre'])) {

                $id = limpiarCadena($this->obtenerPost('id_categoria'));
                $nombre = limpiarCadena($this->obtenerPost('nombre'));

                if ($id == '' || $nombre == '' ) {

                    $this->alerta = new Alertas('error', 'El id, nombre y el tipo de la categoria no pueden estar vacíos');
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                $this->model = new CategoriaModel();
                $this->model->setIdCategoria($id);
                $this->model->setNombre($nombre);

                $respuesta = $this->model->actualizar();
                error_log('Categoria::actualizar -> Respuesta: ' . json_encode($respuesta));

                if ($respuesta['status'] > 300) {

                    $msg = $respuesta['response']['message'];

                    $this->alerta = new Alertas('error', $msg);
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                $this->alerta = new Alertas('success', 'Categoria actualizada correctamente');
                http_response_code(200);
                echo $this->alerta->recargar()->exito()->getAlerta();

                exit();
            }
        }


        public function eliminar(){
            if ($this->existeParametrosPost(['id_categoria'])) {

                $id = limpiarCadena($this->obtenerPost('id_categoria'));

                if ($id == '') {

                    $this->alerta = new Alertas('error', 'El id de la categoria no puede estar vacío');
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                

                $respuesta = $this->model->eliminar($id);

                if ($respuesta['status'] > 300) {

                    $msg = $respuesta['response']['message'];

                    $this->alerta = new Alertas('error', $msg);
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                $this->alerta = new Alertas('success', 'Categoria eliminada correctamente');
                http_response_code(200);
                echo $this->alerta->recargar()->exito()->getAlerta();

                exit();
            }
        }

        public function lista(){

            $categorias = $this->model->obtenerTodo();

            $respuesta = '';

            foreach ($categorias as $categoria):

                $respuesta .='
                <div class="tarjeta-categoria">
                <div class="nombre-categoria">'.$categoria->getNombre().'</div>
                <div class="acciones">
                    <button class="btn-editar">
                        <ion-icon name="create"></ion-icon>
                    </button>
                    <form class="FormularioAjax" action="'.APP_URL.'categoria/eliminar" method="POST">
        
                        <input type="hidden" name="id_categoria" value="'.$categoria->getIdCategoria().'">
        
                        <button type="submit" class="eliminar btn-eliminar boton-eliminar">
                            <ion-icon name="trash-bin"></ion-icon></button>
                    </form>
                </div>
            </div>
                ';

            endforeach;

            return $respuesta;
        }
    }
?>