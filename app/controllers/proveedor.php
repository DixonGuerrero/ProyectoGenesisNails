<?php 
    class Proveedor extends SessionController{


        function __construct(){
            parent::__construct();
           $this->loadModel('Proveedor');
            error_log('Home::construct -> Inicio de Home');
        }

        public function render(){
            $this->view->render('proveedor/index',[
                'usuario' =>$this->usuario,
                'listaProveedores' => $this->listaProveedores()
            ]);
        }

        public function nuevoProveedor(){
           
            error_log('Proveedor::nuevoProveedor -> inicio de nuevoProveedor');

            if ($this->existeParametrosPost([
                'nombre',
                'direccion',
                'telefono',
                'email',
                'nit'
            ])) {
                $nombre = limpiarCadena($this->obtenerPost('nombre'));
                $direccion = limpiarCadena($this->obtenerPost('direccion'));
                $telefono = limpiarCadena($this->obtenerPost('telefono'));
                $email = limpiarCadena($this->obtenerPost('email'));
                $nit = limpiarCadena($this->obtenerPost('nit'));

                if ($nombre == '' || $direccion == '' || $telefono == '' || $email == '' || $nit == '') {
                    $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }
                
                $this->model->setNombre($nombre);
                $this->model->setDireccion($direccion);
                $this->model->setTelefono($telefono);
                $this->model->setEmail($email);
                $this->model->setNit($nit);

                $respuesta = $this->model->guardar();
                error_log('Proveedor::nuevoProveedor -> respuesta: ' . json_encode($respuesta));
                if ($respuesta['status'] != 200) {
                    $msg = $respuesta['response']['message'];
                    $this->alerta = new Alertas('ERROR', $msg);
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }
                $this->alerta = new Alertas('SUCCESS', 'Proveedor guardado correctamente');
                echo $this->alerta->simple()->exito()->getAlerta();
                exit();
            }
        }

        public function actualizarProducto(){
           
            error_log('Proveedor::actualizarProveedor -> inicio de actualizarProveedor');

            if ($this->existeParametrosPost([
                'id_proveedor',
                'nombre',
                'direccion',
                'telefono',
                'email',
                'nit'
            ])) {
                $id_proveedor = limpiarCadena($this->obtenerPost('id_proveedor'));
                $nombre = limpiarCadena($this->obtenerPost('nombre'));
                $direccion = limpiarCadena($this->obtenerPost('direccion'));
                $telefono = limpiarCadena($this->obtenerPost('telefono'));
                $email = limpiarCadena($this->obtenerPost('email'));
                $nit = limpiarCadena($this->obtenerPost('nit'));

                if ($id_proveedor == '' || $nombre == '' || $direccion == '' || $telefono == '' || $email == '' || $nit == '') {
                    $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }
                $this->model->setIdProveedor($id_proveedor);
                $this->model->setNombre($nombre);
                $this->model->setDireccion($direccion);
                $this->model->setTelefono($telefono);
                $this->model->setEmail($email);
                $this->model->setNit($nit);

                $respuesta = $this->model->actualizar();
                error_log('Proveedor::actualizarProveedor -> respuesta: ' . json_encode($respuesta));
                if ($respuesta['status'] != 200) {
                    $msg = $respuesta['response']['message'];
                    $this->alerta = new Alertas('ERROR', $msg);
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }
                $this->alerta = new Alertas('SUCCESS', 'Proveedor actualizado correctamente');
                echo $this->alerta->simple()->exito()->getAlerta();
                exit();
            }
        }

        public function eliminarProducto(){
          
            error_log('Proveedor::eliminarProveedor -> inicio de eliminarProveedor');

            if ($this->existeParametrosPost([
                'id_proveedor'
            ])) {
                $id_proveedor = limpiarCadena($this->obtenerPost('id_proveedor'));

                if ($id_proveedor == '') {
                    $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }
                $respuesta = $this->model->eliminar($id_proveedor);
                error_log('Proveedor::eliminarProveedor -> respuesta: ' . json_encode($respuesta));
                if ($respuesta['status'] != 200) {
                    $msg = $respuesta['response']['message'];
                    $this->alerta = new Alertas('ERROR', $msg);
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }
                $this->alerta = new Alertas('SUCCESS', 'Proveedor eliminado correctamente');
                echo $this->alerta->simple()->exito()->getAlerta();
                exit();
            }
        }

        public function numProveedores(){
            error_log('Proveedor::numProveedores -> inicio de numProveedores');

            try {
                $proveedores = $this->model->obtenerTodo();

                if ($proveedores) {
                    $numProveedores = count($proveedores);
                    error_log('Proveedor::numProveedores -> numProveedores: ' . $numProveedores);
                    return $numProveedores;
                }
            } catch (Exception $e) {
                error_log('Proveedor::numProveedores -> ERROR: ' . $e);
                return false;
            }
        }

        public function listaProveedores(){
        try {
            //Obtener Datos
            $proveedores = $this->model->obtenerTodo();


            //Validamos los usuarios si no hay mostramos por pantalla un mensaje que diga que no hay usuarios

            if (!$proveedores) {
                $respuesta = '<div class="contenedor-usuarios">
                <h3>No hay Proveedores Registrados</h3>
                </div>';

                return $respuesta;
                exit();
            }

            //Si hay datos vamos a empezar a crear la tabla
            //Creamos tabla
            $tabla = '
            <div class="table-header">
                <p>Lista Proveedores</p>
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
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Nit</th>
                            <th>Direccion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';

            //Empezamos a recorrer los datos y agregarlos a la tabla

            foreach ($proveedores as $proveedor) {
                $tabla .= '<tr>
                <td>' . $proveedor->getIdProveedor() . '</td>
                <td>'.$proveedor->getNombre().'</td>
                <td>' . $proveedor->getTelefono() . '</td>
                <td>' . $proveedor->getEmail() . '</td>
                <td>' . $proveedor->getNit() . '</td>
                <td>' . $proveedor->getDireccion() . '</td>
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