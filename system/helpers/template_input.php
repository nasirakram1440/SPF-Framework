<?PHP
    
/**
* TEMPLATE INPUT HELPER
*
* @author:  Muhammad Nasir Akram.
* @Date:    24/2/2014:1:47am.
* @Functionality:   Wrapper for validating and getting POST VALUES of a template.
* @Howto:
*
*/

// fetch data based on defined template and also sanitize and validate it and return the data as array.
function template_input_fetch_and_validate(&$obj,&$template){
    
    //$obj->load->library('validation');
    
    $post_data=array();
    $passed=true;
    foreach($template->validation as $field_name => $validation_type){
        
        if(input($field_name)=='-- select --'){
        
        	$post_data[$field_name]='';
        
        }else{
        
        	// get the post or get values
        	$post_data[$field_name]=str_replace("'", "\'", $obj->validation->sanitize(input($field_name)));
        
        }
        
        // save it in template_form_values array.
        $template->form_values[$field_name]=$post_data[$field_name];
        
        // validate the data and att the errors to template validation_errors.
        $validation_rules=explode("|", $validation_type);
        
        $verdict=$obj->validation->validate($validation_rules, $post_data[$field_name]);
        
        if($verdict===true){
            // passed the validation.
            $template->validation_errors[$field_name]="";
            
        }else{
            // did not pass validation.
            $template->validation_errors[$field_name]=$verdict;
            
            $passed=false;
            
        }
        
        
        //$template->validation_errors[$field_name]=$this->validation->validate($validation_rules, $post_data[$field_name]);
        
    } // end of foreach loop.
    
    if($passed==false){
        
        $template->passed_validation=false;
        
    }else{
        
        $template->passed_validation=true;
        
    }
    
    return $post_data;
}

?>