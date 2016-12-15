<?php
	require_once( "admin-includes/admin-functions.inc.php" ); 
	
	checkLogin( USER_ADMIN );
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Select Content - <?php echo  $_SERVER[ "HTTP_HOST" ]; ?></title>
		<link rel="stylesheet" type="text/css" href="css/admin-style.css">
	</head>
	<body class="dashboard">
		<div id="wrapper">
			<h1 class="icon-home heading">Select Content</h1>
			<?php require_once("templates/admin-nav-small.inc.php");  ?>
			<ul id="selection-list">
				<?php contentSelect(); ?>
			</ul>
		</div>
	</body>
</html>