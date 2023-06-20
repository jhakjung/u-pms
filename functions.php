<?php
require get_template_directory() . '/inc/comment-template.php';
require get_template_directory() . '/inc/post-meta.php';

// Theme Setups
add_action('after_setup_theme', 'bestmedical_setup');
function bestmedical_setup() {
  add_theme_support('title-tag');
}
// Theme resource FIles
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
function enqueue_custom_scripts() {
  wp_enqueue_style('main-css', get_theme_file_uri('/assets/css/app.bundle.css'));
  wp_enqueue_style('bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css');
  wp_enqueue_style('bestmedical-style', get_stylesheet_uri());

  wp_enqueue_script('fa-js', '//kit.fontawesome.com/61b7275f5f.js', 'NULL', '5.9.0', false);
  wp_enqueue_script('main-js', get_theme_file_uri('/assets/js/app.bundle.js'), 'NULL', '1.0', true);
  wp_enqueue_script('custom-js', get_theme_file_uri('/assets/js/custom.js'), array('jquery'), '1.0', true);
}

// get_id_by_slug('any-page-slug');
function get_id_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
}

// Archive 타이틀에서 괄호 제거
function pms_archive_title( $title ) {
	if ( is_category() ) {
		$title = '<span class="text-white px-2 bg-title1">카테고리: '. single_cat_title( '', false ) . '</span>';
	} elseif ( is_tag() ) {
		$title = '<span class="text-white px-2 bg-title1">태그: '. single_tag_title( '', false ) . '</span>';
	} elseif ( is_author() ) {
		$title = '<span class="text-white px-2 bg-title1">작성자: '. get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) { $title = '<span class="text-white px-2 bg-title1">'. single_term_title( '', false ) . '</span>';
	} return $title;
}
add_filter( 'get_the_archive_title', 'pms_archive_title' );

// Register Widgets
add_action('widgets_init', 'bestmedical_widget');
function bestmedical_widget() {
	register_sidebar(array(
		'name'		=> esc_html__('Sidebar-1', 'bestmedical'),
		'id'			=> 'sidebar1',
		'description'	=> esc_html__('Add widgets here', 'bestmedical'),
		'before_widget'	=> '<div id="%1$s" class="widget-1">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="text-dark"> ',
		'after_title'		=> '</h4>'
	));
	register_sidebar(array(
		'name'		=> esc_html__('Sidebar-2', 'bestmedical'),
		'id'			=> 'sidebar2',
		'description'	=> esc_html__('Add widgets here', 'bestmedical'),
		'before_widget'	=> '<div id="%1$s" class="widget-2">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="text-dark"> ',
		'after_title'		=> '</h4>'
	));
}

// site_url('/') 비교함수
function isCurrentPageMatchSiteURL() {
  $currentURL = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $siteURL = site_url('/');
  return ($currentURL === $siteURL);
}

// 한글 문서 upload 가능하게
add_filter( 'upload_mimes', function( $existing_mimes ) {
  $existing_mimes['hwp'] = 'application/hangul';
  $existing_mimes['hwpx'] = 'application/hangul';
  return $existing_mimes;
} );

// 포스트 타입 등록
function university_post_types() {

  // 성과물 Post Type
  register_post_type('document', array(
    'show_in_rest' => true,
    // 'capability_type' => 'document',
    // 'map_meta_cap'  => true,
    'supports' => array('title', 'editor', 'author', 'tag'),
    'rewrite' => array('slug' => 'documents'),
    'taxonomies'  => array('category'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => '성과물',
      'add_new_item' => '성과물 추가',
      'edit_item' => '성과물 수정',
      'all_items' => '성과물 목록',
      'singular_name' => '성과물' ),
    'menu_icon' => 'dashicons-media-document'
  ));
}
add_action('init', 'university_post_types');

// 성과물 archive용 쿼리
function document_archive_orderby( $query ) {
	if ( !is_admin() AND $query->is_main_query() AND $query->is_archive('document') ) {
			$query->set( 'orderby', 'menu_order' );
			$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'document_archive_orderby' );

// 성과물 category 등록
function custom_taxonomy_document_category() {
	$labels = array(
			'name' => '성과물 카테고리',
			'singular_name' => '성과물 카테고리',
	);

	$args = array(
			'labels' => $labels,
			'hierarchical' => true,
			// 여기에 다른 옵션을 추가할 수 있습니다.
	);

	register_taxonomy('document_category', 'document', $args);
}
add_action('init', 'custom_taxonomy_document_category');

// '성과물' 포스트 타입 메뉴에서 'post'의 카테고리 숨기기
add_action('admin_menu', function() {
	remove_meta_box('categorydiv', 'document', 'side');
} );

// 새로운 포스트의 슬러그를 'YYMM-중복 체크된 연번'로 설정
function custom_force_default_post_slug( $data ) {
    if ( empty( $data['post_name'] ) ) {
        global $wpdb;
        $post_count = $wpdb->get_var( "SELECT MAX(SUBSTRING_INDEX(post_name, '-', -1)) FROM $wpdb->posts WHERE post_status IN ('publish', 'draft', 'pending', 'private', 'trash')" );
        $post_count = sprintf( "%03d", intval( $post_count ) + 1 );

        $new_post_slug = date('ym') . '-' . $post_count;
        $slug_exists = $wpdb->get_var( $wpdb->prepare( "SELECT post_name FROM $wpdb->posts WHERE post_name = %s", $new_post_slug ) );

        while ( $slug_exists ) {
            $post_count++;
            $post_count = sprintf( "%03d", $post_count );
            $new_post_slug = date('ym') . '-' . $post_count;
            $slug_exists = $wpdb->get_var( $wpdb->prepare( "SELECT post_name FROM $wpdb->posts WHERE post_name = %s", $new_post_slug ) );
        }

        $data['post_name'] = $new_post_slug;
    }
    return $data;
}
add_filter( 'wp_insert_post_data', 'custom_force_default_post_slug' );


function my_category_archive_link($category_slug) {
    $category = get_category_by_slug($category_slug); // 슬러그명으로 카테고리 정보 가져오기

    if ($category) {
        $category_archive_url = get_term_link($category); // 카테고리 아카이브 페이지 URL 가져오기

        if (!is_wp_error($category_archive_url)) {
            // 카테고리 아카이브 페이지 URL이 유효한 경우
            return $category_archive_url;
        }
    }

    // 카테고리 아카이브 페이지 URL을 가져오지 못한 경우 또는 오류 발생 시 기본값 반환
    return '';
}

// Redirect subscriber accounts out of admin and onto homepage
add_action('wp_login', 'redirectSubsToFrontend');

function redirectSubsToFrontend($user_login) {
  $user = get_user_by('login', $user_login);

  if (count($user->roles) == 1 && $user->roles[0] == 'subscriber') {
    wp_redirect(site_url('/'));
    exit;
  }
}


add_action('after_setup_theme', 'noSubsAdminBar');

function noSubsAdminBar() {
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 && $ourCurrentUser->roles[0] == 'subscriber') {
    show_admin_bar(false);
  }
}


