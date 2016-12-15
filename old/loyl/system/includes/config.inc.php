<?php

	// start the session on every page of the site
	session_start();
	
	// site-wide settings	
	define( "SITE_TITLE", 				"loyl - love of your life dating" );
	define( "SITE_URL", 				"zaknitsch.com/loyl" );
	define( "SITE_DEBUG", 				true );
	define( "SITE_HOME_PAGE", 			"home" );
	define( "SITE_DEFAULT_TEMPLATE", 	"main" );
	define( "SITE_404_PAGE", 			"/404" ); // change this if no .htaccess
	define( "SITE_MOD_REWRITE",			true );   // is there an .htaccess file?
	
	// site URL constants
	define( "PROFILE_URL", 	SITE_URL . "/profile" );
	define( "USER_URL", 	SITE_URL . "/users/" ); // this URL needs a user identifier appended to the end
	
	// folder settings
	define( "F_SYSTEM", 	"system/" );
	define( "F_INCLUDES", 	F_SYSTEM . "includes/" );
	define( "F_TEMPLATES", 	F_SYSTEM . "templates/" );
	define( "F_ADMIN", 		F_SYSTEM . "admin/" );
	define( "F_FONTS",		F_SYSTEM . "fonts/" );
	define( "F_CSS", 		"css/" );
	define( "F_JS", 		"js/" );
	define( "F_IMAGES", 	"images/" );
	define( "F_UPLOADS", 	F_IMAGES . "uploads/" ); // this folder must have file permissions set to 774
	
	// database settings
	define( "DB_HOST", 		"mysql.studentportfolios.ca" );
	define( "DB_USER", 		"ntsz0001" ); 	// HCnet ID
	define( "DB_PASSWORD", 	"root" ); 	// MySQL Password
	define( "DB_NAME", 		DB_USER );		// on paraFX DB_USER = DB_NAME
	
	// database table names
	define( "T_PREFIX", 		"cms_" );
	define( "T_CONTENT", 		T_PREFIX . "content" );
	define( "T_USERS", 			T_PREFIX . "users" );
	define( "T_MESSAGES", 		T_PREFIX . "messages" );
	
	// user settings
	define( "USER_ADMIN", 	10 );
	define( "USER_EDITOR", 	5 );
	define( "USER_WRITER", 	3 );
	define( "USER_PUBLIC",  0 );
	
	// user-login strings
	define( "LOGGED_IN", 	"akjhdkub3ibe80dacbhabfjkbh34rq23r" );
	define( "YES", 		 	"893hb2n89as8hd23bn328qnad8 349=34" );
	define( "USER_LEVEL", 	"user_level" );
	
	// media upload settings
	
	/*  To add different types of files, add the approriate
		content types here. Please see http://www.w3schools.com/media/media_mimeref.asp
		for a complete list of types. */
	define( "ALLOWED_FILE_TYPES", 
			"image/png,image/gif,image/jpeg,image/pjpeg" );
	
	/* This constant limits the file size in bytes for file uploaded */
	define( "MAX_FILE_SIZE", 4000000 );
	
	
	
	
	
	
	
	
	