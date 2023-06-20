<?php get_header();

  while(have_posts()) {
    the_post();

    get_template_part('template-parts/sections/section', 'banner');
    get_template_part('template-parts/contents/content', 'single');
  }

get_footer(); ?>