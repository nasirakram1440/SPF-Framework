<?PHP
    
/**
* FORM HELPER FUNCTIONS
*
* @author:  Muhammad Nasir Akram.
* @Date:    19/2/2014:8:50pm.
* @Functionality:   Delivers various input components such as text, textarea, radio, checkbox, select, password, button, submit, reset and cancel. Alias are textbox, textarea, radiobutton, checkbox, dropdown, password, button, submit, reset and cancel. Additonal components form_begin and form_end.
* @Howto:
*
*/

// form. returns a forms initial tag.
function form_start($attributes){
    
    $att;
    
    foreach($attributes as $key => $val){
        
        $att.=$key.'='.'"'.$val.'" ';
        
    }
    
    $form="<form {$att}>";
    
    return $form;
    
}
    
// form. returns a forms end tag.
function form_end(){
    
    return "</form>";
        
}
    
// textbox. returns a text box based on the provided parameters.
function form_textbox($attributes, $for_saving=false){
    
    $value=str_replace('"', "", $attributes['value']);
    $value="value=\"{$value}\"";
    
    $field_name=$attributes['name'];
    $end;
    
    if($for_saving){
        
        $value="value=\"<?=\${$field_name}?>\"";
        $end="<span id='error'><span id='error'><?=\$error_{$field_name}?></span>";
        
    }
    
    // remove value attribute.
    unset($attributes['value']);
    
    $att;
    
    foreach($attributes as $key => $val){
        
        $att.=$key.'='.'"'.$val.'" ';
        
    }
        
    $textbox="<input type='text' {$att} {$value}/>".$end;
        
    return $textbox;
        
        
}
    
// password. returns a password box based on the provided parameters.
function form_password($attributes, $for_saving=false){
        
    $value=str_replace('"', "", $attributes['value']);
    $value="value=\"{$value}\"";
    
    $field_name=$attributes['name'];
    $end;
    
    if($for_saving){
        
        $value="value=\"<?=\${$field_name}?>\"";
        $end="<span id='error'><span id='error'><?=\$error_{$field_name}?></span>";
        
    }
    
    // remove value attribute.
    unset($attributes['value']);
    
    $att;
    
    foreach($attributes as $key => $val){
        
        $att.=$key.'='.'"'.$val.'" ';
        
    }
        
        
    $password="<input type='password' {$att} {$value}/>".$end;
        
    return $password;
        
        
}
    
// textarea. returns a textarea based on the provided parameters.
function form_textarea($attributes, $for_saving=false){
        
    $value=$attributes['value'];
    
    $field_name=$attributes['name'];
    $end;
    
    if($for_saving){
        
        $value="<?=\${$field_name}?>";
        $end="<span id='error'><span id='error'><?=\$error_{$field_name}?></span>";
        
    }
    
    // remove value attribute.
    unset($attributes['value']);
    
    $att;
    
    foreach($attributes as $key => $val){
        
        $att.=$key.'='.'"'.$val.'" ';
        
    }
        
    $textarea="<textarea {$att} >";
    
    $textarea.="{$value}";
    
    $textarea.="</textarea>".$end;
    
    return $textarea;
        
}
    
// dropdown. return a dropdown based on the provided parameters.
function form_dropdown($attributes, $for_saving=false){
    
    $value=$attributes['value'];
    
    if($value=='-- select --'){
        
        $value='';
        
    }       
    
    $field_name=$attributes['name'];
    $end;
    
    if($for_saving){
        
        $val="<?=\${$field_name}?>";
        
        $end="<span id='error'><span id='error'><?=\$error_{$field_name}?></span>";
        
        // for caching.
        unset($attributes['value']);
        
        $att;
        
        foreach($attributes as $key => $val){
            
            $att.=$key.'='.'"'.$val.'" ';
            
        }
        
        $dropdown="<select {$att} >";
        
        $dropdown.="<?php foreach(\${$field_name} as \$val){ ?><option value='<?php=\$val?>'><?php=\$val?></option><?php } ?>";
        
        $dropdown.="</select>".$end;
        
        
    }else{
        
        $field_name=$attributes['name'];
        
        // for normal use.
        
        // remove value attribute.
        unset($attributes['value']);
        
        $att;
        
        foreach($attributes as $key => $val){
            
            $att.=$key.'='.'"'.$val.'" ';
            
        }
        
        $dropdown="<select {$att} >";
        
        foreach($value as $val){
            
            $dropdown.="<option value='{$val}'>$val</option>";
            
        }
        
        $dropdown.="</select>";
        
        
    }
    
    
    return $dropdown;
        
}

