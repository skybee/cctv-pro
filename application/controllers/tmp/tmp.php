<?php

class tmp extends CI_Controller{
    
    private $anchor;
    
    function __construct() {
        parent::__construct();
        
//        exit('Закрыт для выполнения');
        
        $this->load->database();
    }
    
    
    function index(){
        echo 'tmp';
    }
    
    
    function get_rnd_articles(){
        header("Content-type:text/plain;Charset=utf-8");
        
        $query = $this->db->query("SELECT `url_name`, `id`, `title` FROM `articles` ORDER BY RAND() LIMIT 500 ");
        
        foreach( $query->result_array() as $row ){
            echo '<a href="http://house-control.org.ua/article/'.$row['id'].'/'.$row['url_name'].'/">'.$row['title'].'</a>'."\n";
        }
    }
    
    function sape_page( $art_goods = 'goods', $page = 1){
        
        $start_limit    = $page*100-100;
        $links          = '';
        
        if( $art_goods == 'goods' ){
            $query = $this->db->query("SELECT * FROM `goods` ORDER BY `price` ASC, `id` ASC LIMIT {$start_limit}, 100 ");
            
            foreach($query->result_array() as $row){
                $links .= '<a href="/goods/'.$row['id'].'/'.$row['url_name'].'/">'.$row['name']."</a><br />\n";
            }
        }
        elseif( $art_goods == 'articles' ){
            $query = $this->db->query("SELECT `id`, `url_name`, `title`, `text` FROM `articles` ORDER BY `id` LIMIT {$start_limit}, 100 ");
            
            $i=0;
            foreach($query->result_array() as $row){
                if($i==0){
                    $links .= '<div><h1>'.$row['title'].'</h1>'.$row['text'].'</div>';
                }
                $links .= '<a href="/article/'.$row['id'].'/'.$row['url_name'].'/">'.$row['title']."</a><br />\n";
                $i++;
            }
        }
        
        echo "<html><head></head><body>{$links}</body></html>";
    }
    
    function sape_donor_link_conver_url(){
        header("Content-type:text/plain;Charset=utf-8");
        $str_ar = file('sape_donor.txt');
        
        $url_pattern    = "#\s(http://\S+?)\s#i";
        $a_pattern      = "|#/?a#|i";
        
        foreach ($str_ar as $str){
            preg_match($url_pattern, $str, $url_ar);
            
            $str = preg_replace($a_pattern, ' ', $str);
            $str = preg_replace($url_pattern, '', $str);
            $str = str_replace("\n", '', $str);
            $str = str_ireplace("house-control.org.ua", '', $str);
            
//            echo $str.'<br />'.$url_ar[1].'<br /><br />';
            
            echo '<a href="'.$url_ar[1].'">'.$str.'</a>'."\n";
        }
    }
    
    function sape_donor_link_conver_url_2(){
        header("Content-type:text/plain;Charset=utf-8");
        $str_ar = file('sape_donor.txt');
        
        foreach ($str_ar as $str){
            $urlAr = explode("\t", $str);

            $urlAr[0] = preg_replace("#\s#i", '', $urlAr[0]);
            $urlAr[1] = preg_replace("#\s#i", '', $urlAr[1]);
            
            echo '<a href="'.$urlAr[1].'">'.$this->getAnchor_conver_url_2($urlAr[0]).'</a>'."\n".
                 '<a href="'.$urlAr[1].'">'.$this->getAnchor_conver_url_2($urlAr[0]).'</a>'."\n".   
                 '<a href="'.$urlAr[1].'">'.$this->getAnchor_conver_url_2($urlAr[0]).'</a>'."\n".   
                 $this->getAnchor_conver_url_2($urlAr[0]).' <a href="'.$urlAr[1].'">'.substr($urlAr[1], 0,30).'</a>'."\n".
                 $this->getAnchor_conver_url_2($urlAr[0]).' <a href="'.$urlAr[1].'">'.substr($urlAr[1], 0,50).'</a>'."\n".   
                 $this->getAnchor_conver_url_2($urlAr[0]).' <a href="'.$urlAr[1].'">'.substr($urlAr[1], 0,70).'</a>'."\n"; 
        }
    }
    
