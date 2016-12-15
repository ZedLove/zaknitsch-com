<?php

	debug(__FILE__);
	displaySession();

	/* debug() : Outputs a message when debugging mode
	 * (SITE_DEBUG) is turned on in the config.inc.php file.
	 * The name of the current script is also echoed.
	 */
	function debug( $message = "" )
	{
		if( SITE_DEBUG )
		{
			echo "<p>[" . $message . "]</p>";
		}
	}
	
	/* displaySession() : Outputs the $_SESSION array
	 * to show what information is stored while a 
	 * user is logged in. Only while SITE_DEBUG is on
	 */
	function displaySession()
	{
		if ( SITE_DEBUG) {
			echo "<pre>";
			print_r($_SESSION);
			echo "<pre>";
		}
	}

	/* redirect() : sends the browser to the specified URL.
	 * If SITE_DEBUG is set to 'true', only a message indicating
	 * the redirect will be displayed.
	 */
	function redirect( $url )
	{
		if( SITE_DEBUG )
		{
			debug( "redirecting to: {$url} (turn off debugging.)" );
			
			// simulate a re-direct with javascript
			echo "<script type=\"text/javascript\">";
			echo "window.location='{$url}'";
			echo "</script>";
			
			exit();
		}
		else
		{
			header( "Location: {$url}" );
		}
	}
	
	/* checkLogin() : checks if user is allowed to see the current
	 * page.  If not, redirects to the login.
	 */
	function checkLogin( $currentLevel = USER_ADMIN )
	{
		// if the user has not logged in, restrict
		// them to only public pages
		if( !isset( $_SESSION[ USER_LEVEL ] ) )
		{
			$_SESSION[ USER_LEVEL ] = USER_PUBLIC;
		}
		
		if( $currentLevel > $_SESSION[ USER_LEVEL ] )
		{
			// restricted, redirect to login
			redirect( "/" . F_ADMIN . "login.php" );
		}
		else
		{
			// everything is OK, so proceed
		}
	}
	
	/* addMessage() : creates an array within
	 * $_SESSION to communicate errors with
	 * the user. 
	 * Accepts $slug as a key, $message as a message
	 * and $value as either success or failure
	 * to determine what kind of message it is printing
	 * value accepts either 'success' or 'error'
	 */
	 
	function addMessage( $slug, $message, $value = false )
	{
		// set $value based on input
		if ($value == false) {
			// the message is an error message
			$value = "error";
		}
		else {
			// the message is a success message
			$value = "success";
		}
		
		if( !is_array( $_SESSION["messages"] ) )
		{
			$_SESSION["messages"] = array();
		}
		
		$_SESSION["messages"][ $slug ] = "<p class=\"{$value}\">" . $message . "</p>";
	}
	
	/* message() : displays error messages
	 * from the array contained in $_SESSION
	 * created by addMessage(). After the message
	 * is displayed, the value is removed from
	 * the array.
	 */
	function message( $slug )
	{
		if( strlen( $_SESSION["messages"][ $slug ] ) > 0 )
		{
			echo $_SESSION["messages"][ $slug ];
			$_SESSION["messages"][ $slug ] = "";
			unset( $_SESSION["messages"][ $slug ] );
		}
	}
	
	/* filterFormData() : Escape any characters that could
	 * break a MySQL query within every entry in the $_POST
	 * array.
	 */
	function filterFormData()
	{
		foreach( $_POST as $key => $value )
		{
			$_POST[ $key ] = mysql_real_escape_string( $value );
		}
	}
	
	/* clearFormData() : Erases everything in the $_POST
	 * array.
	 */
	function clearFormData()
	{
		foreach( $_POST as $key => $value )
		{
			$_POST[ $key ] = "";
			unset( $_POST[ $key ] );
		}
	}
	
	/* login() : Attempts to log a user into the system.
	 * Returns FALSE on failure.
	 */
	function login()
	{
		filterFormData();
		
		// strip off any tags from the email
		$_POST[ "email" ] 		= strip_tags( trim( $_POST[ "email" ] ) );
		
		// encrypt the password
		$_POST[ "password" ] 	= md5( $_POST[ "password" ] );
		
		$query = "SELECT * FROM " . T_USERS . " WHERE email='{$_POST["email"]}'";
					
		$result = mysql_query( $query ) 
			or die( debug( mysql_error() ) );
		
		if( mysql_num_rows( $result ) > 0 )
		{
			// user exists in the database
			$user = mysql_fetch_assoc( $result );
			// check is account is active
			if ( intval( $user[ "active" ] ) == 1 ) {	
				// user account is active
				if( strcmp( $_POST[ "password" ], $user[ "password" ] ) == 0 )
				{
					// password was OK, log them in.
					
					$_SESSION[ LOGGED_IN ] = YES;
					$_SESSION[ USER_LEVEL ] = $user[ "user_level" ];
					
					// store user's info in $_SESSION
					
					foreach ($user as $key => $value) {
						// take information from $user
						// and put it into the $_SESSION
						$_SESSION[ $key ] = $value;
						
					}
					
					// remove user's password from $_SESSION
					$_SESSION[ "password" ] = "";
					unset($_SESSION[ "password" ]);
					
					return true;
				}
				else { // password was wrong
					addMessage( "wrong_password" , "The email/password was incorrect." );
				}
			}
			else { // account is not active
			
				addMessage("not_active" , "Your account is not yet active. Please check the e-mail address you used to register to activate your account.");
			}	
		}
		
		return false;
	}
	
		
	/* logout() : Wipes out the session and redirects the user
	 * to the home page of the site.
	 */
	function logout()
	{	
		// set redirect location based on user level
		if($_SESSION[ USER_LEVEL ] >= 5)
		{
			$path = "/" . F_ADMIN;
		}
		else
		{
			$path = "/";
		}
		
		$_SESSION[ USER_LEVEL ] = 0;
		$_SESSION[ LOGGED_IN ] = "";
		
		unset( $_SESSION[ USER_LEVEL ] );
		unset( $_SESSION[ LOGGED_IN ] );
		
		session_destroy();
		
		redirect( $path );
	}
		
	
	
	
	function checkEmail( $email ) {
		
		$query = "SELECT email FROM
				 cms_users
				 WHERE
				 email='{$email}'";
				 
		$result = mysql_query($query);// or die ( debug( mysql_error() ) );
		
		if( isset($result) ) {	// this step is necessary bc there is no error if query fails
			// the query worked
			if (mysql_num_rows($result) < 1) {
				return true;
			}
			else {
				return false;
			}
		}
	}
	
	/* makeCaptcha() : generates a string of text
	 * to be displayed in a captcha box during
	 * user registration.
	 */
	function makeCaptcha() {
		$string = "";
		// initialize the string
		for ($i = 0; $i < 7; $i++) {
			// populate the string with random characters
			$string .= chr(mt_rand(97, 122));
		}
		
		$_SESSION[ "captcha_string" ] = $string;
		
		// create an image to contain the captcha string
		
		//directory containing the fonts
		$dir = F_FONTS;  
		 // image will be 170px wide by 60px tall
		$image = imagecreatetruecolor(170, 60);  
		$black = imagecolorallocate($image, 0, 0, 0);  
		$color = imagecolorallocate($image, 200, 100, 90); // red  
		$white = imagecolorallocate($image, 255, 255, 255);
		
		// fill the image with a white background
		// numeric values = coordinates. make sure this is larger than $image
		imagefilledrectangle($image,0,0,200,100,$white);  
		// add the string of random text using an uploaded .ttf font
		// params for imagegettftext($image, $font_size, $angle, $x, $y, $color ,$font_file ,$text)
		imagettftext($image, 30, 0, 10, 40, $alt, $dir."alike-regular.ttf", $_SESSION['rand_code']); 
		
		// tell the broswer what file-type to expect
		header("Content-type: image/png");  
		// generate the image
		imagepng($image);
	
	}
	
	/* emailUser() : sends an activation
	 * email to the user based on a key
	 * generated after successful registration.
	 */
	function emailUser( $ukey )
	{
		require_once("system/includes/class.phpmailer.php");
		
		$query = "SELECT email,
						 firstname,
						 lastname
				 FROM " . T_USERS . 
				 " WHERE ukey='{$ukey}'";
		
		$result = mysql_query($query)
					or die( debug( mysql_error() ) );
					
		$user = mysql_fetch_assoc($result);
		
		$url 			  = "http://zaknitsch.com/loyl/verify/" . $ukey;
		
		$mail             = new PHPMailer(); // defaults to using php "mail()"
		
		$body             = "<p>Hi {$user[ "firstname" ]},</p>
							 <p>Thank you for registering at loyl.zaknitsch.com!</p>
							 <p>This e-mail was sent to you because a new account was created at
							 zaknitsch.com/loyl for {$user[ "firstname" ]} {$user[ "lastname" ]}.</p>
							 <p>If you did not register for an account, please disregard this e-mail.</p>
							 <p>To confirm your account, please click <a href=\"{$url}\">here</a> or copy and paste the url below into your web browser.</p><br /><br />" . $url;
				
		$mail->SetFrom("donotreply@loyl.zaknitsch.com", "loyl dating ");
		
		$mail->AddAddress($user[ "email" ], $user[ "firstname" ] . " " . $user[ "lastname" ]);
		
		$mail->Subject    = "loyl dating - confirm your registration";
		
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		
		$mail->MsgHTML($body);
		
		if( !$mail->Send() ) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		// create message to confirm message was sent
		addMessage( "sentmail", "Please check your e-mail to confirm your account. You may have to check your spam folder.", true );
		}
	}
	
	/* activateUser() : accepts activation key
	 * from link in registration e-mail
	 * sets the user's account to active and 
	 * sets the key to blank so the function
	 * can't be run more than once
	 */
	function activateUser( $ukey ) 
	{	
		$active = 1;
		$blankkey = "";
		
		// set the user to active and remove their key from the table so the function can't be run again
		$query = "UPDATE " . T_USERS . " SET active=$active, ukey='{$blankkey}' WHERE ukey='{$ukey}'";
		
		if ( $result = mysql_query($query) ) // var_dump of this returns bool(true) why does this still allow a 32 char string to pass?
		{
			return true;
		}
		else{
			return false;
		}											
	}
	
	/* deleteUser() : Removes a specific user from
	 * T_USERS based on the provided id.
	 */
	function deleteUser( $id )
	{
		$query = "DELETE FROM " . T_USERS . " WHERE id={$id}";
		
		$result = mysql_query( $query ) 
			or die( debug( mysql_error() ) );
	}
	
	/* uploadMedia(): uploads a media file to the web server 
	 * (customizable to any media type).
	 */
	function uploadMedia()
	{		
		$output = array();
		
		if( strstr( ALLOWED_FILE_TYPES, $_FILES[ "user_upload" ][ "type" ] ) )
		{
			// the file is one of the allowed types
			if( $_FILES[ "user_upload" ][ "size" ] <= MAX_FILE_SIZE )
			{
				$filename = md5(date(Bisu)) . "_andid_" . md5($_SESSION[ "id" ]) . "." . substr($_FILES[ "user_upload" ][ "type" ], 6);
				$destination = getcwd() . "/" . F_UPLOADS . $filename;
								
				// file is not too big
				if( @move_uploaded_file( 
					// move the file to the uploads folder
					$_FILES[ "user_upload" ][ "tmp_name" ], 
					$destination ) )
				{
					// insert file info into the database
					
					$query = "UPDATE " 
							 . T_USERS
							 . " SET user_photo='{$filename}'
							 WHERE id={$_SESSION[ "id" ]}";
					
					$result = mysql_query($query)
						or die( debug( mysql_error() ) );
						
					// update the $_SESSION to use new filepath
					
					$_SESSION[ "user_photo" ] = $filename;
					
					$output[ "result" ] = true;
					$output[ "filename" ] =  $filename;
				}
				else
				{
					$output[ "result" ] = false;
					$output[ "error" ] = "<p class=\"error\">The file could not be uploaded.  Make sure the images/uploads/ folder has file permissions set to 774</p>";
				}
			}
			else
			{
				$output[ "result" ] = false;
				$output[ "error" ] = "<p class=\"error\">The file is larger than the allowed size of " . MAX_FILE_SIZE . " bytes.</p>";
			}
		}
		else
		{
			$output[ "result" ] = false;
			$output[ "error" ] = "<p class=\"error\">The file is not one of the allowed types: " . ALLOWED_FILE_TYPES . "</p>";
		}
		
		return $output;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	