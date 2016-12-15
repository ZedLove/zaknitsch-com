<?php
	
	require_once( "admin-includes/admin-functions.inc.php" ); 
	
	checkLogin( USER_ADMIN );
	
	$errors = array();
	$message = "";

	if( isset( $_GET[ "id" ] ) )
	{		
		if( !fetchUser( $_GET[ "id" ] ) )
		{
			redirect( "select-user.php" );
		}
	}
	else
	{			
		if( !filter_var( $_POST[ "email" ], FILTER_VALIDATE_EMAIL ) )
		{
			// invalid email
			$errors[ "email" ] = "<p class=\"error\">Please enter a valid email.</p>";
		}
		
		if( strlen( $_POST[ "password" ] ) < 4 )
		{
			// short password
			$errors[ "password" ] = "<p class=\"error\">Please select a longer password.</p>";
		}
		
		if( strcmp( $_POST[ "password" ], $_POST[ "retype" ] ) != 0 )
		{
			// passwords don't match
			$errors[ "retype" ] = "<p class=\"error\">Passwords did not match, please re-type them.,</p>";
		}
		
		if( count( $errors ) < 1 )
		{
			editUser();
			$message = "<p class=\"success\">The user was saved.</p>";
		}
	}
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Edit User - <?php echo  $_SERVER[ "HTTP_HOST" ]; ?></title>
		<link rel="stylesheet" type="text/css" href="css/admin-style.css">
	</head>
	<body>
		<div id="wrapper">
			<h1 class="icon-edit heading">Edit User</h1>
			<?php require_once("templates/admin-nav-small.inc.php");  ?>
			<?php echo $message; ?>
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
				<fieldset>
				<input type="hidden" name="id" value="<?php echo $_POST[ "id" ]; ?>" />
					<ol>
						<li>
							<label>Email<span>*</span>:</label>
							<?php echo $errors[ "email" ];  ?>
							<input type="text" name="email" 
								size="60" value="<?php echo $_POST[ "email" ]; ?>" />
						</li>
						<li>
							<label>Password<span>*</span>:</label>
							<?php echo $errors[ "password" ];  ?>
							<input type="password" name="password" 
								size="60" />
						</li>
						<li>
							<label>Password (Re-type)<span>*</span>:</label>
							<?php echo $errors[ "retype" ];  ?>
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