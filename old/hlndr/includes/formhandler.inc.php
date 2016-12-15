<?php
	require_once('class.phpmailer.php');

	/* addMessage() : creates an array within
	 * $_SESSION to communicate errors with
	 * the user. 
	 * Accepts $slug as a key, $message as a message
	 * and $value as either success or failure
	 * to determine what kind of message it is printing
	 * value accepts either 'success' or 'error'
	 */
	 
	function addMessage( $slug, $message, $value = false )
	{
		// set $value based on input
		if ($value == false) {
			// the message is an error message
			$value = "error";
		}
		else {
			// the message is a success message
			$value = "success";
		}
		
		if( !is_array( $_SESSION["messages"] ) )
		{
			$_SESSION["messages"] = array();
		}
		
		$_SESSION["messages"][ $slug ] = "<span class=\"{$value}\">" . $message . "</span>";
	}
	
	/* message() : displays error messages
	 * from the array contained in $_SESSION
	 * created by addMessage(). After the message
	 * is displayed, the value is removed from
	 * the array.
	 */
	function message( $slug )
	{
		if( strlen( $_SESSION["messages"][ $slug ] ) > 0 )
		{
			return $_SESSION["messages"][ $slug ];
			//echo $_SESSION["messages"][ $slug ];
			//$_SESSION["messages"][ $slug ] = "";
			//unset( $_SESSION["messages"][ $slug ] );
		}
	}
	
	/* filterFormData() : Escape any characters that could
	 * break a MySQL query within every entry in the $_POST
	 * array.
	 */
	function filterFormData( $myArray )
	{
		foreach( $myArray as $key => $value )
		{
			$myArray[ $key ] = trim( strip_tags( $value ) );
		}

		return $myArray;
	}
	
	/* clearFormData() : Erases everything in the $_POST
	 * array.
	 */
	function clearFormData()
	{
		foreach( $_GET as $key => $value )
		{
			$_GET[ $key ] = "";
			unset( $_GET[ $key ] );
		}
	}

	function checkForm( $message ) {

		$message = filterFormData($message);
		$errors = 0;

		if ( empty( $message ) ) {
			addMessage( 'form', 'Please enter something in the form' );
		}
		
		if ( strlen( $message['name'] ) < 2 ) {
			addMessage( 'name', 'Please enter your name.' );
			$errors++;
		}

		if ( strlen ( $message['email'] ) < 6 ) {
			addMessage( 'email', 'Please enter a valid e-mail address.');
			$errors++;
		}

		if ( strlen ( $message['message'] ) < 6 ) {
			addMessage( 'message', 'Let me know what you\'re contacting me about.' );
			$errors++;
		}

		if ( isset( $message['awesome'] ) && $message['awesome'] == 'on' ) {
			addMessage('awesome', 'Congratulations on being awesome!', true);
		}
		else {
			addMessage('awesome', 'Don\'t worry, I think you\'re awesome anyway!', true);
		}

		if ( $errors < 1 ) {
			$mail             = new PHPMailer(); // defaults to using php "mail()"

			$body             = "New Message from zaknitsch.com Contact Form \n
								 Name: " . $message['name'] . " \n
								 Email: " . $message['email'] . " \n
								 Awesome: " . $message['awesome'] . "\n
								 Message: " . $message['message'];

			$mail->AddReplyTo( $message['email'] , $message['name'] );

			$mail->SetFrom( $message['email'] , $message['name'] );

			$mail->AddReplyTo( $message['email'] , $message['name'] );

			$address = "zaknitsch@gmail.com";
			$mail->AddAddress($address, $message['name']);

			$mail->Subject    = "zaknitsch.com Contact Form";

			$mail->MsgHTML($body);

			if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			  addMessage('message','Your e-mail has been sent!', true);
			}
			clearFormData();
		}

	}