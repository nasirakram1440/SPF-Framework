<?PHP
    
/**
* DATE HELPER
*
* @author:  Muhammad Nasir Akram.
* @Date:    20/06/2014:1:04pm.
* @Functionality:   Contains various functions related to date.
* @Howto:
*
*/

    
// date string to days.
function date_to_days_from_now($last_date) {
    
     $now = time(); // or your date as well
     
     $last_date=strtotime($last_date);
     
     $days_used = $now - $last_date;
     
     $days_used = floor($days_used/(60*60*24));
     		
     return $days_used;
    
}

// returns date when provided initial date and + number of days
function date_to_date_from_days($date, $days){

	$day=" + $days days";
	return date('Y-m-d', strtotime($date.$day));

}
 
// is the date in the past.
function date_is_in_the_past($given_date){

	$date = new DateTime($given_date);
	$now = new DateTime();
	
	if($date < $now) {
    			
    	return true;
    			
	}else{
	
		return false;
	
	}

}   
    
?>