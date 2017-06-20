<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="block block-side-nav">
    <div class="block-title">
        <strong><span>Каталог товаров</span></strong>
    </div>
    <div class="block-content">
        <ul class="sf-menu-phone2">
            
            <?php 
            
//            print_r($menuData);
            
                foreach($menuData as $key => $data):

                    $parentClass='';$firstLastClass='';
                    $navID = $key+1; 
                    if($data['submenu']!=false){
                        $parentClass = 'parent';
                    }

                    if($key==0){$firstLastClass = 'first';}
                    if($key==count($menuData)-1){$firstLastClass = 'last';}
                    
                    $this_cat_btn = '';
                    if($data['id'] == $main_cat_id)
                    {
                        $this_cat_btn = 'this_cat_btn';
                    }
            ?>
            
            <?php 
//                foreach($catname_list as $category):
//                    $this_cat_btn = '';
//                    if($category['id'] == $main_cat_id)
//                    {
//                        $this_cat_btn = 'this_cat_btn';
//                    }    
            ?>
            
            <li class="level0 nav-1 first level-top">
                <a href="/category/<?=$data['url_name']?>/" class="level-top <?=$this_cat_btn;?>">
                    <span class="sf_arow"></span>
                    <span class="sf_btn_name"><?=$data['name']?></span>
                </a>
                
                
                <?php if($data['submenu']!=false):?>
                <div class="sub-cat-menu">
                    <div class="sub-cat-menu-links">
                        <ul>
                            <?php foreach($data['submenu'] as $subKey => $subData):?>
                            <li>
                                <a href="/category/<?=$subData['url_name']?>/">
                                    <span><?=$subData['name']?></span>
                                </a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
                <?php endif;?>
                
            </li>
            
            <?php endforeach; ?>
    </div>
</div>