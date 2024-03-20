<?php 
    class Servicio extends SessionController{


        function __construct(){
            parent::__construct();
            error_log('ServicioAdmin::construct -> Inicio de ServicioAdmin');
        }

        public function render(){
            $this->view->render('servicio/index',[
                'usuario' =>$this->usuario,
                'servicios' => $this->todos()
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
                        <h2>'.$servicio->getTipoServicio().'
                            <ion-icon name="storefront"></ion-icon>
                        </h2>
                        <p>'.$servicio->getDescripcionServicio().'</p>
                        <a href="#" class="boton-agendar-servicio">
                            Agendar cita
                            <ion-icon name="arrow-forward-circle"></ion-icon>
                        </a>
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
       
    } 
?>