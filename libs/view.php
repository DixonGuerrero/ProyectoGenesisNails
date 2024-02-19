<?php 
    class View{
        public $d;

        function __construct(){
            error_log('View::construct -> Inicio de View');

        }

        public function render($nombre, $data=[]): void
        {
            error_log('View::render -> Inicio de render');
            $this->d = $data;
            require 'app/views/' . $nombre . '.php';
        }

        
    }
?>