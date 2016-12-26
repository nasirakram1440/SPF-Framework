<?PHP
    
/**
* STRING HELPER
*
* @author:  Muhammad Nasir Akram.
* @Date:    22/2/2014:2:29pm.
* @Functionality:   Contains various functions related to string.
* @Howto:
*
*/

    
// generates a random string.
function string_random($length = 10) {
    
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
    
}
 
// generates a random string based on supplied id.
function string_random_md5($id) {
    
    $string = md5(uniqid($id.string_random(10), true));
    
    return $string;
    
}   
    
?>