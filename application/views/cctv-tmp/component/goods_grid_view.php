<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

    $cnt_goods  = count($goods_list);
    if( $cnt_goods < 1 ) return '';

//    print_r($goods_list);
?>


<?php    
    $i = 0;
    while( $i < $cnt_goods ):
?>

<ul class="products-grid row">
    <?php 
        for($ii=0; $ii<3 && $i<$cnt_goods; $ii++, $i++): 
            $goodsLink      = "/goods/{$goods_list[$i]['id']}/{$goods_list[$i]['url_name']}/";
            $tagGoodsName   = htmlspecialchars($goods_list[$i]['name']);
    ?>
    <li class="item <?php if($ii == 0) echo 'first'; ?> col-xs-12 col-sm-4">
        <div class="grid_wrap">
            
            <?php if($goods_list[$i]['price_changed'] === true):?>
            <div class="grid_wrap_sale">- <?=$goods_list[$i]['region_discount']?>%</div>
            <?php endif;?>
            
            <a href="<?=$goodsLink;?>" title="<?=$tagGoodsName?>" class="product-image" target="_blank">
                <span class="googs-img-tbl" >
                    <span class="googs-img-tr">
                        <span class="googs-img-td">
                            <img src="/upload/images/upper-small/<?=$goods_list[$i]['main_img']?>" alt="<?=$tagGoodsName?>"/>
                        </span>
                    </span>
                </span>
            </a>
            <div class="product-shop">
                <h2 class="product-name">
                    <a href="<?=$goodsLink;?>" title="<?=$tagGoodsName?>" target="_blank"><?=$goods_list[$i]['name']?></a>
                </h2>
                <div class="desc_grid" title="<?= htmlspecialchars( $goods_list[$i]['short_description'] )?>">
                    <?=$goods_list[$i]['short_description']?>
                </div>
                <div class="price-box">
                    <span class="regular-price" id="product-price-1">
                        <span class="price"><?=price_explode($goods_list[$i]['price'])?></span> </span>
                </div>
                <div class="actions">
                    <a title="Положить в Корзину" href="javascript:void(0)" class="btn-cart" onclick="send_post({id:'<?=$goods_list[$i]['id']?>',cnt: 1 }, '/ajax/basket/show_basket/', {title:'Добавление товара в корзину',content:'loader'})">
                        <i class="fa fa-shopping-cart fa-2x"></i>
                        <span>В Корзину</span>
                    </a>
<!--                    <div class="btn_details">
                        <button type="button" title="Подробнее" class="button btn-details" onclick="setLocation('<?=$goodsLink;?>')">
                            <span><span>Подробнее</span></span>
                        </button>
                    </div>-->
                </div>
            </div>
<!--            <div class="label-product">
            </div>-->
        </div>
    </li>
    <?php endfor; ?>
</ul>
<?php endwhile; ?>