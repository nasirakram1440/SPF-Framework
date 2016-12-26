<?PHP

/**
* CONFIG CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    10/2/2014:4:12pm.
* @Functionality:   Contains general configurations.
* @Howto:
*
*/
    
class config{
    
    public static $default_controller = "accounts";
    
    /*
     * ALLOWED CHARACTERS IN URL
     *
     * Specify which characters are allowed in url.
     * By default a-z /.= are allowed. The characters are limited due to security reason
     * Allowing more characters in url increases the security risk
     * Please add characters inside the braces when needed
     */
    
    public static $url_allowed_characters = "/[^a-z A-Z 0-9 \/.?&=_-]/";
    
    public static $url_query_allowed_characters = "/[^a-z A-Z 0-9]/";
    
    /*
     * ALLOWED CHARACTERS IN POST and GET. Any extra characters will be removed.
     *
     */
    
    public static $input_allowed_characters = "/[^a-z A-Z 0-9@\._:=$\-\n`[]()%]/";
    
    /*
     * ALLOWED CHARACTERS for different VALIDATION formats.
     *
     */
    
    public static $validation_email = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/";
    
    public static $validation_number = "/[0-9 ]/";
    
    public static $validation_date1= "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
    
    public static $validation_date2= "/^[0-9]{4}/(0[1-9]|1[0-2])/(0[1-9]|[1-2][0-9]|3[0-1])$/";
    
    public static $validation_alphabet = "/[^a-z A-Z]/";
    
    public static $validation_alphanumberic = "/[^a-z A-Z 0-9]/";
    
    /*
     * SETTINGS CONFIGS.
     *
     */
    
    
    public static $session_name = '';
    
    public static $session_limit = 0;
    
    public static $session_path  = '/';
    
    public static $session_interval  = 600; // seconds.
    
    public static $session_lifetime  = 3600; // 1 hour.
    
    /*
     * ENCRYPTION KEY.
     *
     */
    
    public static $encryption_key = 'W6bEDRup7usuDUh9THeD2CHe';
    
    /*
     * TIME ZONE.
     * form complete list of time zones please visit http://www.php.net/manual/en/timezones.php
     */
    
    public static $default_timezone = 'Europe/Berlin';
    
    /*
     * BASE FILE.
     * base file is index.php or anyother file.
     */
    public static $base_file = 'index.php';
    
    /*
     * CONTACT EMAIL.
     * The email application should use.
     */
    public static $contact_email = '';
    
    
}

?>
