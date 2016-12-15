<?php
	
	require_once( "common-functions.inc.php" );
	require_once( "config.inc.php" );
	
	debug(__FILE__);
	
	/* getURL() : returns the URL of the current page
	 */
	function getURL()
	{
		if( !SITE_MOD_REWRITE )
		{
			$url = mysql_real_escape_string( $_SERVER[ "QUERY_STRING" ] );
		}
		else
		{
			$url = mysql_real_escape_string( $_SERVER[ "REQUEST_URI" ] );
			$url = substr( $url, 1 );
		}
		
		if( strstr( $url, "verify" ) )
		{
			$url = explode( "/", $url );
			$url = $url[0];
		}
		
		if( strstr( $url, "users" ) )
		{
			$url = explode( "/", $url );
			$url = $url[0];
		}
		
		// if there is no URL, we are looking
		// at the home page.
		if( strlen( $url ) < 1 )
		{
			$url = SITE_HOME_PAGE;
		}
		
		return $url;
	}
	
	/* getContent() : returns the content for a 
	 * specific page URL.
	 */
	function getContent( $url )
	{
	
		$query = "SELECT content, 
						 title, 
						 summary, 
						 timestamp, 
						 template,
						 user_level
					FROM " . T_CONTENT . " WHERE url='{$url}' 
					ORDER BY timestamp DESC";
		
		$result = mysql_query( $query )
			or die( mysql_error() );
			
		if( mysql_num_rows( $result ) < 1 )
		{
			// page does not exist - 404 error
			redirect( SITE_404_PAGE );
		}
		
		$content = mysql_fetch_assoc( $result );
		
		return $content;
	}
	
	/* addPublicUser() : Inserts a new user
	 * into the T_USERS table.
	 * user_level can only be set to 0
	 * for creation of user profile pages
	 */
	function addPublicUser()
	{	
		filterFormData();
		if ( checkEmail( $_POST["email"] ) )
		{	// the email is unique
			// Remove HTML tags from any fields that shouldn't
			
			// contain them.
			$_POST[ "email" ] 			= strip_tags( $_POST[ "email" ] );
			$_POST[ "password" ] 		= md5( $_POST[ "password" ] );
			$_POST[ "firstname" ] 		= strip_tags( $_POST[ "firstname" ] );
			$_POST[ "lastname" ] 		= strip_tags( $_POST[ "lastname" ] );
			$_POST[ "age" ] 			= strip_tags( $_POST[ "age" ] );
			$_POST[ "gender" ] 			= strip_tags( $_POST[ "gender" ] );
			$_POST[ "orientation" ] 	= strip_tags( $_POST[ "orientation" ] );
			$ukey						= md5( md5($_POST[ "email" ]) . md5( date( "dDmisu" ) ) );
			
			// check the captcha
			require_once('recaptchalib.php');
			  $privatekey = "6Lej5coSAAAAAHwWAKTDq5h2Mnq3JlWMuEtA8H6r";
			  $resp = recaptcha_check_answer ($privatekey,
			                                $_SERVER["REMOTE_ADDR"],
			                                $_POST["recaptcha_challenge_field"],
			                                $_POST["recaptcha_response_field"]);
			
			  if (!$resp->is_valid)
			  { 
			    // What happens when the CAPTCHA was entered incorrectly
			    die ( addMessage( "captcha" , "The reCAPTCHA wasn't entered correctly. Go back and try it again." ) );
			    	
				  }	
			  else{ 
			  	// captcha was correct, insert the user
			  	
			  	$query = "INSERT INTO " 
	  					 . T_USERS
	  					 . "(email,
	  					 	password,
	  					 	firstname,
	  					 	lastname,
	  					 	age,
	  					 	gender,
	  					 	orientation,
	  					 	ukey,
	  					 	user_level)
	  					 VALUES('{$_POST["email"]}',
	  					 		'{$_POST["password"]}',
	  					 		'{$_POST["firstname"]}',
	  					 		'{$_POST["lastname"]}',
	  					 		{$_POST["age"]},
	  					 		'{$_POST["gender"]}',
	  					 		'{$_POST["orientation"]}',
	  					 		'{$ukey}',
	  					 		1)";
	  	
			  				$result = mysql_query( $query ) 
			  					or die( debug( mysql_error() ) );
			  		// user is created. send confirmation e-mail
			  		emailUser( $ukey );
			  }
		}
		else {
			// email is duplicate
			addMessage( "duplicate_email" , "An account has already been created with that e-mail address." );
		}
	}
	
	
	function updatePublicUser( $formname )
	{

		if( strcmp( $formname, "general" ) == 0 )
		{	// general form was submitted
			filterFormData();
			$_POST[ "gender" ] 			= strip_tags( $_POST[ "gender" ] );
			$_POST[ "orientation" ] 	= strip_tags( $_POST[ "orientation" ] );
			$_POST[ "city" ] 			= strip_tags( $_POST[ "city" ] );
			
			$query = "UPDATE " . T_USERS .
					 " SET gender={$_POST["gender"]},
					 		orientation={$_POST["orientation"]},
					 		country='{$_POST[ "city" ]}' WHERE id={$_SESSION["id"]}";		 		
			
		}
		
		if( strcmp( $formname, "appearance" ) == 0 )
		{	// appearance form was submitted
			filterFormData();
			$_POST[ "height" ] 			= strip_tags( $_POST[ "height" ] );
			$_POST[ "eyes" ] 			= strip_tags( $_POST[ "eyes" ] );
			$_POST[ "ethnicity" ] 		= strip_tags( $_POST[ "ethnicity" ] );
			
			$appearance = serialize($_POST);
			
			$query = "UPDATE " . T_USERS .
					 " SET appearance='{$appearance}'
					 		WHERE id={$_SESSION["id"]}";		 		
			
		}
		
		if( strcmp( $formname, "lifestyle" ) == 0 )
		{	// lifestyle form was submitted
			
			$lifestyle = serialize($_POST);
			
			$query = "UPDATE " . T_USERS .
					 " SET lifestyle='{$lifestyle}'
					 		WHERE id={$_SESSION["id"]}";		 		
			
		}
		
			$result = mysql_query( $query )
						or die( debug( mysql_error() ) );
		
		if( $result )
		{
			addMessage( "update", "Your profile has been updated.", true );
		}
		elseif ( mysql_affected_rows( $result ) == 0 )
		{
			addMessage( "update", "You did not change any of your information.", true );
		}
		else 
		{
			addMessage( "update", "An error occurred while updating your profile." );
		}

	}
	
	function getUserInfo( $id ) 
	{		
		$query = "SELECT * FROM " . T_USERS . " WHERE id={$id}";
		
		$result = mysql_query( $query ) 
			or die( debug( mysql_error() ) );
			
		if( mysql_num_rows($result)	== 0 )
		{
			return false;
		}	
		else{	
		$user = mysql_fetch_assoc($result);
		
		// unpack the information stored in arrays
		$user[ "appearance" ] = unserialize( $user[ "appearance" ] );
		$user[ "lifestyle" ] = unserialize( $user[ "lifestyle" ] );
		
		return $user;
		}
	}
	
	/* checkPublicLogin() : checks if user is allowed to see the current
	 * page.  If not, redirects to the home page. Pass the function 'false' to avoid redirect
	 */
	function checkPublicLogin( $redirect = true )
	{
		// if the user has not logged in, restrict
		// them to only public pages
		if($_SESSION[ LOGGED_IN ] != YES)
		{
			addMessage( "logged", "You must be logged in to view this page." );
			if ($redirect == true)
			{
				// not logged in, redirect to login
				redirect( "http://zaknitsch.com/working/login" );
			}
			else {
				// redirect is off. alert user to log in
				
			}
		}
		else
		{	// redirect is off
			// user is logged in
			return true;
		}

	}
	/* notLoggedIn() : checks if user is logged in
	 * and determines what content to display in the site navigation
	 */
	function notLoggedIn()
	{
		if( !checkPublicLogin( false ) )
		{	// user is not logged in
			echo "<a href=\"/register-user\">Join</a>";
		
		}
		else
		{	// user is logged in, link them to their profile
			echo "<a href=\"/profile\">Profile</a>";
		}
	}
	
	/* makeQuery() : accepts a string telling it which
	 * search form was submitted
	 */
	function makeQuery( $form = "general" )
	{
		// initialize query output
		$query = "SELECT id, 
						 firstname,
						 lastname,
						 user_photo,
						 age,
						 gender,
						 orientation,
						 country  FROM " . T_USERS . " WHERE ";
		// clean form data
		filterFormData();
		// handle common fields between both forms
		$_POST[ "gender" ] 			= strip_tags( $_POST[ "gender" ] );
		$_POST[ "orientation" ] 	= strip_tags( $_POST[ "orientation" ] );
		$_POST[ "age_low" ] 		= strip_tags( $_POST[ "age_low" ] );
		$_POST[ "age_high" ] 		= strip_tags( $_POST[ "age_high" ] );
		$_POST[ "city" ] 			= strip_tags( $_POST[ "city" ] );
		
		// determine gender and orientation
		if( intval( $_POST[ "gender" ] ) != intval( $_POST[ "orientation" ] ) &&  intval( $_POST[ "orientation" ] ) < 2 )
		{	// gender ≠ orientation and orientation is either male or female (2 is both)
			// set gender as what user's orientation and orientation as user's gender
			$query .= "gender={$_POST["orientation"]} AND orientation={$_POST["gender"]} ";
		}
		if( intval( $_POST[ "gender" ] ) == intval( $_POST[ "orientation" ] ) &&  intval( $_POST[ "orientation" ] ) < 2 )
		{	// gender = orientation and orientation is either male or female (2 is both)
			// set gender as what user's orientation and orientation as user's gender
			$query .= "gender={$_POST["gender"]} AND orientation={$_POST["orientation"]} ";
		}
		if( intval($_POST[ "orientation" ] ) == 2 )
		{	//orientation is both, don't specify gender
			// make sure result's orientation matches user's gender
			$query .= "orientation={$_POST["gender"]} ";
		}
		if( intval( $_POST[ "age_low" ] ) < intval( $_POST[ "age_high" ] ) )
		{	// determine age range, account for form values being out of whack
			$query .= "AND age>{$_POST["age_low"]} AND age<{$_POST["age_high"]} ";
		}
		if( intval( $_POST[ "age_low" ] ) > intval( $_POST[ "age_high" ] ) )
		{	// age_high value is lower
			$query .= "AND age<{$_POST["age_low"]} AND age>{$_POST["age_high"]} ";
		}
		if( intval( $_POST[ "age_low" ] ) == intval( $_POST[ "age_high" ] ) )
		{	// user wants only one age returned
			$query .= "AND age={$_POST["age_low"]} ";
		}
		// make sure result's city matches form value if specified
		if( strlen($_POST[ "city" ]) > 0 )
		{	
			$query .= "AND country LIKE '{$_POST[ "city" ]}' ";
		}
		
		/* the layout breaks if there are more than 4 result
		 * for the purposes of the demo, limit the results to 4
		 */
		 	$query .= " AND id != {$_SESSION["id"]} ORDER BY ABS( age - {$_SESSION["age"]} ) ASC,lastname ASC LIMIT 4";
		
		// which form?
		if( strcmp( $form, "general" ) == 1 )
		{	// general form
			// all fields added to query, we're done
			return $query;			
		}
		if( strcmp( $form, "advanced" ) == 1 )
		{	// advanced form

			return $query;
		}		
	}
	
	function runSearch( $query )
	{
			
		$result = mysql_query($query) or die( debug( mysql_error() ) );
							
		while ( $user = mysql_fetch_assoc($result) )  
		{ // output user info appropriately			
				echo	"<img class=\"ladys\" src=\"images/uploads/{$user["user_photo"]}\" width=\"89\" height=\"87\" alt=\"image\" />
							<ul>
							<li class=\"info\">
							<p class=\"title\"><a href=\"/users/{$user["id"]}\">{$user["firstname"]} {$user["lastname"]}</a></p> 
							<p>{$user["age"]}, {$user["country"]}, Ontario, Canada</p>
							<p class=\"profile\"><a href=\"/users/{$user["id"]}\">View Profile...</a></p>
							
							</li>
							<li class=\"line\"></li>
							</ul>";
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	