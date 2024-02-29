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

    private $user;
 
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
        error_log('SessionController::init()' . $this->session->getCurrentToken());
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
        error_log('SessionController::validateSession()'. $this->session->getCurrentUser());
        //Si existe la sesión
        if($this->existsSession()){
            $role = $this->getUserSessionData()->getRole();


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
        error_log('SessionController::existsSession() => Token: ' . $this->session->getCurrentToken());


        if(!$this->session->exists()){
            error_log('SessionController::existsSession() => No existe sesión 1');
            return false;
        
        } 


        if($this->session->getCurrentUser() == NULL){
            error_log('SessionController::existsSession() => No existe sesión 2');
            return false;
        
        } 


        if($this->session->getCurrentToken() == NULL) {

            error_log('SessionController::existsSession() => No existe sesión 3');
            return false;
        }

        $userid = $this->session->getCurrentUser();

        if($userid) return true;

        return false;
    }

    function getUserSessionData(){
        error_log('SessionController::getUserSessionData()');
        $id = $this->session->getCurrentUser();
        $this->user = new UserModel();
        error_log("sessionController::getUserSessionData(): id: " . $id);
        $this->user->obtenerUno($id);
        error_log("sessionController::getUserSessionData(): " . $this->user->getNombres());
        return $this->user;
    }

    public function initialize($user,$token){
        
        $this->session->setCurrentUser($user->getId());
        error_log("sessionController::initialize(): user: " . $this->session->getCurrentUser());
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
        $url = '';
        for($i = 0; $i < sizeof($this->sites); $i++){
            if($this->sites[$i]['role'] === $role){
                $url = APP_URL.$this->sites[$i]['site'];
            break;
            }
        }
        header('location: '.$url);
        
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
            case 'Cliente':
                $this->redireccionar($this->defaultSites['Cliente'], ['mensaje' => '']);
            break;
            case 'Admin':
                $this->redireccionar($this->defaultSites['Admin'], ['mensaje' => '']);
            break;
            default:
        }
    }

    function logout(){
        $this->session->closeSession();
    }
}


?>