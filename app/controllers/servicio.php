<?php 
    class Servicio extends SessionController{


        function __construct(){
            parent::__construct();
            error_log('ServicioAdmin::construct -> Inicio de ServicioAdmin');
        }

        public function render(){
            $this->view->render('servicio/index',[
                'usuario' =>$this->usuario,
                'servicios' => $this->todos(),
                'formularioCita' => $this->formularioCita()
            ]);
        }



        public function guardar(){}

        public function actualizar(){}

        public function eliminar(){}
        
        public function todos(){
            try {
                
                $datos = $this->model->obtenerTodo();

                if(!$datos){
                   $respuesta = '<h2 class="no-servicios">No hay servicios Registrados</h2>'; 
                   return $respuesta;

                }


                $tarjetas = '';

                foreach($datos as $servicio){
                    $tarjetas .= '
                    <div class="tarjeta-servicio">

                    <img src="' . APP_URL . 'assets/images/servicios/' . $servicio->getImagen() . '" alt=""></td>
                        <h2 class="servicio">'.$servicio->getTipoServicio().'
                            <ion-icon name="storefront"></ion-icon>
                        </h2>
                        <p>'.$servicio->getDescripcionServicio().'</p>
                        <button class="boton-agendar-servicio">
                            Agendar cita
                            <ion-icon name="arrow-forward-circle"></ion-icon>
                        </button>
                 </div>
                    ';
                }

                return $tarjetas;

            } catch (Exception $e) {
                error_log('Servicio::todos -> excepcion: ' . $e);
            }
        }

        public function servicioSemana(){
            //TODO: Obtener los servicios mas solicitados de la semana
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
?>