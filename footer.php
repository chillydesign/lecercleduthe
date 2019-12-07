<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Shop Isle
 */
?>
<?php do_action( 'shop_isle_before_footer' ); ?>

	<?php do_action( 'shop_isle_footer' ); ?>

	</div>
	<!-- Wrapper end -->
	<!-- Scroll-up -->
	<div class="scroll-up">
		<a href="#totop"><i class="arrow_carrot-2up"></i></a>
	</div>

	<?php do_action( 'shop_isle_after_footer' ); ?>

<?php wp_footer(); ?>


<?php if ( is_checkout() ): ?>
<div id="popup_legal" style="display:none">
	<div id="popup_legal_inner">
		<div id="popup_legal_inner_text">
		</div>
	</div>
</div>
<?php endif; ?>

</body>
</html>
