<?php
if(post_password_required()) {
  return;
}
?>
<br>
<!-- <hr> -->
<div id="" class="comments py-4 my-3 border">
  <div class="row">
    <div class="col-md-10 mx-auto py-2">
      <h4 class="text-center text-secondary">
        <i class="fa fa-comments"></i>&nbsp;
        <?php
        $comments_number = get_comments_number();
        if(0 == !$comments_number) {
          /* translators: 1: comment count number, 2: title. */
          printf(_nx( '1개의 댓글', '%1$s개의 댓글', $comments_number, 'comments title', 'bestmedical' ), number_format_i18n( $comments_number ));
        }
        ?>
      </h4>
      <br>

      <!-- Comments List: inc폴더의 comment-template.php로 이동 -->
      <!-- Comments Pagination -->
      <?php
      wp_list_comments('type=comment&callback=bestmedical_comments_list');
      // wp_list_comments('type=pings&callback=bestmedical_comments_list'); // If ping & trackback is allowed
      bestmedical_comments_pagination();
      ?>
      <!-- Comments Form -->
      <div class="media my-3">
        <div class="media-body">
          <?php comment_form(bestmedical_comments_template()); ?>
          <?php if(!comments_open() && get_comments_number()) {
            if(is_single()) { ?>
          <h4 class="no-comments text-center">
            <?php esc_html_e('댓글이 없습니다.', 'bestmedical'); ?>
          </h4>
          <?php }
          } ?>
        </div>
      </div>
    </div>
    <br>
  </div>
</div>