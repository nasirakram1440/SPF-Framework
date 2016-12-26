<?PHP
    
/**
* ACCESS LIBRARY CLASS
*
* @author:  Muhammad Nasir Akram.
* @Date:    20/2/2014:4:52pm.
* @Functionality:   Access related functionality.
* @Howto:
*
*/
    
class access{
    
    
    function __Construct(){
            
        // Constructor

    }
    
    // allow only members.
    public function members($user_id=NULL, $email=NULL,$hosti){
        
        if(empty($user_id) || empty($email)){
            
            header('Location: '.$hosti.'accounts/login');
            exit();
            
        }
        
    }
    
    public function member_payment_status($last_payment, $account_date, $credit, $hosti){
     		
     	$days_account_active_for = date_to_days_from_now($last_payment);
     	
     	$expiry_date = date_to_date_from_days($last_payment, $credit);
     	
     	// decide how many days account has been activated for.
		
		// cases
		// if it has been 3 or more days since user account is created. check for payment.
		// if payment is made then ignore notification_message.
		// else notify user if it has been less then 7 days since user account is created.
		// if it has been more than seven days and payment hasnt processed take user to payment page.
		
		$days_since_account_created = date_to_days_from_now($account_date);
		
		$days_since_account_created=intval($days_since_account_created);
		
		if($days_since_account_created>-1){
		
			// check if payment has been made.
			
			if(empty($last_payment) && $days_since_account_created>3 && $days_since_account_created<7){
			
				$trial_end=7-$days_since_account_created;
				$day="days";
				
				if($trial_end==1){
				
					$day="day";
				
				}
				
				// payment hasnt been made. notify the user.
				$notification_message="Your trial of simple offer will end in {$trial_end} {$day}. Please <a href='".$hosti."paypal/pay'>click</a> here to make the payment";
				//return $notification_message;
				
			}
			
			// it has been more than 7 days since user hasnt paid. redirect him/her to payment page.
			if(empty($last_payment) && $days_since_account_created>-1){

				header('Location: '.$hosti.'paypal/pay');
                exit();
			
			}
			
			
			$past = date_is_in_the_past($expiry_date);
			
			if($past && $last_payment_credit>0) {
    			
    			header('Location: '.$hosti.'paypal/pay');
                exit();
    			
			}
			
		
		}
    
    }
    
}

?>