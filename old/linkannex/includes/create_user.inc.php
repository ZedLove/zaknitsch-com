<?php 

/* Name: Zak Nitsch
 * 
 * Date of Submission:
 * Friday, November 25, 2011
 * 
 * Assignment: Bookmarking App
 */

// This script inserts form data from register.php into tbl_users
$username = mysql_real_escape_string( strip_tags($_POST["username"]) );
$firstname = mysql_real_escape_string( strip_tags($_POST["firstname"]) );
$lastname = mysql_real_escape_string( strip_tags($_POST["lastname"]) );
$email = mysql_real_escape_string( strip_tags($_POST["email"]) );
$password = md5($password);
$newUser = "INSERT INTO tbl_users(username, password, firstname, lastname, email) VALUES ('{$username}', '{$password}', '{$firstname}', '{$lastname}', '{$email}' )";

$result = mysql_query($newUser) or die( mysql_error() );
?>