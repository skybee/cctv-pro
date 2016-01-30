<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<form action="/admin/change_price/" id="page_form">
    <input type="hidden" name="this_cat_id" value="<?=$cat_id?>" />
    <div class="form_container">
        <h2>Список товаров:</h2>

        <div class="goods_list_tbl">
            <table>
                <? if( count($goods_ar) ): ?>
                <tr>
                    <td colspan="2" style="padding: 0;">
                        <div class="goods_list_tools">
                            <div class="goods_list_tools_block">
                                <a href="javascript:void(0)" id="show_goods_list_cat" style="line-height: 35px;">Работа с категориями</a>
                                <div class="goods_list_category">
                                    <select multiple="multiple" style="width: 645px; height: 300px" name="goods_cat[]" >
                                        <?=$cat_select?>
                                    </select>
                                    Для выбора нескольких категорий удерживайте клавишу "Ctrl"
                                    <br /><br />
                                    Категории будут изменены только для выбранных товаров
                                    <div class="admin_button_block admin_button_block_page ">
                                        <div class="admin_button" onclick="send_form('#page_form', {title: 'Сохранение изменений', content: 'loader'}, '/admin/change_goods_cat/')" >ИЗМЕНИТЬ КАТЕГОРИИ</div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="goods_list_tools">
                            <div class="goods_list_tools_block">
                                <input type="checkbox" id="goods_listchange_all" />
                            </div>
                            <div class="goods_list_tools_block">
                                Умножить выбранные на 
                                <input type="text" name="multiply_price_input" id="multiply_price_input" value="1" />
                                <a href="javascript:void(0)" id="multiply_price_do">умножить</a>
                            </div>
                            <div class="goods_list_tools_block">
                                <a href="javascript:void(0)" id="show_del_goods">показать удаленные</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <? 
                    foreach($goods_ar as $goods): 
                        $hide = '';
                        if( $goods['price'] < 1 ) $hide = ' style="display:none;" ';
                ?>
                <tr <?=$hide?> class="goods_list_tr">
                    <td>
                        <input type="checkbox" name="check_goods[<?=$goods['id']?>]" value="<?=$goods['id']?>" class="goods_list_checkbox" />
                        <? if( $goods['competitors_cnt'] > 0 ): ?>
                        <span style="color: #46bf00">[<?=$goods['competitors_cnt']?>]</span> 
                        <? else: ?>
                        <span style="color: #e00000">[-]</span>
                        <? endif; ?>    
                        <a href="/admin/goods/<?=$goods['id']?>/" class="ajax_load" ><?=$goods['name']?></a>
                    </td>
                    <td>
                        <input type="text" name="price[<?=$goods['id']?>]" value="<?=$goods['price']?>" style="width:100px; margin: 3px 0px; height: 27px" />
                    </td>
                </tr>
                <? 
                        endforeach;
                    else: 
                ?>
                <tr>В этой категории отсутсутвуют товары</td>
                <? endif; ?>
            </table>
        </div>
    </div>
</form>

<div class="admin_button_block admin_button_block_page ">
    <div class="admin_button" onclick="send_form('#page_form', {title: 'Сохранение изменений', content: 'loader'})" >СОХРАНИТЬ</div>
</div>