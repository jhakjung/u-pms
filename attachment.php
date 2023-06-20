<?php get_header();

while (have_posts()) : the_post(); ?>

<!-- SECTION: Jumbotron
====================================================== -->
<section class="container mb-0 px-4">
	<div class="section-content">
    	<div class="container mt-3 p-2">
      		<div class="pt-2">
				<?php
				// 현재 첨부 파일에 연결된 원 포스트 ID 가져오기
				$parent_post_id = wp_get_post_parent_id(get_the_ID());

				// 원 포스트 정보 가져오기
				$parent_post = get_post($parent_post_id);

				if ($parent_post) {
				// 원 포스트의 제목과 링크 출력
					echo '<span class="fs-5 pr-3">게시글&nbsp&nbsp;<i class="fas fa-angle-right"></i></span>';
					echo '<span class=fs-4><a href="' . esc_url(get_permalink($parent_post->ID)) . '">' . esc_html($parent_post->post_title) . '</a></span>';
				} ?>
      		</div>
    	</div>
  	</div>
</section>
<!-- SECTION: Jumbotron -->

<!-- SECTION: Post Content
====================================================== -->
<section id="post-<?php the_ID(); ?>" <?php post_class('main'); ?>>
	<div class="section-content">
		<div class="container">


			<br>

			<div class="row">
				<article class="col-sm-12 px-4">
					<?php
					// 첨부 파일 정보 가져오기
					$attachment_title = get_the_title();
					$attachment_id = get_the_ID();
					$attachment_url = wp_get_attachment_url($attachment_id);

					// 첨부 파일 표시
					echo '<p class="fs-5 px-5">📎&nbsp; <a href="' . $attachment_url . '">' . $attachment_title . '</a></p>';?>
					<br>
				</article>
			</div>
		</div>
	</div>
</section>
<!-- SECTION: Post Content -->

<?php endwhile;

get_footer(); ?>