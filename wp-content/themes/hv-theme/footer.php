

<footer id="colophon" class="site-footer">
	<div class="site-footer__inner">
		<?php
		if ( is_active_sidebar( 'footer-sidebar' ) ) {
			dynamic_sidebar( 'footer-sidebar' );
		}
		?>

		<div class="site-info">
			&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'hv-theme' ); ?>
		</div><!-- .site-info -->
	</div><!-- .site-footer__inner -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>
