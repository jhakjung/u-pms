<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">
  	<title><?php wp_title(' | ', 'echo', 'right'); ?><?php bloginfo('name'); ?></title>
  	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- <a id="scrolltoTop" class="text-black-50"><i class="fa fa-arrow-up"></i></a> -->

  	<!-- SECTION: Navbar
	====================================================== -->
	<nav id="primary-navbar" class="navbar navbar-expand-lg rgba-black-strong">
		<div class="container px-4">

			<a class="navbar-brand text-white" href="<?php echo esc_url(site_url('/')); ?>">
				<h3 class=""><?php bloginfo('name'); ?></h3>
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">

				<!-- 테스트용 메뉴 -->
				<li class="nav-item mx-2 <?php
					if(is_category('issue') OR (is_singular('post') AND has_category('issue'))) { echo 'active'; }
					else { echo '';} ?>">

					<a class="nav-link text-center" href="<?php echo site_url('/test'); ?>">테스트</a>
				</li>

				<!-- 이슈 메뉴 -->
				<li class="nav-item mx-2 <?php
					if(is_category('issue') OR (is_singular('post') AND has_category('issue'))) { echo 'active'; }
					else { echo '';} ?>">

					<a class="nav-link text-center" href="<?php echo site_url('/blog'); ?>">이슈</a>
					<!-- <a class="nav-link text-center" href="<?php echo my_category_archive_link('issue'); ?>">이슈</a> -->
				</li>

				<!-- 성과물 메뉴 -->
				<li class="nav-item mx-2 <?php
					if(get_post_type() == 'document' OR is_tax('document_category')) { echo 'active'; }
					else { echo '';} ?>">
					<a class="nav-link text-center" href="<?php echo get_post_type_archive_link('document'); ?>">성과물</a>
				</li>

				<!-- 자주 메뉴 -->
				<li class="nav-item mx-2 dropdown
					<?php
					if(is_page_template('page-freq.php')) {
						echo 'active';
					} else {
						echo '';
					} ?>">

					<a class="nav-link text-center dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					자주 <i class="fa fa-caret-down"></i></a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="<?php echo site_url('/contact'); ?>">연락처</a>
					<a class="dropdown-item" href="<?php echo site_url('/inventory'); ?>">납품내역</a>
				</li>

				<!-- SOP -->
				<li class="nav-item mx-2 dropdown
					<?php
					if ((is_category(array(
					'sop',
					'related_data',
					'related_data-contract',
					'related_data-tech',
					'related_data-etc'
					)))
					OR (is_singular('post') AND has_category(array(
						'sop',
						'related_data',
						'related_data-contract',
						'related_data-tech',
						'related_data-etc'
						))))
					{ echo 'active'; } ?>">
					<a class="nav-link text-center dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					자료실 <i class="fa fa-caret-down"></i></a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="<?php echo my_category_archive_link('sop'); ?>">SOP</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?php echo my_category_archive_link('related_data-contract'); ?>">계약관련</a>
					<a class="dropdown-item" href="<?php echo my_category_archive_link('related_data-tech'); ?>">기술관련</a>
					<a class="dropdown-item" href="<?php echo my_category_archive_link('related_data-etc'); ?>">기타자료</a>
					</div>
				</li>

				<!-- 기타 -->
				<li class="nav-item mx-2 dropdown">
					<a class="nav-link text-center dropdown-toggle" href="#" id="navbarDropdown" role="button"
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					기타 <i class="fa fa-caret-down"></i></a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="<?php echo my_category_archive_link('safety'); ?>">안전관리</a>
					<a class="dropdown-item" href="<?php echo my_category_archive_link('progress'); ?>">공정관리</a>
					<a class="dropdown-item" href="<?php echo my_category_archive_link('meeting'); ?>">회의록</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?php echo my_category_archive_link('etc'); ?>">기타문서</a>

					</div>
				</li>

				<!-- 타 프로젝트 링크 -->
				<!-- <li class="nav-item dropdown px-2 dropdown-wide d-block">
					<a class="nav-link text-center dropdown-toggle" href="#" id="navbarDropdown" role="button"
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					프로젝트
					</a>
					<div class="dropdown-menu w-75 bg-light" aria-labelledby="navbarDropdown">
						<div class="project-list container-fluid d-flex p-3">
							<a class="btn bg-vivid-purple mx-3" href="#">이천충주</a>
							<a class="btn bg-vivid-purple mx-3" href="#">철도전원</a>
							<a class="btn bg-vivid-purple mx-3" href="#">9호선</a>
							<a class="btn bg-vivid-purple mx-3" href="#">위례트램</a>
						</div>
					</div>
				</li> -->
				<!-- <span class="text-white text-center px-2 nav-link">|</span> -->

				<li class="nav-item px-2">
					<?php if(is_user_logged_in()) { ?>
						<a href="<?php echo wp_logout_url(); ?>" class="a-white nav-link float-right">
						<span><?php echo get_avatar(get_current_user_id(),19); ?></span>
						<span>로그아웃</span></a>
					<?php } else { ?>
						<a href="<?php echo wp_login_url(); ?>" class="btn a-white nav-link float-right">
						<span>로그인</span></a>
					<?php }?>
				</li>
				<!-- <span class="text-white text-center px-2 nav-link">|</span> -->

				<li class="nav-item px-2">
					<a class="nav-link float-right text-center" href="<?php echo site_url('/search'); ?>"><i class="<?php if (is_page('search')) {
						echo "vivid-amber";
					} else {
						echo "";
					}?> fa fa-search" aria-hidden="true"></i></a>
				</li>
			</ul>

			</div>
		</div>
	</nav>
	<!-- SECTION: Navbar -->

