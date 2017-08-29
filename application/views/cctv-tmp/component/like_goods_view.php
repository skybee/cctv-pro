<?php 
    if (!defined('BASEPATH')) exit('No direct script access allowed'); 
    $cnt_goods  = count($goods_list);
    if( $cnt_goods < 1 ) return '';
?>

<div class="box-collateral box-up-sell">
    <h2>Похожие товары</h2>
    
<?php    
    $i = 0;
    while( $i < $cnt_goods ):
?>
    
<ul class="products-ups up-sell-carousel-none">
    <?php 
        for($ii=0; $ii<3 && $i<$cnt_goods; $ii++, $i++): 
            $goodsLink      = "/goods/{$goods_list[$i]['id']}/{$goods_list[$i]['url_name']}/";
            $tagGoodsName   = htmlspecialchars($goods_list[$i]['name']);
    ?>
    <li class="item">
        <div class="product-box">
            <a href="<?=$goodsLink?>" title="<?=$tagGoodsName?>" class="product-image">
                <span class="like-googs-img-tbl">
                    <span class="like-googs-img-tbl">
                        <span class="like-googs-img-td">
                            <img src="/upload/images/upper-small/<?=$goods_list[$i]['main_img']?>" alt="<?=$tagGoodsName?>"/>
                        </span>
                    </span>
                </span>
            </a>
            <div class="noSwipe">
                <h3 class="product-name">
                    <a href="<?=$goodsLink?>" title="<?=$tagGoodsName?>"><?=$goods_list[$i]['name']?></a></h3>
                <div class="price-box">
                    <span class="regular-price" id="product-price-6-upsell">
                        <span class="price"><?=price_explode($goods_list[$i]['price'])?></span> 
                    </span>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </li>
    <?php endfor; ?>
</ul>
<?php endwhile; ?>    
</div>