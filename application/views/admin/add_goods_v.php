<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<form action="/admin/add_goods_action/" enctype="multipart/form-data" id="page_form">

    <div class="form_container">
        <h2>Добавление товара</h2>
        
        <br />
        <b>*</b> Название | <b>*</b> Цена<br />
        <input type="text" name="name" value="" style="width: 500px" />
        <input type="text" name="price" value="" style="width: 100px" />

        <br /><br />
        House Control Синхронизация<br />
        HC ID: 
        &nbsp;&nbsp;
        <input type="text" name="hc_goods_id" value="0" style="width: 100px" />
        &nbsp;&nbsp; 
        Множитель: 
        &nbsp;&nbsp;
        <input type="text" name="hc_factor" value="1" style="width: 70px" />
        &nbsp;&nbsp;
        Выполнять синхронизацию:
        <input type="checkbox" name="hc_sync" value="1"  style="position: relative; top: 3px;" />
        
        <br /><br />
        
        <b>*</b> Краткое описание<br />
        <textarea style="width: 600px; height: 120px;" name="short_description" ></textarea>
        <br />
        Полное описание<br />
        <textarea style="width: 600px; height: 500px;" class="tinymce" name="description" ></textarea>
    </div>
    
    <div class="form_container">
        <h2>Изображение товара</h2>
        <br /><br />
        Загрузить с компьютера<br />
        <input type="file" name="image_local" accept="image/jpeg,image/png,image/gif" />
        <br /><br />
        Загрузить из интернета (URL)<br />
        <input type="text" name="image_url" />
    </div>
    
    <div class="form_container">
        <h2>Категории товара</h2>
        <b>*</b> Выбрать несколько категорий можно удерживая клавишу "Ctrl"
        <select multiple="multiple" style="width: 600px; height: 300px" name="categories[]" >
            <?=$cat_select?>
        </select>
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
        </div>
        
        <a href="javascript:void(0)" class="add_competitors_line" >[добаваит строку]</a>
    </div>
    
<!--    <div class="form_container">
        <h2>Спец данные</h2>
        HTML Keywords <i>(перечисляются через запятую)</i><br />
        <input type="text" name="html_keywords" value="" />
        <br />
        HTML Description
        <input type="text" name="html_description" value="" />
    </div>-->

    
</form>

<div class="admin_button_block admin_button_block_page ">
    <div class="admin_button" onclick="tinyMCE.triggerSave(true, true);
                    send_form('#page_form', {title: 'Сохранение изменений', content: 'loader'})" >СОХРАНИТЬ</div>
</div>