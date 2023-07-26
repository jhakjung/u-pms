<div class="container-xxl">
	<div class="row">

		<div class="col">
			<?php
			foreach ($categories as $category) :
				$category_link = get_term_link($category, $taxonomy);
				$category_posts = new WP_Query(array(
					'post_type' => 'document',
					'tax_query' => array(
						array(
							'taxonomy' => $taxonomy,
							'field' => 'slug',
							'terms' => $category->slug,
						),
					),
					'posts_per_page' => -1, // 모든 포스트를 출력하도록 변경
				));
			?>
			<h5><?php echo $category->slug; ?></h5>
			<hr>
			<?php endforeach; ?>
		</div>
		<?php //get_template_part('template-parts/sections/section', 'aside'); ?>

		<!-- <aside class="col">
			<div class="myWidget p-3 pb-2 border mb-3">
				<?php // dynamic_sidebar('sidebar1'); ?>
			</div>
		</aside> -->

	</div>
</div>
