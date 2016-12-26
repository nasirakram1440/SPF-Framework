<?PHP
    
/**
* SECURITY CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    8/2/2014:4:56pm.
* @Functionality:   Contains various security related methods.
* @Howto:   Initialize the class statically by calling registry::getInstance().
*           Access the check_url_for_MVC,check_url_for_allowed_characters methods.
*
*/

class security{

    public static $instance;
    
    // Costructor function
    function __Construct(){
        
        // constructor
        
    }
    
    // the initializer class.
    private static function initialize(){
        
        // check if registry class is initialized.
        if(!isset(self::$instance)){
            
            // instance not created yet. create a new instance.
            self::$instance=new self();
            
        }
        
    }
    
    // get current instance.
    public static function getInstance(){
        
        self::initialize();
        return self::$instance;
        
    }
    
    // check if url is following the MVC pattern.
    public static function check_url_for_MVC($URL){
        
        // check if the first parameter is root file.
        if($URL->parameters[0]==ROOT_FILE && count($URL->parameters)>0){
            
            $URL->parameters=array_slice($URL->parameters,1);
            
            // at this point the array has only one element so set the controller as the first item in array
                
            $URL->controller=$URL->parameters[0];
            
            $URL->action=$URL->parameters[1];
            
        }
        
    }
    
    // Check URL for allowed characters.
    public static function check_url_for_allowed_characters($URL,$config){
        
        $fullURL=str_replace(ROOT_FILE,"",$URL->fullUrl);
        
        if(preg_match($config,$fullURL)){
            
            echo "Contains disallowed characters <br>";exit();
            
        }else{
            
            //echo "Contains allowed characters<br>";
            
        }
        
    }
    
    // Check URL for allowed characters.
    public static function sanitize_url_values($val,$config){
        
        if(preg_match($config,$val)){
            
            echo "One of url parameters ontains disallowed characters <br>";exit();
            
        }
        
    }
    
    // Sanitize input values.
    public static function sanitize_input_values($input){
        
        $config=config::$input_allowed_characters;
        
        return preg_replace($config, '', $input);
        
    }
    
    // Sanitize user agent values.
    public static function sanitize_user_agent($input){
        
        return preg_replace(config::$url_allowed_characters, '', $input);
        
    }
    
} // end of security class
    
?>