<?PHP
    
/**
* MYSQL DATABASE CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    10/2/2014:4:12pm.
* @Functionality:   Contains Wrappers and helpers for different databases.
* @Howto:
*
*/
    
class mysql{
    
    // select
    // insert
    // update
    // delete
    
    function __Construct(){
            
        // Constructor
        print "mysql called<br>";

    }
    
    public static function close($db_link){
        
        // close the connection
        $db_link->close();
        
    }
    
    // normal mysql connection
    public static function database_connect($db_host, $db_user, $db_password, $db_name){
        //print "--------------".$db_host.$db_user;
        // database host, username, password
        $db_link=new mysqli($db_host, $db_user, $db_password, $db_name);
        
        // if connection was unsuccessfull
        if($db_link->connect_errno > 0){
            
            print "Unable to connect to mysql server!.<br>";
            return false;
            
        }else{
            
            // connection was successfull
            //print "Connection was successfull";
            return $db_link;
            
        }
        
    }
    
    // peristant mysql connection
    public static function database_pconnect($db_host, $db_user, $db_password, $db_name){
        
        // database host, username, password
        $db_link=new mysqli('p:'.$db_host, $db_user, $db_password, $db_name);
        
        // if connection was unsuccessfull
        if($db_link->connect_errno > 0){
            
            print "Unable to pconnect to mysql server!.<br>";
            return false;
            
        }else{
            
            // connection was successfull
            print "Connection was successfull";
            return $db_link;
            
        }
        
    }
    
    
// SELECT QUERIES ------------------------------------------------------

    // things to keep in mind
    // select fields from table where and where limit 1,3 order by id desc
    public static function select($query, $db_link){
        
        //print $db_link;
        //print $query;
        //print $db_link;
        // run the mysqli query
        $result=$db_link->query($query);
        //$result->data_seek(0);
        //return $result;
        if($result===false){
            
            print "Error running query ";
            
        }else{
            
            //$result->data_seek(0);
            
            return $result;
            
        }
        
    }
    
    
// SELECT QUERIES ------------------------------------------------------
    
// UPDATE QUERIES ------------------------------------------------------
    
    public static function update($query, $db_link){
        
        //print $db_link;
        //print $query;exit;
        //print $db_link;
        // run the mysqli query
        $result=$db_link->query($query);
        //$result->data_seek(0);
        //return $result;
        if($result===false){
            
            print "Error running query";
            
        }else{
            
            //$result->data_seek(0);
            
            return $result;
            
        }
        
    }
    
// UPDATE QUERIES ------------------------------------------------------
    
// DELETE QUERIES ------------------------------------------------------
    
    public static function delete($query, $db_link){
        
        //print $db_link;
        //print $query;
        //print $db_link;
        // run the mysqli query
        $result=$db_link->query($query);
        //$result->data_seek(0);
        //return $result;
        if($result===false){
            
            print "Error running query";
            
        }else{
            
            //$result->data_seek(0);
            
            return $result;
            
        }
        
    }
    
// DELETE QUERIES ------------------------------------------------------
    
// INSERT QUERIES ------------------------------------------------------
    
    public static function insert($query, $db_link){
        
        //print $db_link;
        //print $query;
        //print $db_link;
        // run the mysqli query
        $result=$db_link->query($query);
        //$result->data_seek(0);
        //return $result;
        if($result===false){
            
            print "Error running query";
            
        }else{
            
            //$result->data_seek(0);
            $data['insert_id']=mysqli_insert_id($db_link);
            $data['result']=$result;
            
            return $data;
            
        }
        
    }
    
// INSERT QUERIES ------------------------------------------------------
    
// INSERT QUERIES ------------------------------------------------------
    
public static function query($query, $db_link){
        
    //print $db_link;
    //print $query;
    //print $db_link;
    // run the mysqli query
    $result=$db_link->query($query);
    //$result->data_seek(0);
    //return $result;
    if($result===false){
        
        print "Error running query";
        
    }else{
        
        //$result->data_seek(0);
        
        return $result;
        
    }
    
}
    
// INSERT QUERIES ------------------------------------------------------
    
// CREATE TABLE QUERIES ------------------------------------------------
    
    public static function create_table($query, $db_link){
        
        //print $db_link;
        //print $query;exit;
        //print $db_link;
        // run the mysqli query
        $result=$db_link->query($query);
        //$result->data_seek(0);
        //return $result;
        if($result===false){
            
            print "Error running query";
            
        }else{
            
            //$result->data_seek(0);
            
            return $result;
            
        }
        
    }
    
// CREATE TABLE QUERIES ------------------------------------------------
        
}

?>