<?php
// 카테고리 리스트 표시
function pms_category() {
	if (get_post_type() === 'document') {
		// 'document' 포스트 타입인 경우 'document_category' 사용
		$categories = get_the_terms(get_the_ID(), 'document_category');
		if ($categories && !is_wp_error($categories)) {
			$category_names = array();
			foreach ($categories as $category) {
				$category_names[] = $category->name;
			}
			echo '<span class="badge bg-vivid-cyan-blue ml-1 mr-2">' . implode(', ', $category_names) . '</span>';
		}
	} else {
		// 'post' 포스트 타입인 경우 기존 처리 방식 적용
		echo '<i class="text-dark text-opacity-25 fas fa-folder-open"></i>';
		echo '<span class="badge bg-vivid-cyan-blue ml-1 mr-2">' . get_the_category_list(', ') . '</span>';
	}
}

// 이슈 상태 표시
function pms_issue_state() {
	$issueStatus = get_field('issue_status');
	if ($issueStatus) {
		if ($issueStatus == '해결') {
			$strClass = "badge bg-vivid-cyan2 ml-1 mr-2";
			$issueStatusLink = site_url('/issue-solved');
		} elseif ($issueStatus == '미해결') {
			$strClass = "badge bg-vivid-red ml-1 mr-2";
			$issueStatusLink = site_url('/issue-unsolved');
		} elseif ($issueStatus == '종결') {
			$strClass = "badge badge-dark ml-1 mr-2";
			$issueStatusLink = site_url('/issue-closed');
		} else {
			return;
		}
		echo '<i class="text-dark text-opacity-25 fas fa-info"></i>';
		echo '<span class="' . $strClass . '"><a href="' . $issueStatusLink . '">' . $issueStatus . '</a></span>';
	}
}

// 태그 표시
function pms_tag() {
	$tags = get_the_tags();
		if ($tags) { // 태그가 존재하는 경우에만 실행
			echo '<i class="text-dark text-opacity-25 fas fa-tag"></i>';
			echo '<span class="badge bg-light-dark ml-1 mr-2">' . get_the_tag_list('', ', ', '') . '</span>';
		}
}

// 댓글 수 표시
function pms_comment() {
	$comment_count = get_comments_number();
	if ($comment_count > 0) {
		echo '<i class="text-dark text-opacity-25 fas fa-comments"></i>';
		echo '<span class="badge bg-vivid-amber ml-1 mr-2"><a href="' . get_comments_link() . '">' . $comment_count . '</a></span>';
	} elseif (comments_open()) {
		echo '<i class="text-dark text-opacity-25 fas fa-comments"></i>';
		echo '<span class="badge bg-vivid-amber ml-1 mr-2"><a href="' . get_comments_link() . '">0</a></span>';
	}
}

// 담당자 or 작성자 표시
function pms_in_charge() {
	echo '<i class="text-dark text-opacity-25 fas fa-user"></i>';
	// echo '<span class="text-muted">담당:&nbsp;</span>';

	$inCharge = get_field('in_charge');

	if ($inCharge) {
		$author_id = $inCharge['ID'];
		$author_posts_url = get_author_posts_url($author_id);
		$display_name = get_the_author_meta('display_name', $author_id);
		echo '<span class="text-muted author ml-1 mr-2"><a href="' . esc_url($author_posts_url) . '">' . esc_html($display_name) . '</a></span>';
	} else {
		pms_postedby();
	}
}

// 게시자 표시
function pms_postedby() {
	$post_author_id = get_post_field('post_author', get_the_ID());
	$author_posts_url = get_author_posts_url($post_author_id);
	$display_name = get_the_author_meta('display_name', $post_author_id);
	echo '<span class="text-muted author ml-1 mr-2"><a href="' . esc_url($author_posts_url) . '">' . esc_html($display_name) . '</a></span>';
}

// 게시일자 표시
function pms_posted_time() {
	echo '<i class="text-dark text-opacity-25 fas fa-clock"></i>'; ?>
		<small class="text-muted"><?php post_time(); ?></small>
<?php }

// Post Time
function post_time() {
	$current = current_time('U');
	$posted = get_the_time('U');
	$diff = $current - $posted;

	if($diff > 0 && $diff < 60*60*24*3) {
		echo sprintf(__('%s 전 게시됨', 'bestmedical'), human_time_diff($posted, $current));
	} else {
		echo the_time('y-m-d');
	}
}

// 성과물 진행상태 표시
function progress_state() {
	$document_progress = get_field('progress_state', get_the_ID(), false);
		if (empty($document_progress)) {
			$document_progress = '';
		} elseif ($document_progress == '완료') {
			echo '<span class="float-right"><i class="vivid-cyan2 fas fa-check fa-sm"></i></span>';
		} elseif ($document_progress == '작성중') {
			echo '<span class="float-right"><i class="vivid-red fas fa-hourglass-half fa-sm"></i></span>';
		} else { // '해당없음'
			echo '<span class="float-right"><i class="light-dark fas fa-ban fa-sm"></i></span>';
		};
}

