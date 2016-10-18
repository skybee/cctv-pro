<div class="breadcrumbs">
    <ul>
        <?php // print_r($breadcrumb_list) ?>
        <li class="home">
            <a href="/" title="На главную страницу">CCTV Pro</a>
            <span>></span>
        </li>
        
        <?php foreach ($breadcrumb_list as $breadcrumb_ar): ?>
        <li class="category4" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <a href="/category/<?=$breadcrumb_ar['url_name']?>/" itemprop="url" title="<?=$breadcrumb_ar['name']?>" >
                <span itemprop="title"><?=$breadcrumb_ar['name']?></span>
            </a>
            <span>&gt;</span>
        </li>
        <?php endforeach; ?>
    </ul>
</div>