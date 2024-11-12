<?php
?>
<div class="navigation-mobile">
	<?php
	// Header
	wp_nav_menu( array(
		'theme_location' => 'header_menu',
		'container'      => false,
		'items_wrap'     => '%3$s',
		'menu_class'     => 'navigation-nav-link',
		'link_before'    => '',
		'link_after'     => '',
	) );
	?>

    <div class="divider"></div>

	<?php
	// Footer меню
	wp_nav_menu( array(
		'theme_location' => 'footer_menu',
		'container'      => false,
		'items_wrap'     => '%3$s',
		'walker'         => new Mobile_Footer_Menu_Walker(),
	) );
	?>
</div>
