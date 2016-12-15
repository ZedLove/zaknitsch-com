<?php
	require_once( "system/includes/functions.inc.php" );
	include_once( "system/includes/checkloginform.inc.php" );
	
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Home - loyl dating</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
	<style type="text/css"></style>
	</head>

	<body>
    <div id="container">
      <div id="header">
        <div id="logo"><span>Content for  id "logo" Goes Here</span></div>
        <!-- closes logo -->
        <div id="nav"><span>Content for  id "nav" Goes Here</span>
          <ul>
            <li><a class="current">Home</a></li>
            <li><a href="about-us">About us</a></li>
            <li><a href="search">Search</a></li>
            <li><?php notLoggedIn(); ?></li>
          </ul>
        </div>
        <!--closes nav--> 
      </div>
      <!--closes header-->
      <div id="banner"><span>Content for  id "banner" Goes Here</span>
        <div id="search_home"><span>Content for  id "search_home" Goes Here</span>
          <div id="search_home_title">
            <h1 class="search_home">SEARCH <a class="new">OUR SINGLES!</a></h1>
          </div>
          <!--search form start in home page-->
          <div id="form">
            <form class="home" action="" method="post">
              <fieldset>
                <ol>
                  <li>
                    <label>I am a: </label>
                    <select name="iama">
                      <optgroup label="">
                      <option selected="selected"
        value="Man">Man</option>
                      <option value="woman">Woman</option>
                      </optgroup>
                    </select>
                  </li>
                  <li>
                    <label> Seeking: </label>
                    <select name="seeking a">
                      <optgroup label="">
                      <option selected="selected"
        value="woman">Woman</option>
                      <option value="man">Man</option>
                      </optgroup>
                    </select>
                  </li>
                  <li>
                    <label>Age:</label>
                    <select name ="age from">
                    <optgroup label="">
                      <option selected="selected"
         value="19">18-20</option>
                      <option value="20">20-25</option>
                      <option value="21">25-30</option>
                      <option value="22">30-35</option>
                      <option value="24">35-40</option>
                      <option value="25">40-45</option>
                      <option value="26">45-50</option>
                      <option value="27">50-55</option>
                      <option value="28">55-60</option>
                      <option value="29">60-65</option>
                      <option value="30">65-70</option>
                      <option value="31">70-75</option>
                      <option value="32">75-80</option>
                      </optgroup>
                    </select>
                  </li>
                  <li>
                    <label> Country:</label>
                    <select name="country">
                    <optgroup label="">
                      <option selected="selected"
        value="canada">Canada</option>
                      <option value="america">America</option>
                      </optgroup>
                    </select>
                  </li>
                  <li>
                    <label>City: </label>
                    <select name ="city">
                    <optgroup label="">
                      <option selected="selected"
        value="canada">Toronto</option>
                      <option value="montreal">Montreal</option>
                      <option value="quebeq">Los angles</option>
                      <option value="quebeq">New york</option>
                      <option value="quebeq">San fransisco</option>
                      <option value="quebeq">Washington</option>
                      <option value="quebeq">Texas</option>
                      </optgroup>
                    </select>
                  </li>
                  <li>
                    <input type="submit" value=""  />
                    </li>
                </ol>
                
                
              </fieldset>
            </form>
            <!--search form ends in home page--> 
            
          </div>
          <!--closes form--> 
          
        </div>
        <!--closes search_home--> 
        <!--flash banner insert here-->
        <div id="banner_right">
          <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="590" height="312">
            <param name="movie" value="swf/flash.swf" />
            <param name="quality" value="high" />
            <param name="wmode" value="opaque" />
            <param name="swfversion" value="6.0.65.0" />
            <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
            <param name="expressinstall" value="Scripts/expressInstall.swf" />
            <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. --> 
            <!--[if !IE]>-->
            <object type="application/x-shockwave-flash" data="swf/flash.swf" width="590" height="312">
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
        </div>
      </div>
      <div id="main_home"><span>Content for  id "main_home" Goes Here</span>
        <div id="left_home">
         <?php if( !checkPublicLogin(false) ): ?>
          <div id="login_header"><span>Content for  id "login_header" Goes Here</span>
            <h2>Member Login</h2>
          </div>
          <!--closes login_header-->
          <div id="login"> <!--login form holder--> 
            <!--login form in home page starting-->
            <form class="login" action="<?php echo getURL(); ?>" method="post">
              <fieldset>
                <ol>
                  <li>
                    <label>Email:</label>
                  </li>
                  <li>
                    <input name="email" type="text" size="30" maxlength="30" />
                  </li>
                  <li>
                    <label>Password:</label>
                  </li>
                  <li>
                    <input name="password" type="password" size="30" maxlength="30" />
                  </li>
                  <li>
                    <input type="submit" value="" />
                  </li>
                  <li>
                    <label>Forget password</label>
                  </li>
                </ol>
              </fieldset>
            </form>
          </div>
          <?php endif; ?>
          <!--closes login--> 
        </div>
        <!--closes left_home-->
        
        <div id="main_home_newmember"><span>Content for  id "main_home_newmember" Goes Here</span>
        <ul>
          <li class="members">
            <h2><a class="new">New</a> Members</h2>
          </li>
          </ul>
          <div id="inside_members"><!--images of new members starting-->
            <ul>
              <li><img class="marie" src="images/marie_home.jpg" width="71" height="68" alt="marie" /></li>
              <li><img class="marie" src="images/janet_home.jpg" width="71" height="68" alt="jannet" /></li>
              <li><img class="marie" src="images/peter_home.jpg" width="71" height="68" alt="peter" /></li>
            </ul>
            <ul>
              <li class="marie">Marie</li>
              <li class="marie">Jannet</li>
              <li class="marie">petter</li>
            </ul>
            <ul>
              <li><img class="marie" src="images/sara_home.jpg" width="71" height="68" alt="sara" /></li>
              <li><img class="marie" src="images/tom_home.jpg" width="71" height="68" alt="tom" /></li>
              <li><img class="marie" src="images/ali_home.jpg" width="71" height="68" alt="ali" /></li>
              </ul>
              <ul>
                <li class="marie">Sara</li>
                <li class="marie">Tom</li>
                <li class="marie">Ali</li>
              </ul>
              <ul>
                <li><img class="marie" src="images/susan_home.jpg" width="71" height="68" alt="susan" /></li>
                <li><img class="marie" src="images/andrea_home.jpg" width="71" height="68" alt="andrea" /></li>
                <li><img class="marie" src="images/micheal_home.jpg" width="71" height="68" alt="micheal" /></li>
                </ul>
                <ul>
                  <li class="marie">Marie</li>
                  <li class="marie">Jannet</li>
                  <li class="marie">petter</li>
               
              
            </ul>
          </div>
          <!--closes inside_members--> 
        </div>
        <!--closes main_home_newmember-->
        <div id="main_home_right"><span>Content for  id "main_home_right" Goes Here</span>
        <ul>
          <li class="members">
            <h2 class="member"></h2>
            <h2>Create<a class="new"> a free profile</a></h2>
          </li>
          </ul>
          <div id="home_right-inside">
            <p class="ad">Join Now, We are<br />
              100% free!</p>
          
            <p class="adpink"><a href="/join">Join...</a></p>
          </div>
          <!--closes home_right_inside--> 
        </div>
      </div>
      <div id="footer">
        <div id="footer_left">
          <ul>
            <li class="footer"><a href="home">Home</a> | <a href="about-us">About us</a> | <a href="search">Search </a>|<a href="register-user"> Join </a></li>
          </ul>
        </div>
        <!--closes footer_left-->
        <div id="footer_right">
          <ul>
            <li><a href="http://twitter.com/#!/loyldating"><img src="/images/twitter.png" width="28" height="23" alt="twitter" /></a></li>
             <li><a href="http://www.facebook.com/pages/Loyl-Dating/237182623018274"><img src="/images/facebook.png" width="28" height="23" alt="facebook" /></a></li>
          </ul>
        </div>
      </div>
      <!--closes footer--> 
    </div>
    <!--closes container--> 
    <script type="text/javascript">
swfobject.registerObject("FlashID");
	</script>
</body>
</html>