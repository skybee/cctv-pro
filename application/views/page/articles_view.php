<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="my_breadcrumb" style="margin-top: 0;">
    <ul>
        <li><a href="/articles/">Статьи и Новости</a></li>
        <li>&gt;</li>
    </ul>
    <br />
    Теги:
    <ul>
        <?php foreach($tags_list as $tag_ar): ?>
        <li style="margin: 0px 7px; line-height: 24px;"><a href="/articles/1/<?=$tag_ar['url_name']?>/"><?=$tag_ar['name']?></a></li> |
        <?php endforeach; ?>
    </ul>
</div>

<div class="product-collateral info_page_txt">
    
    <?php foreach( $articles_list as $article_ar ): ?>
    <div class="article_prev_block">
        <div class="apb_title">
            <a href="/article/<?=$article_ar['id'].'/'.$article_ar['url_name'].'/'?>">
                <?=$article_ar['title']?>
            </a>
        </div>
        <p>
            <?php if( !empty($article_ar['img']) ) echo '<img src="/upload/articles/'.$article_ar['img'].'" />'; ?>
            <?=$article_ar['text']?>
        </p>
    </div>
    <?php endforeach; ?>
    
    
<div class="page-title">
    <h2>
    <div class="goods_pager">
        <ul>
            <?php foreach($pager_ar as $page): ?>
            <li>
                <?php if($page != $page_nmbr && $page != '...'): ?>
                <a href="/articles/<?=$page?>/<?=$tag_url?>"><?=$page?></a>
                <?php else: ?>
                <?=$page?>
                <?php endif;?>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    </h2>
</div>
    
    
</div>