
<div id="breadcrumb_spacer"></div>
<div class="breadcrumbs my_breadcrumb breadcrumb_fixed">
    <ul>
        <?php // print_r($breadcrumb_list) ?>
        <li class="home">
            <a href="/" title="На главную страницу">CCTV Pro</a>
            <? if( isset( $catname_list ) ): ?>
                <div class="breadcrumb_child_list">
                    <div class="bcl_arow"></div>
                    <div class="bcl_a_block">
                        <? foreach( $catname_list as $child_cat ): ?>
                        <span name="<?= $child_cat['name'] ?>" urlname="<?= $child_cat['url_name'] ?>"></span>
                        <? endforeach; ?>
                    </div>
                </div>
            <? endif; ?>
            <span>&gt;</span>
        </li>
        
        <?php foreach ($breadcrumb_list as $breadcrumb_ar): ?>
        <li class="category4" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <a href="/category/<?=$breadcrumb_ar['url_name']?>/" itemprop="url" title="<?=$breadcrumb_ar['name']?>" >
                <span itemprop="title"><?=$breadcrumb_ar['name']?></span>
            </a>
            <? if( isset( $breadcrumb_ar['child'] ) ): ?>
                <div class="breadcrumb_child_list">
                    <div class="bcl_arow"></div>
                    <div class="bcl_a_block">
                        <? foreach( $breadcrumb_ar['child'] as $child_cat ): ?>
                        <span name="<?= $child_cat['name'] ?>" urlname="<?= $child_cat['url_name'] ?>"></span>
                        <? endforeach; ?>
                    </div>
                </div>
            <? endif; ?>
            <span>&gt;</span>
        </li>
        <!--<li>&gt;</li>-->
        <?php endforeach; ?>
    </ul>
</div>