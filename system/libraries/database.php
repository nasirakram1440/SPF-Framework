<?PHP
    
/**
* DATABASE CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    10/2/2014:4:12pm.
* @Functionality:   Contains Wrappers and helpers for different databases.
* @Howto:
*
*/
    
class database extends loader{
    
    private $db_type;
    private $db_name;
    private $db_host;
    private $db_user;
    private $db_password;
    private $db_persist;
    
    protected $db;
    protected $result;
    protected static $db_link=false;
    public static $db_connected=false;
    
    protected $current_operation;
    protected $table_name;
    protected $fields;
    protected $values;
    protected $update_values;
    protected $where;
    protected $and;
    protected $or;
    protected $order_by;
    protected $limit;
    protected $generated_query;
    
    // select
    // insert
    // update
    // delete
    
    function __Construct(){
            
        // Constructor
        parent::__Construct();
        
        $this->db=$this;
        
        $this->db_type=config_database::$database_type;
        
        // load the specific database driver.
        $this->load=loader::getInstance();
        $this->load->library($this->db_type, false);
        
    }
    
    // normal mysql connection
    protected function database_connect(){
        
        // connect to database driver
        $database_type=config_database::$database_type;
        
        if(!self::$db_link){
            
            if($this->db_persist==true){
                
                self::$db_link=@$database_type::database_pconnect(config_database::$database_host, config_database::$database_user, config_database::$database_password, config_database::$database_name);
                
            }else{
                // print "<br>Trying to connect <br>";
                self::$db_link=@$database_type::database_connect(config_database::$database_host, config_database::$database_user, config_database::$database_password, config_database::$database_name);
                
            }
            
        }
        
    }
    
    // close mysql connection
    private function mysql_database_close(){
        
        self::$db_connected=false;
        mysql_close(self::$db_link);
        
    }
    
// GENERAL QUERIES -----------------------------------------------------
    
    // table name.
    protected function table($table_name){
        
        $this->table_name=$table_name;
        
    }
    
    // where.
    protected function where($condition){
        
        if(!empty($condition)){
            
            $this->where=" WHERE {$condition} ";
            
        }
        
    }
    
    // and condition.
    protected function and_where($condition){
        
        if(!empty($condition) && !empty($this->where)){
            
            $this->where.=" AND {$condition} ";
            
        }
        
    }
    
    // or condition.
    protected function or_where($condition){
        
        if(!empty($condition) && !empty($this->where)){
           
            $this->where.=" OR {$condition} ";
            
        }
        
    }
    
    // order by.
    protected function order($order_by){
        
        if(!empty($order_by)){
            
            $this->order_by=" ORDER BY {$order_by} ";
            
        }
        
    }
    
    // limit records returned.
    protected function limit($limit){
        
        if(!empty($limit)){
            
            $this->limit=" LIMIT {$limit} ";
            
        }
        
    }
    
    // fields.
    protected function fields($fields=array()){
        
        $this->update_values=NULL;
        $this->values=NULL;
        $this->fields=NULL;
        $this->generated_query=NULL;
        
        // implode seperator, array
        if(count($fields)>0){
            
            // prepare for update
            foreach($fields as $key => $val ){
                
                $this->update_values.=", {$key}='{$val}'";
                
            }
            $this->update_values=ltrim($this->update_values, ',');
            
            $keys=array_keys($fields);
            $values=array_values($fields);
            
            if(!empty($this->fields)){
                
                $this->fields.=",";
                
            }
            
            $this->fields.=implode(",",$keys);
            
            if(!empty($this->values)){
                
                $this->values.=",";
                
            }
            $this->values.="'".implode("','",$values)."'";
            
        }
        
    }
    
    // reset.
    private function reset(){
        
        $this->current_operation=NULL;
        $this->table_name=NULL;
        $this->fields=NULL;
        $this->values=NULL;
        $this->where=NULL;
        $this->and=NULL;
        $this->or=NULL;
        $this->order_by=NULL;
        $this->generated_query=NULL;
        
    }
    
    // generate select query.
    private function generate_select_query(){
        
        // if no fields are specified then we want to select all columns.
        if(empty($this->fields)){
            
            $this->fields=" * ";
            
        }
        
        // generate the query string.
        $this->generated_query="SELECT ".$this->fields." FROM ".$this->table_name.$this->where.$this->and.$this->or.$this->order_by.$this->limit;
        
        return $this->generated_query;
        
    }
    
