<?PHP

/**
* LOADER CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    8/2/2014:4:56pm.
* @Functionality:   Loads and initializes an object.
* @Howto:   Initialize the class statically by calling registry::getInstance().
*           Access the controller,helper,library,model,view methods.
*
*/

class loader extends url{
    
    public $load;
    
    // instance.
    public static $instance;
    
    // registry instance
    public static $registry;
    
    public function __Construct(){
        
        parent::__Construct();
        
        $this->load=$this;
        
    }
    
    // the initializer class.
    public static function initialize(){
        
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
    
    // autoload specified libraries. will always load from system_path
    public function autoload_libraries($arr=array()){
        
        foreach($arr as $lib){
            
            $this->load_class(LIBRARY_PATH, $lib);
            
        }
        
    }
    
    // load a class. just includes the requested file.
    private function load_class($path, $file_name, $run_constructor=true){

        //print "::$file_name ".registry::getObject($file_name)."::<br>";
        // check if class is registered.
        if(registry::getObject($file_name)==NULL){
            
            // the class is not registered. so proceed and load it.
            //if(file_exists($path."{$file_name}.php")){
                
                @include($path."{$file_name}.php");
                
                // now register this class.
                if($run_constructor){
                    
                    @$this->{$file_name}=new $file_name();

                    @registry::setObject($file_name, $this->{$file_name});
                    
                }else{
                    
                    @registry::setObject($file_name, $file_name);
                    
                }
                
            //} end of file_exits if.
            
        }
        
    }
    
    // load a configuration file
    public function configuration($file_name){
        
        $this->load_class(CONFIG_PATH, $file_name);
        
    }
    
    // loads a specified library and initializes it
    public function library($file_name, $run_constructor=true){
        
        $this->load_class(LIBRARY_PATH, $file_name, $run_constructor);
        
    }
    
    // load a specified helper
    public function helper($file_name){
        
        $this->load_class(HELPER_PATH, $file_name, false);
        
    }
    
    // loads a specified model and initializes it
    public function model($model){
        
        // first load the database config
        $this->configuration('config_database');
        
        // second load the database library
        $this->load_class(LIBRARY_PATH, 'database', false);
        
        // third load the model class
        $this->load_class(CORE_PATH, 'model', false);
        
        // finally the requested model.
        $this->load_class(MODEL_PATH, $model);
        
    }
    
    // loads a specified view and initializes it
    protected function view($view, $data=array(), $string=false){
        
        if(sizeof($data>0)){
            
            extract($data);
            
        }
        
        ob_start();
        ob_implicit_flush(0);
        
        if(file_exists(VIEW_PATH."{$view}.php")){
            
            // if file is requested as string
            if($string){
                
                // get file as string
                ob_start();
                
                // include the file
                include(VIEW_PATH."{$view}.php");
                
                $content=ob_get_contents();
                ob_end_clean();
                
                return $content;
                
            }else{
                
                include(VIEW_PATH."{$view}.php");
                
            }
            
        }else{
            
            print "<br>View {$view} not found!.<br>";
            
        }
        
        
        
    }
    
    
} // end of loader class
    
?>