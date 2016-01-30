<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<html>
    <head>
        <title>Администрирование сайта</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!--<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>-->
        <!--<script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <!--<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>-->
        <script type="text/javascript" src="/js/jquery.form.js"></script>
        <script type="text/javascript" src="/js/form_action.js"></script>
        <script type="text/javascript" src="/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="/js/admin.js"></script>


        <link rel="stylesheet" type="text/css" href="/css/reset.css" media="all" />
        <!--<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" media="all" />-->
        <!--<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic,latin-ext' rel='stylesheet' type='text/css'>-->
        <link rel="stylesheet" type="text/css" href="/css/popup.css" media="all" />
        <link rel="stylesheet" type="text/css" href="/css/admin.css" media="all" />
        
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
            </div>

            <div id="right_content_block">
                <?=$content?>
            </div>
        </div>
    </body>
</html>