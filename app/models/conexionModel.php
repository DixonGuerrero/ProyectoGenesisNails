<?php

    namespace app\models;
    use app\models\respuestasModel;
    use php\utils;

    //Verificar si el archivo de configuracion existe
    if(file_exists(__DIR__."/../../config/config.php")){
        require_once __DIR__."/../../config/config.php";
    }

    

class conexionModel {


    public function __construct(
        private $conexion,private $respuestas
    ){
        
        $this->conexion = $this->conectar();
        $this->respuestas = new respuestasModel();
    }


    public function conectar(){

        $conexion = new \mysqli(
            DB_HOST,
            DB_USER,
            DB_PASS,
            DB_NAME
        );
        
        if($conexion->connect_error){
            throw new \mysqli_sql_exception('
                Error al conectar con la BD
            ');
        }
        $conexion->set_charset('utf8');
        return $conexion;
    }

    

    public function obtenerTodo(string $tabla, int $limit){

        if(!is_int($limit) || $limit <= 0){
            return 'Datos incorrectos';
        }

        $tabla = utils::limpiarCadena($tabla);

        $query = "SELECT * FROM $tabla LIMIT ?";

        $stmt = $this->conexion->prepare($query);

        $stmt->bind_param('i' , $limit);

        $resultado = $stmt->execute();

        if($resultado){
            $respuesta = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $respuesta = $this->respuestas->respuestaExitosa($respuesta);
        }else{
            return $this->respuestas->respuestaError500('
                Error en el servidor
            ');
        }
    } 
    
   
    public function obtenerPorId(string $tabla, int $id){
        
        if(!is_numeric($id) || $id <= 0){
            return $this->respuestas->respuestaError400('Datos incorrectos');
        }

        $query = "SELECT * FROM $tabla WHERE id_persona = ?";

        $stmt = $this->conexion->prepare($query);

        $stmt->bind_param('i' , $id);

        $resultado = $stmt->execute();

        if($resultado){
            
            $respuesta =  $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $this->respuestas->respuestaExitosa($respuesta);
        }else{
            return $this->respuestas->respuestaError500('
                Error en el servidor
            ');
        }
    }

    public function insertar(array $datos, string $tabla){
        $query = "INSERT INTO $tabla (
            $datos->
        ) VALUES (

        )";
    }

    public function delete(int $id){
        # code...
    }



}

?>
