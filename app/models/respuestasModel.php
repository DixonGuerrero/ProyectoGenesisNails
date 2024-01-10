<?php

    namespace app\models;

    /**
     * Clase encargada de gestionar las respuestas http
     */
    class respuestasModel{

    /**
     * Enviar una respuesta exitosa (código HTTP 200) con datos.
     *
     */
    public function respuestaExitosa($datos) {
        header('Content-Type: application/json');
        http_response_code(200);
        return json_encode(['estado' => 'success', 'datos' => $datos]);
    }

    /**
     * Enviar una respuesta de error (código HTTP 400) con un mensaje.
     *
     */
    public function respuestaError400($mensaje) {
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode(['estado' => 'error', 'mensaje' => $mensaje]);
    }

    /**
     * Enviar una respuesta de error no encontrada (código HTTP 404).
     */
    public function respuestaError404() {
        header('Content-Type: application/json');
        http_response_code(404);
        echo json_encode(['estado' => 'error', 'mensaje' => 'Recurso no encontrado']);
    }

    /**
     * Enviar una respuesta de error interno del servidor (código HTTP 500) con un mensaje.
     *
     */
    public function respuestaError500($mensaje) {
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode(['estado' => 'error', 'mensaje' => $mensaje]);
    }
    }
?>