<?PHP
    
/**
* SESSION CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    24/2/2014:3:06pm.
* @Functionality:   Contains wrappers for PHP session and making it more secure.
* @Howto:
*
*/
    
class session{
    
    
    function __Construct(){
            
        // Constructor
        //parent::__Construct();
        
    }
    
    // starting the session.
    public static function start($restart_session_id=true){
        
        // set session cookie lifetime.
        session_set_cookie_params(config::$session_lifetime);
        
        $session_name=config::$session_name;
        $limit=config::$session_limit;
        $path=config::$session_path;
        $session_interval=config::$session_interval;
        
        // set the session name, this helps prevent conflict if two sites run on same domain.
        session_name($session_name.'_session');
        
        // is the site being accessed with ssl.
        $https = isset($https) ? $https : isset($_SERVER['HTTPS']);
        
        // set the cookie settings and start the session.
        session_set_cookie_params($limit, $path, '', $https, true);
        
        session_start();
        
        if(self::first_time_setting()==true && $restart_session_id==true){
            
            // check if session id needs to be refreshed.
            self::session_needs_refreshing($session_interval);
            
        }
        
    }
    
    static private function is_it_ajax_request(){
        
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    static private function first_time_setting(){
        
        if(isset($_SESSION['last_activity'])){
            // session was set earlier.
            return true;
            
        }else{
            // no its first time.
            $data=array(
                        'session_id'=>session_id(),
                        'ip_address'=>security::sanitize_user_agent($_SERVER['REMOTE_ADDR']),
                        'user_agent'=>security::sanitize_user_agent($_SERVER['HTTP_USER_AGENT']),
                        'last_activity'=>time()
                        );
            
            self::set($data);
            
            return false;
            
        }
        
    }
    
    // does session id need refreshing. decision is based on refresh interval saved in config.
    static private function session_needs_refreshing($session_interval){
        
        $session_max_age=self::get('last_activity') + $session_interval;
        if(time()>$session_max_age){
            
            self::regeneratesessionid();
            self::set(array('session_id'=>session_id(), 'last_activity'=>time()));
            
        }
        
    }
    
    // regenerates session id.
    static function regeneratesessionid()
    {
        // destroy the old session.
        session_regenerate_id(true);
        
    }
    
    // sets a key value pair in session.
    public function set($data=array()){
        
        foreach($data as $key => $val){
            
            $_SESSION[$key]=$val;
            
        }
        
    }
    
    // gets a session value based on specified key.
    public function get($key){
        
        if(isset($_SESSION[$key])){
            
            return $_SESSION[$key];
            
        }
        
    }
    
    // unsets a specific session.
    public function session_unset($key){
        
        if(isset($_SESSION[$key])){
            
            unset($_SESSION[$key]);
            
        }
        
    }
    
    // destroys current session.
    public function destroy(){
        
        session_destroy();
        session_write_close();
        
    }
    
}

?>