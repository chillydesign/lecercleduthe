<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package WordPress
 * @subpackage Shop Isle
 */

get_header(); 


update_weight_to_hundred_prods();  ?>
	<!-- Wrapper start -->
	<div class="main">

		<!-- Home start -->
		<?php

		$shop_isle_404_background = get_theme_mod( 'shop_isle_404_background', get_template_directory_uri() . '/assets/images/404.jpg' );

		if ( ! empty( $shop_isle_404_background ) ) :
			echo '<section class="home-section home-parallax home-fade home-full-height bg-dark error-page-background" data-background="' . esc_url( $shop_isle_404_background ) . '">';
		else :
			echo '<section class="home-section home-parallax home-fade home-full-height bg-dark error-page-background">';
		endif;
		?>
			<div class="hs-caption">
				<div class="caption-content">


                    <div class="hs-title-size-4 font-alt mb-30 error-page-title">
                        Erreur 404
                    </div>
                    <div class="font-alt error-page-text">
                        L'URL demandée n'a pas été trouvée sur ce serveur. <br> C'est tout ce que nous savons.
                    </div>


                    <div class="font-alt mt-30 error-page-button-text">
                        <a href="<?php echo  esc_url( home_url( '/' ) ); ?>" class="btn btn-border-w btn-round">Retour à la page d'accueil</a>
                    </div>

				</div>
			</div>

		</section >
		<!-- Home end -->

<?php get_footer(); ?>
