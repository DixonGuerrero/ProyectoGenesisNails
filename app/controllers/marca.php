<?php
class Marca extends SessionController
{
    private $marca;
    function __construct()
    {
        parent::__construct();
        $this->loadModel('MarcaModel');
        $this->marca = new MarcaModel();
        error_log('Marca::construct -> Inicio de Marca');
    }

    /* public function render(){
            $marcas = $this->marca->obtenerTodo();
            $this->view->render('marca/index',[
                'marcas' => $marcas
            ]);
        }
         */

    public function guardar()
    {
        if ($this->existeParametrosPost(['nombre'])) {

            $nombre = limpiarCadena($this->obtenerPost('nombre'));

            if ($nombre == '') {

                $this->alerta = new Alertas('error', 'El nombre de la marca no puede estar vacío');

                echo $this->alerta->simple()->error()->getAlerta();

                exit();
            }

            $this->marca->setNombre($nombre);

            $respuesta = $this->marca->guardar();

            if ($respuesta['status'] > 300) {

                $msg = $respuesta['response']['message'];

                $this->alerta = new Alertas('error', $msg);

                echo $this->alerta->simple()->error()->getAlerta();

                exit();
            }

            $this->alerta = new Alertas('success', 'Marca guardada correctamente');

            echo $this->alerta->simple()->exito()->getAlerta();

            exit();
        }
    }

    public function actualizar(){
        if ($this->existeParametrosPost(['id_marca','nombre'])) {

            $id_marca = limpiarCadena($this->obtenerPost('id_marca'));
            $nombre = limpiarCadena($this->obtenerPost('nombre'));

            if ($nombre == '' || $id_marca == '') {

                $this->alerta = new Alertas('error', 'El nombre de la marca no puede estar vacío');

                echo $this->alerta->simple()->error()->getAlerta();

                exit();
            }

            $this->marca->setIdMarca($id_marca);
            $this->marca->setNombre($nombre);

            $respuesta = $this->marca->actualizar();

            if ($respuesta['status'] > 300) {

                $msg = $respuesta['response']['message'];

                $this->alerta = new Alertas('error', $msg);

                echo $this->alerta->simple()->error()->getAlerta();

                exit();
            }

            $this->alerta = new Alertas('success', 'Marca actualizada correctamente');

            echo $this->alerta->simple()->exito()->getAlerta();

            exit();
        }
    }


        public function eliminar(){
            if ($this->existeParametrosPost(['id_marca'])) {

                $id_marca = limpiarCadena($this->obtenerPost('id_marca'));

                if ($id_marca == '') {

                    $this->alerta = new Alertas('error', 'El id de la marca no puede estar vacío');

                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                $respuesta = $this->marca->eliminar($id_marca);

                if ($respuesta['status'] > 300) {

                    $msg = $respuesta['response']['message'];

                    $this->alerta = new Alertas('error', $msg);

                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                $this->alerta = new Alertas('success', 'Marca eliminada correctamente');

                echo $this->alerta->simple()->exito()->getAlerta();

                exit();
            }
        }

        public function idByNombre($nombre){
            $marcas = $this->marca->obtenerTodo();

            foreach ($marcas as $marca) {
                if ($marca->getNombre() == $nombre) {
                    return $marca->getIdMarca();
                }
            }
        }
    
}
