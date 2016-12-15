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
	
//logging in	


$error = "";
include_once("includes/activate.php"); //key generation function and activation checker
include_once("includes/loggedin.inc.php"); //checks if a user is logged in
include_once("includes/makepost.inc.php"); //processes a new link, if the form was submitted
?>
<!DOCTYPE html>
	<html lang="en">
	<head>
		<!--
			HTML 5 Verification based on tutorial and with images from: 
			http://webdesign.tutsplus.com/tutorials/site-elements/bring-your-forms-up-to-date-with-css3-and-html5-validation/
			
		-->
		<meta charset="utf-8">
		<link rel="stylesheet" media="screen" href="css/style.css?v=6" />
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
					<div id="message">
						<?php if(!empty($message)){
							echo $message;
							echo "message echoed above";
						}
						?>
					</div>
					<div id="links">
						<?php if (strcmp($_SESSION[LOGGED_IN], IS_LOGGED) == 0): ?>
						<div id="postlink">
							<ul>
								<li>Hello <span class="user"><?php echo $_SESSION["firstname"];?></span></li>
								<li><a href="logout.php">Logout</a></li>
							<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" autocomplete="off">
								<fieldset>
								<h2>Post a new link:</h2>
									<li>
										<label for="link">URL:</label>
										<input type="url" name="link" size="80" maxlength="600" />
									</li>
									<li>
										<label for="title">Title:</label>
										<input type="text" name="title" size="80" maxlength="200" />
									</li>
									<li>
										<label for="description">Description:</label>
										<input type="text" name="description" size="80" maxlength="200" />
									</li>
									<li>
										<label for="category">Category:</label>
										<select name="category">
										  <option value="design">Design</option>
										  <option value="funny">Funny</option>
										  <option value="tutorial">Tutorial</option>
										  <option value="awesome">Awesome</option>
										  <option value="sweet">Sweet</option>
										  <option value="dude">Dude</option>
										  <option value="cool">Cool</option>
										  <option value="nsfw">NSFW</option>
										</select>	
									</li>
									<li>
										<button class="submit" type="submit">Post</button>
									</li>
								</ul>
								</fieldset>
							</form>
						</div><?php endif; //ends new post form ?>
						<h2>Recent Links:</h2>
							<ul>
							<?php include_once("includes/getpost.inc.php"); //generates a list of recent links ?>
							</ul>
					</div><!--links close-->
					<div id="login">
						<?php if (strcmp($_SESSION[LOGGED_IN], IS_LOGGED) != 0) : ?>
						<form class="loginform" action="<?php echo "{$_SERVER["PHP_SELF"]}" ?>" method="post" name="loginform" autocomplete="on">
							<ul>
							<li>
							    <label for="username">Username:</label>
							    <input type="text" size="24" maxlength="50" name="username" />
							</li>
							<li>
							    <label for="password">Password:</label>
							    <input type="password" size="24" maxlength="50" name="password" />
							</li>
							<li>
							    <a href="register.php">Sign up</a><button class="submit" type="submit">Login</button>
							</li>
							</ul>
						</form>
						<?php endif; //ends login hiding ?>
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