<?php 
    interface IModel{
        public function obtenerTodo();
        public function obtenerUno($id);
        public function guardar();
        public function actualizar();
        public function eliminar($id);
        public function asignarDatos($datos);
    }
?>