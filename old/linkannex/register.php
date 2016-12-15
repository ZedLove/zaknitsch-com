<?php
	session_start();
	require("includes/connect.inc.php"); 
	
	/* Name: Zak Nitsch
	 * 
	 * Date of Submission:
	 * Friday, November 25, 2011
	 * 
	 * Assignment: Bookmarking App
	 */
	
	define("LOGGED_IN", "f0c04d332c851f7d887981e3ed57fe54"); //logged_in md5'd 3 times
	define("IS_LOGGED", "c8f05269c5fa3a4b9db07b642cf98eab"); //IS_LOGGED md5'd 3 times
	
	//destroy session to make sure user is logged out before creating a new account
	$_SESSION["firstname"] = "";
	$_SESSION["lastname"] = "";
	$_SESSION["username"] = "";
	$_SESSION["password"] = "";
	$_SESSION[LOGGED_IN] = "";
	
	session_destroy();
	
//check if form was submitted	
	if ( isset($_POST["password"]) ) {
			
			$password = mysql_real_escape_string( strip_tags($_POST["password"]) );
			$ver_password = mysql_real_escape_string( strip_tags($_POST["ver_password"]) );
			$email = mysql_real_escape_string( strip_tags($_POST["email"]) );
			$ver_email = mysql_real_escape_string( strip_tags($_POST["ver_email"]) );
			if (strcmp($password, $ver_password) == 0 ) {
				if (strcmp($email, $ver_email) == 0 ) {
					
					//send e-mail with verification 
					include ("includes/email.inc.php");
					
					header ("Location: linkannex.php");
				}//email compare endif
				else {
					$error = "Your emails did not match";
				}	
			}//password compare endif
			else {
				$error = "Your passwords did not match";
			}
	}


?>
<!DOCTYPE html>
	<html lang="en">
	<head>
	<!--
		HTML 5 Verification based on tutorial and with images from: 
		http://webdesign.tutsplus.com/tutorials/site-elements/bring-your-forms-up-to-date-with-css3-and-html5-validation/
		
	-->
		<meta charset="utf-8">
		<link rel="stylesheet" media="screen" href="css/style.css?v=4" />
		<title>Link Annex</title>
		
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<div id="container">
			<div id="wrapper">
				<header>
					<h1><span><a href="linkannex.php">Link Annex</a></span></h1>
				</header>
				<div id="content">
					<div id="links">
						<form class="registerform" action="<?php echo "{$_SERVER["PHP_SELF"]}"; ?>" method="post" name="registerform" autocomplete="off">
							<p>Already registered? <a href="linkannex.php">log in</a>.</p>
							<fieldset>
							<legend><h2>Register:</h2></legend>
								<span class="required_notification">* Denotes Required Field</span>
							<ul>
								<li>
									<label for="email">Email:</label>
									<input type="email" name="email" size="50" maxlength="80" placeholder="example@mail.com" required />
								</li>
								<li>
									<label for="ver_email">Verify Email:</label>
									<input type="email" name="ver_email" size="50" maxlength="80"  required/>
								</li>
								<li>
									<label for="username">Username:</label>
									<input type="text" name="username" size="50" maxlength="80" required/>
								</li>
								<li>
									<label for="password">Password:</label>
									<input type="password" name="password" size="50" maxlength="20" required/>
								</li>
								<li>
									<label for="ver_password">Verify Password:</label>
									<input type="password" name="ver_password" size="50" maxlength="20" required/>
								</li>
								<li>
									<label for="firstname">First Name:</label>
									<input type="text" name="firstname" size="50" maxlength="50" />
								</li>
								<li>
									<label for="lastname">Last Name:</label>
									<input type="text" name="lastname" size="50" maxlength="50" />
								</li>
								<li>
									<button class="submit" type="submit">Register</button>
								</li>
								<?php echo $error; ?>
							</ul>
							</fieldset>
						</form>
					</div><!--links close-->
					<div id="login">
					</div><!--login close-->
				</div><!--content close-->
				<footer>
				</footer>
			</div><!--wrapper close-->
		</div><!--container close-->
	</body>
	</html>
</body>
</html>