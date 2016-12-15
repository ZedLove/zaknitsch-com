<?php 	
	require_once( "system/includes/functions.inc.php" );
	// set URL for form actions
	$pageURL = getURL();
	
	// login form validation
	//include_once( "system/includes/checkloginform.inc.php" );
	
	// registration form validation
	if( isset( $_POST[ "age" ] ) ) // check if unique field from registration isset
	{
		
		if( !filter_var( $_POST[ "email" ], FILTER_VALIDATE_EMAIL ) )
		{
			// invalid email
			addMessage( "email" , "Please enter a valid email.");
		}
		if (strcmp( $_POST['email'], $_POST['ver_email'] ) != 0 ) {		
			addMessage( "email" , "Your emails did not match." );
		}
		
		if( strlen( $_POST[ "password" ] ) < 4 )
		{
			// short password
			addMessage( "password" , "Please select a longer password.");
		}
		
		if( strcmp( $_POST[ "password" ], $_POST[ "retype" ] ) != 0 )
		{
			// passwords don't match
			addMessage("retype" , "Passwords did not match, please re-type them.");
			
		}
		
		if (!isset( $_POST[ "age_confirm" ]) /*&& $_POST[ "age_confirm" ]  != "Yes"*/ ) {
			// age checkbox was not checked	
			addMessage( "age_confirm" , "Please confirm that you are 18 years of age or older. Box not checked." );
		}	
			
		if ( intval( $_POST[ "age" ] ) < 18 ) {	
			addMessage( "age" , "You must be at least 18 to register." );	
		}
		
		if( count($_SESSION[ "messages" ]) < 1 )
		{	// check for errors
			addPublicUser();
			// clear post array out
			clearFormData();
			if( count($_SESSION[ "messages" ]) < 1 )
			{	// check for errors (yes, again. just trust me)
				addMessage("login" , "The user was saved." , true);
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Join - <?php echo  $_SERVER[ "HTTP_HOST" ]; ?></title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<!--captcha theme selection-->
		<script type="text/javascript">
		 var RecaptchaOptions = {
		    theme : 'clean'
		 };
		 </script>
	</head>
<body>
				<div id="container">
						<div id="header">
								<!--div logo start--><div id="logo"><span>Content for  id "logo" Goes Here</span></div><!--div logo finish-->
								<div id="nav"><span>Content for  id "nav" Goes Here</span>
										<li><a href="home">Home</a></li>
										<li><a href="about-us">About us</a></li>
										<li><a href="search">Search</a></li>
										<li><a class="current" href="profile">Join</a></li>
								</div>
						</div><!--div logo finish-->
						<div id="main_searchpage">
								<div id="left_searchpage">
										<div id="left_searchpage_inside">
												<p class="text">Registration</p>
</div><!--div left_serachpage finish-->
										<div id="registration_text">			
			<?php message( "login" ); 
				  message( "sentmail" );?>
			<form class="registration" action="<?php echo $pageURL; ?>" method="post">
				<fieldset>
					<ol>
						<li>
							<label>Email<span>*</span>:</label>
							<?php message( "email" );
								  message( "duplicate_email" ); ?>
							<input type="text" name="email" 
								size="60" value="<?php echo $_POST[ "email" ]; ?>" />
						</li>
						<li>
							<label for="ver_email">Verify Email<span>*</span>:</label>
							<input type="email" name="ver_email" size="50" maxlength="80"  required/>
						</li>
						<li>
							<label>Password<span>*</span>:</label>
							<?php message( "password" );  ?>
							<input type="password" name="password" size="60" />
						</li>
						<li>
							<label>Password (Re-type)<span>*</span>:</label>
							<?php message( "retype" );  ?>
							<input type="password" name="retype" size="60" />
						</li>
						<li>
							<label for="firstname">First Name<span>*</span>:</label>
							<input type="text" name="firstname" size="50" maxlength="50" value="<?php echo $_POST['firstname'];?>" required/>
						</li>
						<li>
							<label for="lastname">Last Name:</label>
							<input type="text" name="lastname" size="50" maxlength="50" value="<?php echo $_POST['lastname'];?>" required/>
						</li>
						<li>
							<label for="gender" required>Gender<span>*</span>:</label>
							<select name="gender">
								<option value="1">Male</option>
								<option value="0">Female</option>
							</select>
						</li>
						<li>
							<label for="orientation">Interested in<span>*</span>:</label>
							<select name="orientation">
								<option value="1">Male</option>
								<option value="0">Female</option>
								<option value="2">Both</option>
								</select>
						</li>
						<li>
							<label for"age">Age<span>*</span>:</label>
							<?php message( "age" ); ?>
							<select name="age" >
								<?php 
								$year = 0;
								for ($i = 0; $i <= 100; $i++) {
									$year = $year;
									echo "<option value=\"{$year}\">{$year}</option>";
									$year++;
								}
								 ?>
							 </select>
						</li>
						<li>
							<input class="shortinput" type="checkbox" name="age_confirm" value="" />
							<?php message( "age_confirm" ); ?>
							<label class="longlabel" for="age_confirm">By checking this box, you confirm that you are 18 years of age or older:</label>
						</li>
						<li>
							<label for="captcha">Not a robot?</label>
							<?php	 message( "captcha" );
							          require_once('system/includes/recaptchalib.php');
							          $publickey = "6Lej5coSAAAAANspw-e6K4hw3h1zd2e1zYy8uIt9";
							          echo recaptcha_get_html($publickey);
							        ?>
						</li>
						<li>
							<input type="submit" value="" />
						</li>
					</ol>
				</fieldset>
			</form>
</div><!--div registration_text-->
                                </div><!--div left_serachpage_inside finish-->
								<div id="right_serachpage">
								</div><!--div right_searchpage-->
								<div id="down_searchpage"></div><!--div dow_searchpage-->
						</div>
                             <div id="footer">
      <div id="footer_left">
	  <ul>
	  <li class="footer">Home | About us | Search | Join
	  </li>
	  </ul>
      </div><!--closes footer_left-->
      <div id="footer_right">
      <ul>
     <li><a href="http://twitter.com/#!/loyldating"><img src="/images/twitter.png" width="28" height="23" alt="twitter" /></a></li>
      <li><a href="http://www.facebook.com/pages/Loyl-Dating/237182623018274"><img src="/images/facebook.png" width="28" height="23" alt="facebook" /></a></li>
       
      </ul></div>
    </div><!--closes footer-->
				</div><!--div container finish-->
</body>
</html>