    function sape_donor_link_conver_url_3(){
        header("Content-type:text/plain;Charset=utf-8");
        $str_ar = file('sape_donor_3.txt');
        $result = '';
        
        foreach($str_ar as $str){
            $str = preg_replace("|#a#\s*http.+?#/a#|i", '', $str);
            
            preg_match("#(http://\S+?)\s#i", $str, $url_ar);
            $url = $url_ar[1];
            
            $str = trim(preg_replace("#http://\S+?\s#i", '', $str));
            
            if(!preg_match("|#a#|i", $str))
            {
                $str = '#a#'.trim($str,'.').'#/a#';
            }
            
            $link_1 = preg_replace(array("|#a#|i","|#/a#|i"), array('<a href="'.$url.'">','</a>'), $str);
            
            if(mb_strlen($url)>40)
            {
                $url_ar = parse_url($url);
                $len = mb_strlen($url);
                $url_ancor = 'http://'.$url_ar['host'].'/.../'.mb_substr($url, $len-10);
            }
            else
            {
                $url_ancor = $url;
            }
            $link_2 = preg_replace("|#/?a#|i", '', trim($str,'.')).' <a href="'.$url.'">'.$url_ancor.'</a>. ';
            
            $result .= $link_1."\n";
            $result .= $link_2."\n";
        }
        echo $result;
    }
    
    private function getAnchor_conver_url_2( $url ){
        $anchorAr = array(
            'http://house-control.org.ua/ustanovka_kamer_videonabljudenija.html'
            => array('Установка видеонаблюдения', 'Установка камер наблюдения', 'Установка камер видеонаблюдения в Харькове'),
            'http://house-control.org.ua/catalog_videoregistrator.html' 
            => array('Видеорегистраторы', 'Регистраторы DVR', 'Купить видеорегистратор'),
            'http://house-control.org.ua/ustanovka_domofona_videodomofona.html' 
            => array('Установка домофонов','Установить видеодомофон'),
            'http://house-control.org.ua/' 
            => array('Видеонаблюдение','Сигнализация','Домофоны','Видеодомофоны'),
            'http://house-control.org.ua/catalog_kamera.html' 
            => array('Камеры видеонаблюдения','Камера наблюдения','CCTV камера'),
            'http://house-control.org.ua/catalog_pc_system_video.html' 
            => array('Платы видиозахвата','Платы видеозахвата ILDVR', 'Карты видеозахвата HIKVISION'),
            'http://house-control.org.ua/category/videonabljudenie/' 
            => array('Видеонаблюдение','Видеонаблюдение в Украине','Видеонаблюдение в Харькове','Системы видеонаблюдения','Система видеонаблюдения Харьков','CCTV системы в Харькове'),
            'http://house-control.org.ua/category/cctv-systems/' 
            => array('Видеонаблюдение','Видеонаблюдение в Украине','Видеонаблюдение в Харькове','Системы видеонаблюдения','Система видеонаблюдения Харьков','CCTV системы в Харькове'),
            'http://house-control.org.ua/category/videoregistrator/' 
            => array('Видеорегистраторы','Купить регистратор DVR в Украине','DVR Partizan Dahua','Магазин видеорегистраторов','DVR видеорегистраторы'),
            'http://house-control.org.ua/category/domofony/' 
            => array('Домофоны','Видеодомофоны','Домофон в Украине','Продажа домофонов','Домофоны для квартиры и дома','Купить видеодомофон Commax и Kenwei'),
            'http://house-control.org.ua/category/kamera/' 
            => array('Камеры видеонаблюдения','CCTV камеры','Камеры наблюдения','Уличные камеры видеонаблюдения','Купить камеры видеонаблюдения в Харькове','Камеры наблюдения в Украине','Наружные CCTV видеокамеры','Продажа камер наблюдения'),
            'http://house-control.org.ua/category/pc_system_video/' 
            => array('Платы видиозахвата','Платы видеозахвата ILDVR', 'Карты видеозахвата HIKVISION'),
            'http://house-control.org.ua/category/kamera/1/donetsk/' 
            => array('Камеры видеонаблюдения','Продажа камер наблюдения в Запорожье','Видеокамеры в Запорожье','Купить уличную CCTV камеру в Запорожье','Видеонаблюдение Запорожье','Камеры видеонаблюдения в Запорожье'),
            'http://house-control.org.ua/category/kamera/1/ip-kameru-cctv-zaporozhye/' 
            => array('Камеры видеонаблюдения','Продажа камер наблюдения в Запорожье','Видеокамеры в Запорожье','Купить уличную CCTV камеру в Запорожье','Видеонаблюдение Запорожье','Камеры видеонаблюдения в Запорожье'),
            'http://house-control.org.ua/category/kamera/1/dnepropetrovsk/' 
            => array('Камеры видеонаблюдения','Продажа камер наблюдения в Днепропетровске','Видеокамеры в Днепропетровске','Купить уличную CCTV камеру в Днепропетровске','Видеонаблюдение Днепропетровск','Камеры видеонаблюдения в Днепропетровске'),
            'http://house-control.org.ua/category/kamera/1/odessa/' 
            => array('Камеры видеонаблюдения','Продажа камер наблюдения в Одессе','Видеокамеры в Одессе','Купить уличную CCTV камеру в Одессе','Видеонаблюдение Одесса','Камеры видеонаблюдения в Одессе'),
            'http://house-control.org.ua/category/kamera/1/ip-kameru-cctv-kiev/' 
            => array('Камеры видеонаблюдения','Продажа камер наблюдения в Киеве','Видеокамеры в Киеве','Купить уличную CCTV камеру в Киеве','Видеонаблюдение Киеве','Камеры видеонаблюдения в Киеве'),
            'http://house-control.org.ua/category/dahua-dvr-nvr-videoregistrator/' 
            => array('Видеорегистраторы Dahua','Dahua DVR','Dahua NVR','CCTV регистраторы Dahua','Продажа видеорегистраторов Dahua','Купить Dahua DVR в Украине','Dahua DH-DVR NVR в Украине'),
            'http://house-control.org.ua/category/cctv-komplekt-videonabludenie/'
            => array('комплект видеонаблюдения','готовые комплекты видеонаблюдения','комплект камер видеонаблюдения','комплект видеонаблюдения для дома')
        );
        
        if( !is_array($anchorAr[$url]) ) return '!--ERROR--'."\n";
        
        $anchor = $anchorAr[$url][ rand(0, count($anchorAr[$url])-1 ) ];
        
        while( $anchor == $this->anchor ){
            $anchor = $anchorAr[$url][ rand(0, count($anchorAr[$url])-1 ) ];
        }
        
        $this->anchor = $anchor;
        return $anchor;
    }
    
