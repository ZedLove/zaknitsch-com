<?php 
	// check that they are not logged in
	include_once( "system/includes/checkloginform.inc.php" );
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>Registration</title>
				<link href="../css/style.css" rel="stylesheet" type="text/css" />
		</head>
		
		<body>
				<div id="container">
						<div id="header">
								<!--div logo start--><div id="logo"><span>Content for  id "logo" Goes Here</span></div><!--div logo finish-->
								<div id="nav"><span>Content for  id "nav" Goes Here</span>
										<li><a href="/home">Home</a></li>
										<li><a href="/about-us">About us</a></li>
										<li><a href="/search">Search</a></li>
										<li><a href="/register-user">Join</a></li>
								</div>
						</div><!--div logo finish-->
						<div id="main_searchpage">
								<div id="left_searchpage">
										<div id="left_serachpage_inside_login">
												<p class="text">Login</p>
</div><!--div left_serachpage finish--><?php message( "logged" ); ?>
										<div id="login_text">
                                        <!--registration form starts--><!--registration form ends-->
                                    
                                    
                                    
                                    
                                    </div><!--div registration_text-->
                                </div><!--div left_serachpage_inside finish-->
								<div id="right_serachpage">
										<div id="login_header"><span>Content for  id "login_header" Goes Here</span>
												<h2>Member Login</h2>
										</div><!--div right_serachpage finish-->
										<div id="login">
                                        <!--login form starts-->
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
										</div><!--div login finish-->
								</div><!--div right_searchpage-->
								<div id="down_searchpage"></div><!--div dow_searchpage-->
						</div>
                             <div id="footer">
      <div id="footer_left">
	  <ul>
	  <li class="footer">Home | About us | Serach | Join
	  </li>
	  </ul>
      </div><!--closes footer_left-->
      <div id="footer_right">
      <ul>
     <li><a href="http://twitter.com/#!/loyldating"><img src="/images/twitter.png" width="28" height="23" alt="twitter" /></a></li>
      <li><a href="http://www.facebook.com/pages/Loyl-Dating/237182623018274"><img src="/images/facebook.png" width="28" height="23" alt="facebook" /></a></li>
       
      </ul></div>
    </div><!--closes footer-->
				</div><!--div container finish-->
</body>
</html>