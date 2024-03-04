<?php 
    class Usuario extends SessionController{
        private $usuario;
        
        
        function __construct(){
            parent::__construct();
            
            $this->usuario = $this->getUserSessionData();
        }

        public function render(){
            $this->view->render('usuario/index');
        }


        public function actulizarUsuario(){
            if($this->existeParametrosPost(
                'nombres',
                'apellidos',
                'correo',
                'telefono',
                'usuario',
            )){
                $nombres = limpiarCadena($this->obtenerPost('nombres'));
                $apellidos = limpiarCadena($this->obtenerPost('apellidos'));
                $correo = limpiarCadena($this->obtenerPost('correo'));
                $telefono = limpiarCadena($this->obtenerPost('telefono'));
                $usuario = limpiarCadena($this->obtenerPost('usuario'));


                if($nombres == '' || $apellidos == '' || $correo == '' || $telefono == '' || $usuario == ''){
                    $this->alerta = new Alertas('Error','Campos vacios');

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
                

                $respuesta = $this->usuario->guardar();

                if(!$respuesta){
                    $this->alerta = new Alertas('Error','No se pudo actualizar el usuario');

                    http_response_code(400);    
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }

                if($respuesta['status']!=200){
                    $this->alerta = new Alertas('Error',$respuesta['response']['message']);

                    http_response_code(400);    
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }

                $this->alerta = new Alertas('Exito','Usuario actualizado');

                http_response_code(200);
                header('Content-Type: application/json');
                //Recargamos la pagina
                echo $this->alerta->recargar()->exito()->getAlerta();
                exit();

            }else{
                $this->alerta = new Alertas('Error','Campos vacios');

                http_response_code(400);    
                header('Content-Type: application/json');
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }
        }

        

        public function actualizarPassword(){
            //Validar los campos del formulario
            if($this->existeParametrosPost(['usuario_password','usuario_password_new'])){
                $password = $this->obtenerPost('usuario_password');
                $password_new = $this->obtenerPost('usuario_password_new');

                if($password == '' || $password_new == ''){
                    $this->alerta = new Alertas('Error','Campos vacios');

                    http_response_code(400);    
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }

                //Validar password
                if($password == $password_new){
                    $this->alerta = new Alertas('Error','La nueva contraseña no puede ser igual a la actual');

                    http_response_code(400);    
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }

                //Validar password actual
                if(!password_verify($password,$this->usuario->getPassword())){
                    $this->alerta = new Alertas('Error','Contraseña actual incorrecta');

                    http_response_code(400);    
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }

                //Validar password
                if(verificarDatos('^(?=.*[A-Z]).{8,20}$
                ',$password_new)){
                    $this->alerta = new Alertas('Error','La contraseña debe tener al menos 8 caracteres, una mayuscula y un numero');

                    http_response_code(400);    
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();

                }

                //Actualizar password
                $this->usuario->setPassword($password_new);
                $respuesta = $this->usuario->guardar();

                if(!$respuesta){
                    $this->alerta = new Alertas('Error','No se pudo actualizar la contraseña');

                    http_response_code(400);    
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }

                if($respuesta['status']!=200){
                    $this->alerta = new Alertas('Error',$respuesta['response']['message']);

                    http_response_code(400);    
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }

                $this->alerta = new Alertas('Exito','Contraseña actualizada');

                http_response_code(200);
                header('Content-Type: application/json');
                //Recargamos la pagina
                echo $this->alerta->recargar()->exito()->getAlerta();
                exit();
        
    }
}

        

        public function actualizarImagen(){
            $directorioImagenes = 'app/assets/images/usuario/';

            if($_FILES['usuario_foto']['name']!="" && 
            $_FILES['usuario_foto']['size']>0){

                //Validar Directorio
                if(!file_exists($directorioImagenes)){
                    if(!mkdir($directorioImagenes, 0777)){
                        $this->alerta = new Alertas('Error','No se pudo crear el directorio de imagenes');

                        http_response_code(400);    
                        header('Content-Type: application/json');
                        echo $this->alerta->simple()->error()->getAlerta();
                        exit();
                    }
                   
                }

                //Validar formato de la imagen
                #Verificando formato img#
                if(mime_content_type($_FILES['usuario_foto']['tmp_name'])!="image/jpeg" &&
                mime_content_type($_FILES['usuario_foto']['tmp_name'])!="image/png"){
                    $this->alerta = new Alertas('Error','Formato de imagen no permitido');

                    http_response_code(400);    
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }

                //Validar tamaño de la imagen
                #Verificando peso de la imagen#
                if(($_FILES['usuario_foto']['size']/1024)>5120){
                    $this->alerta = new Alertas('Error','Tamaño de imagen no permitido');

                    http_response_code(400);    
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }

                //Crear Nombre de imagen
                $imagen = str_ireplace(" ","_",$this->usuario->getNombres());
                $imagen = $imagen."_".rand(0,1000);

                #Extension de imagen#
                switch(mime_content_type($_FILES['usuario_foto']['tmp_name'])){
                    case "image/jpeg":
                        $imagen=$imagen.".jpg";
                    break;
                    case "image/png":
                        $imagen=$imagen.".png";
                    break;
                }

                chmod($directorioImagenes,0777);

                #Moviendo imagenes al directorio#
                if(!move_uploaded_file($_FILES['usuario_foto']['tmp_name'],
                $directorioImagenes.$imagen)){
                    $this->alerta = new Alertas('Error','No se pudo subir la imagen');

                    http_response_code(400);    
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }


               //Actualizar imagen
                $this->usuario->setImagen($imagen);
                $respuesta = $this->usuario->guardar();
                
                if(!$respuesta){
                    $this->alerta = new Alertas('Error','No se pudo actualizar la imagen');

                    http_response_code(400);    
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }

                if($respuesta['status']!=200){
                    $this->alerta = new Alertas('Error',$respuesta['response']['message']);

                    http_response_code(400);    
                    header('Content-Type: application/json');
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }

                $this->alerta = new Alertas('Exito','Imagen actualizada');

                http_response_code(200);
                header('Content-Type: application/json');
                //Recargamos la pagina
                echo $this->alerta->recargar()->exito()->getAlerta();
                exit();

            }
        }





    }
?>