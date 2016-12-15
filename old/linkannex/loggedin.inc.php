<?php 

	/* Name: Zak Nitsch
	 * 
	 * Date of Submission:
	 * Friday, November 25, 2011
	 * 
	 * Assignment: Bookmarking App
	 */

//if ( is_active($_POST["$username"]) == 0 ){ //is the account active?
	
		if ( isset($_POST["username"]) ) {  
			$username = mysql_real_escape_string( strip_tags($_POST["username"]) );
			$password = mysql_real_escape_string( strip_tags($_POST["password"]) );
			
			$query = "SELECT password, username, firstname, lastname FROM tbl_users WHERE username LIKE BINARY '{$username}'";
			$result = mysql_query($query) or die(mysql_error());
			
			//check password against database
			if ( mysql_num_rows( $result ) > 0 ) {
				$row = mysql_fetch_assoc($result);
				
				if( strcmp( $row["password"], md5($password) ) == 0 ) {
					
					$_SESSION[ LOGGED_IN ] = IS_LOGGED;
					
					if( strlen ($row["firstname"] ) < 1) {
						$row["firstname"] = "Mr. President";
						
					}
					$_SESSION["firstname"] = $row["firstname"];
					$_SESSION["username"] = $row["username"];
				}
				
				else {
					$error = "The username/password your entered was not correct.";
					}
				}//closes second if
			else {
				$error = "The username/password your entered was not correct.";
			}
		}
//}
?>