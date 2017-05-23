<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            
            <div class="sf-menu-block">
                <div id="menu-icon">Каталог товаров</div>
                <ul class="sf-menu-phone">
                    
                    
                    <?php 
                        foreach($menuData as $key => $data):
                            
                            $parentClass='';$firstLastClass='';
                            $navID = $key+1; 
                            if($data['submenu']!=false){
                                $parentClass = 'parent';
                            }
                            
                            if($key==0){$firstLastClass = 'first';}
                            if($key==count($menuData)-1){$firstLastClass = 'last';}
                    ?>
                    
                    <li class="level0 nav-<?=$navID;?> level-top <?=$parentClass.' '.$firstLastClass?>">
                        <a href="/category/<?=$data['url_name']?>/" class="level-top">
                            <span><?=$data['name']?></span>
                        </a>
                        
                        <?php if($data['submenu']!=false): ?>
                        <ul class="level0">
                            <?php
                                foreach($data['submenu'] as $subKey => $subData):
                                    $subNavID = $subKey+1;
                                    $subFirstLastClass='';
                                    if($subKey==0){$subFirstLastClass = 'first';}
                                    if($subKey==count($data['submenu'])-1){$subFirstLastClass = 'last';}
                            ?>
                            <li class="level1 nav-<?=$navID.'-'.$subNavID;?> <?=$subFirstLastClass?>">
                                <a href="/category/<?=$subData['url_name']?>/">
                                    <span><?=$subData['name']?></span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    
                    </li>
                    <?php endforeach; ?>
                    
                </ul>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>