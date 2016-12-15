<?php
	require_once( "system/includes/config.inc.php" );
	require_once( F_INCLUDES . "functions.inc.php" );
	require_once( F_INCLUDES . "connect.inc.php" );
	
	$page = getContent( getURL() );
	
	checkLogin( $page[ "user_level" ] );
	
	// select and load a template file
	if( file_exists( F_TEMPLATES . $page[ "template" ] . ".tpl.php" ) )
	{
		// template exists, so load it
		require_once( F_TEMPLATES . $page[ "template" ] . ".tpl.php" );
	}
	else
	{
		// template didn't exist, so load the default one
		require_once( F_TEMPLATES . SITE_DEFAULT_TEMPLATE . ".tpl.php" );
	}