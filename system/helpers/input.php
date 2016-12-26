<?PHP
    
/**
* INPUT HELPER
*
* @author:  Muhammad Nasir Akram.
* @Date:    22/2/2014:2:13pm.
* @Functionality:   Contains Wrappers for GET, POST and FILE.
* @Howto:
*
*/

    
// post wrapper
function input_post($field_name){
        
    return $_POST[$field_name];
        
}
    
// get wrapper
function input_get($field_name){
        
    return $_GET[$field_name];
        
}

// general input function. That fetches the data wether its get or post.
function input($field_name){
        
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        return input_post($field_name);
        
    }elseif($_SERVER['REQUEST_METHOD'] === 'GET'){
        
        return input_get($field_name);
        
    }
        
}

?>