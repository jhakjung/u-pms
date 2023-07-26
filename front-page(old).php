<?php get_header();

// 성과물 메뉴 클릭 시 초기 화면: document 포스트 타입에 대한 archive ?>
<div class="front-page-container my-3 pb-3 px-3">
	<?php
	$taxonomy = 'document_category';
	$categories = get_terms(array(
		'taxonomy' => $taxonomy,
		'hide_empty' => false,
		'orderby' => 'slug',
		'order' => 'ASC',
	));

	$count = 1; // 넘버링을 위한 변수

	foreach ($categories as $category) {
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

		$number = str_pad($count, 2, '0', STR_PAD_LEFT); // 넘버링 포맷팅


		?>

		<div class="card shadow-sm bg-secondary bg-opacity-10 pt-2 pb-4 mt-2">
			<h4 class="fs-4 text-center py-2">
				<!-- 넘버링 -->
				<span class="number text-danger text-opacity-75 fw-bolder fs-2">
					<?php echo $number; ?>&nbsp;</span>
				<!-- 카테고리명 -->
				<a href="<?php echo $category_link; ?>" class="card-title">
					<?php echo $category->name; ?>
				</a>
			</h4>

			<div class="container">
				<ul class="list-group px-3">
					<?php
					if ($category_posts->have_posts()) :
						while ($category_posts->have_posts()) : $category_posts->the_post();
						// 성과물 진행 상태를 체크하기 위한 변수 ?>
							<li class="list-group-item">
								<a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
								<?php progress_state(); ?>
							</li>
						<?php endwhile;
							wp_reset_postdata();
					else :
						echo '<p>등록된 성과물이 없습니다.</p>';
					endif; ?>
				</ul>
			</div>
		</div>
	<?php $count++;
	} ?>
</div>

<?php get_footer(); ?>
