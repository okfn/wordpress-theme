<?php

$data;
header( 'Content-Type: application/json' );
error_reporting( E_ALL ^ E_NOTICE );

if ( ! isset( $_POST['g-recaptcha'] ) || ! wp_verify_nonce( $_POST['g-recaptcha'], 'g-recaptcha-check' ) ) :
	esc_html_e( 'Sorry, your nonce did not verify.', 'okfnwp' );
	exit;
else :

	if ( isset( $_POST['g-recaptcha-response'] ) ) :
		$captcha = $_POST['g-recaptcha-response'];
	endif;

	if ( ! $captcha ) :
		$data = array( 'nocaptcha' => 'true' );
		echo json_encode( $data );
		exit;
	endif;

	// Check with the Google reCAPTCHA API
	$response = file_get_contents( 'https://www.google.com/recaptcha/api/siteverify?secret=' . okfn_get_recaptcha_public_key() . '&response=' . $captcha . '&remoteip=' . $_SERVER['REMOTE_ADDR'] );

	// Validate result
	if ( false == $response . success ) :

		$data = array( 'spam' => 'true' );
		echo json_encode( $data );

	else :

		$data = array( 'spam' => 'false' );
		echo json_encode( $data );

	endif;

endif;
