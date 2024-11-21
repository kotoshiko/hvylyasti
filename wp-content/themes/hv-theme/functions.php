<?php
function hv_theme_setup() {
	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	// Регистрация меню
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'hv-theme' ),
		'header-menu' => __( 'Header Menu', 'hv-theme' ), // Меню для хедера
		'footer-menu-1' => __( 'Footer Menu 1', 'hv-theme' ), // Первое меню для футера
		'footer-menu-2' => __( 'Footer Menu 2', 'hv-theme' ), // Второе меню для футера
	) );

	// Поддержка WooCommerce
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'hv_theme_setup' );
//remove woocommerce breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
//remove woocommerce default sorting
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
function hv_enqueue_swiper() {
	// Подключение Swiper CSS
	wp_enqueue_style( 'swiper-css', get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.css', array(), '8.4.5' );

	// Подключение Swiper JS
	wp_enqueue_script( 'swiper-js', get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js', array(), '8.4.5', true );

	// Подключение Вашего Скрипта для Инициализации Swiper
	wp_enqueue_script( 'hv-swiper-init', get_template_directory_uri() . '/assets/js/swiper-init.js', array( 'swiper-js' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'hv_enqueue_swiper' );


function hv_theme_scripts() {
	wp_enqueue_style('hv-style', get_stylesheet_directory_uri() . '/assets/main.css', array(), '1.0', 'all');
	wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'burger-button-script', get_template_directory_uri() . '/assets/js/burger-button.js', array(), '1.0', true );
	wp_enqueue_script( 'trends-section-tabs-script', get_template_directory_uri() . '/assets/js/trends-section-tabs.js', array(), '1.0', true );
	if (is_shop()){
		wp_enqueue_script( 'hv-shop', get_template_directory_uri() . '/assets/js/shop.js', array(), '1.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'hv_theme_scripts' );

/* START ajax filter product*/

add_action('wp_enqueue_scripts', function() {
	wp_enqueue_script('shop-js', get_template_directory_uri() . '/assets/js/shop.js', ['jquery'], '1.0', true);

	// Передача AJAX URL
	wp_localize_script('shop-js', 'hv_theme', [
		'ajax_url' => admin_url('admin-ajax.php'),
	]);
});



add_action('wp_ajax_filter_products', 'filter_products_callback');
add_action('wp_ajax_nopriv_filter_products', 'filter_products_callback');

function filter_products_callback() {
	// Получаем выбранную категорию из POST
	$selected_category = isset($_POST['categories']) ? intval($_POST['categories']) : 0; // Теперь это просто ID, а не массив

	if (!$selected_category) {
		echo '<p>No category selected.</p>';
		wp_die();
	}

	// Формируем запрос
	$args = [
		'post_type' => 'product',
		'posts_per_page' => -1,
		'tax_query' => [
			[
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $selected_category, // Используем значение переменной
			],
		],
	];

	// Логируем аргументы запроса
	error_log(print_r($args, true));

	$query = new WP_Query($args);

	// Проверяем, есть ли товары
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			wc_get_template_part('content', 'product');
		}
	} else {
		error_log('No products found for category ID: ' . $selected_category);
		echo '<p>No products found for this category.</p>';
	}

	wp_die();
}


/*END ajax filter product*/


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

//menu walker class
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="navigation-nav-link ' . esc_attr( $class_names ) . '"' : ' class="navigation-nav-link"';

		$attributes  = ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';

		$output .= '<a' . $attributes . $class_names . '>';
		$output .= apply_filters( 'the_title', $item->title, $item->ID );
		$output .= '</a>';
	}

	function end_el( &$output, $item, $depth = 0, $args = null ) {
		$output .= "\n";
	}
}

function render_primary_menu() {
	$locations = get_nav_menu_locations();
	if ( isset( $locations['primary'] ) ) {
		$menu = wp_get_nav_menu_items( $locations['primary'] );

		if ( !empty( $menu ) ) {
			echo '<div class="header-top">';
			foreach ( $menu as $menu_item ) {
				$icon = '';
				if ( in_array( 'menu-instagram', $menu_item->classes ) ) {
					$icon = get_template_directory_uri() . '/assets/images/icons/contacts/instagram.svg';
				} elseif ( in_array( 'menu-facebook', $menu_item->classes ) ) {
					$icon = get_template_directory_uri() . '/assets/images/icons/contacts/facebook.svg';
				} elseif ( in_array( 'menu-mail', $menu_item->classes ) ) {
					$icon = get_template_directory_uri() . '/assets/images/icons/contacts/mail.svg';
				} elseif ( in_array( 'menu-phone', $menu_item->classes ) ) {
					$icon = get_template_directory_uri() . '/assets/images/icons/contacts/phone.svg';
				}

				echo '<a class="header-top-link" href="' . esc_url( $menu_item->url ) . '" target="_blank" rel="noopener noreferrer">
                    <img src="' . esc_url( $icon ) . '" alt="" />
                    <span class="header-top-link-text">' . esc_html( $menu_item->title ) . '</span>
                </a>';
			}
			echo '</div>';
		}
	}
}

class Footer_Menu_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		// Уровень вложенности не используется, так как меню плоское.
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		// Закрытие уровня вложенности, если бы он использовался.
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$icon = '';

		if ( in_array( 'menu-instagram', $item->classes ) ) {
			$icon = get_template_directory_uri() . '/assets/images/icons/contacts/instagram_white.svg';
		} elseif ( in_array( 'menu-facebook', $item->classes ) ) {
			$icon = get_template_directory_uri() . '/assets/images/icons/contacts/facebook_white.svg';
		} elseif ( in_array( 'menu-mail', $item->classes ) ) {
			$icon = get_template_directory_uri() . '/assets/images/icons/contacts/mail_white.svg';
		} elseif ( in_array( 'menu-phone', $item->classes ) ) {
			$icon = get_template_directory_uri() . '/assets/images/icons/contacts/phone_white.svg';
		}

		$output .= '<a class="footer-top-link" href="' . esc_url( $item->url ) . '" target="_blank" rel="noopener noreferrer">';

		if ( $icon ) {
			$output .= '<img src="' . esc_url( $icon ) . '" alt="" />';
		}

		$output .= '<span class="footer-top-link-text">' . esc_html( $item->title ) . '</span></a>';
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		// Закрытие элемента меню.
	}
}

