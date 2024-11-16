<?php
?>
<aside><form class="filter-form">
		<div class="filter">
			<div class="filter-header active">
				<span class="filter-title">Фільтр</span>
			</div>
			<div class="filter-content">
				<div class="filter-content-box">
			  <?php
			  $product_categories = get_terms( array(
				  'taxonomy'   => 'product_cat',
				  'hide_empty' => true,
				  'parent'     => 0, // main category
			  ) );

			  // get current category from url
			  $current_category = get_queried_object();
			  $current_category_id = isset( $current_category->term_id ) ? $current_category->term_id : 0;

			  foreach ( $product_categories as $category ) :
				  $category_link = get_term_link( $category );
				  $checked = $current_category_id === $category->term_id ? 'checked' : '';
				  ?>
								<label class="control">
									<input type="checkbox" onclick="window.location.href='<?php echo esc_url( $category_link ); ?>'" <?php echo $checked; ?> />
									<span class="control-checkmark"></span>
					<?php echo esc_html( $category->name ); ?>
								</label>
			  <?php endforeach; ?>
					</div>
		  <?php
		  $current_category = get_queried_object();
		  $current_category_slug = isset( $current_category->slug ) ? $current_category->slug : '';

		  $show_mix_section = ($current_category_slug === 'grinky' || $current_category_slug === 'vergosy');
		  $show_all_sections = ($current_category_slug === 'grinky');
		  ?>

				<div class="filter-content-box" style="<?php echo $show_all_sections ? '' : 'display: none;'; ?>">
					<label class="control">
						<input type="radio" name="filter-group" />
						<span class="control-radio"></span>
						Фасовані
					</label>
					<label class="control">
						<input type="radio" name="filter-group" />
						<span class="control-radio"></span>
						Вагові
					</label>
				</div>

				<div class="filter-content-box" style="<?php echo $show_mix_section ? '' : 'display: none;'; ?>">
					<label class="control switch">
						<input type="checkbox">
						<span class="toggle round"></span>
						MIX смаків
					</label>
				</div>
				<div class="filter-content-count">
					<div class="filter-content-label">Кількість смаків*</div>
					<div class="product-controls-wrapper">
						<button class="button-control minus">
							<img src="/wp-content/themes/hv-theme/assets/images/icons/minus.svg" alt="">
						</button>
						<span class="product-number">12</span>
						<button class="button-control plus">
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
			<?php if($current_category_slug === 'grinky') { ?>
			<div class="filter-content tastes">
				<div class="filter-content-label">Смаки грінок*</div>
				<div class="filter-content-box">
			<?php
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
			<?php } ?>
		<?php if($current_category_slug === 'vergosy') { ?>
			<div class="filter-content tastes">
				<div class="filter-content-label">Смаки вергосів*</div>
				<div class="filter-content-box">
					<div class="filter-content-wrapper">
						<label class="control">
							<input type="checkbox" name="taste1" />
							<span class="control-checkmark"></span>
							<img src="/wp-content/themes/hv-theme/assets/images/icons/tastes/with-salt.svg" alt="" />
						</label>
						<div class="filter-content-title">З сіллю</div>
					</div>
					<div class="filter-content-wrapper">
						<label class="control">
							<input type="checkbox" name="taste1" />
							<span class="control-checkmark"></span>
							<img src="/wp-content/themes/hv-theme/assets/images/icons/tastes/onion-cream.png" alt="" />
						</label>
						<div class="filter-content-title">Цибуля-вершки</div>
					</div>
					<div class="filter-content-wrapper">
						<label class="control">
							<input type="checkbox" name="taste1" />
							<span class="control-checkmark"></span>
							<img src="/wp-content/themes/hv-theme/assets/images/icons/tastes/garlic-cream.png" alt="" />
						</label>
						<div class="filter-content-title">Часник-вершки</div>
					</div>
					<div class="filter-content-wrapper">
						<label class="control">
							<input type="checkbox" name="taste1" />
							<span class="control-checkmark"></span>
							<img src="/wp-content/themes/hv-theme/assets/images/icons/tastes/teriyaki-cream.png" alt="" />
						</label>
						<div class="filter-content-title">Теріякі-вершки</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="filter sum">
			<span class="filter-title">Загалом</span>
			<button class="button button-sum">
				<span class="composition">Склад продукту</span>
				<span class="value">Маса нетто - 900 г. (≈ 120 грінок)</span>
			</button>
			<button class="button button-solid-secondary">
<!--				Замовити на 200 ₴-->
				<?php custom_add_to_cart_in_sidebar();?>
			</button>
		</div>
	</form>
</aside>
