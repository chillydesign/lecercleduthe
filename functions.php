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
         $tva_number = ( ! empty( $_POST['tva_number'] ) ) ? sanitize_text_field( $_POST['tva_number'] ) : '';
         $first_name = ( ! empty( $_POST['first_name'] ) ) ? sanitize_text_field( $_POST['first_name'] ) : '';
         $last_name = ( ! empty( $_POST['last_name'] ) ) ? sanitize_text_field( $_POST['last_name'] ) : '';
         $billing_company = ( ! empty( $_POST['billing_company'] ) ) ? sanitize_text_field( $_POST['billing_company'] ) : '';
         $billing_phone = ( ! empty( $_POST['billing_phone'] ) ) ? sanitize_text_field( $_POST['billing_phone'] ) : '';
         $billing_address_1 = ( ! empty( $_POST['billing_address_1'] ) ) ? sanitize_text_field( $_POST['billing_address_1'] ) : '';
         $billing_address_2 = ( ! empty( $_POST['billing_address_2'] ) ) ? sanitize_text_field( $_POST['billing_address_2'] ) : '';
         $billing_city = ( ! empty( $_POST['billing_city'] ) ) ? sanitize_text_field( $_POST['billing_city'] ) : '';
         $billing_postcode = ( ! empty( $_POST['billing_postcode'] ) ) ? sanitize_text_field( $_POST['billing_postcode'] ) : '';
         $billing_country = ( ! empty( $_POST['billing_country'] ) ) ? sanitize_text_field( $_POST['billing_country'] ) : 'CH';
         $remarque = ( ! empty( $_POST['remarque'] ) ) ? sanitize_text_field( $_POST['remarque'] ) : '';

         ?>
         <h4>Personne de contact</h4>


         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
             <label for="last_name"><?php _e( 'Nom', 'webfactor' ); ?> <span class="required">*</span> </label>
             <input type="text" required class="input-text" name="last_name" id="last_name" value="<?php echo $last_name; ?>" />
         </p>

         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
             <label for="first_name"><?php _e( 'Prénom', 'webfactor' ); ?> <span class="required">*</span> </label>
             <input type="text" required class="input-text" name="first_name" id="first_name" value="<?php echo $first_name; ?>" />
         </p>


         <h4>Société</h4>
         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
             <label for="billing_company"><?php _e( 'Nom de la société', 'webfactor' ); ?> <span class="required">*</span> </label>
             <input type="text" required class="input-text" name="billing_company" id="billing_company" value="<?php echo $billing_company; ?>" />
         </p>

         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
             <label for="tva_number"><?php _e( 'Numéro de TVA', 'webfactor' ); ?> <span class="required">*</span> </label>
             <input type="text" required class="input-text" name="tva_number" id="tva_number" value="<?php echo $tva_number; ?>" />
             <span><em>Si votre société n’est pas soumise à TVA veuillez nous écrire à l’adresse info@lecercleduthe.com avec les informations essentielles ainsi que l’objet de votre demande</em></span>
         </p>


         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
             <label for="billing_phone"><?php _e( 'Numéro de téléphone', 'webfactor' ); ?> <span class="required">*</span> </label>
             <input type="text" required class="input-text" name="billing_phone" id="billing_phone" value="<?php echo $billing_phone; ?>" />
         </p>


         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
             <label for="billing_address_1"><?php _e( 'billing_address_1', 'webfactor' ); ?> <span class="required">*</span> </label>
             <input type="text" required class="input-text" name="billing_address_1" id="billing_address_1" value="<?php echo $billing_address_1; ?>" />
         </p>
         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
             <label for="billing_address_2"><?php _e( 'billing_address_2', 'webfactor' ); ?> </label>
             <input type="text"  class="input-text" name="billing_address_2" id="billing_address_2" value="<?php echo $billing_address_2; ?>" />
         </p>
         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
             <label for="billing_city"><?php _e( 'billing_city', 'webfactor' ); ?> <span class="required">*</span> </label>
             <input type="text" required class="input-text" name="billing_city" id="billing_city" value="<?php echo $billing_city; ?>" />
         </p>
         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
             <label for="billing_postcode"><?php _e( 'billing_postcode', 'webfactor' ); ?> <span class="required">*</span> </label>
             <input type="text" required class="input-text" name="billing_postcode" id="billing_postcode" value="<?php echo $billing_postcode; ?>" />
         </p>
         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
             <label for="billing_country"><?php _e( 'billing_country', 'webfactor' ); ?> <span class="required">*</span> </label>
             <select name="billing_country" id="billing_country">
                 <?php $countries  = WC()->countries->get_countries(); ?>
                 <?php foreach ($countries as $code => $country) : ?>
                     <?php $selected =  ($code ==  $billing_country ) ? 'selected="selected"' : ''; ?>
                     <option <?php echo $selected; ?> value="<?php echo $code; ?>"><?php echo $country; ?></option>
                 <?php endforeach; ?>

             </select>

         </p>


         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
             <label for="billing_country"><?php _e( 'Remarque', 'webfactor' ); ?> </label>
             <textarea  name="remarque" id="remarque"><?php echo $remarque; ?></textarea>
         </p>




         <?php
     }; // if for professional form
 }

 // IF WANT VAT NUMBER AND OTHER FIELDS TO BE REQUIRED
 add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );
 function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
     if (is_professional_signup_form()) {

         if ( isset( $_POST['tva_number'] ) && empty( $_POST['tva_number'] ) ) {
             $validation_errors->add( 'tva_number', __( ' VAT number is required!', 'woocommerce' ) );
         }
         if ( isset( $_POST['billing_company'] ) && empty( $_POST['billing_company'] ) ) {
             $validation_errors->add( 'billing_company', __( ' Nom de la société is required!', 'woocommerce' ) );
         }
         if ( isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) ) {
             $validation_errors->add( 'billing_phone', __( ' Phone number is required!', 'woocommerce' ) );
         }
         if ( isset( $_POST['billing_address_1'] ) && empty( $_POST['billing_address_1'] ) ) {
             $validation_errors->add( 'billing_address_1', __( ' Billing address is required!', 'woocommerce' ) );
         }
         if ( isset( $_POST['billing_postcode'] ) && empty( $_POST['billing_postcode'] ) ) {
             $validation_errors->add( 'billing_postcode', __( ' Postcode is required!', 'woocommerce' ) );
         }


         return $validation_errors;
     }; // if for professional form
 }


