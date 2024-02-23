<?php

    class View{
        public $d;

        function __construct(){
            error_log('View::construct -> Inicio de View');

        }

        public function render($nombre, $data=[]){
            error_log('View::render -> Inicio de render');
            $this->d = $data;

            $this->manejarMensajes();
            require 'app/views/' . $nombre . '.php';
        }

        public function manejarMensajes(){
            if(isset($_GET['exito'])){
                $this->manejarExitos();
            }else if(isset($_GET['error'])){
                $this->manejarErrores();

            }else if(isset($_GET['info'])){
                $this->manejarInformacion();
            }
        }

        public function manejarInformacion(){
            $codigo= $_GET['info'];
            $info = new InfoMensajes();

           if($codigo){
                $this->d['mensajeInfo'] = $info->desencriptarMensaje($codigo);
           }
            
        }

        public function manejarExitos(){
            $codigo= $_GET['exito'];
            $exito = new ExitoMensajes();
;
            if($exito->existeClave($codigo)){
                $this->d['mensajeExito'] = $exito->obtenerMensaje($codigo);
            }

          
        }

        public function manejarErrores(){
            $codigo= $_GET['error'];
            $error = new ErrorMensajes();

            if($error->existeClave($codigo)){
                $this->d['mensajeError'] = $error->obtenerMensaje($codigo);
            }
        }

        public function mostrarMensajes(){
            $this->mostrarMensajeExito();
            $this->mostrarMensajeError();
            $this->mostrarMensajeInfo();
        }

        public function mostrarMensajeInfo(){
            if(array_key_exists('mensajeInfo',$this->d)){
                echo '<script>Swal.fire({
                    title: "Información",
                    text: "'.$this->d['mensajeInfo'].'",
                    icon: "warning",
                  });</script>';
            }
        }

        public function mostrarMensajeExito(){
           if(array_key_exists('mensajeExito',$this->d)){
               echo '<script>Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Exito! '.$this->d['mensajeExito'].'",
                showConfirmButton: false,
                timer: 1800
              });</script>';
           }
        }

        public function mostrarMensajeError(){
            if(array_key_exists('mensajeError',$this->d)){
                echo'<script>Swal.fire({
                    title: "Precaución!",
                    text: "'.$this->d['mensajeError'].'",
                    icon: "error",
                  });</script>' ;
            }
        }
        
    }
?>