<?php
	// check if user is logged in
	checkPublicLogin();
	
	// determine which form was submitted
	if( isset( $_POST[ "general" ] ) )
	{	// general search submitted
		$query = makeQuery();
	}
	if( isset( $_POST[ "advanced" ] ) )
	{	// advanced search submitted
		$query = makeQuery("advanced");
	}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>index</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
		<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
	</head>
<body>
<div id="container">
<div id="header">
	<div id="logo"><span>Content for  id "logo" Goes Here</span></div><!-- closes logo -->
		<div id="nav"><span>Content for  id "nav" Goes Here</span>
			<li><a href="home">Home</a></li>
			<li><a href="about-us">About us</a></li>
			<li><a class="current" href="search">Search</a></li>
			<li><?php notLoggedIn(); ?></li>
		</div><!-- closes nav -->
	</div>
	<div id="main_searchpage">
		<div id="left_searchpage">
		<?php if( strlen( $query ) > 0 ) :?>
				<div id="firstrow_search">
							<h2>Members We Selected For You:  </h2>
					  </div>
					  <div id="second_head">
					  	<p class="second"><a class="link" href="/search">Back to search </a></p>
					  </div>
					  <div id="secondrow_content">
				<?php // query is created, run it
					runSearch($query); ?>
				</div><!--closes secondrow_content-->
		<?php else :?>
			<div id="left_serachpage_inside">
				<p class="text">Search</p>
				<!--Javascript Accordion spry panel starts in search page-->
				<!--General search starts -->
				<div id="Accordion1" class="Accordion" tabindex="0">
					<div class="AccordionPanel">
						<div class="AccordionPanelTab">
							<p>General</p>
						</div><!-- closes AccordionPanelTab -->
							<div class="AccordionPanelContent">
								<form class="search_search" action="" method="post">
									<fieldset>
										<ol>
											<li><input type="hidden" name="general" />
												<label>I am a </label>
												<select name="gender">
													<option	value="1">Male</option>
													<option value="0">Female</option>
												</select>
											</li>
											<li>
												<label>Seeking a</label>
												<select name="orientation">
														<option value="0">Female</option>
														<option value="1">Male</option>
														<option value="2">Both</option>
												</select>
											</li>
											<li>
												<label>Between:</label>
												<select name="age_low">
													<?php 
													$age_low = 18;
													for ($i = 0; $i <= 69; $i++) {
														$age_low = $age_low;
														echo "<option value=\"{$age_low}\">{$age_low}</option>";
														$age_low++;
													} ?>
												</select>
											</li>
											<li>
												<label>and</label>
												<select name="age_high">
													<?php 
													$age_high = 18;
													for ($i = 0; $i <= 69; $i++) {
														$age_high = $age_high;
														echo "<option value=\"{$age_high}\">{$age_high}</option>";
														$age_high++;
													}
													 ?>
												</select>
											</li>
											<li>
												<label>City</label>
												<select name ="city">
													<option value="">Anywhere</option>
													<option	value="Toronto">Toronto</option>
													<option value="Montreal">Montreal</option>
													<option value="Ottawa">Ottawa</option>
													<option value="Kingston">Kingston</option>
													<option value="Waterloo">Waterloo</option>
													<option value="Brampton">Brampton</option>
													<option value="Markham">Markham</option>
												</select>
											</li>
											<li>
												<input type="submit" value=""  />
											</li>
											<li>
												<h2 class="match">Click Advanced To Find A Better Match!</h2>
											</li>
										</ol>
									</fieldset>
								</form>
							</div><!-- closes AccordiaonPnelContent -->
						</div>
						<!--General search ends -->
						<!--Advance search starts -->
						<div class="AccordionPanel">
							<div class="AccordionPanelTab">Advance </div><!--closes AccordionPanelTab-->
								<div class="AccordionPanelContent">
									<form class="search_search" action="" method="post">
										<fieldset>
											<ol>
												<li><input type="hidden" name="advanced" />
													<label>I am a </label>
													<select name="gender">
														<option	value="1">Male</option>
														<option value="0">Female</option>
													</select>
												</li>
												<li>
													<label>Seeking a</label>
													<select name="orientation">
															<option value="0">Female</option>
															<option value="1">Male</option>
															<option value="2">Both</option>
													</select>
													</li>
													<li>
														<label>Between:</label>
														<select name="age_low">
																	<?php 
																	$age_low = 1;
																	for ($i = 0; $i <= 69; $i++) {
																		$age_low = $age_low;
																		echo "<option value=\"{$age_low}\">{$age_low}</option>";
																		$age_low++;
																	}
																	 ?>
														</select>
													</li>
													<li>
														<label>and</label>
														<select name="age_high">
															<?php 
															$age_high = 1;
															for ($i = 0; $i <= 69; $i++) {
																$age_high = $age_high;
																echo "<option value=\"{$age_high}\">{$age_high}</option>";
																$age_high++;
															}
															 ?>
														</select>
													</li>
													<li>
														<label>City</label>
														<select name ="city">
															<option	value="">Anywhere</option>
															<option	value="Toronto">Toronto</option>
															<option value="Montreal">Montreal</option>
															<option value="Ottawa">Ottawa</option>
															<option value="Kingston">Kingston</option>
															<option value="Waterloo">Waterloo</option>
															<option value="Brampton">Brampton</option>
															<option value="Markham">Markham</option>
														</select>
													</li>
													<li>
													   	<label>Smoking:</label>
													   	<input name="smoke[]" value="no" type="checkbox" />
													   	<label>No</label>
													   	<input name="smoke[]" value="social" type="checkbox" />
													   	<label>Socially</label>
													   	<input name="smoke[]" value="yes" type="checkbox" />
													   	<label>Daily</label>
													   </li>
													   <li>
													   	<label>Drinking:</label>
													   	<input name="drink[]" value="no" type="checkbox" />
													   	<label>No</label>
													   	<input name="drink[]" value="social" type="checkbox" />
													   	<label>Socially</label>
													   	<input name="drink[]" value="yes" type="checkbox" />
													   	<label>Daily</label>
													   </li>
													   <li>
													   	<label>Living:</label>
													   	<input name="living[]" value="alone" type="checkbox" />
													   	<label>Alone</label>
													   	<input name="living[]" value="kids" type="checkbox" />
													   	<label>With kids</label>
													   	<input name="living[]" value="parents" type="checkbox" />
													   	<label>With parents</label>
													   	<input name="living[]" value="pets" type="checkbox" />
													   	<label>With pets</label>
													   	<input name="living[]" value="roommate" type="checkbox" />
													   	<label>Roommate(s)</label> 
													   </li>
													   <li>
													   	<label>Social:</label>
													   	<input name="social[]" value="shy" type="checkbox" />
													   	<label>Quiet</label>
													   	<input name="social[]" value="home" type="checkbox" />
													   	<label>Home body</label>
													   	<input name="social[]" value="flirt" type="checkbox" />
													   	<label>Flirt</label>
													   	<input name="social[]" value="comic" type="checkbox" />
													   	<label>Comic relief</label>
													   	<input name="social[]" value="sidekick" type="checkbox" />
													   	<label>Side kick</label>
													   </li>
													<!--   <li>
													   	<label>Tv watching:</label>
													   	<input name="tv[]" value="couch" type="checkbox" />
													   	<label>Couch potato</label>
													   	<input name="tv[]" value="news" type="checkbox" />
													   	<label>News junkie</label>
													   	<input name="tv[]" value="sport" type="checkbox" />
													   	<label>Sports nut</label>
													   	<input name="tv[]" value="movies" type="checkbox" />
													   	<label>Movies</label>
													   	<input name="tv[]" value="dreams" type="checkbox" />
													   	<label>Dreams</label>
													   </li>
													   <li>
													   	<input name="tv[]" value="sitcoms" type="checkbox" />
													   	<label>Sitcoms</label>
													   	<input name="tv[]" value="noTv" type="checkbox" />
													   	<label>No TV</label>
													   	<input name="tv[]" value="channel" type="checkbox" />
													   	<label>Surfer</label>
													   	<input name="tv[]" value="reality" type="checkbox" />
													   	<label>Reality TV</label>
													   </li> -->
													<li>
														<input type="submit" value=""  />
													</li>
												</ol>
											</fieldset>
										</form><!-- form ends in Advance search -->
									</div><!--closes AccordionPanel-->
								</div><!--closes AccordionPanelContent-->
							</div><!--closes Accordion1-->
						</div>
			<?php endif; ?><!-- closes left_searchpage_inside -->
					</div>
					<div id="right_serachpage">
						
					</div><!--closes Right_searchpage-->
					<div id="down_searchpage">
					</div><!--closes down_searchpage-->
				</div><!-- closes main_searchpage -->     <div id="footer">
				<div id="footer_left">
					<ul>
							 <li class="footer"><a href="home">Home</a> | <a href="about-us">About us</a> | <a href="search">Search </a>|<a href="register-user"> Join </a></li>
					</ul>
				</div><!--closes footer_left-->
				<div id="footer_right">
					<ul>
						<li><a href="http://twitter.com/#!/loyldating"><img src="/images/twitter.png" width="28" height="23" alt="twitter" /></a></li>
						 <li><a href="http://www.facebook.com/pages/Loyl-Dating/237182623018274"><img src="/images/facebook.png" width="28" height="23" alt="facebook" /></a></li>
					</ul>
				</div>
			</div><!--closes footer-->
		</div><!--closes Container-->
		<script type="text/javascript">
			var Accordion1 = new Spry.Widget.Accordion("Accordion1");
		</script>
	</body>
</html>