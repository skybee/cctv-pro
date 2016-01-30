<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<form action="/admin/upd_category/" enctype="multipart/form-data" id="page_form">

    <div class="form_container">
        <h2>Редактирование категории: <?=$cat_data['name']?></h2>
        
        <br />
        Название | Сортировка<br />
        <input type="text" name="name" value="<?=$cat_data['name']?>" style="width: 500px" />
        <input type="text" name="sort" value="<?=$cat_data['sort']?>" style="width: 100px" maxlength="2" />

        <input type="hidden" name="cat_id" value="<?=$cat_data['id']?>" />
        <input type="hidden" name="img" value="<?=$cat_data['img']?>" />
        <br />
        Родительская категория:<br /> <br /> 
        <b>+</b> - Категория содержит подкатегории<br /> 
        <b>-</b> - Конечная категория
        <br />
        <select name="parent_cat">
            <option value="0">Главная</option>
            <?=$cat_select?>
        </select>
        <br /><br />
        <a href="/admin/category/<?=$cat_data['parent_id']?>/" class="ajax_load" >Перейти к родительской категории<a/> | 
        <a href="/admin/goods_list/<?=$cat_data['id']?>/" class="ajax_load" >Перейти к товарам этой категории<a/>
    </div>
    
    <div class="form_container">
        <h2>HTML и URL информация</h2>
        Title (заголовок страницы)<br />
        <input type="text" name="html_title" value="<?=$cat_data['html_title']?>" /><br />
        Description (описание страницы)<br />
        <input type="text" name="html_description" value="<?=$cat_data['html_description']?>" /><br />
        Keywords (ключевые слова, перечисляются через запятую)<br />
        <input type="text" name="html_keywords" value="<?=$cat_data['html_keywords']?>" /><br />
        URL-адрес (допускаются только следующие символы: <b>a-z 0-9  -</b> ) !Не менять без особой надобности<br />
        <input type="text" name="url_name" value="<?=$cat_data['url_name']?>" /><br />
    </div>
    
    <div class="form_container">
        <h2>Текст страницы</h2>
        Заголовок &lt;H1&gt;<br />
        <input type="text" name="h1" value="<?=$cat_data['h1']?>" />
        <br />
        
        Текст страницы:<br />
        <textarea style="width: 600px; height: 500px;" class="tinymce" name="text" ><?=$cat_data['text']?></textarea>
        
    </div>
    
    <div class="form_container">
        <h2>Изображение категории</h2>
        Главное изображение <a href="/upload/images/<?=$cat_data['img']?>" target="_blank" >посмотреть</a>
        <br /><br />
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
        <input type="text" name="goods_description_tpl" value="<?=$cat_data['goods_description_tpl']?>" />
        <br />
        Keywords (ключевые слова, перечисляются через запятую)<br />
        <input type="text" name="goods_keywords_tpl" value="<?=$cat_data['goods_keywords_tpl']?>" />
    </div>

    
</form>

<div class="admin_button_block admin_button_block_page ">
    <div class="admin_button" onclick="tinyMCE.triggerSave(true, true);
                    send_form('#page_form', {title: 'Сохранение изменений', content: 'loader'})" >СОХРАНИТЬ</div>
</div>