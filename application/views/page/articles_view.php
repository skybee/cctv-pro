<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="my_breadcrumb" style="margin-top: 0;">
    <ul>
        <li><a href="/articles/">Статьи и Новости</a></li>
        <li>&gt;</li>
    </ul>
    <br />
    Теги:
    <ul>
        <? foreach($tags_list as $tag_ar): ?>
        <li style="margin: 0px 7px; line-height: 24px;"><a href="/articles/1/<?=$tag_ar['url_name']?>/"><?=$tag_ar['name']?></a></li> |
        <? endforeach; ?>
    </ul>
</div>

<div class="product-collateral info_page_txt">
    
    <? foreach( $articles_list as $article_ar ): ?>
    <div class="article_prev_block">
        <div class="apb_title">
            <a href="/article/<?=$article_ar['id'].'/'.$article_ar['url_name'].'/'?>">
                <?=$article_ar['title']?>
            </a>
        </div>
        <p>
            <? if( !empty($article_ar['img']) ) echo '<img src="/upload/articles/'.$article_ar['img'].'" />'; ?>
            <?=$article_ar['text']?>
        </p>
    </div>
    <? endforeach; ?>
    
    
<div class="page-title">
    <h2>
    <div class="goods_pager">
        <ul>
            <? foreach($pager_ar as $page): ?>
            <li>
                <? if($page != $page_nmbr && $page != '...'): ?>
                <a href="/articles/<?=$page?>/<?=$tag_url?>"><?=$page?></a>
                <? else: ?>
                <?=$page?>
                <? endif;?>
            </li>
            <? endforeach;?>
        </ul>
    </div>
    </h2>
</div>
    
    
</div>