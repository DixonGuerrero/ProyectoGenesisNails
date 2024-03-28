<?php 
    class Categoria extends SessionController{
        private $categoria;
        function __construct(){
            parent::__construct();
            $this->loadModel('CategoriaModel');
            error_log('Categoria::construct -> Inicio de Categoria');
        }

         public function render(){
            
            $this->view->render('categoria/index',[
                'usuario' =>$this->usuario
            ]);
        } 

        public function guardar(){
            if ($this->existeParametrosPost(['nombre','tipo'])) {

                $nombre = limpiarCadena($this->obtenerPost('nombre'));

                if ($nombre == '') {

                    $this->alerta = new Alertas('error', 'El nombre y el tipo de la categoria no pueden estar vacíos');

                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                $this->categoria = new CategoriaModel();
                $this->categoria->setNombre($nombre);

                $respuesta = $this->categoria->guardar();

                if ($respuesta['status'] > 300) {

                    $msg = $respuesta['response']['message'];

                    $this->alerta = new Alertas('error', $msg);

                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                $this->alerta = new Alertas('success', 'Categoria guardada correctamente');

                echo $this->alerta->simple()->exito()->getAlerta();

                exit();
            }
        }

        public function actualizar(){
            if ($this->existeParametrosPost(['id','nombre'])) {

                $id = limpiarCadena($this->obtenerPost('id'));
                $nombre = limpiarCadena($this->obtenerPost('nombre'));

                if ($id == '' || $nombre == '' ) {

                    $this->alerta = new Alertas('error', 'El id, nombre y el tipo de la categoria no pueden estar vacíos');

                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                $this->categoria = new CategoriaModel();
                $this->categoria->setIdCategoria($id);
                $this->categoria->setNombre($nombre);

                $respuesta = $this->categoria->actualizar();

                if ($respuesta['status'] > 300) {

                    $msg = $respuesta['response']['message'];

                    $this->alerta = new Alertas('error', $msg);

                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                $this->alerta = new Alertas('success', 'Categoria actualizada correctamente');

                echo $this->alerta->simple()->exito()->getAlerta();

                exit();
            }
        }


        public function eliminar(){
            if ($this->existeParametrosPost(['id'])) {

                $id = limpiarCadena($this->obtenerPost('id'));

                if ($id == '') {

                    $this->alerta = new Alertas('error', 'El id de la categoria no puede estar vacío');

                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                

                $respuesta = $this->categoria->eliminar($id);

                if ($respuesta['status'] > 300) {

                    $msg = $respuesta['response']['message'];

                    $this->alerta = new Alertas('error', $msg);

                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                $this->alerta = new Alertas('success', 'Categoria eliminada correctamente');

                echo $this->alerta->simple()->exito()->getAlerta();

                exit();
            }
        }

        public function idByNombre($nombre){
            $categorias = $this->categoria->obtenerTodo();

            if ($categorias) {
                foreach ($categorias as $categoria) {
                    if ($categoria->getNombre() == $nombre) {
                        return $categoria->getIdCategoria();
                    }
                }
            }
            return null;
        }
    }
?>