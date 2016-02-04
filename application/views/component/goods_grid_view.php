<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

    $cnt_goods  = count($goods_list);
    if( $cnt_goods < 1 ) return '';
?>


<div class="new_products">
<?php if( isset($cat_info) ): ?>
    <div class="page-title"><h2><?=$cat_info['name']?> / Товары: <?php if($page_nmbr > 1 ) echo "стр. {$page_nmbr}" ?></h2></div>                                 
<?php endif; ?>

<?php if( isset($order_val) ): ?>    
<div id="order_goods_block" rel="<?=$order_val?>" >
    <span>Упорядочить: &nbsp;</span>
<!--    <a href="#"   id="price">Цена</a>
    <a href="#"    id="rank">Популярность</a>
    <a href="#"    id="name">Название</a>-->
    
    <a href="/category/<?=$cat_name?>/1/order/price/"   id="price">Цена</a>
    <a href="/category/<?=$cat_name?>/1/order/rank/"    id="rank">Популярность</a>
    <a href="/category/<?=$cat_name?>/1/order/name/"    id="name">Название</a>
</div>
<?php endif; ?>    
    
<?php    
    $i = 0;
    while( $i < $cnt_goods ):
?>
<ul class="products-grid">
    <?php for($ii=0; $ii<3 && $i<$cnt_goods; $ii++, $i++): ?>
        <li class="item <?php if($ii == 0) echo 'first'; ?>">
            <h3 class="product-name">
                <!--<a href="#" ><?=$goods_list[$i]['name']?></a>-->
                <a href="/goods/<?=$goods_list[$i]['id']?>/<?=$goods_list[$i]['url_name']?>/" ><?=$goods_list[$i]['name']?></a>
            </h3>
            <!--<a href="#" class="product-image">-->
            <a href="/goods/<?=$goods_list[$i]['id']?>/<?=$goods_list[$i]['url_name']?>/" class="product-image">   
                <table>
                    <tr>
                        <td><img src="/upload/images/160x160/<?=$goods_list[$i]['main_img']?>"  alt="<?=$goods_list[$i]['name']?>" onerror="imgError(this);" /></td>
                    </tr>
                </table>
            </a>
            <div class="new_descr" title="<?= htmlspecialchars( $goods_list[$i]['short_description'] )?>">
                <?=$goods_list[$i]['short_description']?>
                <div class="descr_gradient"></div>
            </div>                



            <div class="price-box">
                <span class="regular-price">
                    <span class="price"><?= price_explode( $goods_list[$i]['price'] ) ?></span>                
                </span>
            </div>

            <div class="actions">
                <input type="text" name="cnt_goods_grid_<?=$goods_list[$i]['id']?>" value="1" maxlength="3" />
                <button type="button"  class="button btn-cart" onclick="send_post({id:'<?=$goods_list[$i]['id']?>',cnt: $('input[name=cnt_goods_grid_<?=$goods_list[$i]['id']?>]').attr('value') }, '/ajax/basket/show_basket/', {title:'Добавление товара в корзину',content:'loader'})" >
                    <span><span>КУПИТЬ</span></span>
                </button>
            </div>
        </li>
    <?php endfor; ?>
</ul>
<?php endwhile; ?>    
</div>



<?php if( isset($goods_info) ): ?>
<div class="shipping_btn_block">
    <!--<a href="#" class="shipping_btn show_all_goods_btn">Показать все товары этой категории</a>-->
    <a href="/category/<?= $breadcrumb_list[ count($breadcrumb_list)-1 ]['url_name']?>/" class="shipping_btn show_all_goods_btn">Показать все товары этой категории</a>
</div>
<?php endif; ?>



<div class="my_breadcrumb city_list_block">
    <strong><?= get_citty_str(); ?></strong>
</div>

<?php if( isset($pager_ar) ): ?>
<div class="page-title">
    <h2>
    <div class="goods_pager">
        <ul>
            <?php foreach($pager_ar as $page): ?>
            <li>
                <?php if($page != $page_nmbr && $page != '...'): ?>
                <!--<a href="#"><?=$page?></a>-->
                <a href="/category/<?=$cat_name?>/<?=$page?>/<?=$link_order?>"><?=$page?></a>
                <?php else: ?>
                <?=$page?>
                <?php endif;?>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    </h2>
</div>
<?php endif; ?>