<?php get_header(); ?>

<?php
$taxonomy = 'document_category';
// $categories = get_document_categories();

// $category_slugs = array();

// foreach ($categories as $category) :
// 	$category_slugs[] = $category->slug;
// endforeach;
$category_slugs = get_doc_cat_slug();
echo json_encode($category_slugs);
?>




<?php get_footer(); ?>