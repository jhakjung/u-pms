<?php get_header();

// 성과물 페이지에서 상단 카테고리 버튼 클릭시 제공되는 화면
// 상단: 카테고리버튼 그룹, 좌측: 카테고리 내 성과물 목록, 우측: 성과물 리스트 ?>

<!-- 카테고리 버튼 그룹 생성 -->
<div class="container-fluid mt-3">
    <div class="d-flex flex-wrap justify-content-center">
        <?php
        $categories = get_terms(array(
            'taxonomy' => 'document_category',
            'orderby' => 'slug',
            'hide_empty' => false,
        ));

        foreach ($categories as $category) {
            $category_name = $category->name;
            $category_link = get_term_link($category);

            $button_class = '';
            if (is_tax('document_category', $category->slug)) {
                $button_class = 'btn bg-vivid-cyan-blue a-white';
                $current_cat_name = $category_name;
                $current_cat_slug = $category->slug;
            } else {
                $button_class = 'btn-light';
            }

            echo '<a href="' . $category_link . '" class="btn m-2 border ' . $button_class . '">' . $category_name . '</a>';
        }
        ?>
    </div>
</div>

<hr>

<div class="container p-3 pb-4">
	<div class="row">

		<!-- 좌측에 카테고리 내 성과물 리스트 출력 -->
		<?php get_template_part('template-parts/sections/section', 'docList-archive'); ?>

		<!-- 우측에 제목과 내용 출력 -->
		<div class="col-8 px-5">
			<?php
			// 현재 카테고리에 해당하는 포스트 목록 가져오기
			$args = array(
				'post_type' => 'document',
				'tax_query' => array(
						array(
								'taxonomy' => 'document_category',
								'field' => 'slug',
								'terms' => $current_cat_slug,
						),
				),
				'posts_per_page' => -1,
			);

			$query = new WP_Query($args);

			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post(); ?>

					<h5 class="archive-doc-title pb-2">
						<i class="text-secondary text-opacity-75 fa fa-file fa-sm"></i>&nbsp;
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h5>
					<p>
						<?php the_content(); ?>
					</p>
					<hr>
				<?php }
				wp_reset_postdata();
			} else {
				echo '<p>해당 카테고리에 속하는 포스트가 없습니다.</p>';
			}
			?>
		</div> <!-- col-8 --->
	</div> <!-- row -->
</div> <!-- container -->

<?php get_footer(); ?>
