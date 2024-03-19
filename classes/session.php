<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Session{

    private $sessionName = 'user';
    private $token = '';

    public function __construct(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function setCurrentUser($user){
        $_SESSION[$this->sessionName] = $user;
    }

    public function setCurrentToken($token){
        $_SESSION['token'] = $token;
    }

    public function getCurrentToken(){
        return $_SESSION['token'];
    }

    public function getCurrentUser(){
        return $_SESSION[$this->sessionName];
    }

    public function closeSession(){
        error_log('Session::closeSession()' . $this->sessionName);

        session_unset();
        session_destroy();
    }

    public function exists(){
        return isset($_SESSION[$this->sessionName]) && isset($_SESSION['token']);
    }

    public function validacionToken($token){
        error_log('Session::validacionTokenq()');

        try {

            $decoded = $this->decodificarToken($token);

            error_log('Session::validacionToken() -> decoded: ' . json_encode($decoded));

            if(isset($decoded->id)){
                error_log('Session::validacionToken() -> id: ' . $decoded->id);
                return $decoded->id;
            }

            return NULL;
        } catch (Exception $e) {
            return false;
        }
    }

    public function decodificarToken($token){
        $decoded = JWT::decode($token,new Key(KEY_TOKEN, 'HS256'));
        return $decoded;
    }
}

?>
