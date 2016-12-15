<?php 
	require_once( "system/includes/functions.inc.php" ); 
	
	$errors = array();
	$message = "";
	$mediaPath = "";
	
	if( isset( $_FILES[ "user_upload" ] ) )
		$media = uploadMedia();
	
	if( $media[ "result" ]  )
	{
		unset( $errors[ "upload" ] );
		$mediaPath = F_UPLOADS . $media[ "filename" ] ;
		$message = "<p class=\"success\">Media was successfully uploaded.</p>";
	}
	else
	{
		$errors[ "media" ] = $media[ "error" ];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Change Photo - loyl dating</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        </head>

        <body>
<div id="container">
          <div id="header">
    <div id="logo"><span>Content for  id "logo" Goes Here</span></div><!-- closes logo -->
    <div id="nav"><span>Content for  id "nav" Goes Here</span>
              <li><a href="/home">Home</a></li>
              <li><a href="/about-us">About us</a></li>
              <li><a href="/search">Search</a></li>
              <li class="current" ><?php notLoggedIn(); ?></li>
            </div><!-- closes nav -->
  </div>
          <div id="main_searchpage">
    <div id="left_profilepage">
              <div id="left_profilepage_inside">
        <p class="text">Edit Your Profile!</p>
      </div><!-- closes left_profilepage_inside -->
              <div id="top_profile">
        <div id="mypage"><p class="myaccount"><a href="/profile">My Page</a></p></div><!-- closes mypage -->
        <div id="editprofile"><p class="mypage"><a href="/edit-profile">Edit Profile</a></p></div><!-- closes editprofile-->
        <div id="changephoto"><p class="mypage">Change Photo</p></div><!-- closes changephoto -->
      </div>
              <div id="changephoto_content">
                <div id="changephoto_image"><img src="/images/uploads/<?php echo $_SESSION[ "user_photo" ]; ?>" width="89" height="87" alt="photo" /></div>
                <div id="changephoto_info">
                <form class="changephoto" action="" method="post" enctype="multipart/form-data">
<fieldset>
<ol>
																								
	<li><label>Please upload a photo that is 89px by 87px </label></li>
<?php if( strlen( $mediaPath ) > 0 ) :  //if a file was uploaded, show the path  ?>
<li>
	<label>Last Uploaded File:</label>
	<input type="text" disabled="disabled" size="100"
		value="/<?php echo $mediaPath; ?>" />
	<?php
		// translate relative (http) path to a server path so that
		// the file functions can find the image
		$root = str_replace( F_ADMIN, "", getcwd() . "/" );
		$path = $root . $mediaPath;
		?>
</li>
<?php endif; ?>
<li>
	<?php echo $errors[ "upload" ];  ?>
	<?php
		
	
	?>
	<input type="file" name="user_upload" />
</li>
<li>
	<input type="submit" value="" />
</li>
</fieldset>
</form>
                
                
                </div><!-- closes changephoto_info -->
                <!-- closes changephoto_image -->
              </div><!--closes changephot_content-->
    </div><!-- closes left_profilepage -->
    <div id="right_profilepage">
              <div id="header_profile">Profile</div><!-- closes header_profile -->
              <div id="right_profilecontent">
        <div id="first_right"><p class="profile_sidebar"><a href="/edit-profile">Edit Profile</a></p></div><!-- closes first_right -->
        <div id="second_right"><p class="profile_sidebar"><a href="#">Inbox(1)</a></p></div><!-- closes second_right -->
        <div id="third_right"><p class="profile_sidebar"><a href="#">Sent</a></p></div><!-- closes third_right -->
        <div id="forth_right"><p class="profile_sidebar"><a href="logout">Logout</a></p></div><!-- closes forth_right -->
      </div><!-- closes right_profilecontent -->
            </div><!-- closes right_profilepage -->
    <div id="down_profilepage"></div><!-- closes down_profilepage -->
  </div><!-- closes main_searchpage -->
       <div id="footer">
      <div id="footer_left">
	  <ul>
	   <li class="footer"><a href="home">Home</a> | <a href="about-us">About us</a> | <a href="search">Search </a>|<a href="register-user"> Join </a></li>>
	  </ul>
      </div><!--closes footer_left-->
      <div id="footer_right">
      <ul>
     <li><a href="http://twitter.com/#!/loyldating"><img src="/images/twitter.png" width="28" height="23" alt="twitter" /></a></li>
      <li><a href="http://www.facebook.com/pages/Loyl-Dating/237182623018274"><img src="/images/facebook.png" width="28" height="23" alt="facebook" /></a></li>
       
      </ul></div>
    </div><!--closes footer-->
        </div><!-- closes container -->
</body>
</html>