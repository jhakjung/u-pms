<?php

// Custom Comments List
function bestmedical_comments_list($comment, $args, $depth) { ?>

<div id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? 'children' : 'parent'); ?>>
  <?php if($args['type'] != 'pings') { ?>
  <div class="media my-3">
    <?php
    if($args['avatar_size'] != 0) {
      echo get_avatar($comment, 32);
    }
    ?>
    <div class="media-body">
      <h6 class="mt-0">

        <!-- 댓글 작성자 -->
        <span class="">
          <?php echo get_comment_author_link(); ?> |
        </span>

        <!-- 댓글 작성일시 -->
        <span class="text-muted mx-2" >
          <small><?php comment_date('Y-m-d'); echo ', '; comment_time(); ?></small>
          <?php edit_comment_link(esc_html__('수정', 'bestmedical'), ' <span class="badge badge-info">', '</span>');
          ?>
        </span>
      </h6>

      <!-- 댓글 본문  -->
      <?php comment_text(); ?>
      <div class="media-footer">
        <?php
        echo get_comment_reply_link(
          array(
            'depth'   => $depth,
            'max_depth'   => $args['max_depth'],
            'reply_text'  => sprintf('<span class="float-right text-primary" data-toggle="tooltip" data-placement="bottom" title="댓글 달기">
             %s</span>', esc_html__('댓글', 'bestmedical')),
          ),
          $comment->comment_ID,
          $comment->comment_post_ID
        );
        ?>
      </div>
    </div>
  </div>
  <?php } ?>
<hr>
</div>
<?php }

// Custom Comments Template
function bestmedical_comments_template() {
  if(is_user_logged_in()) {
    $current_user = get_avatar(wp_get_current_user(), 32);
  } else {
    // $current_user = '<img src="' . get_theme_file_uri('assets/images/avatar.png') . '" alt="Not logged-in user avatar" class="img-fluid rounded-circle shadow-lg mr-3" width="64px">';
    $current_user = "";
  }

  $req  = get_option('require_name_email');
  $aria_req = ($req ? " aria-required='true'" : '');

  $args   = array(
    'class_form'  => 'form',
    'class_submit'  => 'btn text-white bg-vivid-cyan-blue float-right mt-3',
    'title_reply_before'  => '<h4 class="text-center mt-4">',
    'title_reply_after'   => '</h4> <span class="float-left mt-1"> <div class="avatar">' . $current_user . '</div></span><div class="media-body my-3">',
    'must_log_in'  => '<p class="must-log-in text-center">' .
    sprintf(
      __('댓글을 남기려면 <a href="%s">로그인</a> 하세요.', 'bestmedical'),
      esc_url(wp_login_url(apply_filters('the_permalink', get_permalink())))
    ) . '</p>',
    'fields'  => apply_filters(
      'comment_form_default_fields', array(
        'author'  => '<div class="row"><div class="col-md-6"><div class="form-group"><label>' . esc_html__('이름', 'bestmedical') . ($req ? '<span class="required">*</span>' : '') . '</label><input type="text" name="author" class="form-control" id="author"' . $aria_req . '></div></div>',
        'email'  => '<div class="col-md-6"><div class="form-group"><label>' . esc_html__('이메일', 'bestmedical') . ($req ? '<span class="required">*</span>' : '') . '</label><input type="email" name="email" class="form-control" id="email"' . $aria_req . '></div></div></div>',
      )
    ),
    'comment_field' => '<div class="form-group"><label>' . esc_html__('댓글을 남겨주세요...', 'bestmedical') . '</label><textarea name="comment" id="comment" class="form-control" rows="5" aria-required="true" placeholder="' . esc_html__('댓글을 남겨주세요...', 'bestmedical') . '"></textarea></div></div>'
  );

  return $args;
}

// Custom Comments Pagination
function bestmedical_comments_pagination() {
  $pages = paginate_comments_links(array(
    'echo'    => true,
    'prev_text' => '&laquo;',
    'next_text' => '&raquo;',
    'type'    => 'array'
  ));

  if(is_array($pages)) {
    echo '<ul class="pagination justify-content-center">';
    foreach($pages as $page) {
      echo '<li class="page-item">'. $page .'</li>';
    }
    echo '</ul>';
  }
}