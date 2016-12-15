<?php
	//constants
	define ("DB_HOST" , "localhost");
	define ("DB_USER" , "zkntschc_root");
	define ("DB_PASS" , "#Nintendo3");
	define ("DB_NAME" , "zkntschc_mslmovie"); //paraFX hosting DB_USER = DB_NAME
	define ("TBL_MOVIES", "movies");
	
	require_once("includes/formhandler.inc.php");

	mysql_connect(DB_HOST, DB_USER, DB_PASS) or die( mysql_error-wrap() ); 
												
											  //when connecting to multiple DBs
											  //set this as a variable to be used
											  //in functions to let php know which
											  //DB you want to connect to
											  
	mysql_select_db( DB_NAME ) or die ( mysql_error-wrap() );

	$result = mysql_query( "SELECT * FROM " . TBL_MOVIES );


	if ( isset( $_POST['title'] ) ) {
		// echo '<p>Here\'s what you\'re trying to add to the database.</p><pre>';
		// print_r($_POST);
		// echo '</pre>';

		$title 			= mysql_real_escape_string( strip_tags( $_POST['title'] ) );
		$director 		= mysql_real_escape_string( strip_tags( $_POST['director'] ) );
		$release_date_y	= mysql_real_escape_string( strip_tags( $_POST['release_date_y'] ) );
		$release_date_m	= mysql_real_escape_string( strip_tags( $_POST['release_date_m'] ) );
		$release_date_d	= mysql_real_escape_string( strip_tags( $_POST['release_date_d'] ) );
		$release_date 	= $release_date_y . "-" . $release_date_m . "-" . $release_date_d;
		$rating 		= mysql_real_escape_string( strip_tags( $_POST['rating'] ) );
		$cast 			= mysql_real_escape_string( strip_tags( $_POST['cast'] ) );
		$watched 		= mysql_real_escape_string( strip_tags( $_POST['watched'] ) );
		$netflix 		= mysql_real_escape_string( strip_tags( $_POST['netflix'] ) );
		$id 			= mysql_real_escape_string( strip_tags( $_POST['id'] ) );

		// set up an errors value
		$errors = 0;

		if ( strlen( $title ) < 2 ) {
			addMessage("title", "Please enter a longer title.");
			$errors++;
		}
		if ( strlen( $director ) < 1 ) {
			addMessage("director", "Please enter a director.");
			$errors++;
		}
		if ( strlen( $cast ) < 1 ) {
			addMessage("cast", "Please enter a cast member.");
			$errors++;
		}

		
		if ( $errors == 0 && strcmp( $_POST['form_type'], "add" ) == 0 ) {
			
			$query = "INSERT INTO " . TBL_MOVIES . "(title,
														 director,
														 release_date,
														 rating,
														 cast,
														 watched,
														 netflix) VALUES ('" . $title . "',
														 '" . $director . "',
														 '" . $release_date . "',
														 '" . $rating . "',
														 '" . $cast . "',
														 '" . $watched . "',
														 '" . $netflix . "')";
		
			mysql_query( $query )or die( mysql_error() );

			addMessage( "success", "". $title . " successfully added!", true);
		}

		elseif ( $errors == 0 && strcmp( $_POST['form_type'], "edit" ) == 0 ) {

			$new_release_date = $release_date_y."-".$release_date_m."-".$release_date_d;
			
			$query = "UPDATE " . TBL_MOVIES . " SET title='{$title}', 
													director='{$director}', 
													release_date='{$new_release_date}', 
													rating={$rating},
													cast='{$cast}', 
													watched={$watched}, 
													netflix={$netflix}
													WHERE id={$id}";
			mysql_query( $query )or die( mysql_error() );

			addMessage( "success", "". $title . " successfully edited!", true);	
		}
	}


