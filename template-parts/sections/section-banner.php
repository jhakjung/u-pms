<!-- SECTION: Jumbotron
	====================================================== -->
<section class="container mb-0 px-4">
	<div class="section-content">
    	<div class="container mt-1 p-2">
      		<h3 class="font-weight-bold pt-2">

				<?php
				// 현재 페이지가 index.php = 전체 게시글
				if(is_home()) { ?>
					<span class="text-secondary px-2 fs-3">
					【 전체 글 】
					</span>
					<span>
						<!-- <?php pms_category_list(); ?> -->
					</span>

				<?php // archive 페이지: archive.php
				} elseif(is_archive()) {
					echo get_the_archive_title();
					is_category('issue') ? issue_status_group() : ''; //pms_category_list();

				} elseif(is_page('contact')) {
					$icon = '<i class="fas fa-address-book fa-sm"></i> &nbsp;';
					echo $icon;
					echo get_the_title();

				} elseif(is_page('inventory')) {
					$icon = '<i class="fas fa-cubes fa-sm"></i> &nbsp;';
					echo $icon;
					echo get_the_title();

				// single 포스트: single.php
				} elseif(is_single()) {
					$category_name = get_the_category()[0]->name;
					if ($category_name == '이슈'  || $category_name == '기타발신' || $category_name == '공정관리') {
						$icon = '<i class="fas fa-check-circle fa-sm"></i> &nbsp;';
					} else {
						$icon = '<i class="fas vivid-purple fa-book fa-sm"></i> &nbsp;';
					}
					echo $icon;
					echo get_the_title(); ?>
					<?php $slug = get_post_field('post_name', get_the_ID()); ?>

					<span class="float-right px-3" style="font-size:70%">
						<?php pms_postlink(); ?>
					</span>
					<span class="text-danger text-opacity-50 fw-lighter float-right" style="font-size:70%"><?php echo '#' .$slug; ?></span>

				<?php // 현재 페이지가 이슈: 해결
				} elseif(is_page('issue-solved')) { ?>
					<span class="text-dark v-middle-align">이슈</span>
					<span class="badge bg-vivid-cyan2 mx-1">해결</a></span>
					<?php issue_status_group();

				// 현재 페이지가 이슈: 미해결
				} elseif(is_page('issue-unsolved')) { ?>
					<span class="text-dark v-middle-align">이슈</span>
					<span class="badge bg-vivid-red mx-1">미해결</a></span>
					<?php issue_status_group();

				// 현재 페이지가 이슈: 종결
				} elseif(is_page('issue-closed')) { ?>
					<span class="text-dark v-middle-align">이슈</span>
					<span class="badge badge-secondary mx-1">종결</a></span>
					<?php issue_status_group();

				// 첨부 파일: attachment.php
				} elseif(is_search()) { ?>
					<span class="fs-3 pr-3">
						<i class="fas fa-search fa-sm"></i>&nbsp;&nbsp;검색 결과 :
					</span>
					<?php echo get_search_query(); ?>

				<?php
				// 검색 결과: search.php
				} else { ?>
					<span class="fs-3">
						<i class="fas fa-search fa-sm"></i>&nbsp;&nbsp;???
					</span>
				<?php } ?>
      		</h3>
      		<hr>
    	</div>
  	</div>
</section>
<!-- SECTION: Jumbotron -->