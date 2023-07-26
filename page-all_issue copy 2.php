<?php get_header(); ?>

	<div class="all-issue">
		<div class="container">
			<div class="row">
				<main class="row col-lg-8">
					<?php
					$taxonomy = 'document_category';
					$categories = get_document_categories();

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
					<div class="col-3">
						<h5><?php echo $category->name; ?></h5>
					</div>
					<div class="col-5">
						<h6>이슈리스트</h6>
					</div>
					<hr>
					<?php endforeach; ?>
				</main>
				<?php get_template_part('template-parts/sections/section', 'aside'); ?>
			</div>
		</div>
	</div>
<!-- SECTION: Blog Main -->



<?php get_footer(); ?>