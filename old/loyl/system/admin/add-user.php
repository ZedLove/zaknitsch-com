<?php 
	require_once( "admin-includes/admin-functions.inc.php" ); 
	
	checkLogin( USER_ADMIN );
	
	$errors = 0;
	$message = "";
	
	if( isset( $_POST[ "email" ] ) )
	{
		
		if( !filter_var( $_POST[ "email" ], FILTER_VALIDATE_EMAIL ) )
		{
			// invalid email
			addMessage( "email" , "Please enter a valid email.");
			$errors++;
		}
		
		if( strlen( $_POST[ "password" ] ) < 4 )
		{
			// short password
			addMessage( "password" , "Please select a longer password.");
			$errors++;
		}
		
		if( strcmp( $_POST[ "password" ], $_POST[ "retype" ] ) != 0 )
		{
			// passwords don't match
			addMessage("retype" , "Passwords did not match, please re-type them.");
			$errors++;
		}
		
		if( $errors < 1 )
		{
			addUser();
			// clear post array out
			clearFormData();
			addMessage("user_added" , "The user was saved." , true);
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Add User - <?php echo  $_SERVER[ "HTTP_HOST" ]; ?></title>
		<link rel="stylesheet" type="text/css" href="css/admin-style.css">
	</head>
	<body>
		<div id="wrapper">
			<h1 class="icon-add heading">Add User</h1>
			<?php require_once("templates/admin-nav-small.inc.php");  ?>
			<?php message( "user_added" ); ?>
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
				<fieldset>
					<ol>
						<li>
							<label>Email<span>*</span>:</label>
							<?php message( "email" );
								  message( "duplicate_email" );  ?>
							<input type="text" name="email" 
								size="60" value="<?php echo $_POST[ "email" ]; ?>" />
						</li>
						<li>
							<label>Password<span>*</span>:</label>
							<?php message( "password" );  ?>
							<input type="password" name="password" 
								size="60" />
						</li>
						<li>
							<label>Password (Re-type)<span>*</span>:</label>
							<?php message( "retype" );  ?>
							<input type="password" name="retype" 
								size="60" />
						</li>
						<li>
							<label>User Level<span>*</span>:</label>
							<select name="user_level">
								<option value="<?php echo USER_ADMIN; ?>">Admin</option>
								<option value="<?php echo USER_EDITOR; ?>">Editor</option>
								<option value="<?php echo USER_WRITER; ?>">Writer</option>
								<option value="<?php echo USER_PUBLIC; ?>">Public</option>
							</select>
						</li>
						<li>
							<input type="submit" value="Save" />
						</li>
					</ol>
				</fieldset>
			</form>
		</div>
	</body>
</html>