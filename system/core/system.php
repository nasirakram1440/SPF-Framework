<?PHP
    
/**
* SYSTEM CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    8/2/2014:10:17pm.
* @Functionality:   Initializes the framework.
* @Howto:
*
*/
    
class system{
    
    public static $config;
    public static $url;
    public static $security;
    public static $controller;
    
    // boot the system.
    public static function boot(){
        
        // set the time zone
        self::set_timezone();
        
        // set server side session lifetime
        ini_set('session.gc_maxlifetime', config::$session_lifetime);
        
        // STEP 1: GET THE URL.
        self::$url=url::getInstance();
        self::$url->parse_main_url();
        
        // STEP 2: CHECK URL FOR MVC AND ALLOWED CHARACTERS.
        self::$security=security::getInstance();
        self::$security->check_url_for_MVC(self::$url);
        self::$security->check_url_for_allowed_characters(self::$url, config::$url_allowed_characters);
        
        
        // STEP 3: LOAD THE REQUESTED CONTROLLER & METHOD
        self::load_controller();
        self::load_method();
        
        
    }
    
    // load the controller.
    public function load_controller(){
        
        // check if a controller is requested. if not load default controller.
        
        if(!empty(self::$url->controller)){
            
            if(file_exists(CONTROLLER_PATH.self::$url->controller.".php")){
                
                self::load_requested_controller();
                
            }else{
                
                print "Err: Controller not found!.";exit();
                
            }
            
        }else{
            
            self::load_default_controller();
            
        }
        
    }
    
    // load requested controller.
    public function load_requested_controller(){
        
        include(CONTROLLER_PATH.self::$url->controller.".php");
        self::$controller=new self::$url->controller();
        //self::$controller->__Construct();
    }
    
    // load default controller.
    public function load_default_controller(){
        
        include(CONTROLLER_PATH."default_controller.php");
        self::$controller=new default_controller();
        //self::$controller->__Construct();
        
    }
    
    // load method.
    public function load_method(){
        
        // check weather method is requested.
        if(!empty(self::$url->action)){
            
            $method=self::$url->action;
            
            // check if the method exists.
            if(method_exists(self::$controller,self::$url->action)){
                
                self::$controller->$method();
                
            }else{
                
                // method not found. we run index instead of showing error.
                // check if the method exists.
            	if(method_exists(self::$controller,index)){
                
                	self::$controller->index();
                
            	}
                
            }
            
        }else{
            
            // any specific method is not requested so run index function.
            // check if the method exists.
            if(method_exists(self::$controller,index)){
                
                self::$controller->index();
                
            }
            
        }
        
    }
    
    private function set_timezone(){
        
        // set current timezone.
        if(isset(config::$default_timezone)){
            
            date_default_timezone_set(config::$default_timezone);
            
        }
        
    }

}
    
/**
* CORE CLASSES
*/

include CONFIG_PATH."config.php";
include CORE_PATH."security.php";
include CORE_PATH."url.php";
include CORE_PATH."registry.php";
include CORE_PATH."loader.php";
include CORE_PATH."controller.php";
    
/**
* CORE CLASSES
*/

system::boot();
    
?>