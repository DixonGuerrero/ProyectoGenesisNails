<?php
class Marca extends SessionController{
    function __construct()
    {
        parent::__construct();
    }

    public function render(){
            $this->view->render('marca/index',[
                'usuario' =>$this->usuario,
                'marcas' => $this->lista()
            ]);
    }
         

    public function guardar()
    {
        if ($this->existeParametrosPost(['nombre'])) {

            $nombre = limpiarCadena($this->obtenerPost('nombre'));

            if ($nombre == '') {

                $this->alerta = new Alertas('error', 'El nombre de la marca no puede estar vacío');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();

                exit();
            }

            $this->model->setNombre($nombre);

            $respuesta = $this->model->guardar();

            error_log('Marca::Guardar '.json_encode($respuesta));

            if ($respuesta['status'] > 300) {

                $msg = $respuesta['response']['message'];

                $this->alerta = new Alertas('error', $msg);
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();

                exit();
            }

            $this->alerta = new Alertas('success', 'Marca guardada correctamente');
            http_response_code(200);
            echo $this->alerta->recargar()->exito()->getAlerta();

            exit();
        }
    }

    public function actualizar(){
        if ($this->existeParametrosPost(['id_marca','nombre'])) {

            $id_marca = limpiarCadena($this->obtenerPost('id_marca'));
            $nombre = limpiarCadena($this->obtenerPost('nombre'));

            if ($nombre == '' || $id_marca == '') {

                $this->alerta = new Alertas('error', 'El nombre de la marca no puede estar vacío');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();

                exit();
            }

            $this->model->setIdMarca($id_marca);
            $this->model->setNombre($nombre);

            $respuesta = $this->model->actualizar();

            if ($respuesta['status'] > 300) {

                $msg = $respuesta['response']['message'];

                $this->alerta = new Alertas('error', $msg);
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();

                exit();
            }

            $this->alerta = new Alertas('success', 'Marca actualizada correctamente');
            http_response_code(200);
            echo $this->alerta->recargar()->exito()->getAlerta();

            exit();
        }
    }


        public function eliminar(){
            if ($this->existeParametrosPost(['id_marca'])) {

                $id_marca = limpiarCadena($this->obtenerPost('id_marca'));

                if ($id_marca == '') {

                    $this->alerta = new Alertas('error', 'El id de la marca no puede estar vacío');
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                $respuesta = $this->model->eliminar($id_marca);

                if ($respuesta['status'] > 300) {

                    $msg = $respuesta['response']['message'];

                    $this->alerta = new Alertas('error', $msg);
                    http_response_code(400);

                    echo $this->alerta->simple()->error()->getAlerta();

                    exit();
                }

                $this->alerta = new Alertas('success', 'Marca eliminada correctamente');
                http_response_code(200);
                echo $this->alerta->recargar()->exito()->getAlerta();

                exit();
            }
        }

        public function lista(){
            $marcas = $this->model->obtenerTodo();

            $respuesta = '';

            if(count($marcas) > 0){
                foreach ($marcas as $marca) {
                    $respuesta .= '
                    <div class="tarjeta-marca">
                        <div class="nombre-marca">'.$marca->getNombre().'</div>
                        <div class="acciones">



                            <button class="btn-editar"><ion-icon name="create"></ion-icon></button>
                            
                            

                            <form class="FormularioAjax" action="' . APP_URL . 'marca/eliminar" method="POST">

                            <input type="hidden" name="id_marca" value="' . $marca->getIdMarca() . '">
    
                            <button type="submit" class="eliminar btn-eliminar boton-eliminar">
                            <ion-icon name="trash-bin"></ion-icon></button>
    
                      
    
                        </form>


                        </div>
                    </div>
                    ';
                }
        }

        return $respuesta;
    }

}   

        
    

