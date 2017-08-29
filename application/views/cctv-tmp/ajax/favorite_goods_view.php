<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<ol class="mini-products-list" id="block-related">
    
    <?php 
        foreach ($goods_list as $goods_ar):
            $goodsUrl = "/goods/{$goods_ar['id']}/{$goods_ar['url_name']}/";
            $tagGoodsName = htmlspecialchars($goods_ar['name']);
    ?>
    <li class="item">
        <div class="product">
            <a href="<?=$goodsUrl?>" title="<?=$tagGoodsName?>" class="product-image">
                <img src="/upload/images/upper-small/<?=$goods_ar['main_img']?>" alt="<?=$tagGoodsName?>"/>
            </a>
            <p class="product-name">
                <a href="<?=$goodsUrl?>"><?=$goods_ar['name']?></a>
            </p>
            <div class="product-details">
                <div class="price-box">
                    <span class="regular-price" id="product-price-40-related">
                        <span class="price"><?= price_explode( $goods_ar['price'] ) ?></span> 
                    </span>
                </div>
            </div>
        </div>
    </li>
    <?php endforeach; ?>
    
</ol>