<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>


<?php if( !empty($cat_info['text']) ): ?>
<div class="product-collateral category_text">
    <div class="cat_txt_shadow"></div>
    <div class="box-collateral box-description">
        <h1><?=$cat_info['h1']?></h1>
        <div class="std"><div><?=$cat_info['text']?></div></div>
        
        <div class="show_full_text">
            <div>&nbsp;</div>
        </div>
    </div>
 </div>
<?php endif; ?>