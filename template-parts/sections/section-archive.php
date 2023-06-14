<!-- SECTION: Issue Main
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
						?>

						<div id="" class="blog-card">
							<div class="card-body pb-3">
								<?php $slug = get_post_field('post_name', get_the_ID()); ?>

								<h4 class="card-title mb-1">
									<?php if ($category_name == '이슈') {
										$icon = 'text-dark fa-check-circle fa-sm';
									} else {
										$icon = 'text-dark fa-book fa-sm';
									} ?>
									<i class="fas <?php echo $icon; ?>"></i>&nbsp;
									<a class="fs-4" href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
									<span class="text-muted float-right" style="font-size:75%"><?php echo '#' .$slug; ?></span>
								</h4>

								<!-- 포스트 메타 -->
								<h6 class="post-meta mb-3">
									<?php general_post_meta(); ?>
								</h6>

								<p class="card-text">
									<?php
									if (has_excerpt()) {
										echo get_the_excerpt(); ?>
										<!-- <a href="<?php the_permalink(); ?>">전체보기</a> -->
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
				<aside class="col-lg-4 mb-4">
					<div class="myWidget p-4 border mb-3">
						<?php dynamic_sidebar('sidebar1'); ?>
					</div>
					<div class="myWidget p-4 border">
						<?php dynamic_sidebar('sidebar2'); ?>
					</div>
				</aside>
				<?php pms_pagination(); ?>
			</div>
		</div>
	</div>
</section>
<!-- SECTION: Blog Main -->
