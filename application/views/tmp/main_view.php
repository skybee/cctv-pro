<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Home page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="/js/jquery-1.7.2.min.js" type="text/javascript"></script>

<script type="text/javascript" charset="utf-8">
    var J = jQuery.noConflict();
</script>
<script src="/js/loopedslider.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    J(function(){
        J('#loopedSlider').loopedSlider({
            autoStart: 5000,
            restart: 7500
        });		
    });
</script>
<!--[if lt IE 9]>
<style type="text/css">
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
{ behavior:url(http://livedemo00.template-help.com/magento_34128/skin/frontend/default/theme039k/js/PIE.php) }
</style>
<![endif]-->
<!--[if lt IE 7]>
<script type="text/javascript">
//<![CDATA[
    var BLANK_URL = '/js/blank.html';
    var BLANK_IMG = 'http://livedemo00.template-help.com/magento_34128/js/spacer.gif';
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
<link rel="stylesheet" type="text/css" href="/css/print.css" media="print" />

<script type="text/javascript" src="/js/prototype/prototype.js"></script>
<script type="text/javascript" src="/js/ccard.js"></script>
<script type="text/javascript" src="/js/prototype/validation.js"></script>
<script type="text/javascript" src="/js/scriptaculous/builder.js"></script>
<script type="text/javascript" src="/js/scriptaculous/effects.js"></script>
<script type="text/javascript" src="/js/scriptaculous/dragdrop.js"></script>
<script type="text/javascript" src="/js/scriptaculous/controls.js"></script>
<script type="text/javascript" src="/js/scriptaculous/slider.js"></script>
<script type="text/javascript" src="/js/varien/js.js"></script>
<script type="text/javascript" src="/js/varien/form.js"></script>
<script type="text/javascript" src="/js/varien/menu.js"></script>
<script type="text/javascript" src="/js/mage/translate.js"></script>
<script type="text/javascript" src="/js/mage/cookies.js"></script>
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="/css/styles-ie.css" media="all" />
<![endif]-->
<!--[if lt IE 7]>
<script type="text/javascript" src="/js/ds-sleight.js"></script>
<script type="text/javascript" src="/js/ie6.js"></script>
<![endif]-->

<script type="text/javascript">
//<![CDATA[
Mage.Cookies.path     = '/magento_34128';
Mage.Cookies.domain   = '.livedemo00.template-help.com';
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
optionalZipCountries = [];
//]]>
</script>
<script type="text/javascript">var Translator = new Translate({"Please use only letters (a-z or A-Z), numbers (0-9) or underscore(_) in this field, first character should be a letter.":"Please use only letters (a-z or A-Z), numbers (0-9) or underscores (_) in this field, first character must be a letter."});</script></head>
<body class=" cms-index-index cms-home">
<div class="wrapper">
        <noscript>
        <div class="noscript">
            <div class="noscript-inner">
                <p><strong>JavaScript seem to be disabled in your browser.</strong></p>
                <p>You must have JavaScript enabled in your browser to utilize the functionality of this website.</p>
            </div>
        </div>
    </noscript>
    <div class="page">
        <div class="header-container">
    <div class="header">
        <div class="head_row1">
        	         <h1 class="logo"><strong>Magento Commerce</strong><a href="http://livedemo00.template-help.com/magento_34128/" title="Magento Commerce"><img src="http://livedemo00.template-help.com/magento_34128/skin/frontend/default/theme039k/images/logo.gif" alt="Magento Commerce" /></a></h1>
                  <div class="quick-access">            
           
<div class="currencies">
								<label>Currencies:</label>
        <select name="currency" title="Select Your Currency" onchange="setLocation(this.value)">
                    <option value="http://livedemo00.template-help.com/magento_34128/directory/currency/switch/currency/EUR/uenc/aHR0cDovL2xpdmVkZW1vMDAudGVtcGxhdGUtaGVscC5jb20vbWFnZW50b18zNDEyOC8,/">
                Euro            </option>
                    <option value="http://livedemo00.template-help.com/magento_34128/directory/currency/switch/currency/USD/uenc/aHR0cDovL2xpdmVkZW1vMDAudGVtcGxhdGUtaGVscC5jb20vbWFnZW50b18zNDEyOC8,/" selected="selected">
                US Dollar            </option>
                </select>
</div>
          <p class="welcome-msg">Welcome to our online store!</p>            
       		</div>
        </div>
        <div class="head_row2">
        	<form id="search_mini_form" action="http://livedemo00.template-help.com/magento_34128/catalogsearch/result/" method="get">
    <div class="form-search">
        <label for="search">Search:</label>
        <input id="search" type="text" name="q" value="" class="input-text" />
        <button type="submit" title="Search" class="button"><span><span>Search</span></span></button>
        <div id="search_autocomplete" class="search-autocomplete"></div>
        <script type="text/javascript">
        //<![CDATA[
            var searchForm = new Varien.searchForm('search_mini_form', 'search', 'Search entire store here...');
            searchForm.initAutocomplete('http://livedemo00.template-help.com/magento_34128/catalogsearch/ajax/suggest/', 'search_autocomplete');
        //]]>
        </script>
    </div>
</form>
         <ul class="links">
                        <li class="first" ><a href="http://livedemo00.template-help.com/magento_34128/customer/account/" title="My Account" >My Account</a></li>
                                <li ><a href="http://livedemo00.template-help.com/magento_34128/wishlist/" title="My Wishlist" >My Wishlist</a></li>
                                <li ><a href="http://livedemo00.template-help.com/magento_34128/checkout/cart/" title="My Cart" class="top-link-cart">My Cart</a></li>
                                <li ><a href="http://livedemo00.template-help.com/magento_34128/checkout/" title="Checkout" class="top-link-checkout">Checkout</a></li>
                                <li class=" last" ><a href="http://livedemo00.template-help.com/magento_34128/customer/account/login/" title="Log In" >Log In</a></li>
            </ul>
        </div>
    </div>
</div>

        <div class="main-container col2-left-layout">
            <div class="main">                
                <div class="col-main">
                    																				                    <div class="std"><div class="scroller_block">
 <div id="loopedSlider">	
  <ul class="pagination">
   <li><a href="#"></a></li>
   <li><a href="#"></a></li>
   <li><a href="#"></a></li>
  </ul>	
  <div class="container">
   <div class="slides">
    <div><a href="http://livedemo00.template-help.com/magento_34128/diagnostic-supplies/gamma-camera-for-nuclear-medicine.html"><img src="http://livedemo00.template-help.com/magento_34128/skin/frontend/default/theme039k/images/slider_pic1.jpg" width="710" height="342" alt="" /></a></div>
    <div><a href="http://livedemo00.template-help.com/magento_34128/diagnostic-supplies/patient-monitor-with-co2.html"><img src="http://livedemo00.template-help.com/magento_34128/skin/frontend/default/theme039k/images/slider_pic2.jpg" width="710" height="342" alt="" /></a></div>
    <div><a href="http://livedemo00.template-help.com/magento_34128/diagnostic-supplies/auto-hematology-analyzer.html"><img src="http://livedemo00.template-help.com/magento_34128/skin/frontend/default/theme039k/images/slider_pic3.jpg" width="710" height="342" alt="" /></a></div>
   </div>
  </div>  
 </div>
</div>
<div class="banner_shipping"><img src="http://livedemo00.template-help.com/magento_34128/skin/frontend/default/theme039k/images/banner_shipping.jpg" alt="" /></div>
<div><div class="new_products">
<div class="page-title"><h2>New Products</h2></div>
                    <ul class="products-grid">
                    <li class="item first">
                <h3 class="product-name"><a href="http://livedemo00.template-help.com/magento_34128/opti-neb-pro-nebulizer-machine.html" title="Opti-Neb Pro Nebulizer Machine">Opti-Neb Pro Nebulizer Machine</a></h3>
                <a href="http://livedemo00.template-help.com/magento_34128/opti-neb-pro-nebulizer-machine.html" title="Opti-Neb Pro Nebulizer Machine" class="product-image"><img src="http://livedemo00.template-help.com/magento_34128/media/catalog/product/cache/1/small_image/170x/9df78eab33525d08d6e5fb8d27136e95/p/i/pic1.jpg" width="170" height="170" alt="Opti-Neb Pro Nebulizer Machine" /></a>
                <div class="new_descr">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>                
                

        
    <div class="price-box">
                                                            <span class="regular-price" id="product-price-79-new">
                    <span class="price">$45.89</span>                </span>
                        
        </div>

                <div class="actions">
                                            <button type="button" title="Add to Cart" class="button btn-cart" onclick="setLocation('http://livedemo00.template-help.com/magento_34128/checkout/cart/add/uenc/aHR0cDovL2xpdmVkZW1vMDAudGVtcGxhdGUtaGVscC5jb20vbWFnZW50b18zNDEyOC8,/product/79/')"><span><span>Add to Cart</span></span></button>
                                        
                </div>
            </li>
                                <li class="item">
                <h3 class="product-name"><a href="http://livedemo00.template-help.com/magento_34128/manual-blood-pressure-monitor-with-nylon-cuff.html" title="Manual Blood Pressure Monitor">Manual Blood Pressure Monitor</a></h3>
                <a href="http://livedemo00.template-help.com/magento_34128/manual-blood-pressure-monitor-with-nylon-cuff.html" title="Manual Blood Pressure Monitor" class="product-image"><img src="http://livedemo00.template-help.com/magento_34128/media/catalog/product/cache/1/small_image/170x/9df78eab33525d08d6e5fb8d27136e95/p/i/pic2.jpg" width="170" height="170" alt="Manual Blood Pressure Monitor" /></a>
                <div class="new_descr">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>                
                

        
    <div class="price-box">
                                                            <span class="regular-price" id="product-price-80-new">
                    <span class="price">$25.89</span>                </span>
                        
        </div>

                <div class="actions">
                                            <button type="button" title="Add to Cart" class="button btn-cart" onclick="setLocation('http://livedemo00.template-help.com/magento_34128/checkout/cart/add/uenc/aHR0cDovL2xpdmVkZW1vMDAudGVtcGxhdGUtaGVscC5jb20vbWFnZW50b18zNDEyOC8,/product/80/')"><span><span>Add to Cart</span></span></button>
                                        
                </div>
            </li>
                                <li class="item">
                <h3 class="product-name"><a href="http://livedemo00.template-help.com/magento_34128/welch-allyn-ear-wash-system-plus.html" title="Welch Allyn Ear Wash System Plus">Welch Allyn Ear Wash System Plus</a></h3>
                <a href="http://livedemo00.template-help.com/magento_34128/welch-allyn-ear-wash-system-plus.html" title="Welch Allyn Ear Wash System Plus" class="product-image"><img src="http://livedemo00.template-help.com/magento_34128/media/catalog/product/cache/1/small_image/170x/9df78eab33525d08d6e5fb8d27136e95/p/i/pic3.jpg" width="170" height="170" alt="Welch Allyn Ear Wash System Plus" /></a>
                <div class="new_descr">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>                
                

        
    <div class="price-box">
                                                            <span class="regular-price" id="product-price-81-new">
                    <span class="price">$125.89</span>                </span>
                        
        </div>

                <div class="actions">
                                            <button type="button" title="Add to Cart" class="button btn-cart" onclick="setLocation('http://livedemo00.template-help.com/magento_34128/checkout/cart/add/uenc/aHR0cDovL2xpdmVkZW1vMDAudGVtcGxhdGUtaGVscC5jb20vbWFnZW50b18zNDEyOC8,/product/81/')"><span><span>Add to Cart</span></span></button>
                                        
                </div>
            </li>
                </ul>
            </div>
</div></div>                </div>
                <div class="col-left sidebar"><div class="nav-container">
    <ul id="nav">
        <li class="level0 nav-1 level-top first">
<a href="http://livedemo00.template-help.com/magento_34128/accupuncture.html" class="level-top">
<span> Acupuncture</span>
</a>
</li><li class="level0 nav-2 level-top">
<a href="http://livedemo00.template-help.com/magento_34128/blood-pressure.html" class="level-top">
<span>Blood pressure</span>
</a>
</li><li class="level0 nav-3 level-top">
<a href="http://livedemo00.template-help.com/magento_34128/combination-deals.html" class="level-top">
<span>Combination deals</span>
</a>
</li><li class="level0 nav-4 level-top">
<a href="http://livedemo00.template-help.com/magento_34128/defibrillators.html" class="level-top">
<span>Defibrillators</span>
</a>
</li><li class="level0 nav-5 level-top">
<a href="http://livedemo00.template-help.com/magento_34128/dental-supplies.html" class="level-top">
<span>Dental supplies</span>
</a>
</li><li class="level0 nav-6 level-top">
<a href="http://livedemo00.template-help.com/magento_34128/diabetic.html" class="level-top">
<span>Diabetic</span>
</a>
</li><li class="level0 nav-7 level-top">
<a href="http://livedemo00.template-help.com/magento_34128/diagnostic-supplies.html" class="level-top">
<span>Diagnostic supplies</span>
</a>
</li><li class="level0 nav-8 level-top">
<a href="http://livedemo00.template-help.com/magento_34128/diagnostic-tests.html" class="level-top">
<span>Diagnostic tests</span>
</a>
</li><li class="level0 nav-9 level-top">
<a href="http://livedemo00.template-help.com/magento_34128/ems.html" class="level-top">
<span>EMS</span>
</a>
</li><li class="level0 nav-10 level-top parent">
<a href="http://livedemo00.template-help.com/magento_34128/rehab-supplies.html" class="level-top">
<span>Rehab supplies</span>
</a>
<ul class="level0">
<li class="level1 nav-10-1 first">
<a href="http://livedemo00.template-help.com/magento_34128/rehab-supplies/canes-crutches.html">
<span>Canes &amp; Crutches</span>
</a>
</li><li class="level1 nav-10-2">
<a href="http://livedemo00.template-help.com/magento_34128/rehab-supplies/walkers-rollators.html">
<span>Walkers &amp; Rollators</span>
</a>
</li><li class="level1 nav-10-3 last">
<a href="http://livedemo00.template-help.com/magento_34128/rehab-supplies/wheelchairs-beds.html">
<span>Wheelchairs &amp; Beds</span>
</a>
</li>
</ul>
</li><li class="level0 nav-11 level-top last">
<a href="http://livedemo00.template-help.com/magento_34128/surgical-equipment.html" class="level-top">
<span>Surgical equipment</span>
</a>
</li>    </ul>
</div>
<div class="block block-cart">
        <div class="block-title">
        <strong><span>My Cart</span></strong>
    </div>
    <div class="block-content">
                        <p class="empty">You have <strong>no items</strong> in your<br /> shopping cart.</p>
        </div>
</div>
<div class="block block-list block-compare">
    <div class="block-title">
        <strong><span>Compare Products                    </span></strong>
    </div>
    <div class="block-content">
            <p class="empty">You have <strong>no items</strong> to compare.</p>
        </div>
</div>
<script type="text/javascript">
//<![CDATA[
    function validatePollAnswerIsSelected()
    {
        var options = $$('input.poll_vote');
        for( i in options ) {
            if( options[i].checked == true ) {
                return true;
            }
        }
        return false;
    }
//]]>
</script>
<div class="block block-poll">
    <div class="block-title">
        <strong><span>Community Poll</span></strong>
    </div>
    <form id="pollForm" action="http://livedemo00.template-help.com/magento_34128/poll/vote/add/poll_id/1/" method="post" onsubmit="return validatePollAnswerIsSelected();">
        <div class="block-content">
            <p class="block-subtitle">What is your favorite color</p>
                        <ul id="poll-answers">
                                <li>
                    <input type="radio" name="vote" class="radio poll_vote" id="vote_1" value="1" />
                    <span class="label"><label for="vote_1">Green</label></span>
                </li>
                                <li>
                    <input type="radio" name="vote" class="radio poll_vote" id="vote_2" value="2" />
                    <span class="label"><label for="vote_2">Red</label></span>
                </li>
                                <li>
                    <input type="radio" name="vote" class="radio poll_vote" id="vote_3" value="3" />
                    <span class="label"><label for="vote_3">Black</label></span>
                </li>
                                <li>
                    <input type="radio" name="vote" class="radio poll_vote" id="vote_4" value="4" />
                    <span class="label"><label for="vote_4">Magenta</label></span>
                </li>
                                <li>
                    <input type="radio" name="vote" class="radio poll_vote" id="vote_5" value="5" />
                    <span class="label"><label for="vote_5">White</label></span>
                </li>
                                <li>
                    <input type="radio" name="vote" class="radio poll_vote" id="vote_6" value="6" />
                    <span class="label"><label for="vote_6">Yellow</label></span>
                </li>
                                <li>
                    <input type="radio" name="vote" class="radio poll_vote" id="vote_7" value="7" />
                    <span class="label"><label for="vote_7">Grey</label></span>
                </li>
                            </ul>
            <script type="text/javascript">decorateList('poll-answers');</script>
                        <div class="actions">
                <button type="submit" title="Vote" class="button"><span><span>Vote</span></span></button>
            </div>
        </div>
    </form>
</div>
</div>
            </div>
        </div>
        <div class="footer-container">
    <div class="footer">
        <ul>
<li><a href="http://livedemo00.template-help.com/magento_34128/about-magento-demo-store">About Us</a></li>
<li class="last"><a href="http://livedemo00.template-help.com/magento_34128/customer-service">Customer Service</a></li>
</ul>									<ul class="links">
                        <li class="first" ><a href="http://livedemo00.template-help.com/magento_34128/catalog/seo_sitemap/category/" title="Site Map" >Site Map</a></li>
                                <li ><a href="http://livedemo00.template-help.com/magento_34128/catalogsearch/term/popular/" title="Search Terms" >Search Terms</a></li>
                                <li ><a href="http://livedemo00.template-help.com/magento_34128/catalogsearch/advanced/" title="Advanced Search" >Advanced Search</a></li>
                                <li class=" last" ><a href="http://livedemo00.template-help.com/magento_34128/contacts/" title="Contact Us" >Contact Us</a></li>
            </ul>
 
         <div class="clear"></div>        
         <address>&copy; 2011 Magento Demo Store. All Rights Reserved.<br /><!-- {%FOOTER_LINK} --></address>         
    </div>
</div>
            </div>
</div>
</body>
</html>
