<?php
/**
 * Main functions file
 *
 * @package WordPress
 * @subpackage Shop Isle
 */



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








// ADD MAP SHORTCODE
 function chilly_map( $atts, $content = null ) {

     $attributes = shortcode_atts( array(
         'title' => "le Cercle du Thé",
         'lat' => 46.3837128,
         'lng' => 6.237599,
     ), $atts );



     $title = $attributes['title'];
     $lat = $attributes['lat'];
     $lng = $attributes['lng'];
     $chilly_map = '<div id="map_container"></div>';
     $chilly_map .= "<script> var map_location = {lat: ". $lat . ", lng:  ". $lng . ", title:  '" . $title . "'  }; </script>";
     return $chilly_map;

 }
 add_shortcode( 'chilly_map', 'chilly_map' );
// ADD MAP SHORTCODE




// ADD PROFESSIONAL Customer role.
add_action( 'init', 'add_professional_customer_role', 5 );
function add_professional_customer_role() {

    add_role(
        'professional_customer',
        'Professional Customer',
        array(
            'read' => true,
        )
    );

}
// ADD PROFESSIONAL Customer role.





 // do modal popup when add to cart
 add_action( 'woocommerce_add_to_cart', 'trigger_for_ajax_add_to_cart', 20, 6 );
 function trigger_for_ajax_add_to_cart( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ) {

     $product = get_post($product_id);
     $str = '<div  id="added_popup" class="white_popup">';
     $str .= "<p>L'article  <strong>" . $product->post_title . "</strong> a bien été ajouté à votre panier</p>" ;
     $str .= '<p>';
     $str .= '<a href="'. esc_url( wc_get_cart_url() )  .'" class="button button_black">Aller à mon panier</a>';
     $str .= ' <span>ou</span> ';
     $str .= '<a href="#" class="close_button button">Continuer mes achats</a>';
     $str .= '</p>';
     $str .= '</div>';
     $str .= '<script type="text/javascript"> var added_to_cart_now = true; </script>';
     echo $str;
 }
 // do modal popup when add to cart



// PROFESSIONAL SIGN UP FORM
 function is_professional_signup_form() {
     if (isset($_GET['register'])) {
         if ($_GET['register']  == 'professional' ) {
             return true;
         }
     }
     return false;

 }

 add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );
 function wooc_extra_register_fields() {
     if (is_professional_signup_form()) {
         $vat_number = ( ! empty( $_POST['billing_phone'] ) ) ? sanitize_text_field( $_POST['billing_phone'] ) : '';
         ?>
         <p class="form-row form-row-wide">
             <label for="billing_phone"><?php _e( 'Vat Number', 'woocommerce' ); ?> <span class="required">*</span> </label>
             <input type="text" required class="input-text" name="billing_phone" id="billing_phone" value="<?php echo $vat_number; ?>" />
         </p>
         <?php
     }; // if for professional form
 }

 // IF WANT VAT NUMBER TO BE PRESENT
 add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );
 function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
     if (is_professional_signup_form()) {

         if ( isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) ) {
             $validation_errors->add( 'billing_phone', __( ' VAT number is required!', 'woocommerce' ) );
         }
         return $validation_errors;
     }; // if for professional form
 }


 add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );
 function wooc_save_extra_register_fields( $customer_id ) {

     if (is_professional_signup_form()) {

         if ( isset( $_POST['billing_phone'] ) ) {
             $vat_number = $_POST['billing_phone'];
             if ($vat_number != '') {

                 // Phone input filed which is used in WooCommerce
                 update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $vat_number ) );

                 $customer = new WP_User( $customer_id );
                 // Remove role
                 $customer->remove_role( 'customer' );
                 // Add role
                 $customer->add_role( 'professional_customer' );
             }
         }
     }; // if for professional form
 }
 // PROFESSIONAL SIGN UP FORM
