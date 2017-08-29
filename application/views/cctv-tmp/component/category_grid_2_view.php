<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

    $cnt_cat  = count($child_cat_list);
    if( $cnt_cat < 1 ) return '';
?>




<?php if( isset($cat_info['name']) ): ?>
<!--<div class="page-title category-title">
    <h1><?=$cat_info['name']?> / Категории:</h1>
</div>-->
<?php endif; ?>


<div class="banners_block">
    
    <?php 
        foreach ($child_cat_list as $child_cat):
            $catLink    = "/category/{$child_cat['url_name']}/";
            $catName    = $child_cat['name'];
            $tagCatName = htmlspecialchars($catName);
    ?>
    
    <div class="banner">
        <a href="<?=$catLink?>">
            <div class="banner_img">
                <img src="/img/category_bg.png" alt=""/>
            </div>
            <div class="banner_holder">
                <span style="display: table; height: 100%;">
                    <h2><?=$catName?></h2>
                </span>
            </div>
            <div class="category_grid_image">
                <img src="/upload/images/category-small/<?=$child_cat['img']?>" alt="<?=$tagCatName?>" />
            </div>
        </a>
    </div>
    <?php endforeach;?>
    
</div>