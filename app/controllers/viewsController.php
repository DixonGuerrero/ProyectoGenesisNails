<?php

    namespace app\controllers;

    use app\models\viewsModel;

    class viewsController extends viewsModel{

        public function obtenerVistaControlador($vista){

            if($vista!=""):
                $respuesta=$this->obtenerVistaModelo($vista);
            else:
                $respuesta = "Home";
            endif;

            return $respuesta;
        }

    }

?>