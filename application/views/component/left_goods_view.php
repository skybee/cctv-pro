<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<div class="left_menu_title">
    НАШИ ТОВАРЫ
    <div class="bottom_row"></div>
</div>

<div id="ajax_favorite" class="ajax_favorite">
    
    <? foreach ($left_goods_list as $goods_ar): ?>
        <div class="ajax_fav_block">
            <div class="fav_title">
                <!--<a href="#" ><?=$goods_ar['name']?></a>-->
                <a href="/goods/<?=$goods_ar['id']?>/<?=$goods_ar['url_name']?>/" ><?=$goods_ar['name']?></a>
            </div>
            <div class="fav_content">
                <img  src="/upload/images/70x70/<?=$goods_ar['main_img']?>"  alt="" onerror="imgError(this);" />
                <div class="fav_price"><?= price_explode( $goods_ar['price'] ) ?></div>
            </div>
        </div>
    <? endforeach; ?>
    
    <? if( isset($links['isset']) && $links['isset'] == true ): ?>
    <div class="ajax_fav_block spe_block">
        <?=$links['html']?>
    </div>
    <? endif; ?>
    
</div>