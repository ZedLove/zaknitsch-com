<?php
/* Name: Zak Nitsch
 * 
 * Date of Submission:
 * Friday, November 25, 2011
 * 
 * Assignment: Bookmarking App
 */

  //this script extracts the values from the form and places them in the table
if ( isset($_POST["link"]) ) {

	if (strcmp($_SESSION[LOGGED_IN], IS_LOGGED) == 0) {
		$username = $_SESSION["username"];
		$link = mysql_real_escape_string( strip_tags($_POST["link"]) );
		$title = mysql_real_escape_string( strip_tags($_POST["title"]) );
		$category = mysql_real_escape_string( strip_tags($_POST["category"]) );
		$description = mysql_real_escape_string( strip_tags($_POST["description"]) );
		$newLink = "INSERT INTO tbl_links(link, title, category, username, description) 
		VALUES ('{$link}', '{$title}', '{$category}', '{$username}', '{$description}')";
		$newResult = mysql_query($newLink) or die( mysql_error() );
		header( "Location: {$_SERVER["PHP_SELF"]}");
		}
	}
?>