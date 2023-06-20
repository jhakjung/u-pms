<section id="blog-main">
	<div class="section-content">
		<div class="container">
			<div class="row">
				<div class="col-6 border-right pr-5">
					<h3 class="text-purple search-result pr-2 m-2"><i class="pr-3 fas fa-list fa-sm"></i>게시글</h3>
					<hr>
					<?php
					$post_count = 0;
					// 포스트 타입이 'post'인 검색 결과 표시
					$have_post_results = false; // 게시글 검색 결과 여부 변수 초기화
					if (have_posts()) {
						while (have_posts()) {
							the_post();
							$post_count++;
							if (get_post_type() === 'post') {
								$have_post_results = true; // 게시글 검색 결과가 있는 경우 true로 설정
								?>
								<h4 class="card-title mb-1"><a href="<?php the_permalink(); ?>"><i class="fas fa-check-circle fa-sm pr-2"></i><?php echo get_the_title(); ?></a></h4>
								<p class="text-secondary">
									<?php has_excerpt() ? the_excerpt() : the_content(); ?>
								</p>
								<br>
								<?php if ($post_count < $wp_query->post_count) { ?>
								<hr>
								<?php }
							}
						}
					}
					if (!$have_post_results) {
						echo '<p>검색결과 없음</p>';
					}
					?>
				</div>

				<div class="col-6 pl-5">
				<h3 class="text-purple search-result pr-2 m-2"><i class="pr-3 fas fa-layer-group fa-sm"></i>성과물</h3>
					<hr>
					<?php
					$post_count = 0;
					// 포스트 타입이 'post'인 검색 결과 표시
					$have_document_results = false; // 게시글 검색 결과 여부 변수 초기화
					rewind_posts(); // 이전 루프를 초기화하여 다시 시작
					if (have_posts()) {
						while (have_posts()) {
							the_post();
							$post_count++;
							if (get_post_type() === 'document') {
								$have_document_results = true; // 게시글 검색 결과가 있는 경우 true로 설정
								?>
								<h4 class="card-title mb-1"><a href="<?php the_permalink(); ?>"><i class="fas fa-check-circle fa-sm pr-2"></i><?php echo get_the_title(); ?></a></h4>
								<p class="text-secondary">
									<?php the_content(); ?>
								</p>
								<br>
								<?php if ($post_count < $wp_query->post_count) { ?>
								<hr>
								<?php }
							}
						}
					}
					if (!$have_document_results) {
						echo '<p>검색결과 없음</p>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>