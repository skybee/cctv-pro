<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title><?= $head_data['html_title'] ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description"        content="<?= $head_data['html_description'] ?>" />
        <meta name="keywords"           content="<?= $head_data['html_keywords'] ?>" />

        <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="/js/loopedslider.js"></script>
        <script type="text/javascript" src="/js/jquery.tipTip.minified.js"></script>
        <script type="text/javascript" src="/js/jquery.form.js"></script>
        <script type="text/javascript" src="/js/jquery.json-2.3.min.js"></script>
        <script type="text/javascript" src="/js/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="/js/form_action.js"></script>
        <script type="text/javascript" src="/js/sb-script.js"></script>


        <!--[if lt IE 9]>
        <style type="text/css">
        .products-grid .product-image img{ width: 150px; }
        .products-grid li.item,
        .block,
        .block .block-title,
        .block-cart .subtotal,
        .products-grid li.item,
        .products-list li.item,
        .product-essential,
        .product-collateral .box-collateral,
        .advanced-search-amount,
        .advanced-search-summary,
        .cart .crosssell,
        .cart .discount,
        .cart .shipping,
        .cart .totals,
        .opc,
        .opc .step-title,
        .account-login #login-form,
        .dashboard .welcome-msg,
        .box-account,
        .cms_border
        { behavior:url(--/js/ie/PIE.php) }
        </style>
        <![endif]-->
        <!--[if lt IE 7]>
        <script type="text/javascript">
        //<![CDATA[
            var BLANK_URL = '/js/blank.html';
            var BLANK_IMG = '---/js/ie/spacer2.gif';
        //]]>
        </script>
        <![endif]-->
        <!--[if lt IE 7]>
            <div style=' clear: both; text-align:center; position: relative;'>
                <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/upgrade.jpg" border="0"  alt="" /></a>
            </div>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="/css/styles.css" media="all" />
        <link rel="stylesheet" type="text/css" href="/css/widgets.css" media="all" />
        <link rel="stylesheet" type="text/css" href="/css/tipTip.css" media="all" />
        <link rel="stylesheet" type="text/css" href="/css/sb-style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="/css/new_dark.css" media="all" />
        <link rel="stylesheet" type="text/css" href="/css/colorbox.css" media="all" />

        <link rel="icon" href="/img/favico_32_2.png" type="image/png" />
        <link rel="shortcut icon" href="/img/favico_32_2.png" type="image/png" />
    </head>

        <body class=" cms-index-index cms-home">
            <!--<div style="padding: 6px; border: #c00 2px solid; font-size: 16px; color: #c00; background: #ffff90; ">К ВНИМАНИЮ ПОКУПАТЕЛЕЙ: &nbsp;&nbsp; с 31.12 по 10.01 &nbsp;&nbsp; Магазин не работает</div>-->
                <?=$counter['yandex'].$counter['google']?>
            <!-- MODAL WINDOW -->
            <div id="modal_bg">
                <center>
                    <div id="modal_dialog_block">
                        <div id="modal_dialog_close" onclick="close_modal()"></div>
                        <div id="modal_dialog_title"></div>
                        <div id="modal_dialog_content"></div>
                    </div>
                </center>
            </div>
            <!-- /MODAL WINDOW -->        

            <div class="wrapper">
                <div class="top_bg"></div>
                <div class="page">
                    <div class="header-container">
                        <div class="header">
                            <?=$top_contact?>
                            <div class="head_row2">
                                    <div class="form-search">
                                                <div class="ya-site-form ya-site-form_inited_no" onclick="return {'bg': 'transparent', 'target': '_self', 'language': 'ru', 'suggest': true, 'tld': 'ru', 'site_suggest': true, 'action': 'http://house-control.org.ua/search/', 'webopt': false, 'fontsize': 12, 'arrow': false, 'fg': '#000000', 'searchid': '1956690', 'logo': 'rb', 'websearch': false, 'type': 3}"><form action="http://yandex.ru/sitesearch" method="get" target="_self"><input type="hidden" name="searchid" value="1956690" /><input type="hidden" name="l10n" value="ru" /><input type="hidden" name="reqenc" value="" /><input type="text" name="text" value="" /><input type="submit" value="Найти" /></form></div><style type="text/css">.ya-page_js_yes .ya-site-form_inited_no { display: none; }</style><script type="text/javascript">(function(w, d, c) {
                                        var s = d.createElement('script'), h = d.getElementsByTagName('script')[0], e = d.documentElement;
                                        (' ' + e.className + ' ').indexOf(' ya-page_js_yes ') === -1 && (e.className += ' ya-page_js_yes');
                                        s.type = 'text/javascript';
                                        s.async = true;
                                        s.charset = 'utf-8';
                                        s.src = (d.location.protocol === 'https:' ? 'https:' : 'http:') + '//site.yandex.net/v2.0/js/all.js';
                                        h.parentNode.insertBefore(s, h);
                                        (w[c] || (w[c] = [])).push(function() {
                                            Ya.Site.Form.init()
                                        })
                                    })(window, document, 'yandex_site_callbacks');
                                                                        </script>
                                    </div>
                                <?= $top_menu ?>            
                            </div>
                        </div>
                    </div>

                    <div class="main-container col2-left-layout">
                        <div class="main">                
                            <div class="col-main">
                                <div class="std">

                                    <!-- TOP SLIDER -->
                                    <?php #= $top_slider ?>

                                    <div>
                                        <?= $content ?>
                                    </div>
                                </div>                
                            </div>
                            <div class="col-left sidebar">

                                <div class="left_menu_title">
                                    КОРЗИНА
                                    <div class="bottom_row"></div>
                                </div>

                                <div class="menu_basket" onclick="send_post('', '/ajax/basket/show_basket/', {title: 'Обработка данных', content: 'loader'})">
                                    <table>
                                        <tr>
                                            <td style="width: 50px;">Товаров:</td>
                                            <td><span id="menu_basket_goods">0</span> шт.</td>
                                        </tr>
                                        <tr>
                                            <td>На&nbsp;сумму:</td>
                                            <td><span id="menu_basket_price">0.00</span> грн.</td>
                                        </tr>
