<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<form action="/admin/upd_goods/" enctype="multipart/form-data" id="page_form">

    <div class="form_container">
        <h2>Редактирование: <?=$goods_data['name']?></h2>
        <p>
            Категории товара:<br /><br />
            <?php foreach($goods_data['category'] as $goods_category ): ?>
            <a href="/admin/goods_list/<?=$goods_category['id']?>/" class="ajax_load" ><?=$goods_category['name']?><a/> | 
            <?php endforeach;?>
        </p>
        <br />
        Название | Цена<br />
        <input type="text" name="name" value="<?=$goods_data['name']?>" style="width: 500px" />
        <input type="text" name="price" value="<?=$goods_data['price']?>" style="width: 100px" />
        
        <br /><br />
        House Control Синхронизация<br />
        HC ID: 
        &nbsp;&nbsp;
        <input type="text" name="hc_goods_id" value="<?=$goods_data['hc_goods_id']?>" style="width: 100px" />
        &nbsp;&nbsp; 
        Множитель: 
        &nbsp;&nbsp;
        <input type="text" name="hc_factor" value="<?=$goods_data['hc_factor']?>" style="width: 70px" />
        &nbsp;&nbsp;
        Выполнять синхронизацию:
        <input type="checkbox" name="hc_sync" value="1" <?php if($goods_data['hc_sync'] == '1') echo 'checked="checked"';?> style="position: relative; top: 3px;" />
        
        <br /><br />
        
        <input type="hidden" name="main_img" value="<?=$goods_data['main_img']?>" />
        <input type="hidden" name="goods_id" value="<?=$goods_data['id']?>" />
        <br />
        Краткое описание<br />
        <textarea style="width: 600px; height: 120px;" name="short_description" ><?=$goods_data['short_description']?></textarea>
        <br />
        Полное описание<br />
        <textarea style="width: 600px; height: 500px;" class="tinymce" name="description" ><?=$goods_data['description']?></textarea>
    </div>
    
    <div class="form_container">
        <h2>Изображение товара</h2>
        Главное изображение <a href="/upload/images/<?=$goods_data['main_img']?>" target="_blank" >посмотреть</a>
        <br /><br />
        Загрузить с компьютера<br />
        <input type="file" name="image_local" accept="image/jpeg,image/png,image/gif" />
        <br /><br />
        Загрузить из интернета (URL)<br />
        <input type="text" name="image_url" />
    </div>
    
    <div class="form_container">
        <h2>Категории товара</h2>
        Выбрать несколько категорий можно удерживая клавишу "Ctrl"
        <select multiple="multiple" style="width: 600px; height: 300px" name="categories[]" >
            <?=$cat_select?>
        </select>
    </div>
    
    <div class="form_container">
        <h2>Спец данные</h2>
        HTML Keywords <i>(перечисляются через запятую)</i><br />
        <input type="text" name="html_keywords" value="<?=$goods_data['html_keywords']?>" />
        <br />
        HTML Description
        <input type="text" name="html_description" value="<?=$goods_data['html_description']?>" />
    </div>
    
    <div class="form_container">
        <h2>Цены конкурентов</h2>
        
        <div style="display:none;" class="competitors_tpl">
            <div class="competitors_block">
                URL страницы товара сайта конкурента<br />
                <input type="text" name="competitors[]" value="" style="width: 670px" />
            </div>
        </div>
        
        <div class="competitors_list">
            <?php 
                if( count($competitors) ):
                    foreach($competitors as $cmptrs ): 
            ?>
                <div class="competitors_link_block competitors_link_block_<?=$cmptrs['id']?>">
                    <div class="clb_price_date">
                        ( <?=$cmptrs['price']?> грн. | <?=date( "d.m.y", strtotime($cmptrs['update']) )?> )
                    </div>
                    <div class="clb_link">
                        <a href="<?=$cmptrs['url']?>" target="_blank"><?=$cmptrs['url']?></a>
                    </div>
                    <div class="clb_del">
                        <a href="javascript:void(0)" onclick="send_post({id:'<?=$cmptrs['id']?>'},'/admin/del_competitors/',{title:'Удаление',content:'loader'})" >
                            [удалить]
                        </a>
                    </div>
                </div>
            <?php 
                    endforeach; 
                endif;
            ?>
        </div>
        
        <a href="javascript:void(0)" class="add_competitors_line" >[добаваит строку]</a>
    </div>

    
</form>

<div class="admin_button_block admin_button_block_page ">
    <div class="admin_button" onclick="tinyMCE.triggerSave(true, true);
                    send_form('#page_form', {title: 'Сохранение изменений', content: 'loader'})" >СОХРАНИТЬ</div>
</div>