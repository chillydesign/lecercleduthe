<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @package WordPress
 * @subpackage Shop Isle
 */

/**
 * Class Shopisle_Customizer_Upsell
 *
 * @since  1.0.0
 * @access public
 */
final class Shopisle_Customizer_Upsell {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {
	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param  object $manager - the wp_customizer object.
	 *
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'inc/customizer/customize-pro/class-shopisle-customizer-upsell-main.php' );
		require_once( trailingslashit( get_template_directory() ) . 'inc/customizer/customize-pro/class-shopisle-customizer-upsell-text.php' );
		require_once( trailingslashit( get_template_directory() ) . 'inc/customizer/customize-pro/class-shopisle-customizer-upsell-section.php' );

		// Register custom section types.
		$manager->register_section_type( 'Shopisle_Customizer_Upsell_Main' );
		$manager->register_section_type( 'Shopisle_Customizer_Upsell_Text' );


        // NOTE CHARLES REMOVE REFERENCE TO SHOP ISLE DOCUMENTATION
		// Register sections.
		// Main Upsell In Customizer Root.
		// $manager->add_section(
		// 	new Shopisle_Customizer_Upsell_Main(
		// 		$manager,
		// 		'shopisle-upsell',
		// 		array(
		// 			'upsell_title' => __( 'Shop Isle', 'shop-isle' ),
		// 			'label_url'    => 'http://docs.themeisle.com/article/421-shop-isle-documentation-wordpress-org',
		// 			'label_text'   => __( 'Documentation', 'shop-isle' ),
		// 		)
		// 	)
		// );


        // NOTE CHARLES REMOVE REFERENCE TO VIEW PRO VERSION
		// // Frontpage Sections Upsell.
		// $manager->add_section(
		// 	new Shopisle_Customizer_Upsell_Section(
		// 		$manager,
		// 		'shopisle-upsell-section',
		// 		array(
		// 			'panel'       => 'shop_isle_front_page_sections',
		// 			'priority'    => 500,
		// 			'options'     => array(
		// 				esc_html__( 'Categories Section', 'shop-isle' ),
		// 				esc_html__( 'Map Section', 'shop-isle' ),
		// 				esc_html__( 'Ribbon Section', 'shop-isle' ),
		// 				esc_html__( 'Services Section', 'shop-isle' ),
		// 				esc_html__( 'Add New Sections', 'shop-isle' ),
		// 			),
		// 			'button_url'  => esc_url( 'https://themeisle.com/themes/shop-isle-pro/upgrade/' ),
		// 			'button_text' => esc_html__( 'View PRO version', 'shop-isle' ),
		// 		)
		// 	)
		// );

		// Frontpage Instructions.
		if ( 'page' === get_option( 'show_on_front' ) ) {

			$manager->add_section(
				new Shopisle_Customizer_Upsell_Text(
					$manager,
					'shopisle-upsell-frontpage-instructions',
					array(
						'upsell_text' =>
						sprintf(
							/* translators: 1: Link to static front page customizer control */__( 'To customize the Frontpage sections please go to %1$s and select "Your Latest Posts".', 'shop-isle' ),
							sprintf(
								/* translators: 1: Link to static front page customizer control 2: 'Static Front Page' */
								'<a class="shop_isle_go_to_section" href="%1$s">%2$s</a>',
								admin_url( 'customize.php?autofocus[control]=show_on_front' ),
								esc_html__( 'Static Front Page', 'shop-isle' )
							)
						),
						'panel'       => 'shop_isle_front_page_sections',
						'priority'    => 1,
					)
				)
			);
		}
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'shopisle-upsell-js', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/customize-pro/shopisle-upsell-customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'shopisle-upsell-style', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/customize-pro/shopisle-upsell-customize-controls.css' );
	}
}

Shopisle_Customizer_Upsell::get_instance();
