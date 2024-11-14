<?php
?>
<div class="navigation-mobile">
	<?php
	// Header
  wp_nav_menu( array(
	  'theme_location' => 'header-menu',
	  'container'      => false,
	  'items_wrap'     => '%3$s', // Убирает ul
	  'walker'         => new Mobile_Header_Walker(), // Используем кастомный волкер
  ) );


  ?>

    <div class="divider"></div>

	<?php
	// Footer меню
	wp_nav_menu( array(
		'theme_location' => 'primary',
		'container'      => false,
		'items_wrap'     => '%3$s',
		'walker'         => new Mobile_Primary_Menu_Walker(),
	) );
	?>
</div>