// Customize Login Screen
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
  return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS() {
  wp_enqueue_style('main-css', get_theme_file_uri('/assets/css/app.bundle.css'));
  wp_enqueue_style('bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css');
  wp_enqueue_style('bestmedical-style', get_stylesheet_uri());
  wp_enqueue_script('fa-js', '//kit.fontawesome.com/61b7275f5f.js', 'NULL', '5.9.0', false);
  wp_enqueue_script('main-js', get_theme_file_uri('/assets/js/app.bundle.js'), 'NULL', '1.0', true);
}

add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle() {
  return get_bloginfo('name');
}

// 가입자 등록 확장
function custom_user_register_fields() {
  ?>
      <p>
          <label for="user_bio"><?php _e('사용자 소개', 'text-domain'); ?><br />
              <textarea name="user_bio" id="user_bio" rows="5" cols="34" placeholder="관리자가 승인하기 위해서는 소속과 전화번호를 반드시 입력되어야 합니다."><?php echo (isset($_POST['user_bio'])) ? esc_textarea($_POST['user_bio']) : ''; ?></textarea>
          </label>
      </p>
  <?php
  }
  add_action('register_form', 'custom_user_register_fields');

  // 가입자 등록 필드 유효성 검사
  function custom_user_register_fields_validation($errors, $sanitized_user_login, $user_email) {
      if (empty($_POST['user_bio'])) {
          $errors->add('user_bio_error', __('사용자 소개를 입력해주세요.', 'text-domain'));
      }
      return $errors;
  }
  add_filter('registration_errors', 'custom_user_register_fields_validation', 10, 3);

  // 가입자 등록 정보 저장
  function custom_user_register_fields_save($user_id) {
      if (!empty($_POST['user_bio'])) {
          update_user_meta($user_id, 'user_bio', sanitize_textarea_field($_POST['user_bio']));
      }
  }

// Add the `aaa` class to the `<a>` tag
function add_custom_content_before_link($content) {
  $custom_html = '<img draggable="false" role="img" class="emoji" alt="📎" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f4ce.svg">&nbsp;';
  $content = preg_replace('/(<a\b[^>]*>)/', '$1' . $custom_html, $content);
  $content = str_replace('<a href="', '<a class="aaa" href="', $content);
  return $content;
}
add_filter('the_content', 'add_custom_content_before_link');

// Allow .msg file upload
function allow_msg_uploads($mime_types) {
  $mime_types['msg'] = 'application/vnd.ms-outlook';
  return $mime_types;
}
add_filter('upload_mimes', 'allow_msg_uploads');

// Modify Category and Tag widget titles HTML
function add_icon_to_widget_title($title, $instance, $id_base) {
  if (( $id_base === 'categories' || $id_base === 'tag_cloud' || $title === '최신 글' || $title === '최신 댓글' ) && is_active_widget(false, false, $id_base)) {
    $icon = '';

    if ($id_base === 'categories') {
      $icon = '<i class="fas fa-folder-open fa-sm"></i> '; // 카테고리 아이콘 코드를 여기에 입력하세요.
    } elseif ($id_base === 'tag_cloud') {
      $icon = '<i class="fas fa-tag fa-sm"></i> '; // 태그 아이콘 코드를 여기에 입력하세요.
    } elseif ($title === '최신 글') {
      $icon = '<i class="fas fa-file-alt fa-sm"></i> '; // 최신 글 아이콘 코드를 여기에 입력하세요.
    } elseif ($title === '최신 댓글') {
      $icon = '<i class="fas fa-comments fa-sm"></i> '; // 최신 댓글 아이콘 코드를 여기에 입력하세요.
    }

    $title = '<h5 class="text-center">' . $icon . $title . '</h5>';
  }
  return $title;
}
add_filter('widget_title', 'add_icon_to_widget_title', 10, 3);