class Mobile_Primary_Menu_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$output .= '<a class="header-top-link" href="' . esc_url( $item->url ) . '"';

		if ( ! empty( $item->target ) ) {
			$output .= ' target="' . esc_attr( $item->target ) . '"';
		}

		if ( ! empty( $item->xfn ) ) {
			$output .= ' rel="' . esc_attr( $item->xfn ) . '"';
		}

		$output .= '>';

		// Выводим текст ссылки
		$output .= '<span class="header-top-link-text">' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>';
		$output .= '</a>';
	}
}

class Mobile_Header_Walker extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = null ) {
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$output .= sprintf(
			'<a class="navigation-nav-link" href="%s">%s</a>',
			esc_url( $item->url ),
			apply_filters( 'the_title', $item->title, $item->ID )
		);
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
	}
}

/*SVG support start*/
function add_svg_support($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'add_svg_support');

function sanitize_svg($file) {
	if ($file['type'] === 'image/svg+xml') {
		$svg = file_get_contents($file['tmp_name']);
		$svg = preg_replace('/<script[^>]*>.*?<\/script>/i', '', $svg); // Удаляем любые <script> теги
		file_put_contents($file['tmp_name'], $svg);
	}
	return $file;
}
add_filter('wp_handle_upload_prefilter', 'sanitize_svg');

function display_svg_in_media_library($response, $attachment, $meta) {
	if ($response['mime'] === 'image/svg+xml') {
		$response['sizes'] = array();
		$response['icon'] = wp_get_attachment_url($attachment->ID);
	}
	return $response;
}
add_filter('wp_prepare_attachment_for_js', 'display_svg_in_media_library', 10, 3);

/*SVG support end*/

/*custom button "add to cart"*/
function custom_add_to_cart_in_sidebar() {
	if ( is_shop() || is_product_category() || is_product_tag() ) {
		global $wp_query;

		// get first item on the page
		$products = $wp_query->posts;

		if ( ! empty( $products ) ) {
			$first_product_id = $products[0]->ID;

			echo '<button class="button button-solid-secondary">';
			echo do_shortcode( '[add_to_cart id="' . esc_attr( $first_product_id ) . '"]' );
			echo '</button>';
		}
	}
}


add_action( 'woocommerce_before_main_content', function() {
	if ( is_shop() || is_product_category() ) {
		// Убираем название
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

		// Убираем цену
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

		// Убираем кнопку "Добавить в корзину"
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	}
} );

add_filter( 'woocommerce_add_cart_item_data', 'add_category_data_to_cart_item', 10, 3 );

function add_category_data_to_cart_item( $cart_item_data, $product_id, $variation_id ) {
	// Получить объект товара
	$product = wc_get_product( $product_id );

	// Получить категории текущего товара
	$categories = wp_get_post_terms( $product_id, 'product_cat', array( 'fields' => 'names' ) );

	// Если категории существуют, добавляем текущую категорию
	if ( ! empty( $categories ) && is_array( $categories ) ) {
		$cart_item_data['custom_category_data'] = $categories[0]; // Имя первой категории текущего товара
	}

	// Возвращаем модифицированные данные
	return $cart_item_data;
}


add_action( 'woocommerce_checkout_create_order_line_item', 'add_custom_category_data_to_order', 10, 4 );

function add_custom_category_data_to_order( $item, $cart_item_key, $values, $order ) {
	if ( isset( $values['custom_category_data'] ) ) {
		$item->add_meta_data( 'Смаки', $values['custom_category_data'], true );
	}
}

/*add cart to checkout page*/

add_action( 'woocommerce_before_checkout_form', 'bbloomer_cart_on_checkout_page', 5 );

function bbloomer_cart_on_checkout_page() {
	echo do_shortcode( '[woocommerce_cart]' );
}

add_filter( 'woocommerce_get_cart_url', 'bbloomer_redirect_empty_cart_checkout_to_shop' );

function bbloomer_redirect_empty_cart_checkout_to_shop() {
	return ( isset( WC()->cart ) && ! WC()->cart->is_empty() ) ? wc_get_checkout_url() : wc_get_page_permalink( 'shop' );
}