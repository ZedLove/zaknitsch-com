<?php 
	// get the URL to strip out the key
	$ukey = $_SERVER["REQUEST_URI"];
	// split the key into an array based on the /
	$ukey = explode( "/",$ukey );
	// take only the part of the URL that is the key
	$ukey = $ukey[2];
	
	// only attempt to activate if key is correct length
	// check that $ukey exists
	if ( ( strlen( $ukey ) > 0 ) && ( strlen( $ukey ) == 32 ) )
	{
		if ( activateUser( $ukey ) )
		{	// key existed in DB, user activated
			addMessage( "active", "Your account is now active. Please click <a href=\"/home\">here</a> to login with your account.", true );
		}
		else
		{
			addMessage( "active", "That information does not match our database. Please ensure you have the correct URL." );
		}
	}
	else
	{
		addMessage( "active", "That information does not match our database. Please ensure you have the correct URL." );
	}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>Verification</title>
				<link href="../css/style.css" rel="stylesheet" type="text/css" />
		</head>
		
		<body>
				<div id="container">
						<div id="header">
								<!--div logo start--><div id="logo"><span>Content for  id "logo" Goes Here</span></div><!--div logo finish-->
								<div id="nav"><span>Content for  id "nav" Goes Here</span>
										<li><a class="current" href="home">Home</a></li>
										<li><a href="/about-us">About us</a></li>
										<li><a href="/search">Search</a></li>
										<li><a href="/edit-profile">Join</a></li>
								</div>
						</div><!--div logo finish-->
						<div id="main_searchpage">
								<div id="left_searchpage">
										<div id="left_verify_inside">
												<p class="text">Verification</p>
</div><!--div left_serachpage finish-->
										<div id="registration_text">
                                        <?php message( "active" ); ?>
                                    
                                    
                                    
                                    
                                    </div><!--div registration_text-->
                                </div><!--div left_serachpage_inside finish-->
						  <div id="right_serachpage"><!--div right_serachpage finish--><!--div login finish-->
							</div><!--div right_searchpage-->
						  <div id="down_searchpage"></div><!--div dow_searchpage-->
						</div>
                             <div id="footer">
      <div id="footer_left">
	  <ul>
	  <li class="footer">Home | About us | Search | Join
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