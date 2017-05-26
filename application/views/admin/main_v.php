<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<html>
    <head>
        <title>Администрирование сайта</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="/js/admin/jquery.form.js"></script>
        <script type="text/javascript" src="/js/admin/form_action.js"></script>
        <script type="text/javascript" src="/js/admin/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="/js/admin/admin.js"></script>


        <link rel="stylesheet" type="text/css" href="/css/admin/reset.css" media="all" />
        <link rel="stylesheet" type="text/css" href="/css/admin/popup.css" media="all" />
        <link rel="stylesheet" type="text/css" href="/css/admin/admin.css" media="all" />
        
        <link rel="icon" href="/img/favico_32_2.png" type="image/png" />
        <link rel="shortcut icon" href="/img/favico_32_2.png" type="image/png" />
        
        
        
    </head>

    <body>
        
        <!-- MODAL WINDOW -->
            <div id="modal_bg" >
                <div id="modal_close_block"></div>
                <center>
                    <div id="modal_dialog_block">
                        <div id="modal_dialog_close" onclick="close_modal()"></div>
                        <div id="modal_dialog_title"></div>
                        <div id="modal_dialog_content"></div>
                    </div>
                </center>
            </div>
            <!-- /MODAL WINDOW -->
        
        <div id="top_blue">
            <a href="/admin/logout/" id="logout">Выход</a>
        </div>
        <div id="main_block">
            <div id="left_menu_block">
                <a href="/admin/all_goods/" class="ajax_load active_page" >Категории | Товары</a>
                <a href="/admin/add_goods/" class="ajax_load" >Добавление товаров</a>
                <a href="/admin/add_category/" class="ajax_load" >Добавление категорий</a>
                <div class="menu_spacer"></div>
                <a href="/admin/hi_price/" class="ajax_load" >Высокие цены (<?=$cnt_hi_price?>)</a>
                <div class="menu_spacer"></div>
                <div id="multiply_price_all">
                    <div id="multiply_price_all_title">Умножение Цен</div>
                    <div id="multiply_price_all_form_block">
                        <form action="/admin/multiply_price_all/" enctype="multipart/form-data" id="multiply_price_all_form">
                            <input type="text" value="1.0" name="multiply_price" />
                        </form>
                        <div class="admin_button" onclick="send_form('#multiply_price_all_form', {title: 'Умножение цен', content: 'loader'})" >ОК</div>
                    </div>
                </div>
                <div class="menu_spacer"></div>
                <a href="/doc_form/check/"      target="_blank">Чек+Гарантия</a>
                <a href="/doc_form/invoice/"    target="_blank">Счет</a>
                <a href="/doc_form/bill/"       target="_blank">Накладная</a>
                <a href="/doc_form/proposal/"   target="_blank">Ком. Предложение</a>
                <a href="/doc_form/act/"        target="_blank">Акт работ</a>
                <a href="/doc_form/repair/"     target="_blank">Талон Ремонта</a>
            </div>

            <div id="right_content_block">
                <?=$content?>
            </div>
        </div>
    </body>
</html>