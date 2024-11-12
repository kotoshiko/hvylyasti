<?php
wp_head();
?>
<body id="app">
<div class="header-container">
	<?php render_primary_menu(); ?>
	<div class="header-bottom">
		<?php  get_template_part('parts/navigation')?>
	</div>
	<?php  get_template_part('parts/navigation-mobile')?>
</div>