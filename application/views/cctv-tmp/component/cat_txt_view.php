<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<?php if( !empty($cat_info['text']) ): ?>
<div class="std category-text-block">
    
    <div id="height-category-text-block">
        <h1 id="page_info_h1"><?=$cat_info['h1']?></h1>
        <div id="page_info_txt">
            <?= $cat_info['text'] ?>
        </div>
    </div>
    
    <div class="cat_txt_shadow"></div>
    <div class="show_full_text"><div class="fa fa-sort-desc">&nbsp;</div></div>
</div>
<?php endif; ?>
