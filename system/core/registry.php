<?PHP

/**
* REGISTRY CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    8/2/2014:3:30pm.
* @Functionality:   Registers the initialized class and stores their names and objects.
* @Howto:   Initialize the class statically by calling registry::getInstance().
*           Access the getObject/setObject methods to register and get class objects and names.
*
*/

class registry{
    
    // the registery keeper.
    public static $registered_classes=array();
    
    // instance.
    private static $instance;
    
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
    
    // register a class by name and object.
    // Name and Object of the class will be stored in $registered_classes variable.
    private static function set($key,$val){
        
        // before setting the class object check if it already exists in our array.
        if(!self::get($key)){
            
            // the object is not set.
            self::$registered_classes[$key]=$val;
            
        }
        
    }
    
    // get an object from registery.
    private static function get($key){
        
        // if objects resides in $registered_classes then return it. else throw an error.
        if(isset(self::$registered_classes[$key])){
            
            return self::$registered_classes[$key];
            
        }else{
            
            return false;
            
        }
        
    }
    
    // get object of class by name of the class.
    public static function getObject($key){
        
        return self::get($key);
        
    }
    
    // set object and name of the class.
    public static function setObject($key,$val){
        
        self::set($key,$val);
        
    }
    
} // end of registry class
    
?>