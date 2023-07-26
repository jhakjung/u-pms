<!-- 카테고리 버튼 그룹 생성 -->
<!-- !!! single-document에서만 호출 가능 !!!, archive에서 호출하면 에러남! -->
<?php if (is_singular('document')) : ?>
    <div class="container-fluid mt-3">
        <div class="d-flex flex-wrap justify-content-center">
            <?php
            $current_category = get_the_terms(get_the_ID(), 'document_category');
            if (!empty($current_category)) {
                $current_category_name = $current_category[0]->name;
            }

            $categories = get_doc_cat_slug();
            // array('cat01', 'cat02', 'cat03', 'cat04', 'cat05', 'cat06', 'cat07', 'cat08', 'cat09', 'cat10', 'cat11', 'cat12');

            foreach ($categories as $category_slug) {
                $category = get_term_by('slug', $category_slug, 'document_category');
                if ($category) {
                    $category_name = $category->name;
                    $category_link = get_term_link($category);

                    $button_class = '';
                    if ($category_name == $current_category_name) {
                        $button_class = 'btn bg-vivid-cyan-blue a-white';
                        $current_cat_slug = $category_slug;
                        $current_cat_name = $category_name;
                    } else {
                        $button_class = 'btn-light';
                    }

                    echo '<a href="' . $category_link . '" class="btn m-2 border ' . $button_class . '">' . $category_name . '</a>';
                }
            }
            ?>
        </div>
    </div>
<?php endif; ?>
