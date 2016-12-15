<?php
	//constants
	define ("DB_HOST" , "mysql.studentportfolios.ca");
	define ("DB_USER" , "ntsz0001");
	define ("DB_PASS" , "root");
	define ("DB_NAME" , DB_USER); //paraFX hosting DB_USER = DB_NAME
	
	mysql_connect(DB_HOST, DB_USER, DB_PASS) or die( mysql_error() ); 
												
											  //when connecting to multiple DBs
											  //set this as a variable to be used
											  //in functions to let php know which
											  //DB you want to connect to
											  
	mysql_select_db( DB_NAME ) or die ( mysql_error() );
	
	