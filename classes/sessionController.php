<?php
/**
 * Controlador que también maneja las sesiones
 */
class SessionController extends Controller{
    
    private $userSession;
    private $username;
    private $userid;
    private $defaultSites;
    public $session;
    private $sites;


    public $usuario;
 
    function __construct(){
        parent::__construct();

        $this->init();
    }

    public function getUserSession(){
        return $this->userSession;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getUserId(){
        return $this->userid;
    }

    /**
     * Inicializa el parser para leer el .json
     */
    private function init(){
        //se crea nueva sesión
        $this->session = new Session();
        //se carga el archivo json con la configuración de acceso
        $json = $this->getJSONFileConfig();
        // se asignan los sitios
        $this->sites = $json['sites'];
        // se asignan los sitios por default, los que cualquier rol tiene acceso
        $this->defaultSites = $json['defaultSites'];
        // inicia el flujo de validación para determinar
        // el tipo de rol y permismos
        $this->validateSession();
    }
    /**
     * Abre el archivo JSON y regresa el resultado decodificado
     */
    private function getJSONFileConfig(){
        $string = file_get_contents("config/access.json");
        $json = json_decode($string, true);

        return $json;
    }

    /**
     * Implementa el flujo de autorización
     * para entrar a las páginas
     */
    function validateSession(){
        //Si existe la sesión
        if($this->existsSession()){
            $role = $this->getUserSessionData()->getRole();
            $role = strtolower($role);



            if($this->isPublic()){
                $this->redirectDefaultSiteByRole($role);
                error_log( "SessionController::validateSession() => sitio público, redirige al main de cada rol" );
            }else{
                if($this->isAuthorized($role)){
                    error_log( "SessionController::validateSession() => autorizado, lo deja pasar" );
                    //si el usuario está en una página de acuerdo
                    // a sus permisos termina el flujo
                }else{
                    error_log( "SessionController::validateSession() => no autorizado, redirige al main de cada rol" );
                    // si el usuario no tiene permiso para estar en
                    // esa página lo redirije a la página de inicio
                    $this->redirectDefaultSiteByRole($role);
                }
            }
        }else{
            error_log( "SessionController::validateSession() => no hay sesión" );

            if($this->isPublic()){
                error_log( "SessionController::validateSession() => sitio público, lo deja pasar" );
                //si el usuario está en una página pública
                // y no tiene sesión, lo deja pasar

            }else{

                error_log('SessionController::validateSession() redirect al home');
                error_log($this->getCurrentPage());
                 header('location: '. APP_URL.'');
            }
            
        }
    }
    /**
     * Valida si existe sesión, 
     * si es verdadero regresa el usuario actual
     */
    function existsSession(){


        if(!$this->session->exists()){
            return false;
        
        } 

        $userid = $this->session->getCurrentUser();

        if($userid) return true;

        return false;
    }

    function getUserSessionData(){

        $id = $this->session->getCurrentUser();
        $this->usuario = new UsuarioModel();
        $this->usuario->obtenerUno($id);
        error_log("sessionController::getUserSessionData(): " . $this->usuario->getNombres());
        return $this->usuario;
    }

    public function initialize($user,$token){
        
        $this->session->setCurrentUser($user->getId());
        $this->session->setCurrentToken($token);
        $this->authorizeAccess($user->getRole());
    }

    private function isPublic(){
        $currentURL = $this->getCurrentPage();
        error_log("sessionController::isPublic(): currentURL => " . $currentURL);
        $currentURL = preg_replace( "/\?.*/", "", $currentURL); //omitir get info
        for($i = 0; $i < sizeof($this->sites); $i++){
            if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['access'] === 'public'){
                return true;
            }
        }
        return false;
    }

    private function redirectDefaultSiteByRole($role){
        $url = $this->defaultSites[$role];
        error_log("sessionController::redirectDefaultSiteByRole(): role: $role, url: $url");
        header('location: '. APP_URL . $url);
        
    }

    private function isAuthorized($role){
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace( "/\?.*/", "", $currentURL); //omitir get info
        
        for($i = 0; $i < sizeof($this->sites); $i++){
            if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['role'] === $role){
                return true;
            }
        }
        return false;
    }

    private function getCurrentPage(){
        
        $actual_link = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', $actual_link);
        error_log("sessionController::getCurrentPage(): actualLink =>" . $actual_link . ", url => " . $url[3]);
        return $url[3];
    }

    function authorizeAccess($role){
        error_log("sessionController::authorizeAccess(): role: $role");
        switch($role){
            case 'cliente':
                $this->alerta = new Alertas('Exito', 'Bienvenido al panel de cliente');
                echo $this->alerta->redireccionar($this->defaultSites['cliente'])->exito()->getAlerta();
            break;
            case 'admin':
                $this->alerta = new Alertas('Exito', 'Bienvenido al panel de administración');
                 echo $this->alerta->redireccionar($this->defaultSites['admin'])->exito()->getAlerta();
                 error_log('SessionController::authorizeAccess() => admin');
            break;
            default:
        }
    }

    function logout(){
        error_log('Login::cerrarSesion -> inicio de cerrarSesion desde SessionController');
            $this->session->closeSession();
    }
}


?>