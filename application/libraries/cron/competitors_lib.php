<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class competitors_lib{
    
    
    
    function __construct() {
        $this->ci = &get_instance();
        
        $this->ci->load->helper('simple_html_dom');
        $this->ci->load->model('cron_m');
    }
    
    function update( $competitors_data ){
        
        if( $competitors_data == NULL ){ return FALSE; }
        
        foreach( $competitors_data as $data ){
            
//            $data['url'] = 'http://bezpekashop.com.ua/dahua-technology/dvr-3104h/';
            
            $html = $this->curl_download( $data['url'] );
            
            if( empty($html) ){
                $data_ar['price']   = 0.00;
            }
            else{
                $price = $this->get_price( $data['url'], $html );
                $data_ar['price']   = $price;
            }
            
            $data_ar['id']      = $data['id'];
            $data_ar['date']    = date("Y-m-d H:i:s");
            
            if( $this->ci->cron_m->upd_competitors_link($data_ar) )
                echo "Цена обновлена {$data['url']} <br />\n";
            else
                echo "Ошибка обновления {$data['url']} <br />\n";
        }
    }
    
    private function get_price( $url, $html){
        
        if( stripos($url, 'magazun.com') ){
           $price = $this->parse_magazun( $html );
        }
        elseif( stripos($url, 'worldvision.com.ua') ){
           $price = $this->parse_worldvision( $html );
        }
        elseif( stripos($url, 'bezpekashop.com.ua') ){
           $price = $this->parse_bezpekashop( $html );
        }
        else
           $price = FALSE;
        
        return $price;
    }
    
    private function curl_download( $url ){
        $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.2) Gecko/20100316 Firefox/3.6.2' );
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	$content = curl_exec($ch);
	curl_close($ch);

	return $content;
    }
    
    
    //==== <parse method> ====//
    private function parse_magazun( $html ){
        $dom_obj   = str_get_html( $html );
        $prise_str = $dom_obj->find('span.alter_curr', 0)->innertext;
        
        $prise_str = preg_replace("#(\(|\)|\s|грн\.|,)#i", '', $prise_str);

        $price = round( (float) $prise_str, 2);
        
        if( $price < 1 ) return FALSE;
        
        return $price;
    }
    
    private function parse_worldvision( $html ){
        $dom_obj   = str_get_html( $html );
        $prise_str = $dom_obj->find('span[itemprop=price]', 0)->innertext;
        
        $price = round( (float) $prise_str, 2);
        
        if( $price < 1 ) return FALSE;
        
        return $price;
    }
    
    private function parse_bezpekashop( $html ){
        $dom_obj   = str_get_html( $html );
        if( is_object( $dom_obj->find('span[itemprop=price]', 0) ) )
            $prise_str = $dom_obj->find('span[itemprop=price]', 0)->innertext;
        else
            $prise_str = '0.00';
        
        $prise_str = strip_tags( $prise_str );
        $prise_str = preg_replace("#(Цена:|грн|\s|)#i", '', $prise_str);
        
        $price = round( (float) $prise_str, 2);
        
        if( $price < 1 ) return FALSE;
        
        return $price;
        
    }
    //==== </parse method> ====//
}