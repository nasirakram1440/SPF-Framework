<?PHP
    
/**
* ACCESS LIBRARY CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    20/2/2014:4:52pm.
* @Functionality:   paypal ipn.
* @Howto:
*
*/
    
class paypalipn{
    
    function __Construct(){
            
        // call the parent constructor
        parent::__Construct();
    
    }
    
    
    public function start($mode='sandbox'){
    	
    	print "starting..";
    	if($mode=='live'){
            
            $this->url="https://paypal.com/cgi-bin/webscr";
            
        }
            
        if($mode=='sandbox'){
            
            $this->url="https://sandbox.paypal.com/cgi-bin/webscr";
            	
        }
    
    }
    

    public function verify(){
        
        $postFields='_notify-validate';
            
        foreach($postFields as $key=>$val){
            
            $postFields.="&$key=".urlencode($val);
            
        }
            
        $chandle=curl_init();
            
        curl_setopt_array($chandle, array(
            
            CURLOPT_URL=>$this->url,
            CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_POST=>true,
            CURLOPT_POSTFIELDS=>$postFields
            
        ));
            
        $result=curl_exec($chandle);
        curl_close($chandle);
            
        print $result;
        
    }
    
}

?>