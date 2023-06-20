<?php /* Template Name: 404 */
get_header(); ?>

<section id="page-<?php the_ID(); ?>" class="d-flex justify-content-center align-items-center">
  <div class="section-content">
    <div class="container">
      <div class="row justify-content-center">

        <article class="col-12 p-4">
          <div class="text-center article-content">
            <img src="<?php echo get_theme_file_uri('./assets/images/crying.png'); ?>"
              class="img-fluid mt-5" width="240px" height="240px">
            <h1 class="text-purple display-4 my-4 py-3">
              <?php echo 'Oooooooops!'; ?>
            </h1>

            <br>

            <div class="row justify-content-center mb-4">
              <p class="lead">
                페이지를 찾을 수 없습니다. 키워드로 검색하시겠습니까?
              </p>
            </div>

            <div class="my-4">
				<?php echo do_shortcode('[ivory-search id="1920" title="AJAX Search Form"]'); ?>
            </div>
          </div>
        </article>

      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>