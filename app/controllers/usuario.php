<?php
class Usuario extends SessionController
{


    function __construct()
    {
        parent::__construct();
    }

    public function render()
    {

        $this->view->render('usuario/index', [
            'usuario' => $this->usuario,
            'tablaUsuarios' => $this->listaUsuarios()
        ]);
    }


    public function guardar(){
        error_log('Formulario::nuevoUsuario -> inicio de nuevoUsuario');
            
        if($this->existeParametrosPost(['nombres','apellidos','telefono','email','usuario','rol','clave1','clave2'])){

            error_log('Formulario::nuevoUsuario -> Existen parametros POST');

            $nombres = limpiarCadena($this->obtenerPost('nombres'));
            $apellidos = limpiarCadena($this->obtenerPost('apellidos'));
            $telefono = limpiarCadena($this->obtenerPost('telefono'));
            $correo = limpiarCadena($this->obtenerPost('email'));
            $usuario = limpiarCadena($this->obtenerPost('usuario'));
            $rol = strtolower(
                limpiarCadena($this->obtenerPost('rol'))
            );
            $contrasena = limpiarCadena($this->obtenerPost('clave1'));
            $contrasena2 = limpiarCadena($this->obtenerPost('clave2'));

            if($nombres == '' || $apellidos == '' || $telefono == '' || $correo == '' || $usuario == '' || $contrasena == '' || $contrasena2 == '' || $rol == ''){
                $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');

                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            if($contrasena != $contrasena2){
                $this->alerta = new Alertas('ERROR', 'Las contraseñas no coinciden');

                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            if(($_FILES['imagen'])):
                $imagen = $this->cargarImagen($usuario,'usuario', 'imagen' );

                if(isset($imagen)):
                    $this->usuario->setImagen($imagen);
                else:
                    $this->alerta = new Alertas('ERROR', 'Error al cargar la imagen');
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                endif;
            endif;

            $this->usuario->setNombres($nombres);
            $this->usuario->setApellidos($apellidos);
            $this->usuario->setTelefono($telefono);
            $this->usuario->setEmail($correo);
            $this->usuario->setUsuario($usuario);
            $this->usuario->setPassword($contrasena);
            $this->usuario->setRole($rol);

            $respuesta = $this->usuario->guardar();


            error_log('Formulario::nuevoUsuario -> respuesta: ' . json_encode($respuesta));
            if($respuesta['status'] > 300){
                $msg = $respuesta['response']['message'];
                $this->alerta = new Alertas('ERROR', $msg);
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            if($respuesta['status'] == 201){
                //Redireccionamos al login
                $this->alerta = new Alertas('EXITO', 'Usuario creado correctamente');
                http_response_code(200);
                
                echo $this->alerta->recargar()->exito()->getAlerta();

                exit();
            }


        }else{
            $this->alerta = new Alertas('ERROR', 'Todos los campos son obligatorios');

            http_response_code(400);
            echo $this->alerta->simple()->error()->getAlerta();
            exit();
        }
    }

    public function actualizarUsuario()
    {
        error_log(
            'Usuario::actulizarUsuario -> inicio de actulizarUsuario'
        );

        if ($this->existeParametrosPost(
            'nombres',
            'apellidos',
            'correo',
            'telefono',
            'usuario',
        )) {
            $nombres = limpiarCadena($this->obtenerPost('nombres'));
            $apellidos = limpiarCadena($this->obtenerPost('apellidos'));
            $correo = limpiarCadena($this->obtenerPost('correo'));
            $telefono = limpiarCadena($this->obtenerPost('telefono'));
            $usuario = limpiarCadena($this->obtenerPost('usuario'));


            if ($nombres == '' || $apellidos == '' || $correo == '' || $telefono == '' || $usuario == '') {
                $this->alerta = new Alertas('Error', 'Campos vacios');

                http_response_code(400);
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }


            $this->usuario->setNombres($nombres);
            $this->usuario->setApellidos($apellidos);
            $this->usuario->setEmail($correo);
            $this->usuario->setTelefono($telefono);
            $this->usuario->setUsuario($usuario);


            $respuesta = $this->usuario->actualizar();

            error_log('Usuario::actulizarUsuario -> respuesta: ' . json_encode($respuesta));

            if (!isset($respuesta)) {
                $this->alerta = new Alertas('Error', 'No se pudo actualizar el usuario');

                http_response_code(400);
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            if ($respuesta['status'] != 200) {
                $this->alerta = new Alertas('Error', $respuesta['response']['message']);

                http_response_code(400);
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            $nuevosDatos = $this->usuario = $this->usuario->obtenerUno($this->usuario->getId());

            error_log('Usuario::actulizarUsuario -> nuevosDatos: ' . json_encode($nuevosDatos));



            $this->alerta = new Alertas('Exito', 'Usuario actualizado');

            http_response_code(200);
            header('Content-Type: application/json');
            //Recargamos la pagina
            echo $this->alerta->simple()->exito()->getAlerta();
            exit();
        } else {
            $this->alerta = new Alertas('Error', 'Campos vacios');

            http_response_code(400);
            header('Content-Type: application/json');
            echo $this->alerta->simple()->error()->getAlerta();
            exit();
        }
    }

    public function eliminar(){
        if($this->existeParametrosPost('id_usuario')):
            $id_usuario =limpiarCadena($this->obtenerPost('id_usuario'));

            if(!isset($id_usuario)):
                $this->alerta = new Alertas('Error', 'No se pudo obtener el id del usuario');
                
                http_response_code(400);

                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            endif;

            $respuesta = $this->model->eliminar($id_usuario);

            if($respuesta['status'] != 201):
                $msg = $respuesta['response']['message'];
                $this->alerta = new Alertas('Error', $msg);
                
                http_response_code(400);

                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            endif;

            error_log('Usuario::eliminar -> respuesta: ' . json_encode($respuesta));

            $this->alerta = new Alertas('Exito', 'Usuario eliminado correctamente');
            http_response_code(200);
            echo $this->alerta->recargar()->exito()->getAlerta();
            exit();

        endif;
    }



    public function actualizarPassword()
    {
        //Validar los campos del formulario
        if ($this->existeParametrosPost(['usuario_password', 'usuario_password_new'])) {
            $password = $this->obtenerPost('usuario_password');
            $password_new = $this->obtenerPost('usuario_password_new');

            if ($password == '' || $password_new == '') {
                $this->alerta = new Alertas('Error', 'Campos vacios');

                http_response_code(400);
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            //Validar password
            if ($password == $password_new) {
                $this->alerta = new Alertas('Error', 'La nueva contraseña no puede ser igual a la actual');

                http_response_code(400);
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            //Validar password actual
            if (!password_verify($password, $this->usuario->getPassword())) {
                $this->alerta = new Alertas('Error', 'Contraseña actual incorrecta');

                http_response_code(400);
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            //Validar password
            if (verificarDatos('^(?=.*[A-Z]).{8,20}$
                ', $password_new)) {
                $this->alerta = new Alertas('Error', 'La contraseña debe tener al menos 8 caracteres, una mayuscula y un numero');

                http_response_code(400);
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            //Actualizar password
            $this->usuario->setPassword($password_new);
            $respuesta = $this->usuario->actualizarPassword();

            if (!$respuesta) {
                $this->alerta = new Alertas('Error', 'No se pudo actualizar la contraseña');

                http_response_code(400);
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            if ($respuesta['status'] != 200) {
                $this->alerta = new Alertas('Error', $respuesta['response']['message']);

                http_response_code(400);
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            $this->alerta = new Alertas('Exito', 'Contraseña actualizada');

            http_response_code(200);
            header('Content-Type: application/json');
            //Recargamos la pagina
            echo $this->alerta->recargar()->exito()->getAlerta();
            exit();
        }
    }

    public function numUsuarios()
    {
        try {
            $numUsuarios  = $this->usuario->obtenerTodo();

            if ($numUsuarios) {
                $numUsuarios = count($numUsuarios);
                error_log('Usuario::numUsuarios -> numUsuarios: ' . $numUsuarios);
                return $numUsuarios;
            }

            return 0;
        } catch (Exception $e) {
            error_log('Usuario::numUsuarios -> ERROR: ' . $e);
            return 0;
        }
    }

    public function listaUsuarios()
    {
        try {
            //Obtener Datos
            $usuarios = $this->usuario->obtenerTodo();


            //Validamos los usuarios si no hay mostramos por pantalla un mensaje que diga que no hay usuarios

            if (!$usuarios) {
                $respuesta = '<div class="contenedor-usuarios">
                <h3>No hay usuarios Registrados</h3>
                </div>';

                return $respuesta;
                exit();
            }

            //Si hay datos vamos a empezar a crear la tabla
            //Creamos tabla
            $tabla = '
            <div class="table-header">
                <p>Lista Usuarios</p>
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
                            <th>Perfil</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';

            //Empezamos a recorrer los datos y agregarlos a la tabla

            foreach ($usuarios as $usuario) {
                $tabla .= '<tr>
                <td>' . $usuario->getId() . '</td>
                <td><img src="' . APP_URL . 'assets/images/usuario/' . $usuario->getImagen() . '" alt=""></td>
                <td>' . $usuario->getNombres() . '</td>
                <td>' . $usuario->getApellidos() . '</td>
                <td>' . $usuario->getEmail() . '</td>
                <td>' . $usuario->getTelefono() . '</td>
                <td>' . $usuario->getRole() . '</td>
                <td >
                   <div class="acciones">
                   <button class="editar">
                   <ion-icon name="create"></ion-icon>
               </button>

               <form  action="'.APP_URL.'usuario/eliminar" method="POST" class="form FormularioAjax">
                
               <button type="submit" class="eliminar">
               <ion-icon name="trash-bin"></ion-icon></button>

                  <input type="hidden" name="id_usuario" value="'.$usuario->getId().'"> 

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



}
