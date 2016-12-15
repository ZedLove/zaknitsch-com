<?php 

	/* Name: Zak Nitsch
	 * 
	 * Date of Submission:
	 * Friday, November 25, 2011
	 * 
	 * Assignment: Bookmarking App
	 */
	
	if (!empty($_GET["cat"])) {
		$cat = $_GET["cat"];
		$query = "SELECT timestamp, link, title, description, username, category FROM tbl_links WHERE category = '$cat' ORDER BY timestamp DESC";
	}
	
	elseif (!empty($_GET["user"])) {
		$user = $_GET["user"];
		$query = "SELECT timestamp, link, title, description, username, category FROM tbl_links WHERE username = '$user' ORDER BY timestamp DESC";
	}
	
	else {
		$query = "SELECT timestamp, link, title, description, username, category FROM tbl_links ORDER BY timestamp DESC";
	
	}
	
	$result = mysql_query($query) or die( mysql_error() );
	
	while ($link = mysql_fetch_assoc($result)):
	?>	
	<li class="links">
	<a href="<?php echo $link['link']?>" ><img src="http://api.thumbalizr.com/?url=<?php echo $link['link']?>&width=100" alt="<?php echo $link['link']?>" width="50" height="40" /></a>
	<h3><a href="<?php echo $link['link']?>" ><?php echo $link['title']; ?></a></h3>
	<p><?php echo $link['description']?></p>
	<p>Posted on <span class="timestamp"> <?php echo date("D F j, Y @ g:i a" , strtotime($link['timestamp']) );?></span> 
	by <a href="<?php echo $_SERVER[PHP_SELF]?>?user=<?php echo $link['username'] ?>"><span class="user"><?php echo $link['username'] ?></span></a> 
	in <a class="category" href="<?php echo $_SERVER[PHP_SELF]."?cat=".$link['category'] ?>"><?php echo $link['category']; ?></a>
	</p>
	</li>
<?php 
 endwhile;
 ?>