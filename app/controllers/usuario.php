<?php
class Usuario extends SessionController
{

    public $user;

    function __construct()
    {
        parent::__construct();
        $this->user = new UsuarioModel();
    }

    public function render()
    {

        $this->view->render('usuario/index', [
            'usuario' => $this->usuario,
            'tablaUsuarios' => $this->listaUsuarios()
        ]);

        
    }


    public function guardar(){
            
        if($this->existeParametrosPost(['nombres','apellidos','telefono','email','usuario','rol','clave1','clave2'])){



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

           

            if(($_FILES['imagen']) && ($_FILES['imagen']['size'] > 0)):

                error_log('Formulario::nuevoUsuario -> Existe imagen' . $_FILES['imagen']['name']);

                $imagen = $this->cargarImagen($usuario,'usuario', 'imagen' );

                if(isset($imagen)):
                    $this->user->setImagen($imagen);
                else:
                    $this->alerta = new Alertas('ERROR', 'Error al cargar la imagen');
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                endif;
            endif;

            $this->user->setNombres($nombres);
            $this->user->setApellidos($apellidos);
            $this->user->setTelefono($telefono);
            $this->user->setEmail($correo);
            $this->user->setUsuario($usuario);
            $this->user->setPassword($contrasena);
            $this->user->setRole($rol);

            $respuesta = $this->user->guardar();


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
            'usuario'

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

    public function actualizarUsuarioAdmin()
    {
        error_log(
            'Usuario::actulizarUsuario -> inicio de actulizarUsuario'
        );

        if ($this->existeParametrosPost(
            'nombres',
            'apellidos',
            'email',
            'telefono',
            'usuario',
            'password',
            'password_new',
            'password_new_confirm',
            'id_usuario'

        )) {
            $nombres = limpiarCadena($this->obtenerPost('nombres'));
            $apellidos = limpiarCadena($this->obtenerPost('apellidos'));
            $correo = limpiarCadena($this->obtenerPost('email'));
            $telefono = limpiarCadena($this->obtenerPost('telefono'));
            $usuario = limpiarCadena($this->obtenerPost('usuario'));
            $claveActual = limpiarCadena($this->obtenerPost('password'));
            $clave1 = limpiarCadena($this->obtenerPost('password_new'));
            $clave2 = limpiarCadena($this->obtenerPost('password_new_confirm'));


            if ($nombres == '' || $apellidos == '' || $correo == '' || $telefono == '' || $usuario == '') {
                $this->alerta = new Alertas('Error', 'Campos vacios');

                http_response_code(400);
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }
            
            $this->user->obtenerUno($this->obtenerPost('id_usuario'));

            //Seteamos los datos de el formulario al nuevo usuario
            $this->user->setNombres($nombres);
            $this->user->setApellidos($apellidos);
            $this->user->setEmail($correo);
            $this->user->setTelefono($telefono);
            $this->user->setUsuario($usuario);


           
            //Validamos si la password vienen definidas, si es asi pasamos a actualizar
            if($claveActual != '' && $clave1 != '' && $clave2 != ''):
                $this->actualizarPassword($this->user,$this->usuario->getPassword());

            endif;

            //Validamos si la imagen viene definida, si es asi pasamos a actualizar

            error_log('Usuario::actulizarUsuario -> Existe imagen->>>>>>' . $_FILES['imagen']['name']);

            if($_FILES['imagen'] && $_FILES['imagen']['size'] > 0):;
                $this->actualizarFoto($this->user);
            endif;

            $respuesta = $this->user->actualizar();

            error_log('Usuario::actulizarUsuario -> respuesta: ' . json_encode($respuesta));

            if (!isset($respuesta)) {
                $this->alerta = new Alertas('Error', 'No se pudo actualizar el usuario');

                http_response_code(400);
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            if ($respuesta['status'] > 300) {
                $this->alerta = new Alertas('Error', $respuesta['response']['message']);

                http_response_code(400);
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            




            $this->alerta = new Alertas('Exito', 'Usuario actualizado');

            http_response_code(200);
            header('Content-Type: application/json');
            //Recargamos la pagina
            echo $this->alerta->recargar()->exito()->getAlerta();
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

            error_log('Usuario::eliminar -> respuesta: ' . json_encode($respuesta));

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


    public function actualizarPassword(UsuarioModel $usuario = null,$passwordAdmin)
    {

        $usuario = $usuario ?? $this->usuario;
        //Validar los campos del formulario
        if ($this->existeParametrosPost(['password', 'password_new', 'password_new_confirm'])) {
            $password = $this->obtenerPost('password');
            $password_new = $this->obtenerPost('password_new');

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
            if (!password_verify($password, $passwordAdmin)) {
                $this->alerta = new Alertas('Error', 'Contraseña actual incorrecta');

                http_response_code(400);
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }

            //Validar password
            //TODO: Descomentar cuando se vaya a implementar
            /* if (verificarDatos('^(?=.*[A-Z]).{8,20}$
                ', $password_new)) {
                $this->alerta = new Alertas('Error', 'La contraseña debe tener al menos 8 caracteres, una mayuscula y un numero');

                http_response_code(400);
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            } */

            //Actualizar password
            $usuario->setPassword($password_new);
            $respuesta = $usuario->actualizarPassword();


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
        }else{
            $this->alerta = new Alertas('Error', 'Campos vacios');

            http_response_code(400);
            header('Content-Type: application/json');
            echo $this->alerta->simple()->error()->getAlerta();
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
                    <thead id="encabezado-tabla">
                        <tr>
                            <th>
                            <ion-icon name="id-card"></ion-icon>
                            Id
                            </th>
                            <th>
                            <ion-icon name="person-circle"></ion-icon>
                            Perfil
                            </th>
                            <th>
                            <ion-icon name="people-circle"></ion-icon>
                            Nombres</th>
                            <th>
                            <ion-icon name="people-circle"></ion-icon>
                            Apellidos</th>
                            <th>
                            <ion-icon name="mail"></ion-icon>
                            Email</th>
                            <th>
                            <ion-icon name="call"></ion-icon>
                            Telefono</th>
                            <th>
                            <ion-icon name="layers"></ion-icon>
                            Rol</th>
                            <th>
                            <ion-icon name="build"></ion-icon>
                            Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';

            //Empezamos a recorrer los datos y agregarlos a la tabla

            foreach ($usuarios as $usuario) {
                $tabla .= '<tr>
                <td class="id">' . $usuario->getId() . '</td>
                <td class="perfil"><img src="' . APP_URL . 'assets/images/usuario/' . $usuario->getImagen() . '" alt="">'.$usuario->getUsuario().'</td>
                <td>' . $usuario->getNombres() . '</td>
                <td>' . $usuario->getApellidos() . '</td>
                <td>' . $usuario->getEmail() . '</td>
                <td>' . $usuario->getTelefono() . '</td>
                <td>' . $usuario->getRole() . '</td>
                <td >
                   <div class="acciones">
                   <button class="editar boton-editar">
                   <ion-icon name="create"></ion-icon>
               </button>

            <input type="hidden"  name="usuario_tabla" class="usuario_tabla" value="'.$usuario->getUsuario().'" id="usuario">



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


    public function actualizarFoto(UsuarioModel $usuario = null ){
        $usuario = $usuario ?? $this->usuario;

        if(isset($_FILES['imagen'])):
            $imagen = $this->cargarImagen($usuario->getUsuario(),'usuario', 'imagen' );

            error_log('Usuario::actualizarFoto -> imagen: ' . $imagen);

            if($imagen != null):

                //Vamos a eliminar la foto anterior

                $fotoAnterior = $usuario->getImagen();
                error_log('Usuario::actualizarFoto -> fotoAnterior: ' . $fotoAnterior);

                if($fotoAnterior != 'default.jpg' ):
                    $respuesta = $this->eliminarImagen( $fotoAnterior,'usuario');
                    if (!$respuesta):
                        $this->alerta = new Alertas('ERROR', 'Error al eliminar la imagen anterior');

                        http_response_code(400);

                        echo $this->alerta->simple()->error()->getAlerta();
                        exit();
                    endif;
                endif;

                $usuario->setImagen($imagen);
            else:
                $this->alerta = new Alertas('ERROR', 'Error al cargar la imagen');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            endif;
        endif;

        //Actualizamos todo el perfil

        $respuesta = $usuario->actualizar();

        if($respuesta['status'] != 200):
            $msg = $respuesta['response']['message'];
            $this->alerta = new Alertas('ERROR', $msg);
            http_response_code(400);
            echo $this->alerta->simple()->error()->getAlerta();
            exit();
        endif;


        

        $this->alerta = new Alertas('EXITO', 'Imagen actualizada correctamente');
        http_response_code(200);
        echo $this->alerta->recargar()->exito()->getAlerta();
        exit();
    }





}
