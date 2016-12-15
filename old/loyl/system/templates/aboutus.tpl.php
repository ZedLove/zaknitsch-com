<?php 	require_once( "system/includes/functions.inc.php" );
		include_once( "system/includes/checkloginform.inc.php" );
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>About us</title>
				<link href="css/style.css" rel="stylesheet" type="text/css" />
        <script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
		</head>
		
		<body>
		<div id="container">
								<div id="header">
										<div id="logo"><span>Content for  id "logo" Goes Here</span></div><!--closes logo-->
										<div id="nav"><span>Content for  id "nav" Goes Here</span>
		                                <ul>
												<li><a href="home">Home</a></li>
												<li><a class="current">About us</a></li>
												<li><a href="search">Search</a></li>
												<li><?php notLoggedIn(); ?></li>
		                                  </ul>
										</div><!--closes nav-->
								</div><!--closes header-->
								<div id="main_searchpage">
										<div id="left_searchpage_aboutus">
												<div id="banner_aboutus">
												  <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="620" height="190">
												    <param name="movie" value="swf/flash_about.swf" />
												    <param name="quality" value="high" />
												    <param name="wmode" value="opaque" />
												    <param name="swfversion" value="6.0.65.0" />
												    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
												    <param name="expressinstall" value="Scripts/expressInstall.swf" />
												    <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
												    <!--[if !IE]>-->
												    <object type="application/x-shockwave-flash" data="swf/flash_about.swf" width="620" height="190">
												      <!--<![endif]-->
												      <param name="quality" value="high" />
												      <param name="wmode" value="opaque" />
												      <param name="swfversion" value="6.0.65.0" />
												      <param name="expressinstall" value="Scripts/expressInstall.swf" />
												      <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
												      <div>
												        <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
												        <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
											          </div>
												      <!--[if !IE]>-->
											        </object>
												    <!--<![endif]-->
											      </object>
		                                        </div><!--flash banner placing inside--><!--closes banner_aboutus-->
				<?php echo $page[ "content" ]; ?>
		<div id="right_serachpage">
		<?php if( !checkPublicLogin( false ) ):?> 
		<div id="login_header"><span>Content for  id "login_header" Goes Here</span><h2>Member Login</h2></div><!--closes login_header-->
		  <div id="login">
		  <!--login form start in about us page-->
		  <form class="login" action="<?php echo $pageURL; ?>" method="post">
		  		<fieldset>
		  				<ol>
		  						<li>
		  								<label>Email:</label>
		  						</li>
		  						<li>
		  								<input name="email" class="user"type="text" size="30" maxlength="30" />
		  						</li>
		  						<li>
		  								<label>Password:</label>
		  						</li>
		  						<li>
		  								<input name="password" class="password" type="password" size="30" maxlength="30" />
		  						</li>
		  						<li>
		  								<input type="submit" value="" />
		  						</li>
		  						<li>
		  								<label>Forgot password</label>
		  						</li>
		  				</ol>
		  		</fieldset>
		  </form><!--login form ends-->
		                            </div>
		                            <!--closes login-->
		                             <?php endif; ?>
		                            </div><!--closes right_searchpage-->
										<div id="down_aboutpage"></div><!--closes down_aboutpage-->
								</div><!--closes main_searchpage-->
		                             <div id="footer">
		      <div id="footer_left">
			  <ul>
			  <li class="footer"><a href="home">Home |</a> <a href="about-us">About us</a> | <a href="search">Search</a> |<a href="join"> Join</a></li>
			  </ul>
		      </div><!--closes footer_left-->
		      <div id="footer_right">
		      <ul>
		     <li><a href="http://twitter.com/#!/loyldating"><img src="images/twitter.png" width="28" height="23" alt="twitter" /></a></li>
		      <li><a href="http://www.facebook.com/pages/Loyl-Dating/237182623018274"><img src="images/facebook.png" width="28" height="23" alt="facebook" /></a></li>
		       
		      </ul></div>
		    </div><!--closes footer-->
						</div><!--closes container-->
		        <script type="text/javascript">
		swfobject.registerObject("FlashID");
		                </script>
		</body>
</html>