<?php
	
	debug(__FILE__);
	
	// connect to the database server
	mysql_connect( DB_HOST, DB_USER, DB_PASSWORD ) 
		or die( mysql_error() );
	
	// select the database to be used
	mysql_select_db( DB_NAME )
		or die( mysql_error() );