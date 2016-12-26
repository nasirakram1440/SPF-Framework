<?PHP
    
/**
* VALIDATION CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    23/2/2014:5:18pm.
* @Functionality:   Contains validation method for validating string.
* @Howto:
*
*/
    
class validation extends config{
    
    
    function __Construct(){
            
        // Constructor
        //parent::__Construct();
        
    }
    
    public function sanitize($input){
        
        $config=self::$input_allowed_characters;
        
        return trim(preg_replace($config, '', $input));
        
    }
    
    // normal mysql connection
    public function validate($validate_for=array(), $string=''){
        
        $error_msg;
        
        foreach($validate_for as $key){
        
        switch($key){
        
        case 'email':{
            
            if(!preg_match(self::$validation_email,$string)){
                
                $error_msg = "Ivalid email.";
                
                return $error_msg;
                
            }
            
            break;
            
        }
            
        case 'date':{
            
            if(!preg_match(self::$validation_date1,$string)){
                
                $error_msg = "Ivalid date. Correct format(DD-MM-YY)";
                
                return $error_msg;
            
            }
            
            break;
            
        }
            
        case 'alphabet':{
            print "firing alphabet";
            if(!preg_match(self::$validation_alphabet,$string)){
                
                $error_msg = "Ivalid characters, should contain only alphabets.";
                
                return $error_msg;
                
            }
            
            break;
            
        }
            
        case 'number':{
            
            if(!preg_match(self::$validation_number,$string)){
                
                $error_msg = "Ivalid characters, should contain only numbers.";
                
                return $error_msg;
                
            }
            
            break;
            
        }
            
        case 'alphanumeric':{
            
            if(!preg_match(self::$validation_alphanumeric,$string)){
                
                $error_msg = "Ivalid characters, should contain only alphanumeric characters.";
                
                return $error_msg;
                
            }
            
            break;
            
        }
            
        case 'nn':{
            
            if(empty($string)){
                
                $error_msg = "Empty!";
                
                return $error_msg;
                
            }
            
            break;
            
        }

        default:{
            
            if(is_numeric($key)){
                
                if(strlen($string)>$key){
                    
                    $error_msg = "Must not exceed {$key} characters.";
                    
                    return $error_msg;
                    
                }
                
            }
            
            break;
                
            }

                
        }
            
        }
        
        // finally return true.
        return true;
        
    }
        
}

?>