<?PHP
    
/**
* DATABASE CONFIGURATION CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    10/2/2014:4:12pm.
* @Functionality:   Contains configurations for database.
* @Howto:
*
*/
    
class config_database{
    
    public static $database_type = ''; // type of database. mysql, postgre etc.
    public static $database_name = '';      // name of the database.
    public static $database_host = '';      // database host.
    public static $database_user = '';      // database user.
    public static $database_password = '';  // database password.
    public static $database_persist = false; // user persistant connection.
            
}

?>
