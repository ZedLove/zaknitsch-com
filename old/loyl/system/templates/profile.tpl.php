<?php 
	require_once( "system/includes/functions.inc.php" );
	
	checkPublicLogin();
	
	$user = getUserInfo($_SESSION[ "id" ]);
	// pack info nicely
	$appearance = $user["appearance"];
	$lifestyle = $user["lifestyle"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Profile - <?php echo SITE_TITLE; ?></title>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="container">
	<div id="header">
	  <div id="logo"><span>Content for  id "logo" Goes Here</span></div>
	  <!-- closes logo -->
	  <div id="nav"><span>Content for  id "nav" Goes Here</span>
	    <ul>
	      <li><a href="home">Home</a></li>
	      <li><a href="about-us">About us</a></li>
	      <li><a href="search">Search</a></li>
	      <li class="current" ><?php notLoggedIn(); ?></li>
	    </ul>
	  </div>
	  <!--closes nav--> 
	</div>
	<!--closes header-->
		<div id="main_searchpage">
			<div id="left_profilepage">        
				<div id="left_profilepage_inside">
					<div id="left_profile_inside_left">										  
						<p class="text"><?php echo $user[ "firstname" ] . " " . $user[ "lastname" ]; ?> - Edit Your Profile</p>
					</div><!--closes left_profile_inside_left-->
					<div id="left_profile_inside_right">
						<!--form search for profile page starts-->
						<form class="search_profile" action="" method="post">
						<fieldset>
							<ol>
								<li>
									<!--<label>Search: </label>
	          						<input name="email" class="user" type="text" size="25" maxlength="25" />-->
								</li>
							</ol>
						</fieldset>                                                                                                       
						</form><!--form search for profile page ends-->
					</div><!-- closes left_profile_inside_right -->
				</div><!-- closes left_profilepage_inside -->
				<div id="top_profile">
					<div id="mypage">
						<p class="mypage">My Page<p>
					</div><!-- closes maypage -->
					<div id="editprofile">
						<p class="mypage"><a href="/edit-profile">Edit Profile</a></p>
					</div><!-- closes editprofile -->
					<div id="changephoto">
						<p class="mypage"><a href="/changephoto">Change Photo</a></p>
					</div><!-- closes changephoto -->
				</div><!-- closes top_profile -->
				<div id="info_profile">
					<div id="info_profile_image">
						<img src="images/uploads/<?php echo $user[ "user_photo" ]; ?>" width="89" height="87" alt="profile" />
					</div><!-- closes info_profile_image -->
					<div id="info_profile_textleft">
						<ul>
							<li class="profile">Age</li>
							<li class="profile">Gender</li>
							<li class="profile">Seeking</li>
							<li class="profile">Location</li>                      
						</ul>
					</div><!-- closes info_profile_textleft -->
					<div id="info_profile_textmiddle">
						<ul>
							<li class="profile"><?php echo $user[ "age" ]; ?></li>
							<li class="profile"><?php if ( $user[ "gender" ] == 1 ) {
														// gender is male
														// set same sex var as male
														$same = "Male";
														// opposite sex var as female
														$not = "Female";
														echo "Male";
														}
													  else {
													  	// gender is female
													  	// set same sex var as female
													  	$same = "Female";
													  	// opposite sex var as male
													  	$not = "Male";
													  	echo "Female";
													  } ?></li>
							<li class="profile"><?php if ( $user[ "orientation" ] == $user["gender"]  ) {
															echo $same;
															}
														else {
															echo $not;
														} ?></li>
							<li class="profile"><?php echo $user[ "country" ]; ?></li>                      
						</ul>
					</div><!-- closes info_profile_textmiddle -->
					<div id="info_profile_textmiddle_middle">
						
					</div><!-- closes info_profile_textmiddle_middle -->
					<div id="info_profile_textmiddle_last">
						
					</div><!-- closes info_profile_textmiddle_last -->
				</div><!-- closes info_profile -->
				<div id="recent_activity">
					<p>More Information:</p>
					<ul>
					<li>
						Height: <?php echo $appearance["height"]; ?>
					</li>
					<li>
						Eyes: <?php echo $appearance["eyes"]; ?>
					</li>
					<li>
						Ethnicity: <?php echo $appearance["ethnicity"]; ?>
					</li>
					<li>
						Smoke: <?php echo $lifestyle["smoke"]; ?>
					</li>
					<li>
						Drink: <?php echo $lifestyle["drink"]; ?>
					</li>
					</ul>
				</div><!-- closes recent_activity -->
			</div><!-- closes left_profilepage -->
			<div id="right_profilepage">
				<div id="header_profile">
					<p class="text">Profile</p>
				</div><!-- closes header_profile -->
				<div id="right_profilecontent">
					<div id="first_right">
						<p class="profile_sidebar" ><a href="/edit-profile">Edit Profile</a></p>
					</div><!-- closes first_right -->
					<div id="second_right">
						<p class="profile_sidebar" ><a href="#">Inbox(1)</a></p>
					</div><!-- closes second_right -->
					<div id="third_right">
						<p class="profile_sidebar" ><a href="#">Sent</a></p>
					</div><!-- closes third_right -->
					<div id="forth_right">
						<p class="profile_sidebar" ><a href="/logout">Logout</a></p>
					</div><!-- closes forth_right -->
				</div><!-- closes right_profilecontent -->
			</div><!-- closes right_profilepage -->
			<div id="down_profilepage">
			</div><!-- closes down_profilepage -->
		</div><!-- closes main_searchpage -->
	</div><!-- closes container -->
</body>
</html>