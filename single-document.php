<?php get_header();

get_template_part('template-parts/sections/section', 'catGrp-single'); ?>

<hr>

<!-- 제목과 메타정보 출력 -->
<section class="container-fluid section-content mb-0">
    <div class="container p-2 my-2">
        <h2 class="font-weight-bold text-dark py-3 px-2">
            <i class="text-secondary fa fa-file fa-sm"></i>&nbsp;
            <?php echo get_the_title(); ?>
        </h2>
        <hr>
        <?php general_post_meta(); ?>
    </div>
</section>

<div class="container p-3 pb-5">
    <div class="row">

        <?php
        // 해당 카테고리에 속하는 성과물 목록 출력
        get_template_part('template-parts/sections/section', 'docList-single');

        // 현재 성과물인 single-document의 컨텐트 출력
        get_template_part('template-parts/contents/content', 'doc-single');
        ?>

    </div> <!-- row -->
</div> <!-- container -->

<?php get_footer(); ?>