// dropdown. return a dropdown based on the provided parameters.
function form_dropdowneditable($target_element, $attributes, $for_saving=false){
    
    $value=$attributes['value'];
    
    if($value=='-- select --'){
        
        $value='';
        
    }       
    
    $field_name=$attributes['name'];
    $end;
    
    if($for_saving){
        
        $val="<?=\${$field_name}?>";
        
        $end="<span id='error'><span id='error'><?=\$error_{$field_name}?></span>";
        
        // for caching.
        unset($attributes['value']);
        
        $attributes['id']="dd_".$attributes['id'];
        $attributes['name']="dd_".$target_element;
        
        $att;
        
        foreach($attributes as $key => $val){
            
            $att.=$key.'='.'"'.$val.'" ';
            
        }
        
        $dropdown="<select {$att} onchange=\"form_dropdowneditablechanged('".$target_element."',this.value);\">";
        
        $dropdown.="<?php foreach(\${$field_name} as \$val){ ?><option value='<?php=\$val?>'><?php=\$val?></option><?php } ?>";
        
        $dropdown.="</select>".$end;
        
        
    }else{
        
        $field_name=$attributes['name'];
        
        // for normal use.
        
        // remove value attribute.
        unset($attributes['value']);
        
        $attributes['id']="dd_".$attributes['id'];
        $attributes['name']="dd_".$target_element;
        
        $att;
        
        foreach($attributes as $key => $val){
            
            $att.=$key.'='.'"'.$val.'" ';
            
        }
        
        $dropdown="<select {$att} onchange=\"dropdowneditablechanged('".$target_element."',this.value);\">";
        
        foreach($value as $val){
            
            $dropdown.="<option value='{$val}'>$val</option>";
            
        }
        
        $dropdown.="</select>";
        
        
    }
    
    
    return $dropdown;
        
}
    
// checkbox. return a checkbox based on the provided parameters.
function form_checkbox($attributes, $for_saving=false){
    
    $checked=$attributes['checked'];
    
    $field_name=$attributes['name'];
    $end;
    
    if($for_saving){
        
        $checked="checked=\"<?=\${$field_name}?>\"";
        $end="<span id='error'><span id='error'><?=\$error_{$field_name}?></span>";
        
    }
    
    unset($attributes['checked']);
    
    $att;
    
    foreach($attributes as $key => $val){
        
        $att.=$key.'='.'"'.$val.'" ';
        
    }
     
    $checkbox="<input type='checkbox' {$att} {$checked} />".$end;
        
    return $checkbox;
        
        
}
    
// radiobutton. return a radiobutton based on the provided parameters.
function form_radiobutton($attributes, $for_saving=false){
    
    $checked=$attributes['checked'];
    
    $field_name=$attributes['name'];
    $end;
    
    if($for_saving){
        
        $checked="checked=\"<?=\${$field_name}?>\"";
        $end="<span id='error'><span id='error'><?=\$error_{$field_name}?></span>";
        
    }
    
    unset($attributes['checked']);
    
    $att;
    
    foreach($attributes as $key => $val){
        
        $att.=$key.'='.'"'.$val.'" ';
        
    }
    
    $radiobox="<input type='radio' {$att} {$checked} />".$end;
        
    return $radiobox;
        
        
}
    
// button. returns a button based on the provided parameters.
function form_button($attributes, $for_saving=false){
    
    $field_name=$attributes['name'];
    $end;
    
    if($for_saving){
        
        $end="<span id='error'><span id='error'><?=\$error_{$field_name}?></span>";
        
    }
    
    $att;
        
    foreach($attributes as $key => $val){
            
        $att.=$key.'='.'"'.$val.'" ';
            
    }
        
    $button="<button type='button' {$att}/>".$end;
        
    return $button;
        
}
    
// submit. returns a submit button based on the provided parameters.
function form_submit($attributes=array(), $for_saving=false){
    
    $field_name=$attributes['name'];
    $end;
    
    if($for_saving){
        
        $end="<span id='error'><span id='error'><?=\$error_{$field_name}?></span>";
        
    }
    
    $att;
        
    foreach($attributes as $key => $val){
            
        $att.=$key.'='.'"'.$val.'" ';
            
    }
        
    $submit="<input type='submit' {$att}/>".$end;
        
    return $submit;
        
}
    
// cancel. returns a cancel button based on the provided parameters.
function form_cancel($attributes, $for_saving=false){
    
    $field_name=$attributes['name'];
    $end;
    
    if($for_saving){
        
        $end="<span id='error'><span id='error'><?=\$error_{$field_name}?></span>";
        
    }
    
    $att;
        
    foreach($attributes as $key => $val){
            
        $att.=$key.'='.'"'.$val.'" ';
            
    }
        
    $cancel="<input type='cancel' {$att}/>".$end;
        
    return $cancel;
        
}
    
// reset. returns a reset button based on the provided parameters.
function form_reset($attributes, $for_saving=false){
    
    $field_name=$attributes['name'];
    $end;
    
    if($for_saving){
        
        $end="<span id='error'><span id='error'><?=\$error_{$field_name}?></span>";
        
    }
    
    $att;
        
    foreach($attributes as $key => $val){
            
        $att.=$key.'='.'"'.$val.'" ';
            
    }
        
    $reset="<input type='cancel' {$att}/>".$end;
        
    return $reset;
        
}