// General Post Meta
function general_post_meta() {
	pms_category();
	pms_issue_state();
	pms_tag();
	pms_comment();
	pms_in_charge();
	pms_posted_time();
}

// Post Link
function pms_postlink() { ?>
	<span class="float-right">
		<?php next_post_link('%link', '<span data-toggle="tooltip" data-placement="left" title="%title"><i class="fa fa-arrow-circle-left fa-lg text-muted"></i></span>'); ?>
		<?php previous_post_link('%link', '<span data-toggle="tooltip" data-placement="right" title="%title"><i class="fa fa-arrow-circle-right fa-lg text-muted"></i></span>'); ?>
	</span>
<?php }

// 이슈상태 분류 블록
function issue_status_group() { ?>
    <br class="d-md-none">
		<?php $iClass = 'float-right badge pt-2 mt-3 mx-1" style="font-size:45%"'; ?>
    <span class="badge-secondary <?php echo $iClass; ?>"><a href="<?php echo site_url('/issue-closed'); ?>">종결</a></span>
    <span class="bg-vivid-red <?php echo $iClass; ?>"><a href="<?php echo site_url('/issue-unsolved'); ?>">미해결</a></span>
    <span class="bg-vivid-cyan2 <?php echo $iClass; ?>"><a href="<?php echo site_url('/issue-solved'); ?>">해결</a></span>
	<?php
		$category = get_category_by_slug('issue');
		$category_link = get_category_link($category->term_id); ?>
    <span class="bg-vivid-cyan-blue <?php echo $iClass; ?>"><a href="<?php echo $category_link; ?>">전체이슈</a></span>
<?php }

// 카테고리 리스트 출력 -- section-aside.php로 대체함
function pms_category_list() { ?>
	<ul class="d-flex flex-wrap justify-content-center px-1 pb-2">
		<?php
		// $excluded_category_slugs = array(
		// 	'outgoing',
		// 	'safety',
		// 	'progress',
		// 	'meeting'
		// );
		$categories = get_categories(array(
			// 'hide_empty' => 0,
			'orderby'	=> 'count',
			'order'		=> 'DESC'
		));
		foreach ($categories as $category) {
			// if (in_array($category->slug, $excluded_category_slugs)) {
			// 	continue; // 제외할 카테고리는 건너뜁니다.
			// }
			echo '<li class="cat-item cat-item-' . $category->term_id . '" style="display: inline;"><span class="badge badge-secondary mx-1 fw-light" style="font-size:80%"><a href="' . get_category_link($category->term_id) . '">' . $category->name . ' (' . $category->count . ')</a></span></li>';
			// echo ', ';
		}
		?>
	</ul>

<?php }




// Bootstrap4 Styled Pagination
function pms_pagination($pages = '', $range = 5) {
	$showitems = ($range * 2) + 1;
	global $paged;
	if(empty($paged)) $paged = 1;
	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;

		if(!$pages)
			$pages = 1;
	}

	if(1 != $pages)
	{
	    echo '<nav aria-label="Page navigation" role="navigation">';
        echo '<span class="sr-only">Page navigation</span>';
        echo '<ul class="pagination justify-content-center ft-wpbs">';

        echo '<li class="page-item disabled d-none d-lg-block"><span class="page-link">' . sprintf(__('%d 의 %d 페이지', 'bestmedical'), $paged, $pages) . '</span></li>';

	 	if($paged > 2 && $paged > $range+1 && $showitems < $pages)
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link(1).'" aria-label="First Page">&laquo;<span class="d-none d-md-block"></span></a></li>';

	 	if($paged > 1 && $showitems < $pages)
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($paged - 1).'" aria-label="Previous Page">&lsaquo;<span class="d-none d-md-block"></span></a></li>';

		for ($i=1; $i <= $pages; $i++)
		{
		    if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				echo ($paged == $i)? '<li class="page-item active"><span class="page-link"><span class="sr-only">Current Page </span>'.$i.'</span></li>' : '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($i).'"><span class="sr-only">Page </span>'.$i.'</a></li>';
		}

		if ($paged < $pages && $showitems < $pages)
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($paged + 1).'" aria-label="Next Page"><span class="d-none d-md-block"></span>&rsaquo;</a></li>';

	 	if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages)
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($pages).'" aria-label="Last Page"><span class="d-none d-md-block"></span>&raquo;</a></li>';

	 	echo '</ul>';
        echo '</nav>';
	}
} ?>