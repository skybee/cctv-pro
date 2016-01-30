<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<form action="/admin/add_category_action/" enctype="multipart/form-data" id="page_form">

    <div class="form_container">
        <h2>Добавление категории</h2>
        
        <br />
        <b>*</b> Название | Сортировка<br />
        <input type="text" name="name" value="" style="width: 500px" />
        <input type="text" name="sort" value="1" style="width: 100px" maxlength="2" />

        <input type="hidden" name="img" value="" />
        <br />
        <b>*</b> Родительская категория:<br /> <br /> 
        <b>+</b> - Категория содержит подкатегории<br /> 
        <b>-</b> - Конечная категория
        <br />
        <select name="parent_cat">
            <option value="0">Главная</option>
            <?=$cat_select?>
        </select>
    </div>
    
    <div class="form_container">
        <h2>HTML и URL информация</h2>
        <b>*</b> Title (заголовок страницы)<br />
        <input type="text" name="html_title" value="" /><br />
        Description (описание страницы)<br />
        <input type="text" name="html_description" value="" /><br />
        Keywords (ключевые слова, перечисляются через запятую)<br />
        <input type="text" name="html_keywords" value="" /><br />
        <b>*</b> URL-адрес (допускаются только следующие символы: <b>a-z 0-9  -</b> )<br />
        <input type="text" name="url_name" value="" /><br />
    </div>
    
    <div class="form_container">
        <h2>Текст страницы</h2>
        Заголовок &lt;H1&gt;<br />
        <input type="text" name="h1" value="" />
        <br />
        
        Текст страницы:<br />
        <textarea style="width: 600px; height: 500px;" class="tinymce" name="text" ></textarea>
        
    </div>
    
    <div class="form_container">
        <h2>Изображение категории</h2>
        
        Загрузить с компьютера<br />
        <input type="file" name="image_local" accept="image/jpeg,image/png,image/gif" />
        <br /><br />
        Загрузить из интернета (URL)<br />
        <input type="text" name="image_url" />
    </div>
    
    <div class="form_container">
        <h2>Шаблон HTML информации для товаров</h2>
        ! В шаблоне в нужных местах необходимо вставить <b>#name#</b><br />
        При добавлении товара данная канструкция будет заменена на его название.<br />
        (Если данная категория не является конечной и в ней не предполагается размещение товаров, эти данные можно не заполнять)
        <br /><br />
        Description (описание страницы)<br />
        <input type="text" name="goods_description_tpl" value="" />
        <br />
        Keywords (ключевые слова, перечисляются через запятую)<br />
        <input type="text" name="goods_keywords_tpl" value="" />
    </div>

    
</form>

<div class="admin_button_block admin_button_block_page ">
    <div class="admin_button" onclick="tinyMCE.triggerSave(true, true);
                    send_form('#page_form', {title: 'Добавление категории', content: 'loader'})" >СОХРАНИТЬ</div>
</div>