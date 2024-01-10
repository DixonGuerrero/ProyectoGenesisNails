<?php
//Probamos metodos de la conexion
        use app\models\conexionModel;
        $conexion = new conexionModel();

        //echo $conexion->obtenerTodo('persona', 10);
        echo $conexion->obtenerTodo('persona',10)
?>