    // generate update query.
    private function generate_update_query(){
        
        // generate the query string.
        if(!empty($this->where)){
            
            $this->generated_query="UPDATE ".$this->table_name." SET ".$this->update_values." ".$this->where." ".$this->and_where." ".$this->or_where;
            
            return $this->generated_query;
            
        }
        
    }
    
    // generate delete query.
    private function generate_delete_query(){
        
        // generate the query string.
        if(!empty($this->where)){
            
            $this->generated_query="DELETE FROM ".$this->table_name.$this->where." ".$this->and_where." ".$this->or_where;
        
            return $this->generated_query;
            
        }
        
    }
    
    // generate insert query.
    private function generate_insert_query(){
        
        // generate the query string.
        $this->generated_query="INSERT INTO ".$this->table_name." (".$this->fields.") VALUES (".$this->values.")";
            
        return $this->generated_query;
        
    }
    
    // generate create table query.
    private function generate_create_table_query(){
        
        $update_values=$this->update_values;
        
        $create_values=str_replace('=',' ', str_replace("'","",$this->update_values));
        
        // generate the query string.
        $this->generated_query="CREATE TABLE IF NOT EXISTS ".$this->table_name." (".$create_values.")";
        
        return $this->generated_query;
        
    }
    
// GENERAL QUERIES -----------------------------------------------------
    
// SELECT QUERIES ------------------------------------------------------

    // things to keep in mind
    // select fields from table where and where limit 1,3 order by id desc
    protected function select(){
        
        // generate the select query.
        $query=$this->generate_select_query();
        
        // connect to database.
        $this->database_connect();
        
        // run the query.
        $database_type=$this->db_type;
        $this->result=@$database_type::select($query, self::$db_link);
        
        $database_type::close(self::$db_link);
        self::$db_link=null;
        // reset
        $this->reset();
        
    }
    
    
// SELECT QUERIES ------------------------------------------------------
    
// UPDATE QUERIES ------------------------------------------------------
    
    protected function update(){
        
        // generate the update query.
        $query=$this->generate_update_query();
        
        // connect to database.
        $this->database_connect();
        
        // run the query.
        $database_type=$this->db_type;
        $this->result=@$database_type::update($query, self::$db_link);
        
        $database_type::close(self::$db_link);
        self::$db_link=null;
        // reset
        $this->reset();
        
    }
    
// UPDATE QUERIES ------------------------------------------------------
    
// DELETE QUERIES ------------------------------------------------------
    
    protected function delete(){
        
        // generate the delete query.
        $query=$this->generate_delete_query();
        
        // connect to database.
        $this->database_connect();
        
        // run the query.
        $database_type=$this->db_type;
        $this->result=@$database_type::delete($query, self::$db_link);
        
        $database_type::close(self::$db_link);
        self::$db_link=null;
        // reset
        $this->reset();
        
    }
    
// DELETE QUERIES ------------------------------------------------------
    
// INSERT QUERIES ------------------------------------------------------
    
    protected function insert(){
        
        // generate the insert query.
        $query=$this->generate_insert_query();
        
        // connect to database.
        $this->database_connect();
        
        // run the query.
        $database_type=$this->db_type;
        $data=@$database_type::insert($query, self::$db_link);
        $this->result=$data['result'];
        $database_type::close(self::$db_link);
        
        self::$db_link=null;
        // reset
        $this->reset();
        return $data['insert_id'];
        
    }

// INSERT QUERIES ------------------------------------------------------
    
// INSERT QUERIES ------------------------------------------------------
    
    protected function query($query){
        
        // connect to database.
        $this->database_connect();
        
        // run the query.
        $database_type=$this->db_type;
        $this->result=@$database_type::query($query, self::$db_link);
        
        $database_type::close(self::$db_link);
        self::$db_link=null;
        // reset
        $this->reset();
        
    }
    
// INSERT QUERIES ------------------------------------------------------
    
// INSERT QUERIES ------------------------------------------------------
    
    protected function create_table(){
        
        // generate the insert query.
        $query=$this->generate_create_table_query();
        
        // connect to database.
        $this->database_connect();
        
        // run the query.
        $database_type=$this->db_type;
        $this->result=@$database_type::create_table($query, self::$db_link);
        
        $database_type::close(self::$db_link);
        self::$db_link=null;
        
    }
    
// INSERT QUERIES ------------------------------------------------------
        
}

?>