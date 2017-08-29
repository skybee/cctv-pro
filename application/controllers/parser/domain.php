<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


set_time_limit(3600*5);



class domain extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->library('parser/parse_lib');
        $this->load->library('parser/idna_convert_lib');
        $this->load->helper('simple_html_dom_helper');
        $this->load->database();
    }
    
    function index( $domain ){ 
        header("Content-type:text/plain;Charset=utf-8");
        echo $this->whois($domain);
    }
    
    function yandexGetCY($url){ 
        $cy = unserialize( file_get_contents( rtrim($_SERVER['DOCUMENT_ROOT'],'/').'/application/controllers/parser/cy2.txt' ) );
        $handle = fopen("http://yandex.ru/cycounter?$url", "rb"); 
        $contents = ''; 
        while (!feof($handle)) { 
        $contents .= fread($handle, 8192); 
        } 
        fclose($handle); 
        $hash = md5($contents);     
        if(array_key_exists($hash,$cy)){ 
            return $cy[$hash]; 
        } 
        return "none"; 
    } 
    
    function whois($domain){
        $domain = trim( $domain );
        preg_match("#\.([^\.]+)$#i", $domain, $zove_ar );
        $zone = strtolower( $zove_ar[1] );
        
        $whois_service_ar = array(
            'ua'    => 'whois.ua',
            'com'   => 'whois.verisign-grs.com',
            'gov'   => 'whois.dotgov.gov',
            'in'    => 'whois.inregistry.net',
            'info'  => 'whois.afilias.net',
            'org'   => 'whois.pir.org',
            'uk'    => 'whois.nic.uk',
            'us'    => 'whois.nic.us',
            'xn--p1ai' => 'whois.tcinet.ru',
            'рф'    => 'whois.tcinet.ru',
            'ru'    => 'whois.tcinet.ru',
            'net'   => 'whois.verisign-grs.com',
            'su'    => 'whois.tcinet.ru',
            'biz'   => 'whois.biz',
            'me'    => 'whois.nic.me',
            'md'    => 'whois.nic.md',
            'kz'    => 'whois.nic.kz',
            'cc'    => 'ccwhois.verisign-grs.com',
            'tv'    => 'tvwhois.verisign-grs.com',
            'tr'    => 'whois.nic.tr',
            'ro'    => 'whois.rotld.ro',
            'am'    => 'whois.amnic.net',
            'cn'    => 'whois.cnnic.cn',
            'ws'    => 'whois.website.ws',
            'au'    => 'whois.audns.net.au',
            'kg'    => 'whois.domain.kg'
        );
        
        if( !isset( $whois_service_ar[$zone] ) ){ echo $domain." !not zone \n"; return FALSE; }
        
        // Соединение с сокетом TCP, ожидающим на сервере "whois.arin.net" по 
        // 43 порту. В результате возвращается дескриптор соединения $sock.
        $sock = fsockopen($whois_service_ar[$zone], 43, $errno, $errstr);
        if (!$sock){ return FALSE; }
        else
        {
            // Записываем строку из переменной $_POST["ip"] в дескриптор сокета.
            fputs ($sock, $domain."\r\n");
            // Осуществляем чтение из дескриптора сокета.
            $text = "";
            while (!feof($sock))
            {
              $text .= fgets ($sock, 128);#."<br>";
            }
            // закрываем соединение
            fclose ($sock);

            // Ищем реферальный сервере
            $pattern = "|ReferralServer: whois://([^\n<:]+)|i";
            preg_match($pattern, $text, $out);
            if(!empty($out[1])) return $this->whois($out[1], $domain);
            else return $text;
        }
    }
    
    function cy_pr_com(){
        header("Content-type:text/plain;Charset=utf-8");
        
        $dns        = 'ns1.freedns.ws';
        $cnt_page   = 7;
        
        for($i=1; $i<=$cnt_page; $i++){
            
            $url = 'http://www.cy-pr.com/nameserver/'.$dns.'/'.$i;
            
            $html_list = $this->parse_lib->down_with_curl($url);

            $html_obj = str_get_html($html_list);
            $ii = 0;
            foreach( $html_obj->find('.tablesorter td a') as $tmp_a ){
                $domain = $tmp_a->innertext;
                $domain = str_ireplace('www.', '', $domain);
                $domain = $this->idna_convert_lib->encode( $domain );
                $cy     = $this->yandexGetCY('http://www.'.$domain.'/');
                
                $whois = $this->whois($domain);
                
                if( stripos($whois, $dns) !== false ){
                    $this->db->query("  REPLACE INTO `donor_domain` 
                                        SET  
                                            `name`  = '{$domain}',
                                            `cy`    = '{$cy}',
                                            `dns_service`   = '{$dns}'
                                     ");
                }
                else echo ' - NO NS RECORD ';
                
                echo $domain.' - '.$cy."\n";
                flush();
                sleep(1);
            }
            
            $html_obj->clear();
            unset($html_obj);
        }
    }
    
    function stat_reg_ru(){
        header("Content-type:text/plain;Charset=utf-8");
        
        $cnt_page = 8;
        
        $dns = 'ns1.freedns.ws';
//        $dns = 'ns1.byet.org';
        
//        $top_domain = 'rf'; 
//        $top_domain = 'su';
        $top_domain = 'ru';
        
        //=== получение массива url-адресов ===//
        for($i=1; $i<=$cnt_page; $i++){
            
            $url = 'http://statonline.ru/domains?rows_per_page=200&tld='.$top_domain.'&dns='.$dns.'&page='.$i;
//            exit($url);
            
            $html_list = $this->parse_lib->down_with_curl($url);
            $html_list = iconv('windows-1251', 'utf-8', $html_list);

            $html_obj = str_get_html($html_list);

            foreach( $html_obj->find('a[title=Посмотреть WHOIS этого домена]') as $tmp_a ){
                $domain_url = $this->parse_lib->uri2absolute( $tmp_a->href , $url); //получение ссылки на домен
                preg_match("#domain=(.+)$#i", $domain_url, $url_ar);    //получение домена из строки
                $domain = iconv('windows-1251', 'utf-8', urldecode( $url_ar[1] ) ); //преобразование домена в текст (для РФ)
                $domain = $this->idna_convert_lib->encode( $domain );
                $cy     = $this->yandexGetCY('http://www.'.$domain.'/');
                
                $query = $this->db->query("SELECT `name` FROM `donor_domain` WHERE `name` = '{$domain}' LIMIT 1 ");
                if( $query->num_rows() > 0 ) continue; // пропуск если домен уже есть в БД
                
                echo $domain." - ".$cy."\n";
                
                $this->db->query("  REPLACE INTO `donor_domain` 
                                    SET  
                                        `name`  = '{$domain}',
                                        `cy`    = '{$cy}',
                                        `dns_service`   = '{$dns}'
                                 ");
                flush();
                sleep(2);
            }
            
            echo '--------------------- Страница '.$i."-----------------------\n";
            
            $html_obj->clear();
            unset($html_obj);
        }
        
    }
    
    function nslist_net(){
        header("Content-type:text/plain;Charset=utf-8");
        
        $cnt_page = 82;
        
        for($i=21; $i<=$cnt_page; $i++){
            $page_nbr = $i; 
            if( $page_nbr == 1 ) $page_nbr = '';
            
            $url = 'http://nslist.net/ns1.freedns.ws/'.$page_nbr;
            
            $html_list = $this->parse_lib->down_with_curl($url);
            $html_list = iconv('ISO-8859-1', 'utf-8', $html_list);
            
            $pattern = "#<h2>([a-z\d\.-]+)</h2>#i";
            preg_match_all($pattern, $html_list, $domainAr);
            
//            print_r( $domainAr );
            
            foreach ($domainAr[1] as $domain){
                
                $query = $this->db->query("SELECT `name` FROM `donor_domain` WHERE `name` = '{$domain}' LIMIT 1 ");
                if( $query->num_rows() > 0 ){ 
                    echo $domain." - уже существует в БД \n";
                    continue; // пропуск если домен уже есть в БД
                }
                
                $whoisData = $this->whois($domain);
                $nsPattern = "#ns\d\.freedns\.ws#i";
                
                if( !preg_match($nsPattern, $whoisData) ){
                    echo $domain." - DNS не найден \n";
                    continue; // пропуск при отсутствии нужного DNS
                }
                
                $cy = $this->yandexGetCY('http://www.'.$domain.'/');
                
                $this->db->query("INSERT INTO `donor_domain` SET  `name` = '{$domain}', `cy` = '{$cy}', `dns_service` = 'ns1.freedns.ws' ");
                
                echo 'OK - '.$cy.' - '.$domain."\n";
                
                sleep(2);
                flush();
            }
            
            
            echo '--------------------- Страница '.$i."-----------------------\n";
//            flush();
//            sleep(15);
        }
    }
    
    function new_hash_ar(){
        $path = rtrim($_SERVER['DOCUMENT_ROOT'],'/').'/application/controllers/parser/';
        $dd = opendir( $path.'/cy.buttons/' );
        $hash_ar = array();
        while( $fname = readdir($dd) ){
            if( $fname != '.' && $fname != '..'){
                $content            = file_get_contents( $path.'/cy.buttons/'.$fname );
                $hash               = md5( $content );
                $hash_ar[ $hash ]   = trim($fname,'.gif');
            }
        }
        
        file_put_contents( $path.'cy2.txt', serialize($hash_ar) );
    }
    
    function get_donor(){
        header("Content-type:text/plain;Charset=utf-8");
        
        $query = $this->db->query("SELECT * FROM `donor_domain` WHERE `hosting` != '' AND `account` != '' ORDER BY `account`, `hosting`, `cy` DESC  ");
//        $query = $this->db->query("SELECT * FROM `donor_domain` WHERE `hosting` LIKE '%net76%' OR `hosting` LIKE '%webuda%' OR `hosting` LIKE '%netii%'  ORDER BY `account`, `hosting`, `cy` DESC  ");
        
        $i=1;
        foreach( $query->result_array() as $row ){
            $row['name'] = strtolower( $row['name'] );
            echo $i.'. '.$row['hosting'].' <a href="http://cy.'.$row['name'].'">cy.'.$row['name'].'</a><br />'; $i++;
//            echo '<a href="http://cy.'.$row['name'].'/">cy.'.$row['name'].'</a>'."\n";            
//            echo 'http://cy.'.$row['name']."/\n";
//            echo 'cy.'.$row['name']."\n";
            
//            if( $i%17 == 0 )
//                echo "---------------------------------------------------\n";
//            $i++;
        }
    }
    
    function update_cy(){
        header("Content-type:text/plain;Charset=utf-8");
        
        $query = $this->db->query("SELECT * FROM `donor_domain` ORDER BY `cy` DESC  ");
        
        $i=1;
        foreach( $query->result_array() as $row ){
            $new_cy = $this->yandexGetCY('http://'.$row['name']);
            if( $new_cy == 0 && $row['cy'] != 0 )
                $new_cy = $this->yandexGetCY('http://'.$row['name']);
            if( $new_cy == 0 && $row['cy'] != 0 )
                $new_cy = $this->yandexGetCY('http://'.$row['name']);
            echo $i.'. '.$row['cy'].' -> '.$new_cy.' - '.$row['name']."\n";
            
            $this->db->query("UPDATE `donor_domain` SET `cy`='{$new_cy}' WHERE `name`='{$row['name']}' ");
            
            flush();
            usleep(200000);
            $i++; 
        }
    }
    
    function upd_ns(){
        header("Content-type:text/plain;Charset=utf-8");
        $query = $this->db->query("SELECT * FROM `donor_domain` ORDER BY `cy` DESC  ");
        
        foreach( $query->result_array() as  $row){
            if( stripos($row['name'], '.spb.ru') ) continue;
            
            $whois_str = $this->whois( $row['name'] );
//            echo $whois_str;
            
            if( stripos( $whois_str, 'ns1.freedns.ws') === false ){
                $this->db->query("UPDATE `donor_domain` SET `delete` = 'delete' WHERE `name` = '{$row['name']}' ");
                echo "ERROR -\t".$row['name']."\n";
                flush();
            }
            else
                echo "OK - \t".$row['name']."\n";
            
            sleep(2);
        }
    }
    
}