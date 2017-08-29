<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<div class="col-main col-xs-12 col-sm-9">
    <div class="padding-s">    
        
        <div class="std">
            <h1 id="page_info_h1"><?= $info_ar['title'] ?></h1>
            <div id="page_info_txt">
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
    <?php if ($articles_list): ?>
        <div class="page-title"><h2>Похожие статьи:</h2></div>
        <?php foreach ($articles_list as $article_ar): ?>
            <div class="article_prev_block">
                <div class="apb_title">
                    <a href="/article/<?= $article_ar['id'] . '/' . $article_ar['url_name'] . '/' ?>">
                        <?= $article_ar['title'] ?>
                    </a>
                </div>
                <p>
                    <?php if (!empty($article_ar['img'])) echo '<img src="/upload/articles/' . $article_ar['img'] . '" />'; ?>
                    <?= $article_ar['text'] ?>
                </p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    
</div>

