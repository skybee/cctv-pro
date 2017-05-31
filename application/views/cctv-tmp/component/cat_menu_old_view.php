<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="block block-side-nav">
    <div class="block-title">
        <strong><span>Каталог товаров</span></strong>
    </div>
    <div class="block-content">
        <ul class="sf-menu-phone2">
            
            <?php 
                foreach($catname_list as $category):
                    $this_cat_btn = '';
                    if($category['id'] == $main_cat_id)
                    {
                        $this_cat_btn = 'this_cat_btn';
                    }    
            ?>
            
            <li class="level0 nav-1 first level-top">
                <a href="/category/<?=$category['url_name']?>/" class="level-top <?=$this_cat_btn;?>">
                    <span><?=$category['name']?></span>
                </a>
            </li>
            
            <?php endforeach; ?>
            
        </ul>
    </div>
</div>