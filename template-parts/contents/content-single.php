<!-- SECTION: Post Content
	====================================================== -->
	<section id="post-<?php the_ID(); ?>" <?php post_class('main'); ?>>
		<div class="section-content">
			<div class="container">

				<div class="row row-post mt-2 py-2">
					<h6 class="post-meta mb-3">
						<?php general_post_meta(); ?>
						<span class="float-right text-muted">게시자: <?php pms_postedby();?></span>
					</h6>
				</div>

				<br>

                <div class="row">
				<article class="col-sm-12 px-4">

					<!-- 요약글 -->
					<?php if (has_excerpt()) : ?>
						<div class="container border p-3 bg-warning bg-opacity-10">
							<span><?php the_excerpt(); ?></span>
						</div>
						<br>
					<?php endif; ?>

					<!-- 컨텐트 내용 -->
					<?php the_content(); ?>

					<!-- 댓글 -->
					<div class="container col-11 mx-auto">
						<?php comments_template(); ?>
					</div>

				</article>

                </div>
	        </div>
		</div>
	</section>
<!-- SECTION: Post Content -->