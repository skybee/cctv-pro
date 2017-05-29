<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<div class="ajax_basket">
    <form>
    <?php
        $result_price = 0;
        foreach ($goods_list as $goods_ar): 
            $goods_ar['price']          = abs($goods_ar['price']);
            $count_ar[$goods_ar['id']]  = abs($count_ar[$goods_ar['id']]);
            $result_price =  $result_price + ( $goods_ar['price'] * $count_ar[$goods_ar['id']] );
    ?>
        <div class="ab_goods_block">
            <div class="img_block">
                <table><tr><td><img src="/upload/images/upper-small/<?= $goods_ar['main_img'] ?>" alt="" onerror="imgError(this);" /></td></tr></table>
            </div>
            
            <div class="ab_title_desc">
                <div class="ab_title">
                    <a href="/goods/<?= $goods_ar['id'] ?>/<?= $goods_ar['url_name'] ?>/" target="_blank"><?= $goods_ar['name'] ?></a>
                </div>
                <!--
                <div class="ab_description">
                    <?= $goods_ar['short_description'] ?>
                </div>
                -->
            </div>
            
            <div class="ab_right_block">
                <div class="ab_delete" onclick="del_goods_from_basket(this)"></div>
                <table>
                    <tr>
                        <td>К-во:</td>
                        <td class="ab_price">
                            <input type="text" price="<?= $goods_ar['price'] ?>" name="<?= $goods_ar['id'] ?>" value="<?=$count_ar[$goods_ar['id']]?>" onkeyup="re_summ_basket()" maxlength="3" />
                        </td>
                    </tr>
                    <tr>
                        <td>Цена:</td>
                        <td class="ab_price"><?= $goods_ar['price'] ?> грн.</td>
                    </tr>
                    <tr>
                        <td>Всего:</td>
                        <td class="ab_price ab_goods_summ"><span><?= number_format( $goods_ar['price'] * $count_ar[$goods_ar['id']], 2, '.', '' ) ?></span> грн.</td>
                    </tr>
                </table>
            </div>

        </div>

    <?php endforeach; ?>
    </form>
</div>

<div class="ajax_btn_block">
    <div class="result_price"><b><?=$result_price?></b> <span>грн.</span></div>
    <a href="javascript:void(0)" style="line-height: 33px;" onclick="close_modal()">&larr; Продолжить покупки</a>
    <a href="javascript:void(0)" class="mybtn" onclick="send_post('', '/ajax/basket/order/', {title:'Обработка данных',content:'loader'})">Оформить заказ</a>
</div>