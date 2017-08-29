<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<form action="/admin/change_price/" id="page_form">
    <div class="form_container">
        <h2>Товары с высокой ценой</h2>

        <div class="goods_list_tbl">
            <table>
                <?php if( count($goods_ar) ): 
                    foreach($goods_ar as $goods):
                ?>
                <tr class="goods_list_tr" style="border-bottom: 1px #aaa solid;">
                    <td>    
                        <a href="/admin/goods/<?=$goods['id']?>/" class="ajax_load" style="font-weight: bold;" ><?=$goods['name']?></a>
                        <div class="hi_price_block">
                            <table style="width: 100%">
                                <?php foreach($goods['competitors'] as $competitors): ?>
                                <tr>
                                    <td style="width: 30px;">Цена:</td>
                                    <td style="width: 70px; text-align: right;"><?=$competitors['price']?> грн.</td>
                                    <td style="width: 70px; padding-left: 15px;">Проверено:</td>
                                    <td style="width: 70px;"><?=date( "d.m.y", strtotime($competitors['update']) )?></td>
                                    <td>
                                        <span>
                                            <a href="<?=$competitors['url']?>" target="_blank"><?=$competitors['url']?></a>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </td>
                    <td>
                        <input type="text" name="price[<?=$goods['id']?>]" value="<?=$goods['price']?>" style="width:100px; margin: 3px 0px; height: 27px" />
                    </td>
                </tr>
                <?php
                        endforeach;
                    else: 
                ?>
                <tr>Нет товаров с высокой ценой</td>
                <?php endif; ?>
            </table>
        </div>
    </div>
</form>

<div class="admin_button_block admin_button_block_page ">
    <div class="admin_button" onclick="send_form('#page_form', {title: 'Сохранение изменений', content: 'loader'})" >СОХРАНИТЬ</div>
</div>