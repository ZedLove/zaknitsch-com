<?php 
	/*session_start();
	// this file generates a captcha image to be used during registration

	$string = "";
	// initialize the string
	for ($i = 0; $i < 7; $i++) {
		// populate the string with random characters
		$string .= chr(rand(97, 122));
	}
	
	$_SESSION[ "captcha_string" ] = $string;
	
	// create an image to contain the captcha string
	
	//directory containing the fonts
	$dir = F_FONTS;  
	 // image will be 170px wide by 60px tall
	$image = imagecreatetruecolor(170, 60);  
	$black = imagecolorallocate($image, 0, 0, 0);  
	$color = imagecolorallocate($image, 200, 100, 90); // red  
	$white = imagecolorallocate($image, 255, 255, 255);
	
	// fill the image with a white background
	// numeric values = coordinates. make sure this is larger than $image
	imagefilledrectangle($image,0,0,399,99,$white);  
	// add the string of random text using an uploaded .ttf font
	// params for imagegettftext($image, $font_size, $angle, $x, $y, $color ,$font_file ,$text)
	imagettftext($image, 30, 0, 10, 40, $alt, $dir."alike-regular.ttf", $_SESSION['rand_code']); 
	
	// tell the broswer what file-type to expect
	header("Content-type: image/png");  
	// generate the image
	imagepng($image);*/
	
	
	
	// sample from Amit //
	
		session_start();
	
		//define( "FONT", "../../" . F_FONTS . "alike-regular.ttf" );
		define( "FONT" , "alike-regular.ttf");
		define( "PADDING", 10 );
		define( "FONT_SIZE", 64 );
		define( "LETTER_COUNT", 6 );
		define( "LETTERS", "abcdefghijklmnopqrstuvwxyz" );
		
		for( $i = 0; $i < LETTER_COUNT; $i++ )
		{
			$randPosition = rand( 0, strlen( LETTERS ) - 1 );
			$title .= substr( LETTERS, $randPosition, 1 );
		}
		
		$_SESSION[ "captcha_string" ] = $title;
		
		// get the bounding box for the text to be rendered
		$box = imagettfbbox( FONT_SIZE, 0, FONT, $title );
		
		// determine the dimensions needed to fit the text
		$width 	= $box[ 2 ] - $box[ 0 ];
		$height = $box[ 1 ] - $box[ 7 ];
		
		// create an empty image for the text
		$image = imagecreatetruecolor( $width + PADDING * 2, 
									   $height + PADDING * 2 );
		
		// allocate the font colour
		$fontColour = imagecolorallocate( $image, 0, 0, 0 );
		$backColour = imagecolorallocate( $image, 255, 255, 255 );
	
		imagefilledrectangle( $image, 0, 0, 
							  $width + PADDING * 2, $height + PADDING * 2,
							  $backColour );
							  
		// draw the text
		imagettftext( $image, FONT_SIZE, 0, PADDING, $height - PADDING, 
								$fontColour, FONT, $title );
?>