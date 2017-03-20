<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<html>
    <head>
        <title>Авторизация</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <script type="text/javascript" src="/js/admin/jquery-1.7.2.min.js"></script>
        <!--<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>-->
        <script type="text/javascript" src="/js/admin/jquery.form.js"></script>
        <script type="text/javascript" src="/js/admin/form_action.js"></script>
        <script type="text/javascript" src="/js/admin/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript" src="/js/admin/admin.js"></script>


        <link rel="stylesheet" type="text/css" href="/css/admin/reset.css" media="all" />
        <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" media="all" />
        <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="/css/admin/popup.css" media="all" />
        <link rel="stylesheet" type="text/css" href="/css/admin/admin.css" media="all" />
        
        
        
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
        
        <div id="top_blue"></div>
        <div id="main_block">
            
            <div class="form_container" id="login_block">
                <form action="/admin/auth/" id="login_form">
                <h2>Авторизация</h2>
                Логин:<br />
                <input type="text" name="login" />
                <br />
                Пароль:<br />
                <input type="password" name="password" />
                </form>
                <div class="admin_button_block">
                    <div class="admin_button" onclick="send_form('#login_form', {title: 'Авторизация', content: 'loader'})" >
                        ВОЙТИ
                    </div>
                </div>
            </div>
            
        </div>
    </body>
</html>