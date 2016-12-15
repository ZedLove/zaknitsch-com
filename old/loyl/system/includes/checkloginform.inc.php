<?php

if( isset( $_POST[ "email" ] ) )
{
	if( strlen( $_POST[ "email" ] ) < 6 )
	{
		addMessage( "email" , "Please enter a valid email address");
	}
	else
	{
		if( !filter_var( $_POST[ "email" ], FILTER_VALIDATE_EMAIL ) )
		{
			addMessage( "email" , "Please enter a valid email address.");
		}
	}
	
	if( strlen( $_POST[ "password" ] ) < 1 )
	{
		addMessage("password" , "Please enter a password." );
	}
	
	if( count( $errors ) < 1 )
	{
		// try to log the user in
		
		if( login() )
		{
			// successful login
			redirect( "/profile" );
			
		}
	}
}

?>