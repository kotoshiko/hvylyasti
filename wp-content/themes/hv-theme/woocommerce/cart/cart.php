<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;
?>
<main class="main-container">
	<div class="main-content">
		<section class="cart-section">
			<div class="title-section">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/bg-wave.png" class="bg-wave" alt=""/>
				<div class="title-section-inner">
					<h1 class="title title-big">Кошик</h1>
				</div>
			</div>
			<div class="cart">
				<div>
			<?php do_action( 'woocommerce_before_cart' ); ?>
				</div>
				<div class="cart-inner">
					<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			  <?php do_action( 'woocommerce_before_cart_table' ); ?>
						<table class="cart-table shop_table shop_table_responsive cart woocommerce-cart-form__contents">
							<thead>
							<tr class="cart-header">
								<th class="cart-title"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
								<th class="cart-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
								<th class="cart-number"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
								<th class="cart-total"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
							</tr>
							</thead>
							<tbody>
			  <?php do_action( 'woocommerce_before_cart_contents' ); ?>
			  <?php
			  foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				  $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				  $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				  $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

				  if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					  $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					  ?>
										<tr class="cart-product woocommerce-cart-form__cart-item
										<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
											<td class="cart-product-title product-name"
													data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						  <?php
						  if ( ! $product_permalink ) {
							  echo wp_kses_post( $product_name );
						  } else {
							  echo wp_kses_post( sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ) );
						  }
						  ?>
											</td>
											<td class="cart-product-price product-price"
													data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
						  <?php echo WC()->cart->get_product_price( $_product ); ?>
											</td>
											<td class="cart-product-number product-quantity"
													data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						  <?php
						  echo woocommerce_quantity_input( array(
							  'input_name'  => "cart[{$cart_item_key}][qty]",
							  'input_value' => $cart_item['quantity'],
							  'max_value'   => $_product->get_max_purchase_quantity(),
							  'min_value'   => '0',
						  ), $_product, false );
						  ?>
											</td>
											<td class="cart-product-total product-subtotal"
													data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
						  <?php echo WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ); ?>
											</td>
										</tr>
					  <?php
				  }
			  }
			  ?>
			  <?php do_action( 'woocommerce_after_cart_contents' ); ?>
							</tbody>
						</table>
			  				<?php do_action( 'woocommerce_after_cart_table' ); ?>
							<button type="submit"
										class="button <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ?
												' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"
										name="update_cart"
										value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
									<?php esc_html_e( 'Update cart', 'woocommerce' ); ?>
							</button>

			  				<?php  do_action( 'woocommerce_cart_actions' );
			  				 			 wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' );
											 do_action( 'woocommerce_after_cart_contents' );
											 do_action( 'woocommerce_after_cart_table' ); ?>

					</form>
								<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
								<?php do_action( 'woocommerce_cart_collaterals' ); ?>

				</div>
			</div>
		<?php do_action( 'woocommerce_after_cart' ); ?>
	</section>
	</div>
</main>
