<?php

	require_once("includes/formhandler.inc.php");
		

		checkFormAjax($_GET);

		$results = array();

		function checkFormAjax( $formData ) {

			$formData = filterFormData($formData);
			$errors = 0;

			if ( empty( $formData ) ) {
				addMessage( 'form', 'Please enter something in the form' );
			}
			
			if ( strlen( $formData['name'] ) < 2 ) {
				addMessage( 'name', 'Please enter your name.' );
				$errors++;
			}

			if ( strlen ( $formData['email'] ) < 6 ) {
				addMessage( 'email', 'Please enter a valid e-mail address.');
				$errors++;
			}

			if ( strlen ( $formData['message'] ) < 6 ) {
				addMessage( 'message', 'Let me know why you\'re contacting me.' );
				$errors++;
			}

			if ( isset( $formData['awesome'] ) && $formData['awesome'] == 'on' ) {
				addMessage('awesome', 'Congratulations on being awesome!', true);
			}
			else {
				addMessage('awesome', 'Don\'t worry, I think you\'re awesome anyway!', true);
			}

			if ( $errors < 1 ) {
				// no errors, send e-mail
				$mail             = new PHPMailer(); // defaults to using php "mail()"

				$body             = "New Message from zaknitsch.com Contact Form \r\n
									 Name: " . $formData['name'] . " \r\n
									 Email: " . $formData['email'] . " \r\n
									 Awesome: " . $formData['awesome'] . "\r\n
									 Message: " . $formData['message'];

				$mail->AddReplyTo( $formData['email'] , $formData['name'] );

				$mail->SetFrom( $formData['email'] , $formData['name'] );

				$mail->AddReplyTo( $formData['email'] , $formData['name'] );

				$address = "zaknitsch@gmail.com";
				$mail->AddAddress($address, $formData['name']);

				$mail->Subject    = "zaknitsch.com Contact Form";

				$mail->MsgHTML($body);

				if(!$mail->Send()) {
				  echo "Mailer Error: " . $mail->ErrorInfo;
				} else {
				  addMessage('success','Your e-mail has been sent!', true);
				  $data[0] = "";
				  $data[1] = "";
				  $data[2] = "";
				  $data[3] = "";
				  $data[4] = message('success');
				  $data = json_encode( $data );
				  echo $data;
				  clearFormData();
				}
			}
			else {
				// there were errors

				$data[0] = message('name');
				$data[1] = message('email');
				$data[2] = message('message');
				$data[3] = message('awesome');
				$data[4] = "";

				$data = json_encode( $data );
				
				echo $data;

				$_SESSION["messages"][ 'name' ] = "";
				$_SESSION["messages"][ 'email' ] = "";
				$_SESSION["messages"][ 'message' ] = "";
				$_SESSION["messages"][ 'awesome' ] = "";

				//return true;
			}
		}