// create form element.
function create_form_element($template, $field_type, $attributes, $for_caching=false){
    
    // $field_name, $value, $placeholder, $autocomplete='off'
    
    $field_name=$attributes['name'];
    $value=$attributes['value'];
    $placeholder=$attributes['placeholder'];
    $autocomplete=$attributes['autocomplete'];
    
    switch($field_type){
            
        // if textbox is requested.
        case 'textbox':{
            
            return form_textbox($attributes, $for_caching);
            
        }
            
        // if password is requested.
        case 'password':{
            
            return form_password($attributes, $for_caching);
            
        }
        
        // if textarea is requested.
        case 'textarea':{
            
            $attributes['rows']=10;
            $attributes['cols']=70;
            
            return form_textarea($attributes, $for_caching);
            
        }
            
        // if checkbox is requested.
        case 'checkbox':{
            
            if($value==''){
            
               $attributes['value']='Yes';
            
            }
            
            if($value=='Yes'){
                
                $attributes['checked']="checked";
                
            }
            
            return form_checkbox($attributes, $for_caching);
            
        }
            
        // if radiobutton is requested.
        case 'radiobutton':{
            
            if(!empty($value)){
                
                $attributes['checked']="checked";
                $attributes['value']="Yes";
                
            }else{
                
                $attributes['value']="No";
                
            }
            
            return form_radiobutton($attributes, $for_caching);
            
        }
            
        // if radiobutton is requested.
        case 'radioarraybutton':{
            
            $radios;
            
            $template_fields=$template->fields[$field_name];
            
            // value is array. first value is the value of checkbox. second is the saved value.
            $labels=explode('^', $template_fields);
            
            $default=explode('@', $labels[2]);
            
            $field_names=explode('|', $default[0]);
            
            $i=0;
            
            foreach($field_names as $fields){
                
                $fields=explode(';', $fields);
                
                $field_label=$fields[0];
                $field_value=$fields[1];
                
                $attributes=array(
                                  'name'=>$field_name,
                                  'value'=>$field_value,
                                  'id'=>str_replace(' ', '', $field_value),
                                  'style'=>'',
                                  'class'=>''
                                  );
                
                if($field_value==$value){
                    
                    $attributes['checked']="checked";
                    
                }
                
                if(empty($value) && $default[1]==$i){
                    
                    $attributes['checked']="checked";
                    
                }
                
                $i++;
                
                // radio label.
                $radios.="&nbsp;&nbsp;<label>".$field_label." ";
                
                $radios.=form_radiobutton($attributes, $for_caching);
                
                $radios.="</label>";
                
            }
            
            return $radios;
            
        }
        
        // if editable is requested.
        case 'editable':{
            
            $radios;
            
            $template_fields=$template->fields[$field_name];
            
            // value is array. first value is the value of checkbox. second is the saved value.
            $labels=explode('^', $template_fields);
            
            $default=explode('@', $labels[2]);
            
            $field_attributes=explode('|', $default[0]);
        	
        	$names=array();
        	$values=array();
        	
        	foreach($field_attributes as $attr){
        	
        		$components=explode(';', $attr);
        		
        		$names[]=$components[0];
        		
        		$values[]=$components[1];
        	
        	}
        	
        	
            $attributes['name']=$names;
            
            if(!empty($value)){
            
            	array_unshift($values , $value);
            
            }
            
            $attributes['value']=$values;
            
            //$attributes['width']="200";
            
            //$attributes['class']="dd";
              
            $attributes_textbox['name']=$field_name;
            
            $attributes_textbox['id']=$field_name;
            
            $attributes_textbox['value']=$value;
            
            //$attributes_textbox['width']="200";
            
            //$attributes_textbox['class']="dd";
              
            // radio label.
            $radios.="&nbsp;&nbsp;<label>".$field_label." ";
            
            $radios.=form_textbox($attributes_textbox, $for_caching);
            
            $radios.="</label>";
            
            $radios.=form_dropdowneditable($field_name, $attributes, $for_caching);
                
            
            
            return $radios;
            
        }
            
        // default is dropdown.
        default:{
            
            $value;
            $dropdownvalue;
            // check if values for this drop down is defined in form template.
            if(isset($template->{$field_type})){
                
                $dropdownvalue=$template->{$field_type};
                
            }else{
                
                // the values for this field is not defined in template file. Go check it out in database.
                $dropdownvalue=$this->model_fetch_dropdown->fetch($field_type);
                
            }
            
            if(empty($value)){
                
                $value=$dropdownvalue;
                
            }else{
                $value=array($value);
                $value=array_merge($value,$dropdownvalue);
                
            }
            
            $attributes['value']=$value;
            
            return form_dropdown($attributes, $for_caching);
            
        }
            
    }
    
}


?>