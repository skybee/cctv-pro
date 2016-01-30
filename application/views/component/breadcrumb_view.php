<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div id="breadcrumb_spacer"></div>
<div class="my_breadcrumb breadcrumb_fixed" style="margin-top: 0;" >
    <ul>
        <? // print_r($breadcrumb_list) ?>
        <? foreach ($breadcrumb_list as $breadcrumb_ar): ?>
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" >
                <!--<a href="#" itemprop="url">-->
                <a href="/category/<?= $breadcrumb_ar['url_name'] ?>/" itemprop="url">
                    <span itemprop="title"><?= $breadcrumb_ar['name'] ?></span>
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
            </li>
            <li>&gt;</li>
        <? endforeach; ?>
    </ul>
</div>
