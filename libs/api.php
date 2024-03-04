<?php 

    class API {
        private $url;
        private $headers;
        public $token;

        public function __construct($token = null){
            $this->url = URL_API;
            $this->headers = [
                'Content-Type: application/json',
                'x-access-token:'.$token
            ];
        }

        public function setToken($token){
            $this->token = $token;

            error_log('API::setToken -> Token: ' . $this->token);

            $this->actualizarHeader();
        }

        public function actualizarHeader(){
            array_push($this->headers, "x-access-token:".$this->token);

            error_log('API::actualizarHeader -> Token: ' .json_encode($this->headers));
        }

        private function callApi($method,$table,$data = null){

            $url = $this->url . $table;
            $data = json_encode($data);
            $channel = curl_init();

            error_log('API::callApi -> URL: ' . $url);
            error_log('API::callApi -> Datos:'. $data);

            switch($method){
                case "GET" :
                    error_log($this->token);
                break;
                case "POST":
                    curl_setopt($channel,CURLOPT_POST,TRUE);
                    
                    if($data){
                        curl_setopt($channel,CURLOPT_POSTFIELDS,$data);
                    }
                break;
                case "PUT":
                    curl_setopt($channel,CURLOPT_CUSTOMREQUEST, "PUT");
                    if($data){
                        curl_setopt($channel,CURLOPT_POSTFIELDS,$data);
                    }
                break;
                case "DELETE":
                    curl_setopt($channel,CURLOPT_CUSTOMREQUEST,"DELETE");
                break;
            }

            curl_setopt($channel,CURLOPT_URL,$url);
            curl_setopt($channel,CURLOPT_HTTPHEADER,$this->headers);
            curl_setopt($channel,CURLOPT_RETURNTRANSFER,TRUE);
            $respuesta = curl_exec($channel);

            if(!$respuesta) return curl_error($channel);

            $codigoEstado = curl_getinfo($channel,CURLINFO_HTTP_CODE);

            curl_close($channel);
            //Agregamos el codigo de estado a la respuesta
            $respuesta = json_encode(["status" => $codigoEstado, "response" => json_decode($respuesta,TRUE)]);

            return json_decode($respuesta,TRUE);
            
        }

        public function crear($table,$data){
            return $this->callApi("POST",$table,$data);
        }

        public function obtenerTodo($table){
            return $this->callApi("GET",$table);
        }

        public function obtenerUno($table,$id){
            return $this->callApi("GET","$table/$id");
        }

        public function actualizar($table,$data,$id){
            return $this->callApi("PUT","$table/$id",$data);
        }

        public function eliminar($table,$id){
            return $this->callApi("DELETE","$table/$id");
        }

        public function login($data){   
            return $this->callApi("POST","login",$data);

        }
    
    }
?>