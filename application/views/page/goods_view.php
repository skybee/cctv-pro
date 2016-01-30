<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script type="text/javascript" >
    $(document).ready(function(){
        $.post('/ajax/goods/set_top/', {id:<?=$goods_info['id']?>, ref: document.referrer});
        $('a.colorbox').colorbox({
            opacity: '0.5',
            maxWidth: '90%',
            maxHeight: '90%',
            initialWidth: '265',
            initialHeight: '290',
            fixed: true
        });
    });
</script>
<script type="text/javascript" src="/js/help_window.js" ></script>

<div class="shipping_btn_block">
    <a href="/info/shipping_payment/" target="_blank" class="shipping_btn">Доставка товаров по всей Украине</a>
</div>


<div class="product-view">
    
    
    <div class="product-essential" itemscope itemtype="http://data-vocabulary.org/Product">
        <div class="product-name-info">
            <h1 id="jq_goods_id" val="<?=$goods_info['id']?>" itemprop="name"><?=$goods_info['name']?></h1>
            <span itemprop="category" content="<?=$this_cat['name']?>" ></span>
        </div>

            <div class="product-shop" >
                
                <div class="goods_cart_buy" itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
                    <div class="regular-price goods_cart_price">
                        <meta itemprop="currency" content="UAH" />
                        <span itemprop="availability" content="in_stock"></span>
                        <span itemprop="price" style="display:none;"><?=$goods_info['price']?></span>
                        <div>&nbsp;</div>
                        <span class="price">
                            <?= price_explode( $goods_info['price'] ) ?>
                        </span>                
                    </div>

                    <a href="javascript:void(0)" class="mybtn goods_bay_btn" onclick="send_post({id:'<?=$goods_info['id']?>',cnt: $('input[name=cnt_goods]').attr('value') }, '/ajax/basket/show_basket/', {title:'Добавление товара в корзину',content:'loader'});">КУПИТЬ</a>
                    
                    <div class="goods_count">
                        <input type="text" value="1" name="cnt_goods" maxlength="3"/>
                        <div id="cnt_goods_txt">шт.</div>
                        <div id="cnt_goods_arrow"></div>
                    </div>
                </div>

                <div class="clear"></div>
                
                <div class="warranty">Гарантия: &nbsp; <span><span><?=$goods_info['warranty']?></span> &nbsp;мес.</span></div>


                <div class="short-description">
                    <h2>Краткое описание</h2>
                    <div class="std" itemprop="description"><?= nl2br( $goods_info['short_description'] )?></div>
                </div>

            </div>

            <div class="product-img-box">
                <table>
                    <tr>
                        <td>
                            <a href="/upload/images/<?=$goods_info['main_img']?>" class="colorbox" >
                                <img itemprop="image" id="image" src="/upload/images/265x290/<?=$goods_info['main_img']?>" alt="<?=$goods_info['name']?>" onerror="imgError(this);" >
                            </a>    
                        </td>
                    </tr>
                </table>
            </div>
            <div class="clearer"></div>
    </div>
    
    <!-- GAds -->
    <div class="gad-in-goods" style="margin-bottom: 10px;padding: 5px 0px;">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- HC Block -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:468px;height:60px"
             data-ad-client="ca-pub-8808008647670842"
             data-ad-slot="3469573011"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
    <!-- /GAds -->

    <div class="product-collateral">
        <div class="box-collateral box-description">
            <h2>Подробное описание:</h2>
            <div class="std goods_full_description"><?= $goods_info['description']?></div>
        </div>
    </div>
</div>

<div class="page-title">
    <h2>Похожие товары:</h2>
</div>
<!--<h2 style="font-size: 15px; margin: 15px 0px 10px 0px">Похожие товары:</h2>-->