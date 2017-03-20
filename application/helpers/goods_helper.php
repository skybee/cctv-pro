<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function price_explode( $price ){
    $price_ar = explode('.', $price);
    $cent =& $price_ar[1];
    
    $pattern = "#(\d*)(\d{3})#";
    preg_match($pattern, $price_ar[0], $price_new_ar);
    
//    echo '<pre>'.print_r($price_new_ar, 1).'</pre>';
    
    if( count($price_new_ar) < 1 ){
        $price_new_ar[1] = $price_ar[0];
        $price_new_ar[2] = ''; 
    }
    
    if($price == 0){
        return '<span class="price_cent" style="color:#919191;">нет в наличии</span>';
    }
    
    return '<span class="price_thousand">'.$price_new_ar[1].'</span>'.$price_new_ar[2].'.<span class="price_cent">'.$cent.' &nbsp;грн.</span>';
}

function set_favorite( $goods_id, $cnt_in_list = 10 ){
    $goods_ar = array();
    
    if( isset($_COOKIE['favorit']) )
        $goods_ar = json_decode( $_COOKIE['favorit'], true );
    
    if( !in_array($goods_id, $goods_ar))
        $goods_ar[] = $goods_id;
    
    $cnt_goods = count($goods_ar);
    
    if( $cnt_goods > $cnt_in_list ){
        $new_goods_ar = NULL;
        
        for($i=$cnt_goods-$cnt_in_list; $i<$cnt_goods; $i++ ){
            $new_goods_ar[] = $goods_ar[$i]; 
        }
        $goods_ar = $new_goods_ar;
    }
    
    set_cookie('favorit', json_encode($goods_ar), time()+(3600*24*100) );
}

function get_citty_str(){
    
    $str_ar['city'] = array(
        'Киев',
        'Одессу',
        'Харьков',
        'Донецк',
        'Днепропетровск',
        'Крым',
        'Полтаву',
        'Луганск',
        'Запорожье',
        'Николаев',
        'Сумы',
        'Кировоград',
        'Херсон',
        'Львов'
    );
    
    $str_ar[0] = array(
        'Мы выполняем доставку',
        'Вы можете заказать доставку',
        'Закажите доставку',
        'Мы осуществляем доставку'
    );
    
    $str_ar[1] = array(
        'Вашей покупки',
        'Вашего заказа',
        'Выбранного Вами товара',
        'Купленного Вами товара',
        'своей покупки',
        'купленного у нас товара',
        'нашего товара'
    );
    
    $str_ar[2] = array(
        'в',
        'в такие горада как:',
        'в один из таких городов как:'
    );
    
    srand( abs(crc32($_SERVER['REQUEST_URI'])) );
    
    shuffle( $str_ar['city'] );
    shuffle( $str_ar[0] );
    shuffle( $str_ar[1] );
    shuffle( $str_ar[2] );
        
    $result_str = $str_ar[0][0].' '.$str_ar[1][0].' '.$str_ar[2][0];
        
    $i=0;
    foreach( $str_ar['city'] as $city ){
        if($i) $result_str .= ',';
        $result_str .= ' '.$city;
        $i++;
    }
        
    $result_str .= ' или другой город Украины';
    
    return $result_str;
}

function add_gname_to_larticles( array $articles_arr, $goods_name){ //добавление названия товара в статью слева
    
    $arr_lenght = count($articles_arr);
    
    for($i=0; $i<$arr_lenght; $i+=2 ){
        $article_txt =& $articles_arr[$i]['text'];
        
        $article_txt = str_ireplace('...', " {$goods_name}...", $article_txt);
    }
    
    return $articles_arr;
}