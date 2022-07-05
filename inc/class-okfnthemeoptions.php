<?php

class OKFNThemeOptions {

	private $theme_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'theme_options_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'theme_options_page_init' ) );
	}

	public function theme_options_add_plugin_page() {
		add_theme_page(
			__( 'Theme Options', 'okfnwp' ), // page_title
			__( 'Theme Options', 'okfnwp' ), // menu_title
			'manage_options', // capability
			'theme-options', // menu_slug
			array( $this, 'theme_options_create_admin_page' ) // function
		);
	}

	public function theme_options_create_admin_page() {
		$this->theme_options = get_option( 'theme_options_option_name' );
		?>

		<div class="wrap">
		<h2><?php esc_html_e( 'Theme Options', 'okfnwp' ); ?></h2>
		<p><?php esc_html_e( 'Available options for the Open Knowledge International WordPress theme', 'okfnwp' ); ?></p>
		<?php settings_errors(); ?>

		<form method="POST" action="options.php">
		<?php
		settings_fields( 'theme_options_option_group' );
		do_settings_sections( 'theme-options-admin' );
		submit_button();
		?>
		</form>
		</div>
		<?php
	}

	public function theme_options_page_init() {

		register_setting(
			'theme_options_option_group', // option_group
			'theme_options_option_name', // option_name
			array( $this, 'theme_options_sanitize' ) // sanitize_callback
		);
		// add_settings_section(
		// 'theme_options_setting_section_mailing', // id
		// __('Mailing List', 'okfnwp'), // title
		// array($this, 'theme_options_section_mailing'), // callback
		// 'theme-options-admin' // page
		// );

		add_settings_section(
			'theme_options_setting_section_ga', // id
			esc_html__( 'Google Analytics', 'okfnwp' ), // title
			array( $this, 'theme_options_section_ga' ), // callback
			'theme-options-admin' // page
		);

		add_settings_section(
			'theme_options_setting_section_social', // id
			esc_html__( 'Social Media', 'okfnwp' ), // title
			array( $this, 'theme_options_section_social' ), // callback
			'theme-options-admin' // page
		);

		// add_settings_section(
		// 'theme_options_setting_section_wordpress', // id
		// __('WordPress Settings', 'okfnwp'), // title
		// array($this, 'theme_options_section_wordpress'), // callback
		// 'theme-options-admin' // page
		// );
		// add_settings_field(
		// "okfnwp_mailinglist_heading", // id
		// __('Mailing List Heading', 'okfnwp'), // title
		// array($this, 'okfnwp_mailinglist_heading_callback'), // callback
		// 'theme-options-admin', // page
		// 'theme_options_setting_section_mailing' // section
		// );
		//
		// add_settings_field(
		// "okfnwp_mailinglist_action", // id
		// __('Mailing URL', 'okfnwp'), // title
		// array($this, 'okfnwp_mailinglist_action_callback'), // callback
		// 'theme-options-admin', // page
		// 'theme_options_setting_section_mailing' // section
		// );
		//
		// add_settings_field(
		// "okfnwp_mailinglist_id", // id
		// __('Mailman List ID', 'okfnwp'), // title
		// array($this, 'okfnwp_mailinglist_id_callback'), // callback
		// 'theme-options-admin', // page
		// 'theme_options_setting_section_mailing' // section
		// );

		add_settings_field(
			'okfnwp_ga_id', // id
			esc_html__( 'Google Analytics Tracking ID', 'okfnwp' ), // title
			array( $this, 'okfnwp_ga_id_callback' ), // callback
			'theme-options-admin', // page
			'theme_options_setting_section_ga' // section
		);

		add_settings_field(
			'okfnwp_twitter_id', // id
			esc_html__( 'Twitter Handle', 'okfnwp' ), // title
			array( $this, 'okfnwp_twitter_id_callback' ), // callback
			'theme-options-admin', // page
			'theme_options_setting_section_social' // section
		);

		add_settings_field(
			'okfnwp_fb_id', // id
			esc_html__( 'Facebook Page', 'okfnwp' ), // title
			array( $this, 'okfnwp_fb_id_callback' ), // callback
			'theme-options-admin', // page
			'theme_options_setting_section_social' // section
		);

		add_settings_field(
			'okfnwp_discuss_id', // id
			esc_html__( 'Discuss Page', 'okfnwp' ), // title
			array( $this, 'okfnwp_discuss_id_callback' ), // callback
			'theme-options-admin', // page
			'theme_options_setting_section_social' // section
		);

		// add_settings_field(
		// "okfnwp_admin_bar", // id
		// __('WordPress toolbar visibility', 'okfnwp'), // title
		// array($this, 'okfnwp_admin_bar_callback'), // callback
		// 'theme-options-admin', // page
		// 'theme_options_setting_section_wordpress' // section
		// );

		add_settings_field(
			'okfnwp_donate_url', // id
			esc_html__( 'Donation URL', 'okfnwp' ), // title
			array( $this, 'okfnwp_donate_url_callback' ), // callback
			'theme-options-admin', // page
			'theme_options_setting_section_social' // section
		);

		add_settings_field(
			'okfnwp_newsletter_url', // id
			esc_html__( 'Newsletter sign up URL', 'okfnwp' ), // title
			array( $this, 'okfnwp_newsletter_url_callback' ), // callback
			'theme-options-admin', // page
			'theme_options_setting_section_social' // section
		);

		add_settings_section(
			'theme_options_setting_section_cta', // id
			esc_html__( 'Call to action', 'okfnwp' ), // title
			array( $this, 'theme_options_section_cta' ), // callback
			'theme-options-admin' // page
		);

		add_settings_field(
			'okfnwp_cta_message', // id
			esc_html__( 'Message', 'okfnwp' ), // title
			array( $this, 'okfnwp_cta_message_callback' ), // callback
			'theme-options-admin', // page
			'theme_options_setting_section_cta' // section
		);

		add_settings_field(
			'okfnwp_cta_link_text', // id
			esc_html__( 'Link text', 'okfnwp' ), // title
			array( $this, 'okfnwp_cta_link_text_callback' ), // callback
			'theme-options-admin', // page
			'theme_options_setting_section_cta' // section
		);

		add_settings_field(
			'okfnwp_cta_link_url', // id
			esc_html__( 'Link URL', 'okfnwp' ), // title
			array( $this, 'okfnwp_cta_link_url_callback' ), // callback
			'theme-options-admin', // page
			'theme_options_setting_section_cta' // section
		);
	}

	public function theme_options_sanitize( $input ) {
		$sanitary_values = array();
		// if (isset($input['okfnwp_mailinglist_heading'])) {
		// $sanitary_values['okfnwp_mailinglist_heading'] = sanitize_text_field($input['okfnwp_mailinglist_heading']);
		// }
		//
		// if (isset($input['okfnwp_mailinglist_action'])) {
		// $sanitary_values['okfnwp_mailinglist_action'] = sanitize_text_field($input['okfnwp_mailinglist_action']);
		// }
		//
		// if (isset($input['okfnwp_mailinglist_id'])) {
		// $sanitary_values['okfnwp_mailinglist_id'] = sanitize_text_field($input['okfnwp_mailinglist_id']);
		// }

		if ( isset( $input['okfnwp_ga_id'] ) ) {
			$sanitary_values['okfnwp_ga_id'] = sanitize_text_field( $input['okfnwp_ga_id'] );
		}

		if ( isset( $input['okfnwp_twitter_id'] ) ) {
			$sanitary_values['okfnwp_twitter_id'] = sanitize_text_field( $input['okfnwp_twitter_id'] );
		}

		if ( isset( $input['okfnwp_fb_id'] ) ) {
			$sanitary_values['okfnwp_fb_id'] = sanitize_text_field( $input['okfnwp_fb_id'] );
		}

		if ( isset( $input['okfnwp_discuss_id'] ) ) {
			$sanitary_values['okfnwp_discuss_id'] = sanitize_text_field( $input['okfnwp_discuss_id'] );
		}

		// if (isset($input['okfnwp_admin_bar'])) {
		// $sanitary_values['okfnwp_admin_bar'] = $input['okfnwp_admin_bar'];
		// }

		if ( isset( $input['okfnwp_donate_url'] ) ) {
			$sanitary_values['okfnwp_donate_url'] = sanitize_text_field( $input['okfnwp_donate_url'] );
		}

		if ( isset( $input['okfnwp_newsletter_url'] ) ) {
			$sanitary_values['okfnwp_newsletter_url'] = sanitize_text_field( $input['okfnwp_newsletter_url'] );
		}

		if ( isset( $input['okfnwp_cta_message'] ) ) {
			$sanitary_values['okfnwp_cta_message'] = sanitize_text_field( $input['okfnwp_cta_message'] );
		}

		if ( isset( $input['okfnwp_cta_link_text'] ) ) {
			$sanitary_values['okfnwp_cta_link_text'] = sanitize_text_field( $input['okfnwp_cta_link_text'] );
		}

		if ( isset( $input['okfnwp_cta_link_url'] ) ) {
			$sanitary_values['okfnwp_cta_link_url'] = sanitize_text_field( $input['okfnwp_cta_link_url'] );
		}

		return $sanitary_values;
	}

	// public function theme_options_section_mailing() {
	//
	// }

	public function theme_options_section_ga() {

	}

	public function theme_options_section_social() {

	}

	public function theme_options_section_cta() {}


	// public function theme_options_section_wordpress() {
	//
	// }
	// public function okfnwp_mailinglist_heading_callback() {
	//
	// $current_val = $this->theme_options['okfnwp_mailinglist_heading'];
	// $old_val = get_option('okfnwp_mailinglist_heading');
	//
	// if (!isset($current_val) && isset($old_val)):
	// $current_val = $old_val;
	// endif;
	//
	// printf('<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_mailinglist_heading]" id="okfnwp_mailinglist_heading" value="%s">', isset($current_val) ? esc_attr($current_val) : '');
	// }
	// public function okfnwp_mailinglist_action_callback() {
	// $current_val = $this->theme_options['okfnwp_mailinglist_action'];
	// $old_val = get_option('okfnwp_mailinglist_action');
	//
	// if (!isset($current_val) && isset($old_val)):
	// $current_val = $old_val;
	// endif;
	//
	// printf('<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_mailinglist_action]" id="okfnwp_mailinglist_action" value="%s">', isset($current_val) ? esc_attr($current_val) : '');
	// _e('<p>URL to which the subscribe form data will be sent. Mailman example: http://lists.okfn.org/mailman/subscribe/XYZ</p>');
	// }
	// public function okfnwp_mailinglist_id_callback() {
	// $current_val = $this->theme_options['okfnwp_mailinglist_id'];
	// $old_val = get_option('okfnwp_mailinglist_id');
	//
	// if (!isset($current_val) && isset($old_val)):
	// $current_val = $old_val;
	// endif;
	//
	// printf('<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_mailinglist_id]" id="okfnwp_mailinglist_id" value="%s">', isset($current_val) ? esc_attr($current_val) : '');
	// _e('<p>For the list at http://lists.okfn.org/mailman/subscribe/XYZ, this should be XYZ</p>');
	// }

	public function okfnwp_ga_id_callback() {
		if ( isset( $this->theme_options['okfnwp_ga_id'] ) ) :
			$current_val = $this->theme_options['okfnwp_ga_id'];
	  else :
		  $current_val = '';
	  endif;

	  printf( '<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_ga_id]" id="okfnwp_ga_id" value="%s">', isset( $current_val ) ? esc_attr( $current_val ) : '' );
		?>
  <p><?php esc_html_e( 'Google Analytics tracking ID for current website' ); ?></p>
		<?php
	}

	public function okfnwp_twitter_id_callback() {
		if ( isset( $this->theme_options['okfnwp_twitter_id'] ) ) :
			$current_val = $this->theme_options['okfnwp_twitter_id'];
	  else :
		  $current_val = '';
	  endif;
		$old_val = get_option( 'okfnwp_twitter_id' );

	  if ( ! isset( $current_val ) && isset( $old_val ) ) :
		  $current_val = $old_val;
			endif;

		printf( '<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_twitter_id]" id="okfnwp_twitter_id" value="%s">', isset( $current_val ) ? esc_attr( $current_val ) : '' );
		?>
		<p><?php esc_html_e( 'Twitter handle to link to. Example: If your handle is @okfn, use okfn' ); ?></p>
		<?php
	}

	public function okfnwp_fb_id_callback() {
		if ( isset( $this->theme_options['okfnwp_fb_id'] ) ) :
			$current_val = $this->theme_options['okfnwp_fb_id'];
	  else :
		  $current_val = '';
	  endif;
		$old_val = get_option( 'okfnwp_fb_id' );

	  if ( ! isset( $current_val ) && isset( $old_val ) ) :
		  $current_val = $old_val;
			endif;

		printf( '<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_fb_id]" id="okfnwp_fb_id" value="%s">', isset( $current_val ) ? esc_attr( $current_val ) : '' );
		?>
		<p><?php esc_html_e( 'Facebook page name. If the URL to your page is https://www.facebook.com/OKFNetwork, then use OKFNetwork' ); ?></p>
		<?php
	}

	public function okfnwp_discuss_id_callback() {
		if ( $this->theme_options['okfnwp_discuss_id'] ) :
			$current_val = $this->theme_options['okfnwp_discuss_id'];
	  else :
		  $current_val = '';
	  endif;
		$old_val = get_option( 'okfnwp_discuss_id' );

	  if ( ! isset( $current_val ) && isset( $old_val ) ) :
		  $current_val = $old_val;
			endif;

		printf( '<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_discuss_id]" id="okfnwp_discuss_id" value="%s">', isset( $current_val ) ? esc_attr( $current_val ) : '' );
		?>
		<p><?php esc_html_e( 'Discuss (discuss.okfn.org) page name. If the URL to your page is https://discuss.okfn.org/c/local-groups/okbr, then use c/local-groups/okbr' ); ?></p>
		<?php
	}

	// public function okfnwp_admin_bar_callback() {
	// $current_val = isset($this->theme_options['okfnwp_admin_bar']) ? $this->theme_options['okfnwp_admin_bar'] : false;
	//
	// printf('<label for="okfnwp_admin_bar"><input type="checkbox" name="theme_options_option_name[okfnwp_admin_bar]" id="okfnwp_admin_bar" value="1" %s>%s</label>', checked(1, $current_val, false), __(' Show the WordPress Admin toolbar when viewing site', 'okfnwp'));
	// }

	public function okfnwp_donate_url_callback() {
		if ( $this->theme_options['okfnwp_donate_url'] ) :
			$current_val = $this->theme_options['okfnwp_donate_url'];
	  else :
		  $current_val = '';
	  endif;
	  $old_val = get_option( 'okfnwp_donate_url' );

	  if ( ! isset( $current_val ) && isset( $old_val ) ) :
		  $current_val = $old_val;
		endif;

	  printf( '<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_donate_url]" id="okfnwp_donate_url" value="%s">', isset( $current_val ) ? esc_attr( $current_val ) : '' );
		?>
	<p>E.g <code>https://okfn.org/donate</code></p>
		<?php
	}

	public function okfnwp_newsletter_url_callback() {
		if ( $this->theme_options['okfnwp_newsletter_url'] ) :
			$current_val = $this->theme_options['okfnwp_newsletter_url'];
	  else :
		  $current_val = '';
	  endif;
	  $old_val = get_option( 'okfnwp_newsletter_url' );

	  if ( ! isset( $current_val ) && isset( $old_val ) ) :
		  $current_val = $old_val;
		endif;

	  printf( '<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_newsletter_url]" id="okfnwp_newsletter_url" value="%s">', isset( $current_val ) ? esc_attr( $current_val ) : '' );
		?>
	<p>E.g <code>https://..</code></p>
		<?php
	}

	public function okfnwp_cta_message_callback() {
		if ( $this->theme_options['okfnwp_cta_message'] ) :
			$current_val = $this->theme_options['okfnwp_cta_message'];
	  else :
		  $current_val = '';
	  endif;
	  $old_val = get_option( 'okfnwp_cta_message' );

	  if ( ! isset( $current_val ) && isset( $old_val ) ) :
		  $current_val = $old_val;
		endif;

	  printf( '<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_cta_message]" id="okfnwp_cta_message" value="%s">', isset( $current_val ) ? esc_attr( $current_val ) : '' );
		?>
	<p>E.g <code>Support a fair, free and open future.</code></p>
		<?php
	}

	public function okfnwp_cta_link_text_callback() {
		if ( $this->theme_options['okfnwp_cta_link_text'] ) :
			$current_val = $this->theme_options['okfnwp_cta_link_text'];
	  else :
		  $current_val = '';
	  endif;
	  $old_val = get_option( 'okfnwp_cta_link_text' );

	  if ( ! isset( $current_val ) && isset( $old_val ) ) :
		  $current_val = $old_val;
		endif;

	  printf( '<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_cta_link_text]" id="okfnwp_cta_link_text" value="%s">', isset( $current_val ) ? esc_attr( $current_val ) : '' );
		?>
	<p>E.g <code>Donate now</code></p>
		<?php
	}

	public function okfnwp_cta_link_url_callback() {
		if ( $this->theme_options['okfnwp_cta_link_url'] ) :
			$current_val = $this->theme_options['okfnwp_cta_link_url'];
	  else :
		  $current_val = '';
	  endif;
	  $old_val = get_option( 'okfnwp_cta_link_url' );

	  if ( ! isset( $current_val ) && isset( $old_val ) ) :
		  $current_val = $old_val;
		endif;

	  printf( '<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_cta_link_url]" id="okfnwp_cta_link_url" value="%s">', isset( $current_val ) ? esc_attr( $current_val ) : '' );
		?>
	<p>E.g <code>https://okfn.org/donate</code></p>
		<?php
	}

}

if ( is_admin() ) :
	$theme_options = new OKFNThemeOptions();
endif;

/*
 * Retrieve this value with:
 * $theme_options = get_option( 'theme_options_option_name' ); // Array of All Options
 * $okfnwp_mailinglist_heading = $theme_options['okfnwp_mailinglist_heading']; // okfnwp_mailinglist_heading
 * $okfnwp_mailinglist_action = $theme_options['okfnwp_mailinglist_action']; // okfnwp_mailinglist_action
 * $okfnwp_mailinglist_id = $theme_options['okfnwp_mailinglist_id']; // okfnwp_mailinglist_id
 * $okfnwp_twitter_id = $theme_options['okfnwp_twitter_id']; // okfnwp_twitter_id
 * $okfnwp_fb_id = $theme_options['okfnwp_fb_id']; // okfnwp_fb_id
 * $okfnwp_admin_bar = $theme_options['okfnwp_admin_bar']; // okfnwp_admin_bar
 */