?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!--
		++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,?????????????????$,,,,,,
		,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,????????????????$,,,,,,
		,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,??????????????$,,,,,,
		?????????????????????,,,,,,,,,,,,,,,,,,,?????????????$,,,,,,
		???????????????????,,,,,,,,??,,,,,I,,,,,,:???????????$,,,,,,
		?????????????????,,,,,,,,????,,,,,I?,,,,,,,??????????$,,,,,,
		???????????????,,,,,,,,??????,,,,,I???,,,,,,?????????$,,,,,,
		?????????????,,,,,,,,????????,,,,,I????,,,,,,,???????$,,,,,,
		???????????,,,,,,,,??????????,,,,,I?????,,,,,,,??????$,,,,,,
		?????????,,,,,,,,,???????????,,,,,I???????,,,,,,?????$,,,,,,
		????????,,,,,,,,?????????????,,,,,I????????,,,,,,,???$,,,,,,
		??????,,,,,,,,???????????????,,,,,I?????????,,,,,,,??$,,,,,,
		????,,,,,,,,?????????????????,,,,,I???????????,,,,,,,$,,,,,,
		??,,,,,,,,???????????????????,,,,,I????????????,,,,,,,,,,,,,
		,,,,,,,,I????????????????????,,,,,I?????????????,,,,,,,,,,,,
		,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,I???????????????,,,,,,,,,,
		,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,I????????????????,,,,,,,,,
		,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,I??????????????????,,,,,,,
		++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

		OHAI

		Your reward for finding this message is this FANCYBEAR in a RESPLENDENT NECK RUFF:

		(FAILED TO LOAD FANCYBEAR)
		



-->
	<title>Movie Database</title>
	<meta name="description" content="This is a movie database.">
	<meta name="author" content="Zak Nitsch">

	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css">

	<script type="text/javascript" src="js/libs/modernizr-2.5.2-respond-1.1.0.min.js"></script>

	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="fancybox/jquery.easing-1.3.pack.js"></script>
	<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>
