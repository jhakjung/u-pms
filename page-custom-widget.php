<?php /* Template Name: custom-widget */ ?>

<ul class="category-list-inline">
<?php
$categories = get_categories(array(
  'hide_empty' => 0,
));
foreach ($categories as $category) {
  echo '<li class="cat-item cat-item-' . $category->term_id . '" style="display: inline;"><a href="' . get_category_link($category->term_id) . '">' . $category->name . ' (' . $category->count . ')</a></li>';
  echo ', ';
}
?>
</ul>