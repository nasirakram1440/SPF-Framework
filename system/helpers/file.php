<?PHP
    
/**
* FILE HELPER
*
* @author:  Muhammad Nasir Akram.
* @Date:    18/2/2014:2:11pm.
* @Functionality:   Contains Wrappers for reading and writing file to disk.
* @Howto:
*
*/

    
// write file to a path
function file_write($path, $data=''){
        
        //print dirname($path)."--".$data;
        
    // check to see if file path is writable
    if(is_writable(dirname($path))){
            
        // open the file
        $file=fopen($path, 'w+');
        // write file
        fwrite($file,$data);
            
    }else{
            
        return false;
            
    }
        
}
    
function file_read($path){
        
    // check to see if file is readable
    if(is_readable($path)){
            
        // read the file
        return file_get_contents($path);
        // return readfile($path);
            
            
    }else{
            
        return false;
            
    }
        
}

// show the pdf file to user.
function file_pdf_serve($file, $pre='', $filename=''){
    
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        
        // set filename if the file name is provided.
        if($filename!=''){
        header('Content-Disposition: inline; filename="'.$filename.'"');
        }
        
        header('Content-Type: application/pdf');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
    
}
    
// send a file to client.
function file_download($file, $pre=''){
    
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$pre.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
    
}

?>