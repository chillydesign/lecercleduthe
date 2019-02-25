<?php
/**
 * Main functions file
 *
 * @package WordPress
 * @subpackage Shop Isle
 */
$vendor_file = trailingslashit( get_template_directory() ) . 'vendor/autoload.php';
if ( is_readable( $vendor_file ) ) {
	require_once $vendor_file;
}

if ( ! defined( 'WPFORMS_SHAREASALE_ID' ) ) {
	define( 'WPFORMS_SHAREASALE_ID', '848264' );
}

add_filter( 'themeisle_sdk_products', 'shopisle_load_sdk' );
/**
 * Loads products array.
 *
 * @param array $products All products.
 *
 * @return array Products array.
 */
function shopisle_load_sdk( $products ) {
	$products[] = get_template_directory() . '/style.css';

	return $products;
}
/**
 * Initialize all the things.
 */
require get_template_directory() . '/inc/init.php';

/**
 * Note: Do not add any custom code here. Please use a child theme so that your customizations aren't lost during updates.
 * http://codex.wordpress.org/Child_Themes
 */




 function disable_wp_emojicons() {

   // all actions related to emojis
   remove_action( 'admin_print_styles', 'print_emoji_styles' );
   remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
   remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
   remove_action( 'wp_print_styles', 'print_emoji_styles' );
   remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
   remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
   remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

 }
 add_action( 'init', 'disable_wp_emojicons' );
 function remove_json_api () {

     // Remove the REST API lines from the HTML Header
     remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
     remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
     // Remove the REST API endpoint.
     remove_action( 'rest_api_init', 'wp_oembed_register_route' );
     // Turn off oEmbed auto discovery.
     add_filter( 'embed_oembed_discover', '__return_false' );
     // Don't filter oEmbed results.
     remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
     // Remove oEmbed discovery links.
     remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
     // Remove oEmbed-specific JavaScript from the front-end and back-end.
     remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    // Remove all embeds rewrite rules.
   // add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

 }
 add_action( 'after_setup_theme', 'remove_json_api' );

 
