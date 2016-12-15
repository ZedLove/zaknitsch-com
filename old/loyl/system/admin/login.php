<?php 
	require_once( "admin-includes/admin-functions.inc.php" ); 
	
	$message = "";
	
	if( isset( $_POST[ "email" ] ) )
	{
		if( strlen( $_POST[ "email" ] ) < 6 )
		{
			addMessage( "email" , "Please enter a valid email address");
		}
		else
		{
			if( !filter_var( $_POST[ "email" ], FILTER_VALIDATE_EMAIL ) )
			{
				addMessage( "email" , "Please enter a valid email address.");
			}
		}
		
		if( strlen( $_POST[ "password" ] ) < 1 )
		{
			addMessage("password" , "Please enter a password." );
		}
		
		if( count( $errors ) < 1 )
		{
			// try to log the user in
			
			if( login() )
			{
				// successful login
				
				redirect( "/" . F_ADMIN );
				
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Login - <?php echo  $_SERVER[ "HTTP_HOST" ]; ?></title>
		<link rel="stylesheet" type="text/css" href="css/admin-style.css">
	</head>
	<body class="login">
		<div id="wrapper">
			<h1 class="icon-login heading">Login</h1>
			<?php message("wrong_password");
				  message("not_active"); ?>
			<form action="<?php echo $_SERVER[ "PHP_SELF" ];?>" method="post">
				<fieldset>
					<ol>
						<li>
							<label>Email:</label>
							<?php message("email"); ?>
							<input type="text" name="email" size="30"
								value="<?php echo $_POST[ "email" ]; ?>" />
						</li>
						<li>
							<label>Password:</label>
							<?php message("password"); ?>
							<input type="password" name="password" size="30" />
						</li>
						<li>
							<input type="submit" value="Sign In" />
						</li>
					</ol>
				</fieldset>
			</form>
		</div>
	</body>
</html>