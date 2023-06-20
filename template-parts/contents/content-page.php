<?php $args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'issue_status', // 커스텀 필드 키를 'custom_field_key'로 변경하세요.
            'value' => '해결',
            'compare' => '='
        )
    )
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $post_title = get_the_title();
        $post_summary = get_field('issue_status');
        echo "<h2>$post_title</h2>";
        echo "<p>$post_summary</p>";
    }
} else {
    echo "해당하는 포스트가 없습니다.";
}

wp_reset_postdata();
?>




<!-- SECTION: Blog Main
	====================================================== -->
  <section id="blog-main">
  <div class="section-content">
    <div class="container">
      <div class="row">
        <main class="col-lg-8 mb-4">

        <?php
          while(have_posts()) {
            the_post();
        ?>
          <div id="" class="card blog-card">
            <div class="card-body">
              <h6 class="mb-3">
                <!-- 카테고리 -->
                <i class="fa fa-cube"></i>
                <span class="badge badge-success"><?php the_category(', '); ?></span> |
                <?php $issueStatus = get_field('issue_status');
                if ($issueStatus == 'solved') { $strClass = "badge badge-success"; }
                elseif ($issueStatus == 'unsolved') { $strClass = "badge badge-danger"; }
                else { $strClass = "badge badge-secondary"; }
                ?>
                <!-- 이슈 상태 -->
                <i class="fa fa-exclamation"></i>
                <span class="<?php echo $strClass; ?>"><?php the_field('issue_status'); ?></span> |
                <!-- 태그 표시 -->
                <i class="fa fa-tag"></i>
                <span class="badge badge-secondary"><?php the_tags('', '</span>, <span class="badge badge-secondary">', ''); ?></span> |
                <!-- 댓글 수 표시 -->
                <i class="fa fa-comments"></i>
                <span class="badge badge-info">댓글: <?php echo get_comments_number(); ?></span>
              </h6>
              <h4 class="card-title text-dark"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
              <p class="card-text">
                <?php
                if(has_excerpt()) {
                  echo get_the_excerpt();
                }  else {
                  echo wp_trim_words(get_the_content(), 25);
                }
                ?>
              <a href="<?php the_permalink(); ?>">전체보기</a>
              </p>
              <br>
              <div class="card-footer">
                <small class="text-muted">
                  <?php echo get_avatar(get_the_author_meta('ID'), 30, '', '', array('class' => array('shadow-xl', 'rounded-circle', 'mr-2'))); ?>
                  <span><?php echo get_the_author_meta('display_name'); ?></span>
                  <span class="float-right"><?php post_time(); ?></span>
                </small>
              </div>
            </div>
          </div>

          <?php } ?>

          <br>

          <?php pms_pagination(); ?>

        </main>

        <aside class="col-lg-4 mb-4">
          <div class="myWidget p-4 border">
            <?php dynamic_sidebar('sidebar1'); ?>
          </div>
        </aside>
      </div>
    </div>
  </div>
</section>
<!-- SECTION: Blog Main -->