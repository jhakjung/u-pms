<div class="col-4">
	<?php
	$current_category = get_the_terms(get_the_ID(), 'document_category')[0];
	$current_category_name = $current_category->name;
	$current_category_slug = $current_category->slug;
	// $current_doc_title = get_the_title(get_the_ID());
	?>
	<ul class="list-group doc-list">
		<li class="list-group-item border-bottom text-dark bg-light px-4">
			<?php echo $current_category_name; ?>
		</li>
		<?php
		$args = array(
			'post_type' => 'document',
			'tax_query' => array(
					array(
							'taxonomy' => 'document_category',
							'field' => 'slug',
							'terms' => $current_category_slug,
					),
			),
			'posts_per_page' => -1
		);
		$query = new WP_Query($args);

		if ($query->have_posts()) {
			while ($query->have_posts()) {
					$query->the_post();	?>

					<li class="list-group-item border px-4 fs-5">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<?php progress_state(); ?>
					</li>
			<?php }
			wp_reset_postdata();
		} else {
			echo '<li class="list-group-item">해당 카테고리에 속하는 포스트가 없습니다.</li>';
		}
		?>
	</ul>
</div>