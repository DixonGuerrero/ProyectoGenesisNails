<?php 
    class ServicioAdmin extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('ServicioAdmin::construct -> Inicio de ServicioAdmin');

            
        }

        public function render(){
            $this->view->render('servicioAdmin/index',[
                'usuario' =>$this->usuario,
                'listaServicios' => $this->listarServicios()
            ]);
        }

        public function nuevoServicio(){
            if($this->existeParametrosPost(
                'nombre',
                'descripcion'
            )):
              
            $nombre = limpiarCadena($this->obtenerPost('nombre'));
            $descripcion = limpiarCadena($this->obtenerPost('descripcion'));

            if($nombre == '' || $descripcion == ''):
                $this->alerta = new Alertas('ERROR','Todos los campos son obligatorios');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();

            endif;

            $this->model->setTipoServicio($nombre);
            $this->model->setDescripcionServicio($descripcion);

            if($_FILES['imagen'] && $_FILES['imagen']['size'] > 0):
                $imagen = $this->cargarImagen($nombre,'servicios','imagen');

                if(!$imagen):
                    $this->alerta = new Alertas('ERROR','No se pudo subir la imagen');
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                endif;


                $this->model->setImagen($imagen);
            endif;


            $respuesta = $this->model->guardar();

            if($respuesta['status'] != 201):
                $msg = $respuesta['response']['message'];
                $this->alerta = new Alertas('ERROR',$msg);
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            endif;


            $this->alerta = new Alertas('SUCCESS','Servicio guardado correctamente');
            http_response_code(201);
            echo $this->alerta->redireccionar('servicioAdmin')->exito()->getAlerta();

            endif;

        }

        public function editarServicio(){

        if ($this->existeParametrosPost('id_servicio', 'nombre', 'descripcion')):

            $id_servicio = limpiarCadena($this->obtenerPost('id_servicio'));
            $nombre = limpiarCadena($this->obtenerPost('nombre'));
            $descripcion = limpiarCadena($this->obtenerPost('descripcion'));

            if ($id_servicio == '' || $nombre == '' || $descripcion == ''):

                $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();

            endif;

            $this->model->setTipoServicio($nombre);
            $this->model->setDescripcionServicio($descripcion);
            $this->model->setIdServicio($id_servicio);

            if ($_FILES['imagen'] && $_FILES['imagen']['size'] > 0):
                $imagen = $this->cargarImagen($nombre, 'servicios', 'imagen');

                if (!$imagen):
                    $this->alerta = new Alertas('ERROR', 'No se pudo subir la imagen');
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                endif;

                $this->model->setImagen($imagen);
            endif;

            $respuesta = $this->model->actualizar();

            if ($respuesta['status'] != 200):
                $msg = $respuesta['response']['message'];
                $this->alerta = new Alertas('ERROR', $msg);
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            endif;

            $this->alerta = new Alertas('SUCCESS', 'Servicio actualizado correctamente');
            http_response_code(200);
            echo $this->alerta->redireccionar('servicioAdmin')->exito()->getAlerta();
            exit();

        endif;

        }

        public function eliminar(){
            error_log('ServicioAdmin::eliminar -> inicio de eliminar');

            if ($this->existeParametrosPost('id_servicio')):
                $id_servicio = $this->obtenerPost('id_servicio');

                

                $respuesta = $this->model->eliminar($id_servicio);

                if ($respuesta['status'] != 200):
                    $msg = $respuesta['response']['message'];
                    $this->alerta = new Alertas('ERROR', $msg);
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                endif;

                $this->alerta = new Alertas('SUCCESS', 'Servicio eliminado correctamente');
                http_response_code(200);
                echo $this->alerta->redireccionar('servicioAdmin')->exito()->getAlerta();
                exit();
            endif;

        }

        public function listarServicios(){
        try {
            //Obtener Datos
            $servicios = $this->model->obtenerTodo();


            //Validamos los usuarios si no hay mostramos por pantalla un mensaje que diga que no hay usuarios

            if (!$servicios) {
                $respuesta = '<div class="contenedor-usuarios">
                <h3>No hay servicios Registrados</h3>
                </div>';

                return $respuesta;
                exit();
            }

            //Si hay datos vamos a empezar a crear la tabla
            //Creamos tabla
            $tabla = '
            <div class="table-header">
                <p>Lista Servicios</p>
                <div>
                    <button class="add-new btn-agregar">
                        <ion-icon name="add-circle"></ion-icon>
                        Nuevo
                    </button>
                </div>
            </div>
            <div class="table-section">
                <table id="tablaDatos">
                    <thead id="encabezado-tabla">
                        <tr>
                            <th>
                            <ion-icon name="id-card"></ion-icon>
                            Id</th>
                            <th>
                            <ion-icon name="image"></ion-icon>
                            Imagen</th>
                            <th>
                            <ion-icon name="storefront"></ion-icon>
                            Servicio</th>
                            <th>
                            <ion-icon name="reader"></ion-icon>
                            Descripcion</th>
                            <th>
                            <ion-icon name="build"></ion-icon>
                            Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';

            //Empezamos a recorrer los datos y agregarlos a la tabla

            foreach ($servicios as $servicio) {
                $tabla .= '<tr>
                <td>' . $servicio->getIdServicio() . '</td>
                <td><img src="' . APP_URL . 'assets/images/servicios/' . $servicio->getImagen() . '" alt=""></td>
                <td>' . $servicio->getTipoServicio() . '</td>
                <td>' . $servicio->getDescripcionServicio() . '</td>
                <td>
                <div class="acciones">
                <button class="editar boton-editar">
                    <ion-icon name="create"></ion-icon>
                </button>
                <form class="FormularioAjax" action="'.APP_URL.'servicioAdmin/eliminar" method="POST">

                        <button type="submit" class="eliminar">
                        <ion-icon name="trash-bin"></ion-icon>
                        </button>

                        <input type="hidden" class="id_servicio" name="id_servicio" value="'.$servicio->getIdServicio().'">

                </form>
            </div>
                </td>
            </tr>';
            }

            //Cerramos la tabla
            $tabla .= '
            </tbody>
        </table>
    </div>
            ';

            return $tabla;
        } catch (Exception $e) {
            error_log('Usuario::listaUsuarios -> ERROR: ' . $e);
            return false;
        }
        }
    }
?>