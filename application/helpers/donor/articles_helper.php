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
                $replace_ar['replace'][$key]    = ' <a href="http://house-control.org.ua'.$url.'">'.$keyword_ar[0].'</a> ';
                
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

function get_city_link( $rand_str, $file = 'city_link.txt' ){
    $link_ar = file( $file );
    
    mt_srand( abs( crc32($rand_str) ) );
//    shuffle($link_ar);
    $return = $link_ar[mt_rand(0, count($link_ar)-1)];
    mt_srand();
    
    return $return;
}

function get_cctv_pl_link( $seed_int ){
    
    $host_ar    = array(
        'camera-cctv.pp.ua',
        'kharkov-cctv.pp.ua',
        'videonabludenie-ukraine.pp.ua',
        'videonabludenie-kharkov.pp.ua',
        'videonabludenie-kiev.pp.ua',
        'cctv-camera.pp.ua',
        'cctv-cam.pp.ua',
        'cctv-dvr.pp.ua',
        'cctv-camera.cf',
        'cctv-camera.ga',
        'cctv-camera.gq',
        'cctv-camera.ml',
        'cctv-camera.tk',
        'cctv-dahua.cf',
        'cctv-dahua.ga',
        'cctv-dahua.gq',
        'cctv-dahua.ml',
        'cctv-dahua.tk'
    );
    $ancor_ar   = array(
        'Видеонаблюдение',
        'Домофоны',
        'Видеодомофоны',
        'Сигнализация',
        'Видеорегистраторы',
        'Камеры видеонаблюдения',
        'Домофоны и Видеодомофоны',
        'Системы видеонаблюдения',
        'Видеонаблюдение и Сигнализация',
        'Системы контроля и управления доступом',
        'Управление доступом',
        'Охранная сигнализация',
        'Пожарная сигнализация',
        'Установка видеонаблюдения',
        'Установка домофонов',
        'Установка сигнализации',
        'Видеорегистраторы для видеонаблюдения',
        'Интернет магазин видеонаблюдения',
        'Интернет магазин домофонов',
        'Интернет магазин видеодомофонов',
        'Интернет магазин сигнализации',
        'Интернет магазин видеорегистраторов',
        'IP Камеры наблюдения',
        'Магазин систем безопасности',
        'Видеонаблюдение в Украине',
        'Камеры видеонаблюдения в Украине',
        'Домофоны в Украине',
        'Видеодомофоны в Украине',
        'Видеонаблюдение в Киеве',
        'Магазин видеонаблюдения в Украине',
        'Магазин систем видеонаблюдения в Киеве',
        'Магазин видеонаблюдения в Харькове',
        'Магазин систем видеонаблюдения в Днепропетровске',
        'Магазин видеонаблюдения в Одессе',
        'Магазин систем видеонаблюдения в Запорожье',
        'Магазин домофонов в Украине',
        'Магазин видеодомофонов в Киеве',
        'Магазин домофонов в Харькове',
        'Магазин видеодомофонов в Днепропетровске',
        'Магазин домофонов в Одессе',
        'Магазин видеодомофонов в Запорожье'
        
    );
    
    mt_srand($seed_int);
    
    $url    = 'http://'.$host_ar[rand( 0,count($host_ar)-1 )].'/';
    $ancor  = $ancor_ar[rand( 0,count($ancor_ar)-1 )];
    
    if( mt_rand(0,1) )
        $link = '<a href="'.$url.'" >'.$ancor.'</a>';
    else
        $link = $ancor.' <a href="'.$url.'" >'.$url.'</a>';
        
    mt_srand();
    
    return $link;
}

function get_donor_url( array $data, integer $seed){
    $prefix = json_decode( $data['prefix_1'] );
    
    srand($seed);
    $subdomain = $prefix[rand(0, count($prefix)-1)];
    srand();
    
    $url = 'http://'.$subdomain.$data['name'].'/';
    
    return $url;
}