    function set_goods_key_descript(){
        $cat_url_name   = 'dvernye-bloki-3';
        $keywords       = 'дверной,блок,домофон,аудиодомофон,купить,продажа,#name#';
        $description    = 'Дверной блок аудиодомофона  #name#. Продажа #name# с доставкой по Украине';
        
        
        $query = $this->db->query(" SELECT 
                                        goods.id, goods.name 
                                    FROM 
                                        `goods`, `category`, `category_goods`
                                    WHERE
                                        goods.id = category_goods.goods_id
                                        AND
                                        category_goods.category_id = category.id
                                        AND
                                        category.url_name = '{$cat_url_name}'
                                    ");
                                        
        foreach( $query->result_array() as $row ){
//            echo $row['id'].' - '.$row['name'].'<br />';
            
            $sql_keywords       = str_ireplace('#name#', $this->get_keyw_goods_name( $row['name'] ), $keywords);
            $sql_description    = str_ireplace('#name#', $row['name'], $description);
            
            
            $sql_query  = " UPDATE `goods`
                            SET 
                                `html_keywords`     = '{$sql_keywords}',
                                `html_description`  = '{$sql_description}'
                            WHERE
                                `id` = {$row['id']}
                          ";
                                
//            echo $sql_query.'<br />';
            $this->db->query( $sql_query );
        }                                          
        
    }
    
    private function get_keyw_goods_name( $name ){
        $name = trim($name);
        $name = str_ireplace('-', ' ', $name);
        $name = str_ireplace('&nbsp;', ' ', $name);
        $name = str_ireplace(' ', ',', $name);
        
        return $name;
    }
    
    function resize_image_goods(){
        set_time_limit(600);
        $this->load->library('upload_img_lib');
        
        $query = $this->db->query("SELECT `main_img` FROM `goods` WHERE `main_img` != '' ");
        
        $i = 0; $i_nofile = 0;
        foreach( $query->result_array() as $row ){
            
            if( !file_exists( 'upload/images/'.$row['main_img'] ) ){ $i_nofile++;  continue; }
            
            $this->upload_img_lib->resize_img( $row['main_img'], '70x70');
            $this->upload_img_lib->resize_img( $row['main_img'], '160x160');
            $this->upload_img_lib->resize_img( $row['main_img'], '265x290');
            $i++;
        }
        
        echo 'Выполнено. Обработано '.$i.' файлов.<br /> Не найдено '.$i_nofile.' файлов';
    }
    
    function resize_image_category(){
        set_time_limit(600);
        $this->load->library('upload_img_lib');
        
        $query = $this->db->query("SELECT `img` FROM `category` WHERE `img` != '' ");
        
        $i = 0; $i_nofile = 0;
        foreach( $query->result_array() as $row ){
            
            if( !file_exists( 'upload/images/'.$row['img'] ) ){ $i_nofile++;  continue; }
            
            $this->upload_img_lib->resize_img( $row['img'], '160x160');
            $i++;
        }
        
        echo 'Выполнено. Обработано '.$i.' файлов.<br /> Не найдено '.$i_nofile.' файлов';
    }
}