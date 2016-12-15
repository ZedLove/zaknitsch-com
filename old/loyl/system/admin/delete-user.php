<?php 
	require_once( "admin-includes/admin-functions.inc.php" ); 
	
	
	if( isset( $_GET[ "id" ] ) )
		deleteUser( $_GET[ "id" ] );
	
	redirect( "select-user.php" );