<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<div class="left_menu_title">
    КАТАЛОГ ТОВАРОВ
    <div class="bottom_row"></div>
</div>

<div class="nav-container">
    <ul id="nav">
        
        <?php foreach($catname_list as $category): ?>
        
        <li class="level0 nav-1 level-top first">
            <!--<a href="#" class="level-top <?if( $category['id'] == $main_cat_id ) echo 'this_cat_btn'?>">-->
            <a href="/category/<?=$category['url_name']?>/" class="level-top <?php if( $category['id'] == $main_cat_id ) echo 'this_cat_btn'?>" >
                <?=$category['name']?>
            </a>
        </li>
        
        <?php if( $category['id'] == $main_cat_id ): ?>
        <li>
            <div class="bottom_row"></div>
            <div class="child_cat">
                <?php foreach( $child_main_cat as $cat_ar ): ?>
                    <!--<a href="#" <?php if($cat_ar['id'] == $child_cat_id ) echo 'class="this_child_cat_btn"' ?> >-->
                    <a href="/category/<?=$cat_ar['url_name']?>/" <?php if($cat_ar['id'] == $child_cat_id ) echo 'class="this_child_cat_btn"' ?> >   
                        <div class="child_cat_txt"><?=$cat_ar['name']?></div>
                        
                        <div class="child_bottom_row"></div>
                    </a>
                <?php endforeach; ?>
                
            </div>
        </li>
        <?php endif; ?>
        
        <?php endforeach; ?>
    </ul>
</div>