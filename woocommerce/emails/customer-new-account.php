<?php
/**
* Customer new account email
*
* This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see https://docs.woocommerce.com/document/template-structure/
* @package WooCommerce/Templates/Emails
* @version 3.7.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>


<?php $is_professional = false;
$customer =  get_user_by( 'login', $user_login );
if ($customer):
    $tva_number  = get_user_meta( $customer->ID, 'tva_number', true );
    if ( $tva_number && $tva_number != '' ):
        $is_professional = true;
    endif; // end if is professional customer
endif; //  end if customer
?>


<?php /* translators: %s Customer username */ ?>
<p>Bonjour, </p>

<?php if ($is_professional) : ?>

    <p>Nous vous confirmons la création de votre compte professionnel pour l’achat de produits sur notre site lecercleduthe.com. Votre compte professionnel vous donne accès à des produits exclusifs, des offres en gros et des réductions sur nos produits.</p>

<?php else: // if not professional user  ?>

    <p>Nous vous confirmons la création de votre compte sur le site du Cercle du Thé. Vous pouvez vous y connecter pour accéder à l'historique de vos commandes.</p>

<?php endif;  // end if is not professional user ?>

<p>Vous pouvez vous connecter à votre compte à l’adresse <a href="<?php echo  esc_url( wc_get_page_permalink('myaccount')); ?>">lecercleduthe.com</a> avec votre adresse email et le mot de passe que vous avez choisi pour démarrer vos achats.</p>

<p>A bientôt sur lecercleduthe.com!</p>

<p>L’équipe du Cercle du Thé</p>



<?php
do_action( 'woocommerce_email_footer', $email );
