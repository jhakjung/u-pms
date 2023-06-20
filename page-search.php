<?php /* Template Name: search */
get_header(); ?>

<section id="page-<?php the_ID(); ?>" class="d-flex justify-content-center align-items-center">
  <div class="section-content">
    <div class="container">
      <div class="row justify-content-center">
        <article class="col-12 p-4">
          <p class="m-2">
            <li class="text-primary">
              검색하고자 하는 키워드을 입력하시면, 검색결과가 자동으로 로딩됩니다.
            </li>
            <li class="text-primary">
              게시글과 성과물을 구분하여 보고 싶으시면 키워드 입력 후 <kbd>Enter</kbd>키를 치세요.
            </li>
            <li class="text-primary">
            키워드가 하이라이트 되어 보이지 않으면 본문, 첨부파일, 댓글, 카테고리, 태그입니다.
            </li>
            <li class="text-primary">
            이때는 해당 게시물을 클릭하여 해당 게시물로 이동 후 <kbd>Ctrl</kbd> + <kbd>F</kbd>로 키워드를 다시 검색하시면 됩니다.
            </li>
            <br>
          </p>
           <div class="w-100" style="margin-bottom:50rem;">
              <?php echo do_shortcode('[ivory-search id="1920" title="AJAX Search Form"]'); ?>
            </div>
        </article>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>