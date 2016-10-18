<div class="col-main col-xs-12 col-sm-9">
    <div class="padding-s">
        
        <!-- CATEGORY GRID -->
        <?=$category_grid?>
        <!-- /CATEGORY GRID -->
        
        <!-- CONTENT -->
        <?= $content ?>
        <!-- /CONTENT -->
        
        <div class="page-title category-title" style="margin-bottom: 10px;">
            <h1><?=$cat_info['name']?> / Товары: <?php if($page_nmbr > 1 ) echo "стр. {$page_nmbr}" ?></h1>
        </div>
        <div class="category-products">
            <div class="toolbar">
                <div class="pager" id="goods_sorter">
                    <span>Упорядочить: &nbsp;</span>
                    <a href="/category/<?=$cat_name?>/1/order/price/"   id="price">Цена</a>
                    <a href="/category/<?=$cat_name?>/1/order/rank/"    id="rank">Популярность</a>
                    <a href="/category/<?=$cat_name?>/1/order/name/"    id="name">Название</a>
                </div>
            </div>

            <!-- GOODS GRID -->
            <?= $goods_grid ?>
            <!-- /GOODS GRID -->
                
                

            <script type="text/javascript">decorateGeneric($$('ul.products-grid'), ['odd', 'even', 'first', 'last'])</script>
            <div class="toolbar-bottom">
                <div class="toolbar">
                    <div class="pager">
                        <?php if( isset($pager_ar) ): ?>
                        <div class="pages">
                            <strong>Страница:</strong>
                            <ol>
                                <?php foreach($pager_ar as $page): ?>
                                    <?php if($page != $page_nmbr && $page != '...'): ?>
                                    <li>
                                        <a href="/category/<?=$cat_name?>/<?=$page?>/<?=$link_order?>"><?=$page?></a>
                                    </li>
                                    <?php else: ?>
                                    <li class="current">
                                        <?=$page;?>
                                    </li>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </ol>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>