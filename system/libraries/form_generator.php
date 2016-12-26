<?PHP
    
/**
* FORM GENERATOR LIBRARY CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    21/2/2014:9:23pm.
* @Functionality:   Creates a html form. name of the template file should be provided along with if output is meant for caching or regular form generation.
* @Howto:
*
*/
    
class form_generator{
    
    private $requested_form;
    
    function __Construct(){
            
        // Constructor

    }
    
    public function generate($load_template, $for_caching=false){
        
        $this->load->helper('form');
        $this->load->library('template_'.$load_template);
        $this->load->model('model_fetch_dropdown');
        
        // requested form
        //$this->requested_form;
        
        $template=$this->template_kitForm;
        $this->template=$this->template_kitForm;
        
        // lets prepare the input for each cell of the table.
        foreach($template->types as $field_name => $field_type){
            
            
            // pre comment. split the pre and post parts.
            $comments=explode('^',$template->fields["{$field_name}"]);
            // pre comment. add the pre comment to the array.
            $template->values["{$field_name}"].=$comments[0].'&nbsp';
            
            // add the requested form element to the array.
            $template->values["{$field_name}"].=$this->create_form_element($template, $field_type, $field_name, $value='',$placeholder=$comments[2], $for_caching);
            
            // post comment. add the post comment to array.
            $template->values["{$field_name}"].=$comments[1];
            
            
        }
        
        // print the title
        
        print '<br>
        
        <div style="width:800px; margin:0 auto;">
        
        ';
        print '<h1 style=\'width:400px\'>'.$template->title.'</h1>';
        
        // -------------------------------------------------------------
        $this->load->library('autotable');
        
        $this->autotable->border=1;
        
        $this->autotable->valign='top';
        
        $this->autotable->cellpadding=5;
        
        $this->autotable->cellspacing=0;
        
        // set the table->data;
        $this->autotable->layout=$template->form_layout;
        
        $this->autotable->values=$template->values;
        
        $this->autotable->spans=$template->spans;
        
        $ourtable=$this->autotable->create();
        print $ourtable;
        
        print '<p><b>'.$template->footer_text.'</b></p><br><br></div>';
        
        //$this->load->helper('file');
        //file_write('/Library/Webserver/secure_fdf_files/sampleNewform.fdf',$fdf);
        
        
    }
    
    // create form element.
    private function create_form_element($template, $field_type, $field_name, $value, $placeholder, $for_caching=false){
        
        switch($field_type){
                
                // if textbox is requested.
            case 'textbox':{
                
                $attributes=array(
                                  'name'=>$field_name,
                                  'value'=>$value,
                                  'id'=>$field_name,
                                  'style'=>'width:100%;padding:3px;font-size:15px',
                                  'class'=>'',
                                  'maxlength'=>'',
                                  'placeholder'=>'',
                                  );
                
                return form_textbox($attributes, $for_caching);
                
            }
                
                // if password is requested.
            case 'password':{
                
                $attributes=array(
                                  'name'=>$field_name,
                                  'value'=>$value,
                                  'id'=>$field_name,
                                  'style'=>'width:250px;padding:3px;font-size:15px',
                                  'class'=>'',
                                  'maxlength'=>'',
                                  'placeholder'=>'',
                                  );
                
                return form_password($attributes, $for_caching);
                
            }
                // if textarea is requested.
            case 'textarea':{
                
                $attributes=array(
                                  'name'=>$field_name,
                                  'value'=>$value,
                                  'id'=>$field_name,
                                  'style'=>'',
                                  'class'=>'',
                                  'rows'=>10,
                                  'cols'=>70,
                                  );
                
                return form_textarea($attributes, $for_caching);
                
            }
                
                // if checkbox is requested.
            case 'checkbox':{
                
                $attributes=array(
                                  'name'=>$field_name,
                                  'value'=>$value,
                                  'id'=>$field_name,
                                  'style'=>'',
                                  'class'=>'',
                                  );
                
                return form_checkbox($attributes, $for_caching);
                
            }
                
                // if radiobutton is requested.
            case 'radiobutton':{
                
                $attributes=array(
                                  'name'=>$field_name,
                                  'value'=>$value,
                                  'id'=>$field_name,
                                  'style'=>'',
                                  'class'=>'',
                                  );
                
                return form_radiobutton($attributes, $for_caching);
                
            }
                
                // default is dropdown.
            default:{
                
                $value;
                
                // check if values for this drop down is defined in form template.
                if(isset($template->{$field_type})){
                    
                    $value=$template->{$field_type};
                    
                }else{
                    
                    // the values for this field is not defined in template file. Go check it out in database.
                    $value=$this->model_fetch_dropdown->fetch($field_type);
                    
                }
                
                $attributes=array(
                                  'name'=>$field_name,
                                  'value'=>$value,
                                  'id'=>$field_name,
                                  'style'=>'width:100%;padding:3px;font-size:15px',
                                  'class'=>'',
                                  'maxlength'=>'',
                                  'placeholder'=>'',
                                  );
                
                return form_dropdown($attributes, $for_caching);
                
            }
                
        }
        
    }
    
}

?>