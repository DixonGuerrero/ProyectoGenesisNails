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

        public function nuevoServicio(){}

        public function editarServicio(){}

        public function eliminarServicio(){}

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
                    <button class="add-new">
                        <ion-icon name="add-circle"></ion-icon>
                        Nuevo
                    </button>
                </div>
            </div>
            <div class="table-section">
                <table id="tablaDatos">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Imagen</th>
                            <th>Servicio</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
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
                    <button class="editar">
                        <ion-icon name="create"></ion-icon>
                    </button>
                    <button class="eliminar">
                        <ion-icon name="trash"></ion-icon>
                    </button>
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