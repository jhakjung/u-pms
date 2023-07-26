<?php get_header(); ?>

<?php
$taxonomy = 'document_category';
$categories = get_document_categories();
?>

<div class="container">
	<div class="row">
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
		<div class="col-lg-8">
			<div class="col-6">
				<h5><?php echo $category->name; ?></h5>
			</div>
			<div class="col-6">
				<h6>이슈리스트</h6>
			</div>
		</div>
		<hr>
        <?php endforeach; ?>
		<?php get_template_part('template-parts/sections/section', 'aside'); ?>

        <!-- <div class="col-4">
            <h3>사이드바</h3>
        </div> -->
	</div>
</div>


<?php get_footer(); ?>