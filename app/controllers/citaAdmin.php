<?php
class CitaAdmin extends SessionController
{

    function __construct()
    {
        parent::__construct();
        $this->loadModel('CitaAdmin');
        error_log('Home::construct -> Inicio de Home');
    }

    public function render()
    {
        $this->view->render('citaAdmin/index', [
            'usuario' => $this->usuario,
            'tablaCitas' => $this->listaCitas(),
        ]);
    }

    public function guardar()
    {
        error_log('CitaAdmin::guardar -> inicio de guardar');

        if ($this->existeParametrosPost([
            'id_servicio',
            'fecha'
        ])) {


            $id_servicio = limpiarCadena($this->obtenerPost('id_servicio'));
            $fecha = limpiarCadena($this->obtenerPost('fecha'));

            if ($id_servicio == '' || $fecha == '') {
                $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }
            $this->model->setIdServicio($id_servicio);
            $this->model->setFecha($fecha);
            $this->model->setIdCliente($this->usuario->getId());

            $respuesta = $this->model->guardar();
            error_log('CitaAdmin::guardar -> respuesta: ' . json_encode($respuesta));
            if ($respuesta['status'] != 200) {
                $msg = $respuesta['response']['message'];
                $this->alerta = new Alertas('ERROR', $msg);
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }
            $this->alerta = new Alertas('SUCCESS', 'Cita guardada correctamente');
            echo $this->alerta->simple()->exito()->getAlerta();
            exit();
        }
    }

    public function actualizar()
    {
        error_log('CitaAdmin::actualizar -> inicio de actualizar');

        if ($this->existeParametrosPost([
            'id_cita',
            'id_servicio',
            'fecha_cita'
        ])) {

            $id_cita = limpiarCadena($this->obtenerPost('id_cita'));
            $id_servicio = limpiarCadena($this->obtenerPost('id_servicio'));
            $fecha_cita = limpiarCadena($this->obtenerPost('fecha'));

            if ($id_cita == '' || $id_servicio == '' || $fecha_cita == '') {
                $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            $this->model->setIdCita($id_cita);
            $this->model->setIdServicio($id_servicio);
            $this->model->setFecha($fecha_cita);
            $this->model->setIdCliente($this->usuario->getId());


            $respuesta = $this->model->actualizar();
            error_log('CitaAdmin::actualizar -> respuesta: ' . json_encode($respuesta));
            if ($respuesta['status'] != 200) {
                $msg = $respuesta['response']['message'];
                $this->alerta = new Alertas('ERROR', $msg);
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }
            $this->alerta = new Alertas('SUCCESS', 'Cita actualizada correctamente');
            echo $this->alerta->simple()->exito()->getAlerta();
            exit();
        }
    }

    public function eliminar()
    {
        error_log('CitaAdmin::eliminar -> inicio de eliminar');

        if ($this->existeParametrosPost([
            'id_cita'
        ])) {

            $id_cita = limpiarCadena($this->obtenerPost('id_cita'));

            if ($id_cita == '') {
                $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            $respuesta = $this->model->eliminar($id_cita);
            error_log('CitaAdmin::eliminar -> respuesta: ' . json_encode($respuesta));
            if ($respuesta['status'] != 200) {
                $msg = $respuesta['response']['message'];
                $this->alerta = new Alertas('ERROR', $msg);
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }
            $this->alerta = new Alertas('SUCCESS', 'Cita eliminada correctamente');
            echo $this->alerta->simple()->exito()->getAlerta();
            exit();
        }
    }

    public function numCitas()
    {

        try {
            $citas = $this->model->obtenerTodo();
            error_log('CitaAdmin::numCitas -> citas: ' . json_encode($citas));

            if ($citas) {
                $numCitas = count($citas);
                error_log('CitaAdmin::numCitas -> numCitas: ' . $numCitas);
                return $numCitas;
            }
            return 0;
        } catch (Exception $e) {
            error_log('CitaAdmin::numCitas -> ERROR: ' . $e);
            return 0;
        }
    }

    public function listaCitas()
    {
        try {
            //Obtener Datos
            $citas = $this->model->obtenerTodo();


            //Validamos los usuarios si no hay mostramos por pantalla un mensaje que diga que no hay usuarios

            if (!$citas) {
                $respuesta = '<div class="contenedor-usuarios">
                <h3>No hay Citas Registradas</h3>
                </div>';

                return $respuesta;
                exit();
            }

            //Si hay datos vamos a empezar a crear la tabla
            //Creamos tabla
            $tabla = '
            <div class="table-header">
                <p>Lista Citas</p>
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
                            <th>servicio</th>
                            <th>Tipo Servicio</th>
                            <th>cliente</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';

            //Empezamos a recorrer los datos y agregarlos a la tabla

            foreach ($citas as $cita) {
                $tabla .= '<tr>
                <td>' . $cita->getIdCita() . '</td>
                <td><img src="' . APP_URL . 'assets/images/servicios/' . $cita->getImagenServicio() . '" alt=""></td>
                <td>' . $cita->getTipoServicio() . '</td>
                <td>' . $this->getNombreClietne($cita->getIdCliente()) . '</td>
                <td>' . $cita->getFecha() . '</td>
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


    public function getNombreClietne($idCliente)
    {
        $cliente = $this->usuario->obtenerUno($idCliente);

        if ($cliente) {
            return $cliente->getNombres();
        }

        return 'No se encontro el cliente';
    }
}
