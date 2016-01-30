<?php if (!defined('BASEPATH')) exit('No direct script access allowed');





function article_linkator( $text ){ 
    
    $pattern_list['/category/kamera/']                              = "#(купол[а-я]*|уличн[а-я]+|поворотн[а-я]+|наружн[а-я]+|)\s*(ip-|cctv-|ptz-|)(теле|видео|)камер[а-я]*\s*((видео|)наблюден[а-я]+|)#ui";
    $pattern_list['/info/services/#ustanovka_videjnabludenie']      = "#(устан[а-я]*|монт[а-я]*|инстал[а-я]*)\s*(систем.{0,20}|.{0,20}камер[а-я]*|)\s*видеонаблюден[а-я]+#ui";
    $pattern_list['/category/videonabljudenie/']                    = "#(систем.{1,20}|)видеонаблюден[а-я]+#ui";
    $pattern_list['/category/avto_videoregistratory/']              = "#авто(мобил[а-я]*|)\s*(видео|)регистр[а-я]*#ui";
    $pattern_list['/category/videoregistrator/']                    = "#(цифров[а-я]*|сетев[а-я]*|ip-|)\s*видеорегистр[а-я]*#ui";
    $pattern_list['/info/services/#ustanovka_domofonov']            = "#(устан[а-я]*|монт[а-я]*)\s*(видео|аудио|)\s*домофон[а-я]*\s*(.{0,20}(дом[а-я]*|офис[а-я]*|квартир[а-я]*|commax)|)#ui";
    $pattern_list['/category/domofony/']                            = "#(панель|монитор|)\s*(видео|аудио|)\s*домофон[а-я]*\s*(.{0,20}(дом[а-я]*|офис[а-я]*|квартир[а-я]*|commax)|)#ui";
    $pattern_list['/category/ohranna_pozharnaja_signalizacija/']    = "#(систем[а-я]*.{0,15}|)\s*(охран[а-я]*|(охран[а-я]*.{0,3}|)пожар[а-я]*|)\s*сигнализ[а-я]*\s*(.{0,20}(дом[а-я]*|офис[а-я]*|квартир[а-я]*|магазин[а-я]*|склад[а-я]*)|)#ui";
    $pattern_list['/category/kontrol_dostupa/']                     = "#(систем[а-я]*.{0,15}|)\s*контр[а-я]*\s*(.{0,10}управ[а-я]*|)\s*доступ[а-я]*#ui";
    
    
    $key = 1;
    foreach( $pattern_list as $url => $pattern ){
        if( !empty($pattern) ){
            if( preg_match($pattern, $text, $keyword_ar ) ){
//                echo '<pre>'.print_r($keyword_ar[0],1).'</pre>';
                $replace_key = "#$key#";
                
                $replace_ar['search'][$key]     = $replace_key;
                $replace_ar['replace'][$key]    = ' <a href="'.$url.'">'.$keyword_ar[0].'</a> ';
                
                $text = preg_replace("#{$keyword_ar[0]}#ui", $replace_key, $text, 1);
            }
        }
        $key++;
    }
    
    if( $replace_ar['search'] > 1 ){
        $text = str_ireplace( $replace_ar['search'], $replace_ar['replace'], $text);
    }
    
    return $text;
}

function get_city_link( $rand_str ){
    $link_ar = file('city_link.txt');
    
    srand( abs( crc32($rand_str) ) );
    shuffle($link_ar);
    srand();
    
    return $link_ar[0];
}