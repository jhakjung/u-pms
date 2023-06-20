<aside class="col-lg-4 mb-4">
    <div class="myWidget p-3 pb-2 border mb-3">
        <?php dynamic_sidebar('sidebar1'); ?>
    </div>
    <div class="myWidget p-3 pb-2 border">
        <div id="categories-2" class="widget-2">
            <h5 class="text-center"><i class="fas fa-folder-open" aria-hidden="true"></i> 카테고리</h5>
            <?php pms_category_list(); ?>

        </div>
        <hr>
        <?php dynamic_sidebar('sidebar2'); ?>
    </div>


</aside>