<?php

class Alertas{

    public $alerta = [];

    public function __construct($titulo = '', $mensaje = ''){
        error_log('Alertas::construct -> Inicio de Alertas');

        // Inicializamos la alerta con valores por defecto
        $this->alerta = [
            'titulo' => $titulo,
            'texto' => $mensaje

        ];
    }

    //Tipos de alertas

    public function simple(){

        $this->alerta['tipo'] = 'simple';

        return $this;
    }

    public function redireccionar($vista){
        $this->alerta['tipo'] = 'redireccionar';
        $this->alerta['url'] = APP_URL . $vista;
        error_log('Alertas::redireccionar -> url: ' . $this->alerta['url']);

        return $this;
    }

    public function recargar(){
        $this->alerta['tipo'] = 'recargar';
        return $this;
    }

    //Tipos de iconos

    public function error(){
        if (isset($this->alerta['tipo'])) {
            $this->alerta['icono'] = 'error';
            $this->alerta['titulo'] = 'Error';
        }

        return $this;
    }

    public function exito(){
        if (isset($this->alerta['tipo'])) {
            $this->alerta['icono'] = 'success';
        }

        return $this;
    }


    public function advertencia(){
        if (isset($this->alerta['tipo'])) {
            $this->alerta['icono'] = 'warning';
        }

        return $this;
    }

    public function info(){
        if (isset($this->alerta['tipo'])) {
            $this->alerta['icono'] = 'info';
        }

        return $this;
    }


    // Método para obtener la alerta en formato JSON
    public function getAlerta(){
        error_log('Alertas::getAlerta -> alerta: ' . json_encode($this->alerta));
        return json_encode($this->alerta);
    }
}
