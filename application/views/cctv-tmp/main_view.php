<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


        <title><?= $head_data['html_title'] ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
            <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0"/>
            <meta name="apple-mobile-web-app-capable" content="yes"/>
            <meta name="description" content="<?= $head_data['html_description'] ?>"/>
            <meta name="keywords" content="<?= $head_data['html_keywords'] ?>"/>
            
            <link rel="icon" href="/favicon32-2.png" type="image/png">
            <link rel="shortcut icon" href="/favicon32-2.png" type="image/png"/>

            <script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>
            <script type="text/javascript" src="/js/jquery-migrate-1.2.1.min.js"></script>
            <script type="text/javascript" src="/js/superfish.js"></script>
            <script type="text/javascript" src="/js/scripts.js"></script>

            <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
                <!--[if lt IE 7]>
                <script type="text/javascript">
                //<![CDATA[
                    var BLANK_URL = '/js/ie/blank.html';
                    var BLANK_IMG = '/js/ie/spacer.gif';
                //]]>
                </script>
                <![endif]-->
                <!--[if lt IE 9]>
                <div style=' clear: both; text-align:center; position: relative;'>
                 <a href="//windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"><img src="//storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a>
                </div>
                <style>
                        body {	min-width: 960px !important;}
                </style>
                <![endif]-->

                <link rel="stylesheet" type="text/css" href="/css/jquery.bxslider.css" media="all"/>
                <link rel="stylesheet" type="text/css" href="/css/photoswipe.css" media="all"/>
                <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" media="all"/>
                <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css" media="all"/>
                <link rel="stylesheet" type="text/css" href="/css/extra_style.css" media="all"/>
                <link rel="stylesheet" type="text/css" href="/css/styles.css" media="all"/>
                <link rel="stylesheet" type="text/css" href="/css/responsive.css" media="all"/>
                <link rel="stylesheet" type="text/css" href="/css/superfish.css" media="all"/>
                <link rel="stylesheet" type="text/css" href="/css/camera.css" media="all"/>
                <link rel="stylesheet" type="text/css" href="/css/widgets.css" media="all"/>
                <!--<link rel="stylesheet" type="text/css" href="/css/cloud-zoom.css" media="all"/>-->
                <link rel="stylesheet" type="text/css" href="/css/catalogsale.css" media="all"/>

                <link rel="stylesheet" type="text/css" href="/css/my-css/jquery-ui.css" media="all"/>
                <link rel="stylesheet" type="text/css" href="/css/my-css/popup.css" media="all"/>
                <link rel="stylesheet" type="text/css" href="/css/my-css/cctv-pro.css" media="all"/>
                <link rel="stylesheet" type="text/css" href="/css/print.css" media="print"/>


                <script type="text/javascript" src="/js/prototype/prototype.js"></script>
                <script type="text/javascript" src="/js/lib/ccard.js"></script>
                <script type="text/javascript" src="/js/prototype/validation.js"></script>
                <script type="text/javascript" src="/js/scriptaculous/builder.js"></script>
                <script type="text/javascript" src="/js/scriptaculous/effects.js"></script>
                <script type="text/javascript" src="/js/scriptaculous/dragdrop.js"></script>
                <script type="text/javascript" src="/js/scriptaculous/controls.js"></script>
                <script type="text/javascript" src="/js/scriptaculous/slider.js"></script>
                <script type="text/javascript" src="/js/varien/js.js"></script>
                <script type="text/javascript" src="/js/varien/form.js"></script>
                <script type="text/javascript" src="/js/mage/translate.js"></script>
                <script type="text/javascript" src="/js/mage/cookies.js"></script>
                <!--<script type="text/javascript" src="/js/ecommerceteam/cloud-zoom.1.0.2.js"></script>-->
                <script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
                <script type="text/javascript" src="/js/jquery.mobile.customized.min.js"></script>
                <script type="text/javascript" src="/js/bootstrap.js"></script>
                <script type="text/javascript" src="/js/jquery.carouFredSel-6.2.1.js"></script>
                <script type="text/javascript" src="/js/jquery.touchSwipe.js"></script>
                <script type="text/javascript" src="/js/jquery.bxslider.min.js"></script>
                <script type="text/javascript" src="/js/carousel.js"></script>

                <script type="text/javascript" src="/js/my-js/jquery-ui.min.js"></script>
                <script type="text/javascript" src="/js/my-js/jquery.json-2.3.min.js"></script>
                <script type="text/javascript" src="/js/my-js/jquery.form.js"></script>
                <script type="text/javascript" src="/js/my-js/form_action.js"></script>
                <script type="text/javascript" src="/js/my-js/cctv-pro.js"></script>
                <!--[if lt IE 8]>
                <link rel="stylesheet" type="text/css" href="/js/ie/styles-ie.css" media="all" />
                <![endif]-->
                <!--[if lt IE 7]>
                <script type="text/javascript" src="/js/ie/ds-sleight.js"></script>
                <script type="text/javascript" src="/js/ie/ie6.js"></script>
                <![endif]-->


                </head>
                <body class="ps-static  cms-index-index cms-home">

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


                    <div class="wrapper ps-static en-lang-class">
                        <noscript>
                            <div class="global-site-notice noscript">
                                <div class="notice-inner">
                                    <p>
                                        <strong>JavaScript seems to be disabled in your browser.</strong><br/>
                                        You must have JavaScript enabled in your browser to utilize the functionality of this website. </p>
                                </div>
                            </div>
                        </noscript>
                        <div class="page">
                            <div class="shadow"></div>
                            <div class="swipe-left"></div>
                            <div class="swipe">
                                <div class="swipe-menu">
                                    <ul class="links">
                                        <li class="first"><a href="/" title="Home">Home</a></li>
                                        <li><a href="" title="My Account">My Account</a></li>
                                        <li><a href="" title="My Wishlist">My Wishlist</a></li>
                                        <li><a href="" title="My Cart" class="top-link-cart">My Cart</a></li>
                                        <li><a href="" title="Checkout" class="top-link-checkout">Checkout</a></li>
                                        <li class=" last"><a href="" title="Log In">Log In</a></li>
                                    </ul>
                                    <div class="currency-switch switch-show">
                                        <div class="currency-title">
                                            <span class="label">Currency:</span><strong class="current">USD</strong>
                                        </div>
                                        <ul class="currency-dropdown">
                                            <li>
                                                <a href="">
                                                    <span>British Pound Sterling -</span> GBP
                                                </a>
                                            </li>
                                            <li>
                                                <a href=""><span>Euro -</span> EUR</a></li><li><a href="" class="selected"><span>US Dollar -</span> USD</a></li></ul>
                                    </div>

                                    <div class="language-list switch-show">
                                        <div class="language-title"><span class="label">Your Language:</span> <strong>en</strong></div>
                                        <ul>
                                            <li>
                                                <a class="selected" href="" title="en_US">   <strong>en</strong></a>
                                            </li>
                                            <li>
                                                <a href="" title="de_DE">   <strong>de</strong></a>
                                            </li>
                                            <li>
                                                <a href="" title="es_ES">   <strong>es</strong></a>
                                            </li>
                                            <li>
                                                <a href="" title="ru_RU">   <strong>ru</strong></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="footer-links-menu">
                                        <ul>
                                            <li><a href="">About Us</a></li>
                                            <li><a href="">Customer Service</a></li>
                                            <li><a href="">Template Settings</a></li>
                                            <li class="last privacy"><a href="">Privacy Policy</a></li>
                                        </ul>
                                        <ul class="links-2">
                                            <li class="first"><a href="">Product Sitemap</a></li>
                                            <li><a href="">Category Sitemap</a></li>
                                            <li><a href="">Advanced Search</a></li>
                                            <li><a href="">Orders and Returns</a></li>
                                        </ul> </div>
                                </div>
                            </div>
                            <div class="top-icon-menu">
                                <div class="swipe-control"><i class="fa fa-align-justify"></i></div>
                                <div class="top-search"><i class="fa fa-search"></i></div>
                                <span class="clear"></span>
                            </div>
                            <div class="header-container">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="header">
                                                <h1 class="logo">
                                                    <strong>CCTV Pro - Магазин Систем Видеонаблюдения</strong>
                                                    <a href="/" title="CCTV Pro - Магазин Систем Видеонаблюдения">
                                                        <img src="/img/logo.png" alt="CCTV Pro - Магазин Систем Видеонаблюдения"/>
                                                    </a>
                                                </h1>

                                                <?=$top_contact?>

                                                <!--                                                <div class="right_head">
                                                                                                    <div class="block-cart-header">
                                                                                                        <h3>Cart:</h3>
                                                                                                        <div class="block-content">
                                                                                                            <div class="empty">
                                                                                                                <div>0 item(s) - <span class="price">$0.00</span></div>
                                                                                                                <div class="cart-content">
                                                                                                                    You have no items in your shopping cart. </div>
                                                                                                            </div>
                                                                                                            <p class="mini-cart"><strong>0</strong></p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <form id="search_mini_form" action="" method="get">
                                                                                                        <div class="form-search">
                                                                                                            <label for="search">Search:</label>
                                                                                                            <input id="search" type="text" name="q" value="" class="input-text"/>
                                                                                                            <button type="submit" title="Search" class="button"><strong><i class="fa fa-search"></i></strong></button>
                                                                                                            <div id="search_autocomplete" class="search-autocomplete"></div>
                                                
                                                                                                            <script type="text/javascript">
                                                                                                                        //<![CDATA[
                                                                                                                        var searchForm = new Varien.searchForm('search_mini_form', 'search', '');
                                                                                                                        searchForm.initAutocomplete('', 'search_autocomplete');
                                                                                                                        //]]>
                                                                                                            </script>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                    <style>.ajaxsearch{border:solid #CCCCCC 1px}.ajaxsearch .suggest{background:#0A263D;color:#B4B4B4}.ajaxsearch .suggest .amount{color:#FF0000}.ajaxsearch .preview{background:#ffffff}.ajaxsearch .preview a{color:#1B43AC}.ajaxsearch .preview .description{color:#0A263D}.ajaxsearch .preview img{float:left;border:solid 1px #CCC}.header .form-search .ajaxsearch li.selected{background-color:#FBFBFB}</style> 
                                                                                                </div>-->
                                                <div class="clear"></div>
                                                <div class="quick-access">
                                                    <?= $top_menu; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="nav-container">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <ul id="nav" class="sf-menu">
                                                <li class="level0 nav-1 first level-top"><a href="" class="level-top"><span>Accessoriess</span></a></li><li class="level0 nav-2 level-top parent"><a href="" class="level-top"><span>Tyres</span></a><ul class="level0"><li class="level1 nav-2-1 first parent"><a href=""><span>Brand</span></a><ul class="level1"><li class="level2 nav-2-1-1 first"><a href=""><span>Bridgestone</span></a></li><li class="level2 nav-2-1-2 last"><a href=""><span>Goodyear</span></a></li></ul></li><li class="level1 nav-2-2 last"><a href=""><span>Size</span></a></li></ul></li><li class="level0 nav-3 last level-top parent"><a href="" class="level-top"><span>Wheels</span></a><ul class="level0"><li class="level1 nav-3-1 first parent"><a href=""><span>Brand</span></a><ul class="level1"><li class="level2 nav-3-1-1 first"><a href=""><span>ATS</span></a></li><li class="level2 nav-3-1-2 last"><a href=""><span>Fondmetal</span></a></li></ul></li><li class="level1 nav-3-2 last"><a href=""><span>Size</span></a></li></ul></li> </ul>
                                            <div class="sf-menu-block">
                                                <div id="menu-icon">Categories</div>
                                                <ul class="sf-menu-phone">
                                                    <li class="level0 nav-1 first level-top"><a href="" class="level-top"><span>Accessoriess</span></a></li><li class="level0 nav-2 level-top parent"><a href="" class="level-top"><span>Tyres</span></a><ul class="level0"><li class="level1 nav-2-1 first parent"><a href=""><span>Brand</span></a><ul class="level1"><li class="level2 nav-2-1-1 first"><a href=""><span>Bridgestone</span></a></li><li class="level2 nav-2-1-2 last"><a href=""><span>Goodyear</span></a></li></ul></li><li class="level1 nav-2-2 last"><a href=""><span>Size</span></a></li></ul></li><li class="level0 nav-3 last level-top parent"><a href="" class="level-top"><span>Wheels</span></a><ul class="level0"><li class="level1 nav-3-1 first parent"><a href=""><span>Brand</span></a><ul class="level1"><li class="level2 nav-3-1-1 first"><a href=""><span>ATS</span></a></li><li class="level2 nav-3-1-2 last"><a href=""><span>Fondmetal</span></a></li></ul></li><li class="level1 nav-3-2 last"><a href=""><span>Size</span></a></li></ul></li> </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="main-container col2-left-layout">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="main">

                                                <!-- BREADCRUMB -->
                                                <?php
                                                if (isset($breadcrumb) && !empty($breadcrumb)) {
                                                    echo $breadcrumb;
                                                }
                                                ?>
                                                <!-- /BREADCRUMB -->

                                                <div class="row">

                                                    <!-- CONTENT -->
                                                    <?= $content; ?>
                                                    <!-- /CONTENT -->

                                                    <div class="col-left sidebar col-xs-12 col-sm-3">

                                                        <div class="block menu_basket_info" onclick="send_post('', '/ajax/basket/show_basket/', {title: 'Обработка данных', content: 'loader'})">
                                                            <div class="menu_basket_txt">
                                                                <span id="menu_basket_goods">  0 шт. - </span>
                                                                <span id="menu_basket_price"> 0 грн.</span>
                                                            </div>
                                                        </div>

                                                        <!-- CAT MENU -->
                                                        <?= $cat_menu; ?>
                                                        <!-- /CAT MENU -->

                                                        <div class="block block-related">
                                                            <div class="block-title">
                                                                <strong><span>Вы смотрели</span></strong>
                                                            </div>
                                                            <div class="block-content" id="ajax_favorite">
                                                                <!-- LAST LOOKING GOODS-->
                                                                <script type="text/javascript">decorateList('block-related', 'none-recursive')</script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-container">
                                <?= $top_menu; ?>
                            </div>
                            <div class="bottom-container">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="bottom_block">
                                                <address>&copy; 2016 CCTV Pro - Ukraine. All Rights Reserved.</address>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <!-- COUNTERS -->
                    <div style="overflow: hidden; height: 1px; width: 1px; position: absolute; top: -100px; left: -100px">
                        <!--LiveInternet counter--><script type="text/javascript"><!--
                        document.write("<img src='//counter.yadro.ru/hit?t26.11;r"+
                        escape(document.referrer)+((typeof(screen)=="undefined")?"":
                        ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                        screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                        ";"+Math.random()+
                        "' alt='' title='LiveInternet: показано число посетителей за"+
                        " сегодня' "+
                        "border='0' width='88' height='15'>")
                        //--></script>
                        <!--/LiveInternet-->
                    </div>
                    <!-- /COUNTERS -->

                </body>
                </html>