function chilly_field_set_in_post($field) {
    if (isset($_POST[$field])) {
        if ($_POST[$field] != '' ) {
            return true;
        }
    }
    return false;
}





 add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );
 function wooc_save_extra_register_fields( $customer_id ) {

     if (is_professional_signup_form()) {
         // if have all the required fields to be proffessional
         if (
             chilly_field_set_in_post( 'tva_number' )   &&
             chilly_field_set_in_post( 'billing_company' )   &&
             chilly_field_set_in_post( 'billing_phone' )   &&
             chilly_field_set_in_post( 'billing_address_1' )   &&
             chilly_field_set_in_post( 'billing_postcode' )
          ) {



             update_user_meta($customer_id, 'first_name', sanitize_text_field( $_POST['first_name']));
             update_user_meta($customer_id, 'last_name', sanitize_text_field( $_POST['last_name']));
             update_user_meta($customer_id, 'billing_company', sanitize_text_field( $_POST['billing_company']));
             update_user_meta($customer_id, 'tva_number', sanitize_text_field( $_POST['tva_number']));
             update_user_meta($customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone']));
             update_user_meta($customer_id, 'billing_address_1', sanitize_text_field( $_POST['billing_address_1']));
             update_user_meta($customer_id, 'billing_address_2', sanitize_text_field( $_POST['billing_address_2']));
             update_user_meta($customer_id, 'billing_city', sanitize_text_field( $_POST['billing_city']));
             update_user_meta($customer_id, 'billing_postcode', sanitize_text_field( $_POST['billing_postcode']));
             update_user_meta($customer_id, 'billing_country', sanitize_text_field( $_POST['billing_country']));
             update_user_meta($customer_id, 'remarque', sanitize_text_field( $_POST['remarque']));


             $customer = new WP_User( $customer_id );
             // Remove role
             $customer->remove_role( 'customer' );
             // Add role
             $customer->add_role( 'professional_customer' );


             // send email to notify admin
             $mailer = WC()->mailer();
             $headers = "Content-Type: text/html\r\n";
             $recipient =   get_option( 'admin_email' );
             $subject = __('Le Cercle du thé : Création d’un nouveau compte professionnel', 'chilly');
             $template = 'emails/admin-new-customer.php';
             $contents =  wc_get_template_html( $template, array(
                 'customer'      => $customer,
                 'email_heading' => $subject,
                 'sent_to_admin' => true,
                 'plain_text'    => false,
                 'email'         => $mailer
             ) );


             $mailer->send( $recipient, $subject, $contents, $headers );



         }
     }; // if for professional form
 }
 // PROFESSIONAL SIGN UP FORM





 // SHOW EXTRA USER META ON ADMIN PAGES  // tva_number // remarque
 add_action( 'show_user_profile', 'chilly_extra_user_profile_fields' );
 add_action( 'edit_user_profile', 'chilly_extra_user_profile_fields' );
 add_action( 'personal_options_update', 'chilly_save_extra_user_profile_fields' );
 add_action( 'edit_user_profile_update', 'chilly_save_extra_user_profile_fields' );

 function chilly_save_extra_user_profile_fields( $user_id ) {
     if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

     update_user_meta( $user_id, 'tva_number', $_POST['tva_number'] );
     update_user_meta( $user_id, 'remarque', $_POST['remarque'] );
 }

 function chilly_extra_user_profile_fields( $user ) { ?>
     <h3>Extra Info</h3>
     <table class="form-table">
         <tr>
             <th><label for="tva_number">tva_number</label></th>
             <td>
                 <input type="text" id="tva_number" name="tva_number" size="20" value="<?php echo esc_attr( get_the_author_meta( 'tva_number', $user->ID )); ?>">
             </td>
         </tr>
         <tr>
             <th><label for="remarque">remarque</label></th>
             <td>
                 <textarea id="remarque" name="remarque"><?php echo esc_attr( get_the_author_meta( 'remarque', $user->ID )); ?></textarea>
             </td>
         </tr>
     </table>
 <?php
 }



 add_action('wp_enqueue_scripts', 'webfactor_styles'); // Add Theme Stylesheet
 function webfactor_styles(){
     // remove gutenberg css
     wp_dequeue_style( 'wp-block-library' );
 }


 add_action( 'wp_print_scripts', 'themeprefix_remove_password_strength', 100 );
 // CHARLES Remove password strength script
 function themeprefix_remove_password_strength() {
     if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
         wp_dequeue_script( 'wc-password-strength-meter' );
     }
 }