</head>
<body>
	<div id="wrapper">
		
		<header> 

			<h1>This <span class="">is a movie database.</span></h2>

		</header>

		<section id="database">

			<p>Here is an example of some data being pulled from the database.</p>
			<p>The functionality to sort and rate movies as well as query IMDB and Netflix for data will be available at a later date.</p>
			<p>Feel free to add movies and edit movies.</p>
			<table>
			  <tr>
			  	<th class="title" >Title:</th>
			  	<th class="director" >Director:</th>
			  	<th class="release-date" >Release Date:</th>
			  	<th class="rating" >Rating:</th>
			  	<th class="date-added" >Date Added:</th>
			  	<th class="cast" >Cast:</th>
			  	<th class="watched" >Watched:</th>
			  	<th class="netflix" >Netflix?</th>
			  </tr>
			<?php
			while($movie = mysql_fetch_assoc($result)):
			?>
			  <tr>
			  	<td><?php echo $movie['title']; ?> <a class="edit" href="<?= $_SERVER['PHP_SELF']?>?id=<?=$movie['id']?>">Edit</a></td>
			 	<td><?php echo $movie['director'];?></td>
			  	<td class="middle"><?php echo $movie['release_date'];?></td>
			  	<td class="middle"><?php if( $movie['watched'] > 0 ) {
			  								echo $movie['rating'];
			  							 }
			  							 else {
			  							 	echo "N/A";
			  							 }
			  						?></td>			  	
			  	<td class="middle"><?php echo substr( $movie['date_added'], 0, 10 );?></td>			  	
			  	<td><?php echo $movie['cast'];?></td>
			  	<td class="middle">
			  		<?php
					  	if ( $movie['watched'] > 0 ) {
					  		$watched = 'Yes';
					  		}

					  	else { $watched = 'No'; }
					  	echo $watched;
			  		?>
			  	</td>
			  	<td class="middle">
			  		<?php
					  	if ( $movie['netflix'] > 0 ) {
					  		$netflix = 'Yes';
					  		}

					  	else { $netflix = 'No'; }
					  	echo $netflix;
			  		?>
			  	</td>
			  </tr>
			 <?php
			  endwhile;
			?>
			</table>

		</section><!-- close #database -->
		<?php 
			// not editing a movie
			if ( !isset( $_GET['id'] ) ) :

		?>
		<section class="add" id="add">
			<?=message("success")?>
			<form method="post" action="<?php echo "http://zkntsch.com".$_SERVER["PHP_SELF"]; ?>"#add>
				<legend>Add a Movie:</legend>
				<fieldset>
					<input type="hidden" name="form_type" value="add" />
					<ul>
						<li>
							<label for="title" >Title:</label>
							<input name="title" class="title" type="text" />
						</li>
						<li class="error-wrap">
							<?=message("title");?>
						</li>
						<li>
							<label for="director" >Director:</label>
							<input name="director" class="director" type="text" />
						</li>
						<li class="error-wrap">
							<?=message("director");?>
						</li>
						<li>
							<label for="release_date" >Release Date:</label>
							<select name="release_date_m">
								<optgroup label="Month">
									<option value="01">Jan</option>
									<option value="02">Feb</option>
									<option value="03">Mar</option>
									<option value="04">Apr</option>
									<option value="05">May</option>
									<option value="06">Jun</option>
									<option value="07">Jul</option>
									<option value="08">Aug</option>
									<option value="09">Sep</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
								</optgroup>
							</select>
							<select name="release_date_d">
								<optgroup label="Day">
								<?php
									for ($i=1; $i < 32; $i++) { 
										if ( $i < 10 ) {
											echo "<option value=\"0" . $i . "\">0" . $i . "</option>";		
										}
									 	else {
									 		echo "<option value=\"" . $i . "\">" . $i . "</option>";		
									 	}
									}
								?>
								</optgroup>
							</select>
							<select name="release_date_y">
								<optgroup label="Year">
									<?php
									for ($i=2013; $i > 1899; $i--) { 
									 echo "<option value=\"" . $i . "\">" . $i . "</option>";		
									}
								?>
								</optgroup>
							</select>
						</li>
						<li class="error-wrap">
							<?=message("release_date");?>
						</li>
						<li>
							<label for="rating" >Rating:</label>
							<select name="rating" >
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</li>
						<li class="error-wrap">
						</li>
						<li>
							<label for="cast" >Cast:</label>
							<input name="cast" type="text" />
						</li>
						<li class="error-wrap">
							<?=message("director");?>
						</li>
						<li>
							<label for="watched" >Watched:</label>
							<input name="watched" value="1" type="checkbox" />
						</li>
						<li class="error-wrap">
						</li>
						<li>
							<input id="submit" value="Add" type="submit" />
						</li>

					</ul>
				</fieldset>
			</form>


		</section><!-- close #add -->

		<?php
			// editing a movie
			// elseif ( isset( $_GET['id'] ) ) :
			else:
				$edit_query = "SELECT * FROM " . TBL_MOVIES . " WHERE id=" . $_GET['id'] . "";

				$edit_row = mysql_query( $edit_query )or die( mysql_error() );

				while ( $edit = mysql_fetch_assoc( $edit_row) ) :

					$edit['release_date'] = explode("-", $edit['release_date']);
					$edit['release_date_y'] = $edit['release_date'][0];
					$edit['release_date_m'] = $edit['release_date'][1];
					$edit['release_date_d'] = $edit['release_date'][2];

					$release_date_y = array();
					$release_date_y[ $edit['release_date_y'] ] = " selected=\"selected\"";

					$release_date_m = array();
					$release_date_m[ $edit['release_date_m'] ] = " selected=\"selected\"";

					$release_date_d = array();
					$release_date_d[ $edit['release_date_d'] ] = " selected=\"selected\"";

					$rating = array();
					$rating[ $edit['rating'] ] = " selected=\"selected\"";

					$watched = array();
					$watched[ $edit['watched'] ] = " selected=\"selected\"";

		?>
		<section class="edit" id="edit">
			<?=message("success")?>
				<form method="post" action="<?php echo "http://zkntsch.com".$_SERVER["PHP_SELF"]; ?>"#add>
					<legend>Edit <?=$edit['title']?>:</legend>
					<fieldset>
						<input type="hidden" name="form_type" value="edit" />
						<input type="hidden" name="id" value="<?=$edit['id']?>" />
						<input type="hidden" name="netflix" value="<?=$edit['netflix']?>" />
						<ul>
							<li>
								<label for="title" >Title:</label>
								<input name="title" class="title" type="text" value="<?=$edit['title']?>" />
							</li>
							<li class="error-wrap">
								<?=message("title");?>
							</li>
							<li>
								<label for="director" >Director:</label>
								<input name="director" class="director" type="text" value="<?=$edit['director']?>" />
							</li>
							<li class="error-wrap">
								<?=message("director");?>
							</li>
							<li>
								<label for="release_date" >Release Date:</label>
								<select name="release_date_m">
									<optgroup label="Month">
										<option <?=$release_date_m["01"]?> value="01">Jan</option>
										<option <?=$release_date_m["02"]?> value="02">Feb</option>
										<option <?=$release_date_m["03"]?> value="03">Mar</option>
										<option <?=$release_date_m["04"]?> value="04">Apr</option>
										<option <?=$release_date_m["05"]?> value="05">May</option>
										<option <?=$release_date_m["06"]?> value="06">Jun</option>
										<option <?=$release_date_m["07"]?> value="07">Jul</option>
										<option <?=$release_date_m["08"]?> value="08">Aug</option>
										<option <?=$release_date_m["09"]?> value="09">Sep</option>
										<option <?=$release_date_m["10"]?> value="10">Oct</option>
										<option <?=$release_date_m["11"]?> value="11">Nov</option>
										<option <?=$release_date_m["12"]?> value="12">Dec</option>
									</optgroup>
								</select>
								<select name="release_date_d">
									<optgroup label="Day">
									<?php
										for ($i=1; $i < 32; $i++) { 
											if ( $i < 10 ) {
												// less than 10, hack it to double digits
												$key = "0".$i;
												echo "<option " . $release_date_d[$key] . " value=\"0" . $i . "\">0" . $i . "</option>";		
											}
										 	else {
										 		echo "<option " . $release_date_d[$i] . " value=\"" . $i . "\">" . $i . "</option>";		
										 	}
										}
									?>
									</optgroup>
								</select>
								<select name="release_date_y">
									<optgroup label="Year">
										<?php
										for ($j=2013; $j > 1899; $j--) { 
										 echo "<option " . $release_date_y[$j] . " value=\"" . $j . "\">" . $j . "</option>";		
										}
									?>
									</optgroup>
								</select>
							</li>
							<li class="error-wrap">
								<?=message("release_date");?>
							</li>
							<li>
								<label for="rating" >Rating:</label>
								<select name="rating" >
									<option <?=$rating['0']?> value="0">0</option>
									<option <?=$rating['1']?> value="1">1</option>
									<option <?=$rating['2']?> value="2">2</option>
									<option <?=$rating['3']?> value="3">3</option>
									<option <?=$rating['4']?> value="4">4</option>
									<option <?=$rating['5']?> value="5">5</option>
								</select>
							</li>
							<li class="error-wrap">
							</li>
							<li>
								<label for="cast" >Cast:</label>
								<input name="cast" type="text" value="<?=$edit['cast']?>" />
							</li>
							<li class="error-wrap">
								<?=message("director");?>
							</li>
							<li>
								<label for="watched" >Watched:</label>
								<select name="watched">
									<option <?=$watched["1"]?> value="1">Yes</option>
									<option <?=$watched["0"]?> value="0">No</option>
								</select>
							</li>
							<li class="error-wrap">
							</li>
							<li>
								<input id="submit" value="Edit" type="submit" />
							</li>

						</ul>
					</fieldset>
				</form>


			</section><!-- close #edit -->
		<?php 
			endwhile;
			endif; 
		?>


	</div><!-- close div#wrapper -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26766761-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<script type="text/javascript" src="js/script.js" ></script>
</body>
<!--**********HAVE A NICE DAY**********-->
</html>
