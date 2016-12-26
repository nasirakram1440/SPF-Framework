<?PHP
    
/*
*---------------------------------------------------------------
* APPLICATION FRAMEWORK BEGINS
*---------------------------------------------------------------
* @Developer Muhammad Nasir Akram
* @DevelopmentStartDate 25/01/2014, 11 in the morning
* 
* How things Happen
* System object initialized
* System object initialized other objects such as url, loader, helpers
* Based on the request the appropriate controller is loaded
*/
    
/*
*---------------------------------------------------------------
* ROOT FILE NAME
*---------------------------------------------------------------
*
* Usually the root file is index.php.
* If you have changed this filename in apache configuration, Please change it here as well
*/

define('ROOT_FILE',"index.php");

/*
*---------------------------------------------------------------
* APPLICATION ENVIRONMENT
*---------------------------------------------------------------
*
* Possible values
* DEVELOPMENT
* RELEASE
* The release environment turns off error reporting
*/

define('ENVIRONMENT',"DEVELOPMENT");

/*
*---------------------------------------------------------------
* PATH TO APPLICATION FOLDERS
*---------------------------------------------------------------
* Path to root folder
* Path to applications folder
* Path to controllers folder
* path to models folder
* path to views folder
* path to helpers folder
*/

define('APPLICATION_REAL_PATH', realpath(dirname('__FILE__')));
    
define('SYSTEM_PATH', APPLICATION_REAL_PATH.'/system/');
    
define('CORE_PATH', SYSTEM_PATH.'core/');
    
define('LIBRARY_PATH', SYSTEM_PATH.'libraries/');
    
define('HELPER_PATH', SYSTEM_PATH.'helpers/');

define('APPLICATION_PATH', APPLICATION_REAL_PATH.'/application/');
    
define('CONFIG_PATH', APPLICATION_PATH.'config/');

define('CONTROLLER_PATH', APPLICATION_PATH.'controllers/');

define('MODEL_PATH', APPLICATION_PATH.'models/');

define('VIEW_PATH', APPLICATION_PATH.'views/');

/*
*---------------------------------------------------------------
* PROCEED TO SYSTEM
*---------------------------------------------------------------
*
*/

include CORE_PATH."system.php";

?>