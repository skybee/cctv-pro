<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

    $cnt_cat  = count($child_cat_list);
    if( $cnt_cat < 1 ) return '';
?>


<?php if( isset($cat_info['name']) ): ?>
<div class="page-title category-title">
    <h1><?=$cat_info['name']?> / Категории:</h1>
</div>
<?php endif; ?>



<div class="category-products" id="category-grid">
    
<?php
    $i = 0;
    while ($i < $cnt_cat):
?>
    <ul class="products-grid row">
        <?php 
            for($ii=0; $ii<3 && $i<$cnt_cat; $ii++, $i++):
                $catLink    = "/category/{$child_cat_list[$i]['url_name']}/";
                $catName    = $child_cat_list[$i]['name'];
                $tagCatName = htmlspecialchars($catName);
        ?>
        <li class="item <?php if($ii == 0) echo 'first'; ?> col-xs-12 col-sm-4">
            <div class="grid_wrap">
                <a href="<?=$catLink;?>" title="<?=$tagCatName?>" class="product-image">
                    <img src="/upload/images/upper-small/<?=$child_cat_list[$i]['img']?>" alt="<?=$tagCatName?>"/>
                </a>
                <div class="product-shop">
                    <h2 class="product-name">
                        <a href="<?=$catLink;?>" title="<?=$tagCatName?>"><?=$catName?></a>
                    </h2>
                </div>
            </div>
        </li>
        <?php endfor; ?>
    </ul>
<?php endwhile; ?>    
</div>