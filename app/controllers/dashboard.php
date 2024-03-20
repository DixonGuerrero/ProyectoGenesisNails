<?php
class Dashboard extends SessionController
{
    private $cita;
    function __construct()
    {
        parent::__construct();
        error_log('Dashboard::construct -> Inicio de Dashboard');
        $this->cita = new CitaAdminModel();
    }

    public function render()
    {
        $this->view->render('dashboard/index', [
            'usuario' => $this->usuario,
            'mensajeTiempo' => $this->mensajeTiempo(),
            'citas' => $this->citasReservadas(),
            'servicioSemana' => $this->servicioSemana(),
            'formularioCita' => $this->formularioCita()
        ]);
    }

    public function mensajeTiempo()
    {
        // Obtener la hora actual
        $hora = date("H");

        // Inicializar variable de mensaje
        $mensaje = '';

        // Determinar el mensaje apropiado según la hora
        if ($hora >= 6 && $hora < 12) {
            $mensaje = 'Buenos días, ';
        } elseif ($hora >= 12 && $hora < 18) {
            $mensaje = 'Buenas tardes, ';
        } else {
            $mensaje = 'Buenas noches, ';
        }

        $mensaje .= $this->usuario->getUsuario();

        // Mostrar el mensaje
        return $mensaje;
    }

    public function citasReservadas()
    {
        try {
            $citas = $this->cita->obtenerTodo();

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


            $respuesta = '
                <h2 class="titulo-sesion">
                    <ion-icon name="calendar"></ion-icon>
                    Citas reservadas
                </h2>
            
                <div class="contenedor-citas">';

            foreach ($citasReservada as $cita) {
                $respuesta .= ' 
                    <div class="tarjeta-cita">
                        <div class="info">
                            <h2 class="titulo-cita">
                                ' . $cita->getTipoServicio() . '
                                <ion-icon name="storefront"></ion-icon>
                            </h2>
                            <p class="descripcion-cita">
                               ' . $cita->getDescripcionServicio() . '
                            </p>
                        </div>
                        <div class="fecha">
                            <ion-icon name="calendar-number"></ion-icon>
                            <p>' . $cita->formatoFecha($cita->getFecha()) . '</p>
                        </div>
                </div>';
            }

            $respuesta .= '</div>
                ';

            return $respuesta;
        } catch (Exception $e) {
            error_log('Cita::citasReservadas -> error: ' . $e);
        }
    }

    public function servicioSemana()
    {

        $servicio =  new ServicioModel();
        try {

            $citas =  $this->cita->obtenerTodo();
            

            $servicios = array();

            //Obtener id de servicios de las citas y mirar cual es el que mas se repite
            $IDsServicios = array();
            foreach ($citas as $cita) {
                array_push($IDsServicios, $cita->getIdServicio());
            }

            //Cual es el id mas repetido
            $frecuencia = array_count_values($IDsServicios);

            //Valor maximo
            $maximo = max($frecuencia);

            // Encontrar todos los elementos con la frecuencia máxima
            $elementosMasRepetidos = array_keys($frecuencia, $maximo);

            //Luego debemos cruzar esto con las busquedas por servicio y armar el html

            $servicio = $servicio->obtenerTodo();

            foreach($servicio as $item){
                if(in_array($item->getIdServicio(),$elementosMasRepetidos)){
                    array_push($servicios,$item);
                }
            }

            //Armar el html

            $respuesta = '';

            foreach($servicios as $servicio){
                $respuesta .='<div class="tarjeta-servicio-semana">
                    <img src="'.APP_URL.'assets/images/servicios/'.$servicio->getImagen().'" alt="">
                    <div class="info">
                        <h2 class="titulo-servicio">
                            '.$servicio->getTipoServicio().'
                        </h2>
                        <p class="descripcion-semana">
                            '.$servicio->getDescripcionServicio().'
                        </p>
                    </div>
                </div>';
            }

            return $respuesta;
        } catch (Exception $e) {
            error_log('Dashboard::servicioSemana -> excepcion: ' . $e);
        }
    }

    public function formularioCita(){
        $citas = [];
        try {
            $citas = $this->cita->obtenerTodo();

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
