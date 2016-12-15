<?php 
	
	/* Name: Zak Nitsch
	 * 
	 * Date of Submission:
	 * Friday, November 25, 2011
	 * 
	 * Assignment: Bookmarking App
	 */

		// The commented-out section below was for e-mail verification. 
		// Left in as a future reference.
	
			/*	function make_verification($username, $email) {
			 *			echo "WHILE LOOP";
			 *			
			 *			$key = ""; $i = 0;
			 *			while ($i < 32) {
			 *				$key .= chr(rand(97,122));
			 *				$i++;
			 *			}
			 *			//clear previous keys
			 *			$query = "DELETE FROM tbl_pendinglogin WHERE login = '{$username}'";
			 *			mysql_query($query);
			 *			//create new key
			 *			$query = "INSERT INTO tbl_pendinglogin (login, ukey) VALUES ('{$username}', '{$key}')";
			 *			mysql_query($query);
			 *			
			 *		}
			 * //set the URL the new user will be linked to
			 * $query = "SELECT ukey FROM tbl_pendinglogin  WHERE login = '{$username}'";
			 * $result = mysql_query($query);
			 * 
			 * $key = mysql_fetch_assoc( $result );
			 * $key = $key["ukey"];
			 */
			$url = "http://db.zaknitsch.com/linkannex.php";
			
			
			//sending the mail
			include ("includes/class.phpmailer.php");
				
			$mail = new PHPMailer;
			$mail->ClearAddresses();
			$mail->AddAddress($email, $username);
			$mail->From = 'contact@zaknitsch.com';
			$mail->FromName = 'Link Annex - Account Created';
			$mail->Subject = 'Login to Your Account on Link Annex';
			$mail->Body = "Thank you for registering with Link Annex. Please do not respond to this e-mail.\n
							To use your account, please click on the URL below: 
							\nYour username is ".$username."\n".$url."\n";
							
			if ($mail->Send()) {
				//make_verification($username, $email); //make a verification key
				include("includes/create_user.inc.php"); //send user to database
				//$message = "An email has been sent to the address provided to verify your account.";
				//return $message;
			}
			else{
				print $mail->ErrorInfo;
				return false;
				echo "MAIL FAILED";
			}
			return true;
		
?> 