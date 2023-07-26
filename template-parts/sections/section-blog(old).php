<!-- SECTION: Blog Main
	====================================================== -->
<section id="blog-main">
	<div class="section-content">
		<div class="container">
			<div class="row px-4">
				<main class="col-lg-8">

					<?php
					$post_count = 0; // 포스트 카운터 변수 초기화
					while (have_posts()) {
						the_post();
						$category_name = get_the_category()[0]->name;
						$post_count++;
						$slug = get_post_field('post_name', get_the_ID()); // 슬러그
						$book_icon = array('SOP', '기술관련', '기타자료', '계약관련');
						if (in_array($category_name, $book_icon)) {
							$icon = 'fa-book fa-sm';
						} else {
							$icon = 'fa-check-circle fa-sm';
						}?>

						<div id="" class="blog-card">
							<div class="card-body pb-3">

								<!-- 아이콘 + 포스트 제목 + 슬러그  -->
								<h4 class="card-title mb-1">
									<i class="fas <?php echo $icon; ?>"></i>&nbsp;
									<a class="fs-4" href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?>
									<span class="text-danger text-opacity-50 fw-lighter float-right" style="font-size:70%"><?php echo '#' .$slug; ?></span>
									</a>
								</h4>

								<!-- 포스트 메타 -->
								<h6 class="post-meta mb-3">
									<?php general_post_meta(); ?>
								</h6>

								<p class="card-text">
									<?php
									if (has_excerpt()) {
										echo get_the_excerpt(); ?>
									<?php } else {
										echo wp_trim_words(get_the_content(), 45);
									} ?>
								</p>

							</div>
							<?php if ($post_count < $wp_query->post_count) { ?>
								<hr>
							<?php } ?>
						</div>

					<?php } ?>
				</main>
				<?php get_template_part('template-parts/sections/section', 'aside'); ?>
			</div>
				<?php pms_pagination(); ?>
		</div>
	</div>
</section>
<!-- SECTION: Blog Main -->
