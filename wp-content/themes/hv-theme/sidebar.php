<?php
?>
<aside>
	<form id="filter-form" class="filter-form">
		<div class="filter">
			<div class="filter-header active">
				<span class="filter-title">Фільтр</span>
			</div>
			<div class="filter-content">
				<div class="filter-content-box">
			<?php
			$current_selected_category = isset($_POST['categories']) ? intval($_POST['categories']) : 0;
			if (!$current_selected_category) {
				$default_category_slug = 'grinky'; // default category slug
				$default_category = get_term_by('slug', $default_category_slug, 'product_cat');
				$current_selected_category = $default_category ? $default_category->term_id : 0;
			}
			//get all category
			$product_categories = get_terms(array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
				'parent'     => 0,
			));

			foreach ($product_categories as $category) :
				$checked = ($category->term_id === $current_selected_category) ? 'checked' : '';
				?>
							<label class="control">
								<input type="radio" name="category-filter" class="category-filter" data-category-id="<?php echo esc_attr($category->term_id); ?>" <?php echo $checked; ?> />
								<span class="control-checkmark"></span>
				  <?php echo esc_html($category->name); ?>
							</label>
			<?php endforeach; ?>
				</div>
				<?php $show_all_sections = ($current_selected_category === 29); ?>
				<div class="filter-content-box" data-filter-type="package" style="<?php echo $show_all_sections ? '' : 'display: none;'; ?>">
					<label class="control">
						<input type="radio" name="filter-group" value="packaged" />
						<span class="control-radio"></span>
						Фасовані
					</label>
					<label class="control">
						<input type="radio" name="filter-group" value="weight" />
						<span class="control-radio"></span>
						Вагові
					</label>
				</div>

				<div class="filter-content-box" data-filter-type="mix" style="display: none;">
					<label class="control switch">
						<input type="checkbox">
						<span class="toggle round"></span>
						MIX смаків
					</label>
				</div>
				<div class="filter-content-count" style="display: none;">
					<div class="filter-content-label">Кількість смаків*</div>
					<div class="product-controls-wrapper">
						<button type="button" class="button-control minus">
							<img src="/wp-content/themes/hv-theme/assets/images/icons/minus.svg" alt="">
						</button>
						<span class="product-number">1</span>
						<button type="button" class="button-control plus">
							<img src="/wp-content/themes/hv-theme/assets/images/icons/plus.svg" alt="">
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="filter">
			<div class="filter-header active">
				<span class="filter-title">Смак</span>
			</div>
			<div class="filter-content tastes">
				<div class="filter-content-label">
			<?php if ( $current_selected_category === 29 ) {
					 _e('Смаки грінок*', 'hv-theme');
					 } else {
		  _e( 'Смаки вергосів*', 'hv-theme' );
	  }
				?>
				</div>
				<div class="filter-content-box sub-categories">
			<?php
	  $current_category_id = $current_selected_category;
			if ( $current_category_id ) {
				$subcategories = get_terms( array(
					'taxonomy'   => 'product_cat',
					'hide_empty' => true,
					'parent'     => $current_category_id,
				) );

				if ( ! empty( $subcategories ) ) {
					foreach ( $subcategories as $subcategory ) :
			  $size = 'thumbnail';
			  $thumbnail_id = get_term_meta( $subcategory->term_id, 'thumbnail_id', $size );
			  $icon_url = wp_get_attachment_url( $thumbnail_id );
						?>
											<div class="filter-content-wrapper">
												<label class="control">
													<input type="checkbox" name="taste-<?php echo esc_attr( $subcategory->slug ); ?>" />
													<span class="control-checkmark"></span>
													<img src="<?php echo esc_url( $icon_url ); ?>" alt="<?php echo esc_attr( $subcategory->name ); ?>" />
												</label>
												<div class="filter-content-title"><?php echo esc_html( $subcategory->name ); ?></div>
											</div>
					<?php
					endforeach;
				} else {
					echo '<p>No subcategories available.</p>';
				}
			} else {
				echo '<p>Select a category to see subcategories.</p>';
			}
			?>
				</div>
			</div>
		</div>
		<div class="filter sum">
			<span class="filter-title">Загалом</span>
			<button class="button button-sum">
				<span class="composition">Склад продукту</span>
				<span class="value">Маса нетто - 900 г. (≈ 120 грінок)</span>
			</button>
<!--				Замовити на 200 ₴-->
				<?php custom_add_to_cart_in_sidebar();?>
		</div>
	</form>
</aside>