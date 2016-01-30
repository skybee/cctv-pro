<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<div class="left_menu_title">
    КАТАЛОГ ТОВАРОВ
    <div class="bottom_row"></div>
</div>

<div class="nav-container">
    <ul id="nav">
        
        <? foreach($catname_list as $category): ?>
        
        <li class="level0 nav-1 level-top first">
            <!--<a href="#" class="level-top <?if( $category['id'] == $main_cat_id ) echo 'this_cat_btn'?>">-->
            <a href="/category/<?=$category['url_name']?>/" class="level-top <?if( $category['id'] == $main_cat_id ) echo 'this_cat_btn'?>">
                <?=$category['name']?>
            </a>
        </li>
        
        <? if( $category['id'] == $main_cat_id ): ?>
        <li>
            <div class="bottom_row"></div>
            <div class="child_cat">
                <? foreach( $child_main_cat as $cat_ar ): ?>
                    <!--<a href="#" <? if($cat_ar['id'] == $child_cat_id ) echo 'class="this_child_cat_btn"' ?> >-->
                    <a href="/category/<?=$cat_ar['url_name']?>/" <? if($cat_ar['id'] == $child_cat_id ) echo 'class="this_child_cat_btn"' ?> >   
                        <div class="child_cat_txt"><?=$cat_ar['name']?></div>
                        
                        <div class="child_bottom_row"></div>
                    </a>
                <? endforeach; ?>
                
            </div>
        </li>
        <? endif; ?>
        
        <? endforeach; ?>
    </ul>
</div>