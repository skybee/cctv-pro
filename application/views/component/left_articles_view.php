<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<div class="left_menu_title">
    СТАТЬИ и НОВОСТИ
    <div class="bottom_row"></div>
</div>

<div class="left_articles">
    <? foreach($left_articles_list as $article_ar): ?>
    <div class="la_article_block">
        <div class="la_title">
            <!--<a href="#"><?=$article_ar['title']?></a>-->
            <a href="/article/<?=$article_ar['id']?>/<?=$article_ar['url_name']?>/"><?=$article_ar['title']?></a>
        </div>
        <div class="la_text">
            <?=$article_ar['text']?>
        </div>
        <div class="la_shadow"></div>
    </div>
    <? endforeach; ?>
    
    <? if( isset($links['isset']) && $links['isset'] == true ): ?>
    <div class="la_article_block spe_block">
        <?=$links['html']?>
    </div>
    <? endif; ?>
    
    
</div>