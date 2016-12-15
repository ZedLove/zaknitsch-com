<?php 
	require_once( "admin-includes/admin-functions.inc.php" ); 
	
	checkLogin( USER_ADMIN );
	
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Upload Media - <?php echo  $_SERVER[ "HTTP_HOST" ]; ?></title>
		<link rel="stylesheet" type="text/css" href="css/admin-style.css">
	</head>
	<body>
		<div id="wrapper">
			<h1 class="icon-up heading">Upload Media</h1>
			<?php require_once("templates/admin-nav-small.inc.php");  ?>
			<?php echo $message; ?>
			<form class="upload" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
				<fieldset>
					<ol>
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
								// get all the attributes of the image
								list( $width, $height, $type, $attr ) = getimagesize( $path );
								// output all the image information
							?>
							<p>
							 	<strong>Width:</strong> <?php echo $width; ?>px 
								<strong>Height:</strong> <?php echo $height ?>px
								<strong>Type:</strong> <?php echo image_type_to_mime_type( $type ) ?> 
								<strong>Size:</strong> <?php echo filesize( $path ); ?> bytes
							</p>
							<img id="media-preview" src="/<?php echo $mediaPath; ?>" alt="Preview of <?php echo $mediaPath; ?>" />
						</li>
						<?php endif; ?>
						<li>
							<?php echo $errors[ "upload" ];  ?>
							<?php
								
							
							?>
							<input type="file" name="user_upload" />
						</li>
						<li>
							<input type="submit" value="Upload" />
						</li>
					</ol>
				</fieldset>
			</form>
		</div>
	</body>
</html>