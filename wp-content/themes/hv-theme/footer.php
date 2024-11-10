<?php
?>
<div class="footer-container">
	<img src="/wp-content/themes/hv-theme/assets/images/footer-wawe.svg" alt="">
	<div class="footer-top">
		<div class="footer-top-content">
			<a class="navigation-logo" href="/">
				<img class="navigation-logo" src="/wp-content/themes/hv-theme/assets/images/app-logo.svg" />
			</a>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'footer-menu-1',
			'container'      => 'div',
			'container_class' => 'footer-top-grid',
	  	'items_wrap'      => '%3$s',
			'walker'         => new Footer_Menu_Walker(),
		) );
		?>
		</div>
	</div>
	<div class="footer-bottom">
		<span class="copyright"></span> &nbsp; Хвилясті 2024
	</div>
</div>
</body>
<?php wp_footer();?>