<!--                                        <tr>
                                            <td colspan="2">
                                                <a href="javascript:void(0)" onclick="send_post('', '/ajax/basket/show_basket/', {title: 'Обработка данных', content: 'loader'})">Открыть корзину  &gt;</a>
                                            </td>
                                        </tr>-->
                                    </table>
                                </div>


                                <!-- cat menu -->                
                                <?= $cat_menu ?>
                                
                                <?php #if( isset($left_banner) ) echo $left_banner ?>


                                <div class="left_menu_title">
                                    ПРОСМОТРЕННЫЕ
                                    <div class="bottom_row"></div>
                                </div>
                                <div id="ajax_favorite" class="ajax_favorite"></div>


                                <?= $left_articles_goods ?>

                            </div>
                        </div>
                    </div>
                    <div class="footer-container">
                        <div class="footer">

                            <?= $top_menu ?>

                            <div class="clear"></div>        
                            <address>&copy; 2008 House Control Украина, Харьков. All Rights Reserved.<br /><!-- {%FOOTER_LINK} --></address>         
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="help_window">
                <div id="hw_question">
                    Затрудняетесь с выбором подходящего<br /> Вам товара?
                </div>
                <div id="hw_answer">
                    Проконсультируйтесь со специалистом!
                </div>
                <div id="hw_phone">
                    (057) 759-56-81
                    <br />
                    (098) 427-01-25
                </div>
                <div id="hw_noavatar"></div>
                <div id="hw_close" onclick="close_help_window()"></div>
                <!--<audio id="hw_audio" src="/upload/help_window.mp3" preload="auto"></audio>-->
            </div>
            
            <div id="message_btn" onclick="send_post('', '/ajax/message/show_form/', {title: 'Открытие формы сообщения', content: 'loader'})"></div>
            
            <?=$counter['li']?>
        </body>
</html>