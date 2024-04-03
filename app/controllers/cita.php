<?php
class Cita extends SessionController
{
    function __construct()
    {
        parent::__construct();
        error_log('Home::construct -> Inicio de Home');
    }

    public function render()
    {
        $this->view->render('cita/index', [
            'usuario' => $this->usuario,
            'citas' => $this->citasReservadas(),
            'formularioActualizarCita' => $this->formularioActualizarCita(),
            'formularioCita' => $this->formularioCita()
        ]);
    }

    public function guardar()
    {
        error_log('Cita::guardar -> inicio de guardar');

        if ($this->existeParametrosPost([
            'id_servicio',
            'fecha',
            'hora'
        ])) {

            $id_servicio = (int) limpiarCadena($this->obtenerPost('id_servicio'));
            $fecha = limpiarCadena($this->obtenerPost('fecha'));
            $hora = limpiarCadena($this->obtenerPost('hora'));

            if ($id_servicio == '' || $fecha == '' || $hora == '') {
                $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            //Validar Fecha
            $fechaActual = date('Y-m-d');
            if ($fecha < $fechaActual) {
                $this->alerta = new Alertas('ERROR', 'La fecha no puede ser menor a la actual');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            //Modificamos la fecha para que se guarde con la hora
            $fecha1 = $fecha . 'T' . $hora;
            error_log('Cita::guardar -> fecha: ' . $fecha);

            $this->model->setIdServicio($id_servicio);
            $this->model->setFecha($fecha1);
            $this->model->setIdCliente($this->usuario->getIdCliente());

            $respuesta = $this->model->guardar();
            error_log('Cita::guardar -> respuesta: ' . json_encode($respuesta));
            if ($respuesta['status'] > 300) {
                error_log('Cita::guardar -> respuesta: Aqui tOY');

                $msg = $respuesta['response']['message'];
                $this->alerta = new Alertas('ERROR', $msg);
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }
            $this->alerta = new Alertas('SUCCESS', 'Cita guardada correctamente');
            http_response_code(200);
            echo $this->alerta->recargar()->exito()->getAlerta();
            exit();
        }
    }

    public function actualizar()
    {
        if (
            $this->existeParametrosPost([
                'id_servicio',
                'fecha',
                'hora',
                'id_cita'
            ])
        ) :

            $id_servicio = limpiarCadena($this->obtenerPost('id_servicio'));
            $fecha = limpiarCadena($this->obtenerPost('fecha'));
            $hora = limpiarCadena($this->obtenerPost('hora'));
            $id_cita = limpiarCadena($this->obtenerPost('id_cita'));

            if ($id_servicio == '' || $fecha == '' || $hora == '' || $id_cita == '') {
                $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            //Validar Fecha
            $fechaActual = date('Y-m-d');
            if ($fecha < $fechaActual) {
                $this->alerta = new Alertas('ERROR', 'La fecha no puede ser menor a la actual');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            //Modificamos la fecha para que se guarde con la hora
            $fecha1 = $fecha . 'T' . $hora;
            error_log('Cita::actualizar -> fecha: ' . $fecha);

            $this->model->setIdServicio($id_servicio);
            $this->model->setFecha($fecha1);
            $this->model->setIdCliente($this->usuario->getIdCliente());
            $this->model->setIdCita($id_cita);

            $respuesta = $this->model->actualizar();
            error_log('Cita::actualizar -> respuesta: ' . json_encode($respuesta));
            if ($respuesta['status'] > 300) {
                error_log('Cita::actualizar -> respuesta: Aqui tOY');

                $msg = $respuesta['response']['message'];
                $this->alerta = new Alertas('ERROR', $msg);
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }
            $this->alerta = new Alertas('SUCCESS', 'Cita actualizada correctamente');
            echo $this->alerta->recargar()->exito()->getAlerta();
            exit();

        endif;
    }

    public function eliminar()
    {
        error_log('Cita::eliminar -> inicio de eliminar');
        if ($this->existeParametrosPost(['id_cita'])) {
            $id = limpiarCadena($this->obtenerPost('id_cita'));
            if ($id == '') {
                $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            $respuesta = $this->model->eliminar($id);
            error_log('Cita::eliminar -> respuesta: ' . json_encode($respuesta));
            if ($respuesta['status'] != 200) {
                $msg = $respuesta['response']['message'];
                $this->alerta = new Alertas('ERROR', $msg);
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }
            $this->alerta = new Alertas('SUCCESS', 'Cita eliminada correctamente');
            echo $this->alerta->recargar()->exito()->getAlerta();
            exit();
        }
    }


    public function citasReservadas()
    {
        try {
            $citas = $this->model->obtenerTodo();
            error_log('Cita::citasReservadas -> Todas: ' . json_encode($citas));

            $fechaActual = date('Y-m-d');

            $idCliente = $this->usuario->getIdCliente();


            $citasUsuario = array();

            foreach ($citas as $cita) {
                error_log('Cita::citasReservadas -> cita: ' . $cita->getIdCliente());
                if ($cita->getIdCliente() == $idCliente) {
                    array_push($citasUsuario, $cita);
                }
            }

            error_log('Cita::citasReservadas -> citasUsuario: ' . json_encode($citasUsuario));

            if (count($citasUsuario) <= 0) {
                $respuesta = '<h2>No hay citas Reservadas</h2>';

                return $respuesta;
            }

            //Validar que la cita sea en el futuro

            $citasReservada = array();

            foreach ($citasUsuario as $cita) {
                if ($cita->getFecha() > $fechaActual) {
                    array_push($citasReservada, $cita);
                }
            }

            if (count($citasReservada) <= 0) {
                $respuesta = '<h2>No hay citas Reservadas</h2>';

                return $respuesta;
            }


            $respuesta = '';

            foreach ($citasReservada as $cita) {
                $respuesta .= ' 
                    <div class="tarjeta-cita">
                        <h2 class="servicio">' . $cita->getTipoServicio() . '
                            <ion-icon name="storefront"></ion-icon>
                        </h2>
                        <p>' . $cita->getDescripcionServicio() . '</p>
            
                        <div class="datos-cita">
                            <p class="fecha">Fecha: ' . $cita->formatoFecha($cita->getFecha()) . '</p>

                            <p >Hora: ' . $cita->formatoHora($cita->obtenerSoloHora($cita->getFecha())) . '</p>
                            
                        </div>

                        <input type="hidden" class="hora" value="' . $cita->obtenerSoloHora($cita->getfecha()) . '">

                        
                        <div class="acciones">

                            <button class="boton-editar  ">
                            <ion-icon name="create"></ion-icon>
                            </button>
                            

                            <form class="FormularioAjax" action="' . APP_URL . 'cita/eliminar" method="POST">

                            <button type="submit" class="boton-eliminar">
                            <ion-icon name="trash-bin"></ion-icon></button>

                            <input type="hidden" class="id_cita" name="id_cita" value="' . $cita->getIdCita() . '">

                            </form>
                        </div>
                </div>';
            }

            return $respuesta;
        } catch (Exception $e) {
            error_log('Cita::citasReservadas -> error: ' . $e);
        }
    }


    public function formularioActualizarCita()
    {
        $citas = [];
        $servicio = new ServicioModel();
        try {
            $servicios = $servicio->obtenerTodo();

            $respuesta = '
            <div class="modal_container">
            <div class="encabezado">
                <h1>Actualizar Cita</h1>
                <a href="#" class="modal_close">X</a>
            </div>
            
            <img src="' . APP_URL . 'assets/images/calendario_edit.png"  class="modal_img" alt="">
            <h2 class="modal_title">Configure su Cita</h2>
        
            <p class="modal_text">
                Edite los campos que crea necesarios
            </p>
            <form action="' . APP_URL . 'cita/actualizar" method="POST" class="form FormularioAjax">
                

                <div class="form_group">
                    <label for="servicio">Servicio</label>
                    <select name="id_servicio" id="servicio" class="form_input servicio" >';

            //Asignamos datos
            foreach ($servicios as $servicio) {
                $respuesta .= '<option value="' . $servicio->getIdServicio() . '">' . $servicio->getTipoServicio() . '</option>';
            }


            $respuesta .= '
                    </select>
                </div>

                <!-- <------Fecha y Hora------> 
                <div class="form_group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form__input fecha">
                </div>

                <div class="form_group">
                    <label for="hora">Hora</label>
                    <input type="time" name="hora" id="hora" class="form__input hora">
                </div>

                <input type="hidden" name="id_cita" id="id_cita" value="">

                <button type="submit" class="enviar">
                    Actualizar
                </button>
            </form>

            </div>';

            return $respuesta;
        } catch (Exception $e) {
            error_log('Dashboard::formularioCita -> excepcion: ' . $e);
        }
    }

    public function formularioCita(){
        $citas = [];
        $servicio = new ServicioModel();
        try {
            $servicios = $servicio->obtenerTodo();

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
            <form action="'.APP_URL.'cita/guardar" method="POST" class="form FormularioAjax">
                

                <div class="form_group">
                    <label for="servicio">Servicio</label>
                    <select name="id_servicio" id="servicio" class="form_input " >';

        //Asignamos datos
        foreach ($servicios as $servicio) {
            $respuesta .= '<option value="' . $servicio->getIdServicio() . '">' . $servicio->getTipoServicio() . '</option>';
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
