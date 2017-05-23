<div class="col-main col-xs-12 col-sm-9">
    <div class="padding-s">
        
        <!-- CATEGORY GRID -->
        <?=$category_grid?>
        <!-- /CATEGORY GRID -->
        
        <!-- CONTENT -->
        <?= $content ?>
        <!-- /CONTENT -->
        
        <div class="page-title category-title" style="margin-bottom: 10px;">
            <h2><?=$cat_info['name']?> / Товары: <?php if($page_nmbr > 1 ) echo "стр. {$page_nmbr}" ?></h2>
        </div>
        
        <?php
            if($name_filter_data != false && is_array($name_filter_data)){
                $thisNameFilterUri = $name_filter_data['name'].'-'.$name_filter_data['id'].'/';
            }
            else{
                $thisNameFilterUri = '';
            }
        ?>
        
        <div class="category-products">
            <div class="toolbar toolbar_goods_sorter">
                <div class="pager goods_sorter" id="goods_sorter" rel="<?=$order_val?>">
                    <span>Упорядочить: &nbsp;</span>
                    <a href="/category/<?=$cat_name?>/1/order/price/<?=$thisNameFilterUri?>"   id="price">Цена</a>
                    <a href="/category/<?=$cat_name?>/1/order/rank/<?=$thisNameFilterUri?>"    id="rank">Популярность</a>
                    <a href="/category/<?=$cat_name?>/1/order/name/<?=$thisNameFilterUri?>"    id="name">Название</a>
                </div>
            </div>
            
            <?php if($name_filter_list != false): ?>
            <div class="toolbar">
                <div class="pager goods_sorter" id="brand_sorter" rel="<?=$brand_val?>">
                    <span>Производитель: &nbsp;</span>
                    <a href="/category/<?=$cat_name?>/"   id="allbrands">Все</a>
                    <?php foreach($name_filter_list as $name_filter):?>
                    <a href="/category/<?=$cat_name?>/1/order/<?=$order_val?>/<?=$name_filter['name']?>-<?=$name_filter['id']?>/"   id="<?=$name_filter['name']?>">
                            <?=$name_filter['name']?>
                    </a>
                    <?php endforeach;?>
                </div>
            </div>
            <?php endif;?>

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
                                        <a href="/category/<?=$cat_name?>/<?=$page?>/<?=$link_order?><?=$thisNameFilterUri?>"><?=$page?></a>
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