<?PHP
    
/**
* AUTOTABLE LIBRARY CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    20/2/2014:4:52pm.
* @Functionality:   Creates an auto table based on the input.
* @Howto:
*
*/
    
class autotable{
    
    public $layout=array();
    public $values=array();
    public $spans=array();
    public $style;
    public $class;
    public $border;
    public $align;
    public $valign;
    public $cellpadding;
    public $cellspacing;
    public $tr_class;
    public $td_class;
    public $table_start;
    public $table;
    public $table_end;
    
    function __Construct(){
            
        // Constructor

    }
    
    private function init(){
        
        $this->table_start="<table border='{$this->border}' style=\"{$this->style}\" class='{$this->class}' cellpadding='{$this->cellpadding}' cellspacing='{$this->cellspacing}'>";
        
        $this->table.=$this->table_start;
        
        $this->table_end="</table>";
        
    }
    
    // returns a table with contents of $data inside it.
    public function create(){
        
        $this->init();
        
        //print $this->table_style;
        // iterates the rows.
        foreach($this->layout as $rows){
            
            $this->table.="<tr>";
            
            // iterates the columns in this rows.
            foreach($rows as $columns){
                
                $span=explode(':',$this->spans["{$columns}"]);
                
                $this->table.="<td rowspan='{$span[0]}' colspan='{$span[1]}' align='{$this->align}' valign='{$this->valign}'>";
                
                if(empty($this->values["{$columns}"])){
                    $this->table.=$columns;
                }
                
                $this->table.=$this->values["{$columns}"];
                
                $this->table.="</td>";
                
            }
            
            $this->table.="<tr>";
            
        }
        
        // add the end tag.
        $this->table.=$this->table_end;
        
        return $this->table;
        
    }
    
}

?>