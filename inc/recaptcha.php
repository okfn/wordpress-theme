<?php
/**
 * Form validation template for reCAPTCHA
 *
 * @package OKFNWP
 */

$okf_data;
header( 'Content-Type: application/json' );
error_reporting( E_ALL ^ E_NOTICE );

if ( ! isset( $_POST['g-recaptcha'] ) || ! wp_verify_nonce( $_POST['g-recaptcha'], 'g-recaptcha-check' ) ) :
	esc_html_e( 'Sorry, your nonce did not verify.', 'okfnwp' );
	exit;
else :

	if ( isset( $_POST['g-recaptcha-response'] ) ) :
		$okf_captcha = $_POST['g-recaptcha-response'];
	endif;

	if ( ! $okf_captcha ) :
		$okf_data = array( 'nocaptcha' => 'true' );
		echo json_encode( $okf_data );
		exit;
	endif;

	// Check with the Google reCAPTCHA API.
	$okf_response = file_get_contents( 'https://www.google.com/recaptcha/api/siteverify?secret=' . okfn_get_recaptcha_public_key() . '&response=' . $okf_captcha . '&remoteip=' . $_SERVER['REMOTE_ADDR'] );

	// Validate result.
	if ( false == $okf_response . success ) :

		$okf_data = array( 'spam' => 'true' );
		echo json_encode( $okf_data );

	else :

		$okf_data = array( 'spam' => 'false' );
		echo json_encode( $okf_data );

	endif;

endif;
