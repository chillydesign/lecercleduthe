<?php
/**
* Admin new order email
*
* This template can be overridden by copying it to yourtheme/woocommerce/emails/admin-new-order.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see https://docs.woocommerce.com/document/template-structure/
* @package WooCommerce/Templates/Emails/HTML
* @version 3.5.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
* @hooked WC_Emails::email_header() Output the email header
*/
do_action( 'woocommerce_email_header', $email_heading, $email );

$customer = get_user_by( 'id', $customer_id );


$first_name = get_user_meta($customer_id, 'first_name');
$last_name = get_user_meta($customer_id, 'last_name');
$billing_company = get_user_meta($customer_id, 'billing_company');
$tva_number = get_user_meta($customer_id, 'tva_number');
$billing_phone = get_user_meta($customer_id, 'billing_phone');
$billing_address_1 = get_user_meta($customer_id, 'billing_address_1');
$billing_address_2 = get_user_meta($customer_id, 'billing_address_2');
$billing_city = get_user_meta($customer_id, 'billing_city');
$billing_postcode = get_user_meta($customer_id, 'billing_postcode');
$billing_country = get_user_meta($customer_id, 'billing_country');
$remarque = get_user_meta($customer_id, 'remarque');


$styling = 'padding:7px;font-size:13px;border:0;margin:0';

?>

<table>

    <tr>
        <td <?php echo $styling; ?>><strong>Prénom</strong></td>
        <td <?php echo $styling; ?>><?php echo $first_name; ?></td>
    </tr>
    <tr>
        <td <?php echo $styling; ?>><strong>Nom</strong></td>
        <td <?php echo $styling; ?>><?php echo $last_name; ?></td>
    </tr>
    <tr>
        <td <?php echo $styling; ?>><strong>Adresse email</strong></td>
        <td <?php echo $styling; ?>><?php echo $customer->user_email; ?></td>
    </tr>
    <tr>
        <td <?php echo $styling; ?>><strong>Nom de la société</strong></td>
        <td <?php echo $styling; ?>><?php echo $billing_company; ?></td>
    </tr>
    <tr>
        <td <?php echo $styling; ?>><strong>Numéro de TVA</strong></td>
        <td <?php echo $styling; ?>><?php echo $tva_number; ?></td>
    </tr>
    <tr>
        <td <?php echo $styling; ?>><strong>Numéro de téléphone</strong></td>
        <td <?php echo $styling; ?>><?php echo $billing_phone; ?></td>
    </tr>
    <tr>
        <td <?php echo $styling; ?>><strong>Adresse complète</strong></td>
        <td <?php echo $styling; ?>>
            <?php echo $billing_address_1; ?>  <br>
            <?php echo $billing_address_2; ?> <br>
            <?php echo $billing_city; ?> <br>
            <?php echo $billing_postcode; ?> <br>
            <?php echo $billing_country; ?>
        </td>
    </tr>
    <tr>
        <td <?php echo $styling; ?>><strong>remarque</strong></td>
        <td <?php echo $styling; ?>><?php echo $remarque; ?></td>
    </tr>
</table>



<?php
/*
* @hooked WC_Emails::email_footer() Output the email footer
*/
do_action( 'woocommerce_email_footer', $email );
