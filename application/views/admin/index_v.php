<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<form action="/admin/upd_cat_sort/" id="page_form">

    <div class="form_container">
        <h2>Категории | Товары:</h2>
        <div class="category_list_block">
            <?=$category_list?>
        </div>
    </div>
    
    <div class="admin_button_block admin_button_block_page ">
        <div class="admin_button" onclick="send_form('#page_form', {title: 'Сохранение изменений', content: 'loader'})" >СОХРАНИТЬ СОРТИРОВКУ</div>
    </div>

    
</form>
