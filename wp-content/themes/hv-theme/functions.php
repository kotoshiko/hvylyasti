<?php
function hv_theme_setup() {
	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	// Регистрация меню
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'my-custom-theme' ),
	) );

	// Поддержка WooCommerce
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'hv_theme_setup' );


function hv_theme_scripts() {
	wp_enqueue_style('hv-style', get_stylesheet_directory_uri() . '/assets/main.css', array(), '1.0', 'all');
	wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'hv_theme_scripts' );


defined( 'ABSPATH' ) || exit(); // Exit if accessed directly.
if ( ! class_exists( 'Hv_Plus_Minus' ) ) {
	/**
	 * Main Class.
	 */
	class Hv_Plus_Minus {
		/**
		 * The instance variable of the class.
		 *
		 * @var $instance.
		 */
		protected static $instance = null;
		/**
		 * Constructor of this class.
		 */
		public function __construct() {
			add_action( 'woocommerce_after_quantity_input_field', array( $this, 'hv_display_quantity_plus' ) );
			add_action( 'woocommerce_before_quantity_input_field', array( $this, 'hv_display_quantity_minus' ) );
			add_action( 'wp_footer', array( $this, 'hv_add_cart_quantity_plus_minus' ) );
		}
		public function hv_display_quantity_plus() {
			echo '<button type="button" class="plus">+</button>';
		}
		public function hv_display_quantity_minus() {
			echo '<button type="button" class="minus">-</button>';
		}
		public function hv_add_cart_quantity_plus_minus() {
			if ( ! is_product() && ! is_cart() ) {
				return;
			}
			wc_enqueue_js(
				"$(document).on( 'click', 'button.plus, button.minus', function() {
                    var qty = $( this ).parent( '.quantity' ).find( '.qty' );
                    var val = parseFloat(qty.val());
                    var max = parseFloat(qty.attr( 'max' ));
                    var min = parseFloat(qty.attr( 'min' ));
                    var step = parseFloat(qty.attr( 'step' ));
                    if ( $( this ).is( '.plus' ) ) {
                        if ( max && ( max <= val ) ) {
                        qty.val( max ).change();
                        } else {
                        qty.val( val + step ).change();
                        }
                    } else {
                        if ( min && ( min >= val ) ) {
                        qty.val( min ).change();
                        } else if ( val > 1 ) {
                        qty.val( val - step ).change();
                        }
                    }
                });"
			);
		}
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
	}
}
Hv_Plus_Minus::get_instance();

















