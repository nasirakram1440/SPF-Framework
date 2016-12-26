<?PHP

/**
* LOADER CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    8/2/2014:5:53pm.
* @Functionality:   Retries the essential components of the url.
* @Howto:   Initialize the class statically by calling registry::getInstance().
*           Access the controller,helper,library,model,view methods.
*
*/

class url{

    public static $instance;
    public $host;
    public $hosti;
    public $fullUrl;
    public $urlQuery;
    public $parameters;
    public $controller;
    public $action;
    public $url;
    
    public function __Construct(){
        
        $this->parse_main_url();
        
        $this->url=$this;
        
        $this->check_first_parameter($this->url);
            
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
        
        //$this->parse_main_url();
        
    }

    // Parses the url and separates different components from it. This function runs when the class is instantiated.
    public function parse_main_url(){
        
        $path=array();
            
        if(isset($_SERVER['REQUEST_URI'])){
                
            $request_path=explode('?',$_SERVER['REQUEST_URI']);
                
            $path['path']=rtrim(dirname($_SERVER['SCRIPT_NAME']),'\/');
                
            // remove the pre forward slash from url /
            $path['call_utf8']=substr(urldecode($request_path[0]), strlen($path['base']) + 1);
                
            $path['call'] = utf8_decode($path['call_utf8']);
            
            if ($path['call'] == basename($_SERVER['PHP_SELF'])) {
                $path['call'] = '';
            }
                
            // extract the components of url by /
            $path['parameters']=array();
            
            $parameters=array();
            
            $parameters = explode('/', $path['call']);
            
            // controller
            $controller = $parameters[0];
            
            // action
            $action = $parameters[1];
            
            // decode the components that has ?
            $path['query_utf8'] = urldecode($request_path[1]);
            
            $path['query'] = utf8_decode(urldecode($request_path[1]));
            
            // extract the query by & parameter. eg ?name=n&fname=a -> name=n fname=a
            $vars = explode('&', $path['query']);
            
            foreach ($vars as $var) {
                $t = explode('=', $var);
                
                // sanitize query variables
                security::sanitize_url_values($t[0],config::$url_query_allowed_characters);
                
                security::sanitize_url_values($t[1],config::$url_query_allowed_characters);
                // sanitize query variables
                
                //$name=$t[0];
                $this->urlQuery["{$t[0]}"] = $t[1];
            }
            
            // get the host.
            $host=$_SERVER['HTTP_HOST'];
            $full_host;
            $full_host_i;
            // check if https is enabled.
            if(isset($_SERVER['HTTPS'])){
                $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
                $full_host=$protocol.'://'.$host.'/';
            }
            else{
                $protocol = 'http';
                $full_host=$protocol.'://'.$host.'/';
            }
            
            $full_host_i=$full_host;
            
            // check if first parameter is index.php
            if($parameters[0]==config::$base_file){
                $full_host_i.=$parameters[0].'/';
            }
            // get the host.
            
            $this->fullUrl=$_SERVER['REQUEST_URI'];
            $this->host=$full_host;
            $this->hosti=$full_host_i;
            $this->parameters=$parameters;
            $this->controller=$controller;
            $this->action=$action;
                
        }
            
    }
    
    // check if first parameter is ROOT_FILE
    private function check_first_parameter($URL){
        
        // check if the first parameter is root file.
        if($URL->parameters[0]==ROOT_FILE && count($URL->parameters)>0){
            
            $URL->parameters=array_slice($URL->parameters,1);
            
            // at this point the array has only one element so set the controller as the first item in array
            
            $URL->controller=$URL->parameters[0];
            
            $URL->action=$URL->parameters[1];
            
        }
        
    }

    // Returns the full url.
    protected function getFullUrl(){
        
        return $this->fullUrl['call_utf8'];
        
    }
    
    // Returns the controller part of the url.
    protected function getController(){
        
        return $this->controller;
        
    }
    
    // Returns the action part of the url.
    protected function getAction(){
        
        return $this->action;
        
    }
    
    // Returns a segment of url.
    public function segment($key){
        
        return $this->parameters[$key];
        
    }
        
} // end of class url
    
?>