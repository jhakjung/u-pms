<!-- SECTION: Post Content
	====================================================== -->
	<section id="post-<?php the_ID(); ?>" <?php post_class('main'); ?>>
		<div class="section-content">
			<div class="container-fluid">

					<?php the_content(); ?>

					<!-- 댓글 -->
					<div class="container col-11 mx-auto">
						<?php comments_template(); ?>
					</div>

	        </div>
		</div>
	</section>
<!-- SECTION: Post Content -->