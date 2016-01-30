<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>



<div class="my_breadcrumb" style="margin-top: 0;">
    <ul>
        <li><a href="/articles/">Статьи и Новости</a></li>
        <li>&gt;</li>
    </ul>
    <br />
    Теги:
    <ul>
        <? foreach ($tags_list as $tag_ar): ?>
            <li style="margin: 0px 7px; line-height: 24px;"><a href="/articles/1/<?= $tag_ar['url_name'] ?>/"><?= $tag_ar['name'] ?></a></li> |
        <? endforeach; ?>
    </ul>
</div>

<div class="product-collateral info_page_txt article_page">
    <div class="box-collateral box-description">

        <h1><?= $info_ar['title'] ?></h1>
        <div class="std">            
            <?=$info_ar['text']?>
            <br />
            <?=$city_link?>
            <p style="margin-top:30px; font-style: italic; text-indent: 0; ">
                Источник: &nbsp;&nbsp; <span class="jq_link" rel="nofollow" ><?= $info_ar['donor_host'] ?></span>
            </p>
        </div>
    </div>
</div>


<!-- похожие статьи -->
<? if ($articles_list): ?>
    <div class="page-title"><h2>Похожие статьи:</h2></div>
    <? foreach ($articles_list as $article_ar): ?>
        <div class="article_prev_block">
            <div class="apb_title">
                <a href="/article/<?= $article_ar['id'] . '/' . $article_ar['url_name'] . '/' ?>">
                    <?= $article_ar['title'] ?>
                </a>
            </div>
            <p>
                <? if (!empty($article_ar['img'])) echo '<img src="/upload/articles/' . $article_ar['img'] . '" />'; ?>
                <?= $article_ar['text'] ?>
            </p>
        </div>
    <? endforeach; ?>
<? endif; ?>