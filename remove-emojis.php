<?php
/**
 * Plugin Name: Disable WP Emojis
 * Plugin URI: https://bidwellwebsites.com/
 * Description: Removes WP Emojis and all related code.
 * Version: 1.0
 * Author: Mason Wiley
 * Author URI: https://bidwellwebsites.com/
 */

/**
* Disable the emojis
*/
function mw_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'mw_disable_emojis_tinymce' );
	add_filter( 'emoji_svg_url', '__return_false' );
}

add_action( 'init', 'mw_disable_emojis' );

/**
* Filter function used to remove the tinymce emoji plugin.
* 
* @param array $plugins 
* @return array Difference betwen the two arrays
*/
function mw_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
