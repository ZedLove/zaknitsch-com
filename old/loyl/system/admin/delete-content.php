<?php 
	require_once( "admin-includes/admin-functions.inc.php" ); 
	
	
	if( isset( $_GET[ "id" ] ) )
		deleteContent( $_GET[ "id" ] );
	
	redirect( "select-content.php" );