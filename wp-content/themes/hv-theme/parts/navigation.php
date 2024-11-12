<?php
?>
<nav class="navigation">
	<a class="navigation-logo" href="/">
		<img class="navigation-logo" src="/wp-content/themes/hv-theme/assets/images/app-logo.svg" />
	</a>
	<?php
	if ( has_nav_menu( 'header-menu' ) ) {
		wp_nav_menu( array(
			'theme_location' => 'header-menu',
			'container' => 'div',
			'container_class' => 'navigation-nav',
			'menu_class' => '',
			'walker' => new Custom_Walker_Nav_Menu(),
	  	'items_wrap' => '%3$s',
		) );
	}
	?>
	<div class="navigation-action">
		<a href="/cart" class="button button-solid-secondary">
			<img src="/wp-content/themes/hv-theme/assets/images/icons/shopping-cart-box.svg" alt="" />
			кошик
		</a>

		<button class="burger-btn">
            <span></span>
            <span></span>
            <span></span>
        </button>
	</div>
</nav>
