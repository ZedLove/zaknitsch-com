<?php
	
	/* Name: Zak Nitsch
	 * 
	 * Date of Submission:
	 * Friday, November 25, 2011
	 * 
	 * Assignment: Bookmarking App
	 */
	
	function activate_account($key) {
		$key = preg_replace("/[^a-z]/", "", $key);
		
		$query = "SELECT login FROM tbl_pendinglogin WHERE ukey = '$key'";
		
		$c = mysql_query($query);
		
		if(mysql_num_rows($c) != 1 ){
			return false;
		}
		
		$query = "SELECT login FROM tbl_pendinglogin WHERE ukey = '$key'";	
		mysql_query($query);
		
		return true;
	}
if ( !empty($_GET["k"]) ) {
		$key = $_GET["k"];
		activate_account($key);
		echo "account being activated\n";
		//header( "Location: linkannex.php" );
	}
	
	function is_active($username) {
		$query = "SELECT count(*) AS c FROM tbl_pendinglogin WHERE login = '$username'";
		$c = mysql_query($query);
		
		$r = mysql_fetch_array($c);
		if(intval($r["c"]) > 0) {
			return false;
		}
		return true;
	}
	?>