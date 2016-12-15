<?php 
	// get the URL to strip out the key
	$ukey = $_SERVER["REQUEST_URI"];
	// split the key into an array based on the /
	$ukey = explode( "/",$ukey );
	// take only the part of the URL that is the key
	$ukey = $ukey[2];
	
	// only attempt to activate if key is correct length
	if( strlen($ukey) == 32 ) 
	{
		deletePublicUser($ukey);
	}
	else
	{
		addMessage( "delete", "That information does not match our database. Please ensure you have the correct URL." );
	}
 ?><!DOCTYPE html>
<!--[if lt IE 7]> <html xmlns="http://www.w3.org/1999/xhtml" class="ie ie6 lte9 lte8 lte7">	<![endif]--> 
<!--[if IE 7]>	  <html xmlns="http://www.w3.org/1999/xhtml" class="ie ie7 lte9 lte8 lte7">	<![endif]--> 
<!--[if IE 8]>	  <html xmlns="http://www.w3.org/1999/xhtml" class="ie ie8 lte9 lte8"> 	 	<![endif]--> 
<!--[if IE 9]>	  <html xmlns="http://www.w3.org/1999/xhtml" class="ie ie9 lte9">			<![endif]--> 
<!--[if gt IE 9]> <html xmlns="http://www.w3.org/1999/xhtml">								<![endif]--> 
<!--[if !IE]><!--><html xmlns="http://www.w3.org/1999/xhtml">								<!--<![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo SITE_TITLE; ?></title>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
	</head>
	<body><?php if( SITE_DEBUG ) {
				// display current template with debugging on
				echo "verify template";
				} ?>
		<h1><?php echo SITE_TITLE; ?></h1>
		<h2><?php echo $page["title"]; ?></h2>
		<?php echo $page["content"]; ?>
		<?php message( "delete" ); ?>
	</body>
</html>