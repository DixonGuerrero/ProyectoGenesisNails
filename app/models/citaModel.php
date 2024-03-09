<?php 
    class CitaModel extends Model implements IModel{

        private $id_cita;
        private $id_servicio;
        private $id_cliente;
        private $fecha;
        private $imagenServicio;
        private $tipoServicio;
        private $descripcionServicio;

        public function __construct(){
            parent::__construct();

            $this->id_cita = 0;
            $this->id_servicio = 0;
            $this->id_cliente = 0;
            $this->fecha = '';
            $this->imagenServicio = '';
            $this->tipoServicio = '';
            $this->descripcionServicio = '';

        }

        public function guardar(){
            try {

                $data = [
                    'id_servicio' => $this->id_servicio,
                    'id_cliente' => $this->id_cliente,
                    'fecha' => $this->fecha
                ];

                $respuesta =  $this->api->crear('cita',$data);

                return $respuesta;

            } catch (Exception $e) {
                error_log('CitaAdminModel::guardar -> ERROR: ' . $e);
                return false;

            }
        }

        public function obtenerTodo(){
            $datos = [];
            try {

                $respuesta = $this->api->obtenerTodo('cita');

  
                
                foreach($respuesta['response'] as $row){

                    $item = new CitaModel();
                    $item->asignarDatos($row);

                    array_push($datos, $item);

                }


                return $datos;

            } catch (Exception $e) {
                error_log('CitaAdminModel::obtenerTodo -> ERROR: ' . $e);
                return false;
            }

        }

        public function obtenerUno($id){
            $datos = [];
            try {

                $respuesta = $this->api->obtenerUno('cita',$id);

                foreach($respuesta['response'] as $row){
                    $item = new CitaModel();
                    $item->asignarDatos($row);
                    array_push($datos, $item);
                }

                return $datos;

            } catch (Exception $e) {
                error_log('CitaAdminModel::obtenerUno -> ERROR: ' . $e);
                return false;
            }
        }

        public function actualizar(){
            try {
                $data = [
                    'id_servicio' => $this->id_servicio,
                    'fecha' => $this->fecha
                ];

                $respuesta = $this->api->actualizar('cita',$data,$this->id_cita);

                return $respuesta;

            } catch (Exception $e) {
                error_log('CitaAdminModel::actualizar -> ERROR: ' . $e);
                return false;
            }
        }

        public function eliminar($id){
            try {
                $respuesta = $this->api->eliminar('cita',$id);

                return $respuesta;

            } catch (Exception $e) {
                error_log('CitaAdminModel::eliminar -> ERROR: ' . $e);
                return false;
            }
        }



        public function asignarDatos($datos){

            $this->setIdCita($datos['id_cita']);
            $this->setIdServicio($datos['id_servicio']);
            $this->setIdCliente($datos['id_cliente']);
            $this->setImagenServicio($datos['imagen']);
            $this->setTipoServicio($datos['tipo_servicio']);
            $this->setDescripcionServicio($datos['descripcion_servicio']);
            $this->setFecha($datos['fecha_cita']);

        }

        //Getters
        public function getIdCita(){
            return $this->id_cita;
        }

        public function getIdServicio(){
            return $this->id_servicio;
        }

        public function getIdCliente(){
            return $this->id_cliente;
        }

        public function getImagenServicio(){
            return $this->imagenServicio;
        }

        public function getTipoServicio(){
            return $this->tipoServicio;
        }

        public function getDescripcionServicio(){
            return $this->descripcionServicio;
        }

        public function getFecha(){
            return $this->fecha;
        }

        //Setters

        public function setIdCita($id_cita){
            $this->id_cita = $id_cita;
        }

        public function setIdServicio($id_servicio){
            $this->id_servicio = $id_servicio;
        }

        public function setIdCliente($id_cliente){
            $this->id_cliente = $id_cliente;
        }

        public function setImagenServicio($imagenServicio){
            $this->imagenServicio = $imagenServicio;
        }

        public function setTipoServicio($tipoServicio){
            $this->tipoServicio = $tipoServicio;
        }

        public function setDescripcionServicio($descripcionServicio){
            $this->descripcionServicio = $descripcionServicio;
        }

        public function setFecha($fecha){
            $this->fecha = $this->formatoFecha($fecha);
        }


        public function formatoFecha($fecha){
            $fecha = explode('T',$fecha);
            return $fecha[0];
        }


    }
?>