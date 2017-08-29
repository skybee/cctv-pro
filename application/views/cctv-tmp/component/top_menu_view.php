<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<ul class="links">
<?php
    $cnt = count( $main_menu_list );
    for( $i=0; $i<$cnt; $i++):
        if( $i == 0 )
            $class = ' class="first" ';
//        elseif( $i == $cnt-1 )
//            $class = ' class="last" ';
        else
            $class = '';
?>    
    <li <?=$class?> >
        <a href="/info/<?=$main_menu_list[$i]['url_name']?>/"><?=$main_menu_list[$i]['name']?></a>
    </li>
<?php endfor; ?>
    <li class="last" >
        <a href="javascript:void(0)" onclick="send_post('', '/ajax/basket/show_basket/', {title: 'Обработка данных', content: 'loader'})">Корзина</a>
    </li>
    <!--<li class="article_link" ><a href="/articles/" >Статьи и Новости</a></li>-->
</ul>