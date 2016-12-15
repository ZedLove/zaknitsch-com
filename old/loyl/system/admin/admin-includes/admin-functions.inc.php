<?php
	
	session_start();
	
	require_once( "../includes/config.inc.php" );
	require_once( "../includes/common-functions.inc.php" );
	
	debug(__FILE__);
	
	require_once( "../includes/connect.inc.php" );
	
	/* stringToURL() : Converts a normal string into a url-safe
	 * string by stripping off any special characters.
	 */
	function stringToURL( $string )
	{
		// list of characters to remove
		$illegalCharacters =  array( "'", "\"", "@", "#", "!", "?" );
		
		// strip off any leading and/or following whitespace characters
		$string = trim( $string );
		
		// make the string all lower case characters
		$url = str_replace( " ", "-", strtolower( $string ) );
		
		// remove the "illegal" characters
		$url = str_replace( $illegalCharacters, "", $url );
		
		// as a final precaution, replace any leftover characters with their
		// url-coded versions.
		return urlencode( $url );
	}
	
	function templateSelect( $current = "" )
	{
		$templates = glob( "../../" . F_TEMPLATES . "*.tpl.php" );
		
		if( strlen( $current ) < 1 )
		{
			$current = SITE_DEFAULT_TEMPLATE;
		}
		
		echo "<select name=\"template\">";
		
		foreach( $templates as $key => $value )
		{
			// strip off the folders from the path
			$value = str_replace( "../../" . F_TEMPLATES, "", $value );
			// strip off the file extensions
			$templates[ $key ] = str_replace( ".tpl.php", "", $value );
			// output the menu option
			
			if( strcmp( $current, $templates[ $key ] ) == 0  )
			{
				echo "<option selected=\"selected\">{$templates[$key]}</option>";
			}
			else
			{
				echo "<option>{$templates[$key]}</option>";
			}
		}
		
		echo "</select>";
	}
	
	/* addContent() : Inserts a new piece of content
	 * into the cms_content table.
	 */
	function addContent()
	{
		filterFormData();
		
		// Remove HTML tags from any fields that shouldn't
		// contain them.
		$_POST[ "title" ] 		= strip_tags( $_POST[ "title" ] );
		$_POST[ "url" ] 		= strip_tags( $_POST[ "url" ] );
		$_POST[ "summary" ] 	= strip_tags( $_POST[ "summary" ] );
		$_POST[ "template" ] 	= strip_tags( $_POST[ "template" ] );
		$_POST[ "user_level" ] 	= intval( strip_tags( $_POST[ "user_level" ] ) );
		
		// kick out unauthorized users
		checkLogin( USER_ADMIN );
		
		$query = "INSERT INTO " 
				 . T_CONTENT 
				 . "(title,url,content,summary,template,user_level)
				 VALUES('{$_POST["title"]}',
				 		'{$_POST["url"]}',
						'{$_POST["content"]}',
						'{$_POST["summary"]}',
						'{$_POST["template"]}',
						{$_POST["user_level"]})";

		$result = mysql_query( $query ) 
			or die( debug( mysql_error() ) );
	}
	
	/* editContent() : Edits an existing piece of content
	 * in the database.
	 */
	function editContent()
	{
		filterFormData();
		
		// Remove HTML tags from any fields that shouldn't
		// contain them.
		$_POST[ "id" ] 			= strip_tags( $_POST[ "id" ] );
		$_POST[ "title" ] 		= strip_tags( $_POST[ "title" ] );
		$_POST[ "url" ] 		= strip_tags( $_POST[ "url" ] );
		$_POST[ "summary" ] 	= strip_tags( $_POST[ "summary" ] );
		$_POST[ "template" ] 	= strip_tags( $_POST[ "template" ] );
		$_POST[ "user_level" ] 	= intval( strip_tags( $_POST[ "user_level" ] ) );
		
		// kick out unauthorized users
		checkLogin( USER_ADMIN );
		
		$query = "UPDATE " . T_CONTENT . " 
					SET title='{$_POST["title"]}',
						url='{$_POST["url"]}',
						content='{$_POST["content"]}',
						summary='{$_POST["summary"]}',
						template='{$_POST["template"]}',
						user_level={$_POST["user_level"]}
					WHERE id={$_POST["id"]}
				 ";

		$result = mysql_query( $query ) 
			or die( debug( mysql_error() ) );
	}
	
	/* contentSelect() : Generates a list of content that can then
	 * be edited or deleted.
	 */
	function contentSelect()
	{
		$errorPageURL = substr( SITE_404_PAGE, 1 );
		
		$query = "SELECT title, url, id FROM " 
					. T_CONTENT . " WHERE url NOT LIKE '%{$errorPageURL}%'
					ORDER BY title ASC";
		
		$result = mysql_query( $query ) 
			or die( debug( mysql_error() ) );
			
		while( $page = mysql_fetch_assoc( $result ) ): ?>
			<li>
				<a target="_blank" href="/<?php echo $page["url"]; ?>">
					<?php echo $page[ "title" ]; ?>
				</a>
				<a href="edit-content.php?id=<?php echo $page[ "id" ]; ?>"><span class="icon-edit">Edit</span></a>
				<a href="delete-content.php?id=<?php echo $page[ "id" ]; ?>"><span class="icon-delete">Delete</span></a>
			</li>
		<?php endwhile;
	}
	
	/* fetchContent() : Retrieves page data for a specific piece of content
	 * for later editing.  Page data is loaded into the $_POST array, otherwise
	 * a return value of false is provided.
	 */
	function fetchContent( $id )
	{
		$query = "SELECT title, 
						 content, 
						 summary, 
						 url, 
						 template, 
						 user_level
					FROM " . T_CONTENT . " WHERE id={$id}";
		
		$result = mysql_query( $query ) 
			or die( debug( mysql_error() ) );
		
		if( mysql_num_rows( $result ) < 1 )
		{
			return false;
		}
		
		$page = mysql_fetch_assoc( $result );
		
		// fill the post array with page content
		foreach( $page as $key => $value )
		{
			$_POST[ $key ] = $value;
		}
		
		// save the id, to record which page we are editing
		$_POST[ "id" ] = $id;
		
		return true;
	}
	
	
	/* deleteContent() : Removes a specific content entry from
	 * T_CONTENT based on the provided id.
	 */
	function deleteContent( $id )
	{
		$query = "DELETE FROM " . T_CONTENT . " WHERE id={$id}";
		
		$result = mysql_query( $query ) 
			or die( debug( mysql_error() ) );
	}
	
	/* addUser() : Inserts a new user
	 * into the T_USERS table.
	 */
	function addUser()
	{
		filterFormData();
		if ( checkEmail( $_POST["email"] ) )
		{	// the email is unique
			
			// Remove HTML tags from any fields that shouldn't
			// contain them.
			$_POST[ "email" ] 		= strip_tags( $_POST[ "email" ] );
			$_POST[ "password" ] 	= md5( $_POST[ "password" ] );
			$_POST[ "user_level" ] 	= intval( strip_tags( $_POST[ "user_level" ] ) );
			
			// kick out unauthorized users
			checkLogin( USER_ADMIN );
			
			$query = "INSERT INTO " 
					 . T_USERS
					 . "(email,password,user_level)
					 VALUES('{$_POST["email"]}',
					 		'{$_POST["password"]}',
							{$_POST["user_level"]})";
	
			$result = mysql_query( $query ) 
				or die( debug( mysql_error() ) );
		}
		else {
			// email is duplicate
			addMessage( "duplicate_email" , "An account has already been created with that e-mail address." );
		}
	}
	
	/* userSelect() : Generates a list of users that can then
	 * be edited or deleted.
	 */
	function userSelect()
	{
		// don't allow deletion of the admin user
		$query = "SELECT email, id FROM " 
					. T_USERS . " ORDER BY email ASC";
		
		$result = mysql_query( $query ) 
			or die( debug( mysql_error() ) );
					
		while( $user = mysql_fetch_assoc( $result ) ): ?>
			<li>
				<a href="mailto:<?php echo $user[ "email" ]; ?>">
					<?php echo $user[ "email" ]; ?>
				</a>
				<a href="edit-user.php?id=<?php echo $user[ "id" ]; ?>"><span class="icon-edit">Edit</span></a>
				<?php if( intval( $user[ "id" ] ) > 1 ) : ?>
				<a href="delete-user.php?id=<?php echo $user[ "id" ]; ?>"><span class="icon-delete">Delete</span></a>
				<?php endif; ?>
			</li>
		<?php endwhile;
	}
	
	/* fetchUser() : Retrieves user data for a specific user
	 * for later editing.  User data is loaded into the $_POST array, otherwise
	 * a return value of false is provided.
	 */
	function fetchUser( $id )
	{
		$query = "SELECT email, 
						 user_level
					FROM " . T_USERS . " WHERE id={$id}";
		
		$result = mysql_query( $query ) 
			or die( debug( mysql_error() ) );		
		
		if( mysql_num_rows( $result ) < 1 )
		{
			return false;
		}
		
		$user = mysql_fetch_assoc( $result );
		
		// fill the post array with user content
		foreach( $user as $key => $value )
		{
			$_POST[ $key ] = $value;
		}
		
		// save the id, to record which user we are editing
		$_POST[ "id" ] = $id;
		
		return true;
	}
	
	/* editUser() : Edits an existing user
	 * in the database.
	 */
	function editUser()
	{
		filterFormData();
		
		// Remove HTML tags from any fields that shouldn't
		// contain them.
		$_POST[ "id" ] 			= strip_tags( $_POST[ "id" ] );
		$_POST[ "email" ] 		= strip_tags( $_POST[ "email" ] );
		$_POST[ "user_level" ] 	= intval( strip_tags( $_POST[ "user_level" ] ) );
		
		// kick out unauthorized users
		checkLogin( USER_ADMIN );
		
		$query = "UPDATE " . T_USERS . " 
					SET email='{$_POST["email"]}',
						password='{$_POST["password"]}',
						user_level={$_POST["user_level"]}
					WHERE id={$_POST["id"]}
				 ";

		$result = mysql_query( $query ) 
			or die( debug( mysql_error() ) );
	}		
	/* uploadSelect() : Generates a list of users that can then
	 * be edited or deleted.
	 */
	function uploadSelect()
	{
		// don't allow deletion of the admin user
		$query = "SELECT photo FROM " 
					. T_USERS . " WHERE id={$id}";
		
		$result = mysql_query( $query ) 
			or die( debug( mysql_error() ) );
					
	
	}
	
	function editUpload()
		{
			filterFormData();
			
			// Remove HTML tags from any fields that shouldn't
			// contain them.
			$_POST[ "id" ] 			= strip_tags( $_POST[ "id" ] );
			$_POST[ "email" ] 		= strip_tags( $_POST[ "email" ] );
			$_POST[ "user_level" ] 	= intval( strip_tags( $_POST[ "user_level" ] ) );
			
			// kick out unauthorized users
			checkLogin( USER_ADMIN );
			
			$query = "UPDATE " . T_USERS . " 
						SET email='{$_POST["email"]}',
							password='{$_POST["password"]}',
							user_level={$_POST["user_level"]}
						WHERE id={$_POST["id"]}
					 ";
	
			$result = mysql_query( $query ) 
				or die( debug( mysql_error() ) );
		}	
		
		/* deleteUser() : Removes a specific user from
		 * T_USERS based on the provided id.
		 */
		function deleteUpload( $id )
		{
			$query = "DELETE FROM " . T_USERS . " WHERE id={$id}";
			
			$result = mysql_query( $query ) 
				or die( debug( mysql_error() ) );
		}
	
	
	
	
	
	
	
	
	
	