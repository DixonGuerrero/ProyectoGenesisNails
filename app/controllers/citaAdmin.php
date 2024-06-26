<?php
class CitaAdmin extends SessionController
{

    function __construct()
    {
        parent::__construct();
        $this->loadModel('CitaAdmin');
        
    }

    public function render()
    {
        $this->view->render('citaAdmin/index', [
            'usuario' => $this->usuario,
            'tablaCitas' => $this->listaCitas(),
            'formularioCita' => $this->formularioCita(),
            'formularioActualizarCita' => $this->formularioActualizarCita()
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

    public function actualizar(){
        if (
         $this->existeParametrosPost([
             'id_servicio',
             'fecha',
             'hora',
             'id_cita'
         ])
        ):

         $id_servicio = limpiarCadena($this->obtenerPost('id_servicio'));
         $fecha = limpiarCadena($this->obtenerPost('fecha'));
         $hora = limpiarCadena($this->obtenerPost('hora'));
         $id_cita = limpiarCadena($this->obtenerPost('id_cita'));

         if($id_servicio == '' || $fecha == '' || $hora == '' || $id_cita == ''){
             $this->alerta = new Alertas('ERROR','Todos los campos son obligatorios');
             http_response_code(400);
             echo $this->alerta->simple()->error()->getAlerta();
             exit();
         }

         //Validar Fecha
         $fechaActual = date('Y-m-d');
         error_log('Cita::actualizar -> fechaActual: '.$fechaActual);
         if($fecha < $fechaActual){
             $this->alerta = new Alertas('ERROR','La fecha no puede ser menor a la actual');
             http_response_code(400);
             echo $this->alerta->simple()->error()->getAlerta();
             exit();
         }

         //Modificamos la fecha para que se guarde con la hora
         $fecha1 = $fecha.'T'.$hora;
         error_log('Cita::actualizar -> fecha: '.$fecha);

         $this->model->setIdServicio($id_servicio);
         $this->model->setFecha($fecha1);
         $this->model->setIdCliente($this->usuario->getIdCliente());
         $this->model->setIdCita($id_cita);

         $respuesta = $this->model->actualizar();
         error_log('Cita::actualizar -> respuesta: '.json_encode($respuesta));
         if($respuesta['status'] > 300 ){
             error_log('Cita::actualizar -> respuesta: Aqui tOY');

             $msg = $respuesta['response']['message'];
             $this->alerta = new Alertas('ERROR',$msg);
             http_response_code(400);
             echo $this->alerta->simple()->error()->getAlerta();
             exit();
         }
         $this->alerta = new Alertas('SUCCESS','Cita actualizada correctamente');
         echo $this->alerta->recargar()->exito()->getAlerta();
         exit();

     endif;
     
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
            http_response_code(200);
            echo $this->alerta->redireccionar('citaAdmin')->exito()->getAlerta();
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
                            <ion-icon name="storefront"></ion-icon>
                            Servicio</th>
                            <th>
                            <ion-icon name="reorder-three"></ion-icon>
                            Tipo Servicio</th>
                            <th>
                            <ion-icon name="person"></ion-icon>
                            Cliente</th>
                            <th>
                            <ion-icon name="person"></ion-icon>
                            Fecha</th>
                            <th>
                            <ion-icon name="alarm"></ion-icon>
                            Hora</th>
                            <th>
                            <ion-icon name="build"></ion-icon>
                            Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="citas">';

            //Empezamos a recorrer los datos y agregarlos a la tabla

            foreach ($citas as $cita) {
                $tabla .= '<tr>
                <td>' . $cita->getIdCita() . '</td>
                <td><img src="' . APP_URL . 'assets/images/servicios/' . $cita->getImagenServicio() . '" alt=""></td>
                <td>' . $cita->getTipoServicio() . '</td>
                <td>' . $this->getNombreClietne($cita->getIdCliente()) . '</td>
                <td>' . $cita->formatoFecha($cita->getFecha()). '</td>
                <td>' . $cita->formatoHora($cita->obtenerSoloHora($cita->getFecha())). '</td>
                <td>


                <input type="hidden" name="" id="hora_cita" value="'.$cita->obtenerSoloHora($cita->getFecha()).'">
                <div class="acciones">
                    <button class="editar boton-editar" id="editar">
                        <ion-icon name="create"></ion-icon>
                    </button>
                    
               <form  action="'.APP_URL.'citaAdmin/eliminar" method="POST" class="form FormularioAjax">
                
               <button type="submit" class="eliminar">
               <ion-icon name="trash-bin"></ion-icon></button>

                  <input type="hidden" name="id_cita" value="'.$cita->getIdCita().'"> 

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


    public function getNombreClietne($idCliente)
    {
        $user = new UsuarioModel();
        $cliente = $user->obtenerUno($idCliente);

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

    public function formularioActualizarCita(){
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
            
            <img src="'.APP_URL.'assets/images/calendario_edit.png"  class="modal_img" alt="">
            <h2 class="modal_title">Configure su Cita</h2>
        
            <p class="modal_text">
                Edite los campos que crea necesarios
            </p>
            <form action="'.APP_URL.'citaAdmin/actualizar" method="POST" class="form FormularioAjax">
                

                <div class="form_group">
                    <label for="servicio">Servicio</label>
                    <select name="id_servicio" id="servicio" class="form_input servicio" >';

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
}
