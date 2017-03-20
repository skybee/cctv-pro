<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="block block-related">
    <div class="block-title">
        <strong><span>Статьи и Новости</span></strong>
    </div>
    <div class="block-content" >
        <ol class="mini-products-list" id="block-related">
            <?php foreach($left_articles_list as $article_ar): ?>
            <li class="item left-rticles-prew">
                <div class="product">
                    <a href="/article/<?=$article_ar['id']?>/<?=$article_ar['url_name']?>/"><?=$article_ar['title']?></a>
                    
                    <div class="product-details">
                        <div class="price-box">
                            <span class="regular-price" id="product-price-40-related">
                                <?=$article_ar['text']?>
                            </span>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>

        </ol>
        <script type="text/javascript">decorateList('block-related', 'none-recursive')</script>
    </div>
</div>