<?php
$current_slug = get_post_field('post_name', get_queried_object_id());

// 현재 페이지의 issue_status 여부 판단
if ($current_slug == 'issue-solved') {
    $issueStatus = "해결";
} elseif ($current_slug == 'issue-unsolved') {
    $issueStatus = "미해결";
} elseif ($current_slug == 'issue-closed') {
    $issueStatus = "종결";
} else {
    $issueStatus = "";
} ?>

<!-- SECTION: Classficated Issue
	====================================================== -->
<section id="blog-main">
	<div class="section-content">
    	<div class="container">
      		<div class="row px-4">
        		<main class="col-lg-8">
               		<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					$args = array(
						'category_name'	=> 'issue',
						'post_type' => 'post',
						'posts_per_page' => 5,
						'meta_query' => array(
							array(
								'key' => 'issue_status',
								'value' => $issueStatus,
								'compare' => '='
							)
						),
						'paged' => $paged // 페이지 정보 추가
					);

    				$query = new WP_Query($args);

					if ($query->have_posts()) {

						$post_count = 0;
						while($query->have_posts()) {
							$query->the_post();
							$post_count++;
							$slug = get_post_field('post_name', get_the_ID());
						?>

						<div id="" class="blog-card">
							<div class="card-body pb-3">

								<h4 class="card-title mb-1">
									<i class="fas fa-check-circle fa-sm"></i>&nbsp;
									<a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
									<span class="text-danger text-opacity-50 fw-lighter float-right" style="font-size:70%"><?php echo '#' .$slug; ?></span>
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

							</div> <!-- card-body -->
							<?php if ($post_count < $wp_query->post_count) { ?>
								<hr>
							<?php } ?>
						</div> <!-- blog-card -->

						<?php } wp_reset_postdata();
					} else { ?>
						<div id="" class="blog-card">
							<div class="card-body pb-3">
								<p class="card-text">해당되는 이슈가 존재하지 않습니다.</p>

							</div> <!-- card-body -->
						</div> <!-- blog-card -->
						<?php } ?>

					</main>
					<?php get_template_part('template-parts/sections/section', 'aside'); ?>
				</div>
				<?php $query->max_num_pages > 1 ? pms_pagination($query->max_num_pages, 2) : ''; ?>
		</div>
	</div>
</section>
<!-- SECTION: Blog Main -->