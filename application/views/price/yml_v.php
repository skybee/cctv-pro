<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?='<?xml version="1.0" encoding="utf-8"?>'?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="<?=date("Y-m-d H:i")?>">
    <shop>
        <name>House Control</name>
        <company>House Control</company>
        <url>house-control.org.ua</url>
        <email>info@house-control.org.ua</email>
        
        <currencies>
            <currency id="UAH" rate="1"/>
        </currencies>
        
        <categories>
            <? foreach($cats_ar as $cat): ?>
            <category id="<?=$cat['id']?>" <?if($cat['parent_id'] > 0) echo 'parentId="'.$cat['parent_id'].'"'?>><?=$cat['name']?></category>
            <? endforeach; ?>
        </categories>
        
        <offers>
            <? foreach($goods_ar as $goods): ?>
            <offer id="<?=$goods['id']?>" available="true">
                <url>http://house-control.org.ua/goods/<?=$goods['id']?>/<?=$goods['url_name']?>/</url>
                <price><?=$goods['price']?></price>
                <currencyId>UAH</currencyId>
                <categoryId><?=$goods['category_id']?></categoryId>
                <picture>http://house-control.org.ua/upload/images/<?=$goods['main_img']?></picture>
                <pickup>true</pickup>
                <delivery>true</delivery>
                <name><?=$goods['name']?></name>
                <description><?=$goods['short_description']?></description>
            </offer>
            <? endforeach; ?>
        </offers>
    </shop>
</yml_catalog>    