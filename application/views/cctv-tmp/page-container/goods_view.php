<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script type="text/javascript">
    jQuery.post('/ajax/goods/set_top/', {id:<?=$goods_info['id']?>, ref: document.referrer});
</script>


<div class="col-main col-xs-12 col-sm-9">
    <div class="padding-s">
        <div id="messages_product_view"></div>
        <div class="product-view">
            <div class="product-essential" itemscope itemtype="http://data-vocabulary.org/Product">
                <form action="#" method="post" id="product_addtocart_form">
                    <input name="form_key" type="hidden" value="KngVVWs6nCAFXIx8"/>
                    <div class="no-display">
                        <input type="hidden" name="product" value="5"/>
                        <input type="hidden" name="related_product" id="related-products-field" value=""/>
                    </div>
                    <div class="product-img-box">
                        
                        <?php if($goods_info['price_changed'] === true):?>
                        <div class="product-img-sale">- <?=$goods_info['region_discount']?>%</div>
                        <?php endif;?>
                        
                        <div class="product-box-customs">
                            <p class="product-image">
                                <?php
                                    $tagGoodsName = htmlspecialchars($goods_info['name']);
                                ?>
                                <a href="/upload/images/<?=$goods_info['main_img']?>" target="_blank" >
                                    <img itemprop="image" class="big" src="/upload/images/medium/<?=$goods_info['main_img']?>" alt="<?=$tagGoodsName?>" title="<?=$tagGoodsName?>"/>
                                </a>
                            </p>
                            
                            
                        </div>
                    </div>
                    <div class="product-shop">
                        <div class="product-name">
                            <h1 id="jq_goods_id" val="<?=$goods_info['id']?>" itemprop="name"><?=$goods_info['name']?></h1>
                            <span itemprop="category" content="<?=$this_cat['name']?>" ></span>
                        </div>
                        <p class="availability in-stock">Гарантия: <span>12 мес.</span></p>

                        <p class="availability-only">
                            <!--<span title="Only 10000 left">Only <strong>10000</strong> left</span>-->
                        </p>
                        <div class="price-box" itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
                            <meta itemprop="currency" content="UAH" />
                            <span itemprop="availability" content="in_stock"></span>
                            <span itemprop="price" style="display:none;"><?=$goods_info['price']?></span>
                            
                            <span class="regular-price" id="product-price-5">
                                <span class="price">
                                    <?php if($goods_info['price_changed'] === true):?>
                                    <span class="old-price">
                                        &nbsp;<?= $goods_info['old_price'] ?>&nbsp;
                                    </span>
                                    <?php endif;?>
                                    <?= price_explode( $goods_info['price'] ) ?>
                                </span> 
                            </span>
                        </div>
                        <div class="clear"></div>
                        <div class="short-description">
                            <div class="std" itemprop="description">
                                <p><?= nl2br( $goods_info['short_description'] )?></p>
                            </div>
                        </div>
                        <div class="clear"></div>
                        
                        <?php if($goods_info['price'] > 0):?>
                        <div class="add-to-box">
                            <div class="add-to-cart">
                                <div class="qty-block">
                                    <label for="qty">К-во:</label>
                                    <input type="text" name="cnt_goods" id="qty" maxlength="12" value="1" title="Qty" class="input-text qty"/>
                                </div>
                                <button type="button" title="Add to Cart" class="button btn-cart" onclick="send_post({id:'<?=$goods_info['id']?>',cnt: jQuery('input[name=cnt_goods]').attr('value') }, '/ajax/basket/show_basket/', {title:'Добавление товара в корзину',content:'loader'});">
                                    <span><span>КУПИТЬ</span></span>
                                </button>
                            </div>
                            <!--<span class="or">OR</span>-->
                        </div>
                        <?php endif;?>
                    </div>
                    <div class="clearer"></div>
                </form>
            </div>
            <div class="product-collateral">
                <div class="box-collateral box-description">
                    <h2>Описание и Характеристики</h2>
                    <div class="box-collateral-content hide-goods-descript">
                        <div id="goods_descript_height">
                            <div class="std goods_full_description">
                                <?= $goods_info['description']?>
                                
                                <?php if($like_video=0): ?>
                                <h2 style="margin-top: 50px;">Видео из YouTube</h2>
                                <div class="goods-youtube-block" id="like-video-container">
                                    <?php foreach ($like_video as $lVideo): ?>
                                    <div class="like-video-item">
                                        <div class="like-video-item-left">
                                            <div class="respon_video">
                                                <iframe width="auto" height="auto"  src="https://www.youtube.com/embed/<?=$lVideo['video_id']?>" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                        <div class="like-video-item-right">
                                            <h3><?=$lVideo['title']?></h3>
                                            <p><?=$lVideo['description']?></p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                                
                                <div class="rnd-goods-descript">
                                    <?php if(!empty($rnd_descript)){ echo  '<p>'.$rnd_descript.'</p>';} ?>
                                    <?php if(!empty($rnd_city_shipping)){ echo  '<p>'.$rnd_city_shipping.'</p>';} ?>
                                </div>
                                
                            </div>
                            <div id="full_description_footer">
                                <div class="show-goods-descript-btn"><txt id="btn_txt">показать</txt> <span id="btn_ico" class="fa fa-angle-down fa-2x"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- LIKE GOODS -->
        <?=$tpl_container['like_goods']?>
        <!-- /LIKE GOODS -->
        
    </div>
</div>