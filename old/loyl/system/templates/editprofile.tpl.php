<?php 
	require_once( "system/includes/functions.inc.php" );
	checkPublicLogin();
	
	// general form handling
	if( isset( $_POST[ "gender" ] ) )
	{
		$formname = "general";
		updatePublicUser( $formname );	
	}
	// appearance form handling
	if( isset( $_POST[ "height" ] ) )
	{
		$formname = "appearance";
		updatePublicUser( $formname );
	}
	// lifestyle form handling
	if( isset( $_POST[ "smoke" ] ) )
	{
		$formname = "lifestyle";
		updatePublicUser( $formname );
	}
	// if forms were submitted, user info is updated after submission
	$user = getUserInfo($_SESSION[ "id" ]);
	$appearance = $user["appearance"];
	$lifestyle = $user["lifestyle"];
	// form repopulation
	// general
	$gender = array();
	$gender[ $user["gender"] ] = " selected=\"selected\"";
	
	$orientation = array();
	$orientation[ $user["orientation"] ] = " selected=\"selected\"";
	
	$city = array();
	$city[ $user["country"] ] = " selected=\"selected\"";
	
	// appearance
	$height = array();
	$height[ $appearance["height"] ] = " selected=\"selected\"";
	
	$eyes = array();
	$eyes[ $appearance["eyes"] ] = " selected=\"selected\"";
	
	$ethnicity = array();
	$ethnicity[ $appearance["ethnicity"] ] = " selected=\"selected\"";
	
	// lifestyle
	
	// smoking
	$smoke = array();
	$smoke[ $lifestyle["smoke"] ] = " checked=\"checked\"";
					//var_dump($smoke);
	// drinking
	$drink = array();
	$drink[ $lifestyle["drink"] ] = " checked=\"checked\"";
					//var_dump($drink);
	// living checkbox options
	$living = array();
	foreach( $lifestyle["living"] as $livingValue )
	{
		$living[ $livingValue ] = " checked=\"checked\"";
	}
	// social checkbox options
	$social = array();
	foreach( $lifestyle["social"] as $socialValue )
	{
		$social[ $socialValue ] = " checked=\"checked\"";
	}
	// television checkbox options
	$television = array();
	foreach( $lifestyle["television"] as $televisionValue )
	{
		$television[ $televisionValue ] = " checked=\"checked\"";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Edit Profile - <?php echo  $_SERVER[ "HTTP_HOST" ]; ?></title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />

        <script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
        <link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
        </head>

        <body>
<div id="container">
          <div id="header">
    <div id="logo"><span>Content for  id "logo" Goes Here</span></div><!-- closes logo -->
    <div id="nav"><span>Content for  id "nav" Goes Here</span>
              <li><a href="home">Home</a></li>
              <li><a href="about-us">About us</a></li>
              <li><a href="search">Search</a></li>
              <li class="current"><?php notLoggedIn(); ?></li>
            </div><!-- closes nav -->
  </div>
          <div id="main_searchpage">
    <div id="left_profilepage">
              <div id="left_profilepage_inside">
        <p class="text">Edit Your Profile</p>
      </div><!-- closes left_profilepage_inside -->
              <div id="top_profile">
        <div id="mypage"><p class="myaccount"><a href="/profile">My Page</a></p></div><!-- closes maypage -->
        <div id="editprofile"><p class="mypage">Edit Profile</p></div><!-- closes editprofile-->
        <div id="changephoto"><p class="mypage"><a href="/changephoto">Change Photo</a></p></div><!-- closes changephoto -->
      </div>
      
      <!--Javascript Tabbed Panel starts-->
              <div id="TabbedPanels1" class="TabbedPanels">
        <ul class="TabbedPanelsTabGroup">
                  <li class="TabbedPanelsTab" tabindex="0">General</li>
                  <li class="TabbedPanelsTab" tabindex="0">Appearance</li>
                  <li class="TabbedPanelsTab" tabindex="0">Lifestyle</li>
                </ul>
        <div class="TabbedPanelsContentGroup"> 
                  <!-- general Tabbed Pannel starts-->
                  <div class="TabbedPanelsContent">
            <form class="edit_profile" action="<?php echo getURL(); ?>" method="post">
<fieldset>
<ol>
									<?php message( "update" ); ?>
									<li>
										<label>I am a </label>
										<select name="gender">
											<option	<?php echo $gender[1]?> value="1">Male</option>
											<option <?php echo $gender[0]?> value="0">Female</option>
										</select>
									</li>
									<li>
										<label>Seeking a</label>
										<select name="orientation">
												<option <?php echo $orientation[0]?> value="0">Woman</option>
												<option <?php echo $orientation[1]?> value="1">Man</option>
										</select>
									</li>
									<li>
										<label>From:</label>
										<select name="city">
											<option<?php echo $city["Toronto"]?>	value="Toronto">Toronto</option>
											<option<?php echo $city["Vaughan"]?> value="Vaughan">Vaughan</option>
											<option<?php echo $city["Ottawa"]?> value="Ottawa">Ottawa</option>
											<option<?php echo $city["Kingston"]?> value="Kingston">Kingston</option>
											<option<?php echo $city["Waterloo"]?> value="Waterloo">Waterloo</option>
											<option<?php echo $city["Brampton"]?> value="Brampton">Brampton</option>
											<option<?php echo $city["Markham"]?> value="Markham">Markham</option>
										</select>
									</li>
									<li>
									<input type="submit" value=""  />
									</li>
									</ol>
</fieldset>
</form>
</div><!-- general form finishes--> 
                  
                  <!--Apperance tabbed starts-->
                  <div class="TabbedPanelsContent">
                  <!-- Apperance form starts-->
            <form class="search_appearance" action="<?php echo getURL(); ?>" method="post">
                      <fieldset>
                <ol>
                   <li>
                    <label>Height </label>
                    <select name="height" class="Height">
                              <option<?php echo $height["later"]?> value="later">I'll tell you later</option>
                              <option<?php echo $height["tall"]?> value="tall">&gt; 6' 4"</option>
                              <option<?php echo $height["6-4"]?> value="6-4">6' 4"</option>
                              <option<?php echo $height["6-3"]?> value="6-3">6' 3"</option>
                              <option<?php echo $height["6-2"]?> value="6-2">6' 2"</option>
                              <option<?php echo $height["6-1"]?> value="6-1">6' 1"</option>
                              <option<?php echo $height["6-0"]?> value="6-0">6' 0"</option>
                              <option<?php echo $height["5-11"]?> value="5-11">5' 11"</option>
                              <option<?php echo $height["5-10"]?> value="5-10">5' 10"</option>
                              <option<?php echo $height["5-9"]?> value="5-9">5' 9"</option>
                              <option<?php echo $height["5-8"]?> value="5-8">5' 8"</option>
                              <option<?php echo $height["5-7"]?> value="5-7">5' 7"</option>
                              <option<?php echo $height["5-6"]?> value="5-6">5' 6"</option>
                              <option<?php echo $height["5-5"]?> value="5-5">5' 5"</option>
                              <option<?php echo $height["5-4"]?> value="5-4">5' 4"</option>
                              <option<?php echo $height["5-3"]?> value="5-3">5' 3"</option>
                              <option<?php echo $height["short"]?> value="short">&lt; 5' 3"</option>
                            </select>
                    </li>
                    <li>
                    <label>Eye Colour</label>
                    <select name="eyes" class="eyes">
		                      <option<?php echo $eyes["Brown"]?> value="Brown">Brown</option>
		                      <option<?php echo $eyes["Hazel"]?> value="Hazel">Hazel</option>
                              <option<?php echo $eyes["Blue"]?> value="Blue">Blue</option>
                              <option<?php echo $eyes["Green"]?> value="Green">Green</option>
                              <option<?php echo $eyes["Grey"]?> value="Grey">Grey</option>
                              <option<?php echo $eyes["Other"]?> value="Other">Other</option>
                              <option<?php echo $eyes["later"]?> value="later">I will tell you later</option>
                            </select>
                    </li>
                    <li>
                    <label>Ethnicity</label>
                    <select name="ethnicity" class="ethnicity">
                              <option<?php echo $ethnicity["Middle Eastern"]?> value="Middle Eastern">Middle Eastern</option>
                              <option<?php echo $ethnicity["Asian"]?> value="Asian">Asian</option>
                              <option<?php echo $ethnicity["African"]?> value="African">African</option>
                              <option<?php echo $ethnicity["Caucasian"]?> value="Caucasian">Caucasian</option>
                              <option<?php echo $ethnicity["East Indian"]?> value="East Indian">East Indian</option>
                              <option<?php echo $ethnicity["later"]?> value="later">I will tell you later</option>
                            </select>
                  </li>
                  <li>
                  	<input type="submit" value=""  />
                  </li>
                </ol>
              </fieldset>
             </form><!--Apperance tabbed finishes-->
          </div>
                  <!--lifestyle starts-->
                  <div class="TabbedPanelsContent">
            <form class="search_lifestyle" action="<?php echo getURL(); ?>" method="post">
                      <fieldset>
               <li>
               	<label>Smoking:</label>
               	<input<?php echo $smoke["no"]; ?> name="smoke" value="no" type="radio" />
               	<label>No</label>
               	<input<?php echo $smoke["social"]; ?> name="smoke" value="social" type="radio" />
               	<label>Socially</label>
               	<input<?php echo $smoke["yes"]; ?> name="smoke" value="yes" type="radio" />
               	<label>Daily</label>
               </li>
               <li>
               	<label>Drinking:</label>
               	<input<?php echo $drink["no"]; ?> name="drink" value="no" type="radio" />
               	<label>No</label>
               	<input<?php echo $drink["social"]; ?> name="drink" value="social" type="radio" />
               	<label>Socially</label>
               	<input<?php echo $drink["yes"]; ?> name="drink" value="yes" type="radio" />
               	<label>Daily</label>
               </li>
               <li>
               	<label>Living:</label>
               	<input<?php echo $living["alone"]; ?> name="living[]" value="alone" type="checkbox" />
               	<label>Alone</label>
               	<input<?php echo $living["kids"]; ?> name="living[]" value="kids" type="checkbox" />
               	<label>With kids</label>
               	<input<?php echo $living["parents"]; ?> name="living[]" value="parents" type="checkbox" />
               	<label>parents</label>
               	<input<?php echo $living["pets"]; ?> name="living[]" value="pets" type="checkbox" />
               	<label>With pets</label>
               	<input<?php echo $living["roommate"]; ?> name="living[]" value="roommate" type="checkbox" />
               	<label>Roommate(s)</label> 
               </li>
               <li>
               	<label>Social:</label>
               	<input<?php echo $social["shy"]; ?> name="social[]" value="shy" type="checkbox" />
               	<label>Quiet</label>
               	<input<?php echo $social["home"]; ?> name="social[]" value="home" type="checkbox" />
               	<label>Lazy</label>
               	<input<?php echo $social["flirt"]; ?> name="social[]" value="flirt" type="checkbox" />
               	<label>Flirt</label>
               	<input<?php echo $social["comic"]; ?> name="social[]" value="comic" type="checkbox" />
               	<label>Funny</label>
               	<input<?php echo $social["sidekick"]; ?> name="social[]" value="sidekick" type="checkbox" />
               	<label>Friendly</label>
               </li>
               <li>
               	<label>Television:</label>
               	<input<?php echo $television["couch"]; ?> name="television[]" value="couch" type="checkbox" />
               	<label>Potato</label>
               	<input<?php echo $television["news"]; ?> name="television[]" value="news" type="checkbox" />
               	<label>News</label>
               	<input<?php echo $television["sport"]; ?> name="television[]" value="sport" type="checkbox" />
               	<label>Sports</label>
               	<input<?php echo $television["movies"]; ?> name="television[]" value="movies" type="checkbox" />
               	<label>Movies</label>
               	<input<?php echo $television["dreams"]; ?> name="television[]" value="dreams" type="checkbox" />
               	<label>Dreams</label>
               </li>
               <li>
               	<input<?php echo $television["sitcoms"]; ?> name="television[]" value="sitcoms" type="checkbox" />
               	<label>Sitcoms</label>
               	<input<?php echo $television["noTv"]; ?> name="television[]" value="noTv" type="checkbox" />
               	<label>No TV</label>
               	<input<?php echo $television["channel"]; ?> name="television[]" value="channel" type="checkbox" />
               	<label>Surfer</label>
               	<input<?php echo $television["reality"]; ?> name="television[]" value="reality" type="checkbox" />
               	<label>Reality</label>
               </li> 
               <li>
					<input type="submit" value=""  />
				</li>
                </ol>
              </fieldset>
             </form><!--Lifestyle form finishes-->
          </div><!--closes TabbedPanelsContent-->
        </div><!--closes TabbedPanelsContentGroup-->
      </div><!--closes div TabbedPanels1-->
            </div><!-- closes left_profilepage -->
    <div id="right_profilepage">
              <div id="header_profile">Profile</div><!-- closes header_profile -->
              <div id="right_profilecontent">
        <div id="first_right"><p class="profile_sidebar"><a href="edit-profile">Edit Profile</a></p></div><!-- closes first_right -->
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
	   <li class="footer"><a href="home">Home</a> | <a href="about-us">About us</a> | <a href="search">Search </a>|<a href="register-user"> Join </a></li>
	  </ul>
      </div><!--closes footer_left-->
      <div id="footer_right">
      <ul>
     <li><a href="http://twitter.com/#!/loyldating"><img src="/images/twitter.png" width="28" height="23" alt="twitter" /></a></li>
      <li><a href="http://www.facebook.com/pages/Loyl-Dating/237182623018274"><img src="/images/facebook.png" width="28" height="23" alt="facebook" /></a></li>
       
      </ul></div>
    </div><!--closes footer-->
        </div><!-- closes container -->
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
        </script>
</body>
</html>