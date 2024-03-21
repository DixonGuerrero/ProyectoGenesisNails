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
            'formularioCita' => $this->formularioCita()
        ]);
    }

    public function guardar()
    {
        error_log('CitaAdmin::guardar -> inicio de guardar');

        if ($this->existeParametrosPost([
            'id_servicio',
            'fecha',
            'usuario',
            'hora'
        ])) {


            $id_servicio =(int) limpiarCadena($this->obtenerPost('id_servicio'));
            $fecha = limpiarCadena($this->obtenerPost('fecha'));
            $hora = limpiarCadena($this->obtenerPost('hora'));
            $usuario =(int) limpiarCadena($this->obtenerPost('usuario'));

            if ($id_servicio == '' || $fecha == '' || $usuario == '') {
                $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }


            //Validar Fecha
            $fechaActual = date('Y-m-d');
            if($fecha < $fechaActual){
                $this->alerta = new Alertas('ERROR','La fecha no puede ser menor a la actual');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            //Modificamos la fecha para que se guarde con la hora
            $fecha1 = $fecha.'T'.$hora;
            error_log('Cita::guardar -> fecha: '.$fecha);

            $this->model->setIdServicio($id_servicio);
            $this->model->setFecha($fecha1);

            $respuesta = $this->model->guardar($usuario);
            error_log('CitaAdmin::guardar -> respuesta: ' . json_encode($respuesta));
            if ($respuesta['status'] > 300 ) {
                $msg = $respuesta['response']['message'];
                $this->alerta = new Alertas('ERROR', $msg);
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }
            $this->alerta = new Alertas('SUCCESS', 'Cita guardada correctamente');
            echo $this->alerta->recargar()->exito()->getAlerta();
            exit();
        }else{
            $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');
            http_response_code(400);
            echo $this->alerta->simple()->error()->getAlerta();
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

    public function formularioCita(){
        $citas = [];
        try {
            $citas = $this->model->obtenerTodo();

            $respuesta = '
            <div class="modal_container">
            <div class="encabezado">
                <h1>Cita</h1>
                <a href="#" class="modal_close">X</a>
            </div>
            
            <img src="'.APP_URL.'assets/images/calendario_cita.png"  class="modal_img" alt="">
            <h2 class="modal_title">Configure su Cita</h2>
        
            <p class="modal_text">
                Por favor, complete el siguiente formulario para agendar su cita.
            </p>
            <form action="'.APP_URL.'citaAdmin/guardar" method="POST" class="form FormularioAjax">
                

                <div class="form_group">
                    <label for="servicio">Servicio</label>
                    <select name="id_servicio" id="servicio" class="form_input" >';

        //Asignamos datos
        foreach ($citas as $cita) {
            $respuesta .= '<option value="' . $cita->getIdServicio() . '">' . $cita->getTipoServicio() . '</option>';
        }


            $respuesta.='
                    </select>
                </div>

                <!-- <------Fecha y Hora------> 
                <div class="form_group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form__input">
                </div>

                <div class="form_group">
                    <label for="hora">Hora</label>
                    <input type="time" name="hora" id="hora" class="form__input">
                </div>
                
                <div class="form_group">
                <label for="usuario">Usuario</label>
                <select name="usuario" id="usuario" class="form_input" >
                ';



            $usuarios = $this->usuario->obtenerTodo();
                foreach ($usuarios as $usuario) {
                    $respuesta .= '<option value="' . $usuario->getId() . '">' . $usuario->getNombres() . '</option>';
                }


                $respuesta.='
                </select>
                </div>
                
                <button type="submit" class="enviar">
                    Registrar
                </button>
            </form>

            </div>';

        return $respuesta;
        } catch (Exception $e) {
            error_log('Dashboard::formularioCita -> excepcion: ' . $e);
        }
    }
}
