<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(3600*5);

class news extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->library('parser/parse_lib');
        $this->load->helper('simple_html_dom_helper');
    }
    
    function index(){}
    
    function test(){
        $this->load->view('tmp/test_parser_view');
    }
    
    function secnews(){
        header("Content-type:text/plain;Charset=utf-8");
        
//        $url = 'http://www.secnews.ru/russian/';
//        $url = 'http://www.secnews.ru/russian/?PAGEN_1=45';
//        $url = 'http://www.secnews.ru/articles/cctv.php';
//        $url = 'http://www.secnews.ru/articles/';
        
        
        for($i_page=1; $i_page<=1; $i_page++ ):
        
            $url = 'http://www.secnews.ru/articles/?PAGEN_1='.$i_page; //40 новостей на странице
            echo "\n\n == Обработка страницы {$i_page} ==\n\n";
            
        //=== получение массива url-адресов ===//
        $html_list = $this->parse_lib->down_with_curl($url);
        $html_list = iconv('windows-1251', 'utf-8', $html_list);
        
        $pattern = "#<a href=\"(/(articles|russian)/\d+[\S]*?)\"[\s\S]*?>(<img[\s\S]*?src=\"([\S]*?)\"[\s\S]*?|[\s\S]*?)</a>#i";
        preg_match_all($pattern, $html_list, $tmp_uri_ar);
        
        $url_ar = array();
        $cnt_tmp_uri = count($tmp_uri_ar[1]);
        for($i=0,$ii=0; $i<$cnt_tmp_uri; $i++){ //обход массива адресов url
            $tmp_article_url    = $this->parse_lib->uri2absolute($tmp_uri_ar[1][$i],$url); //получение url
            
            foreach( $url_ar as $tmp_url_ar ) //поиск аналогичного url и пропуск его
                if( $tmp_url_ar['url'] == $tmp_article_url )  continue(2);
                
            //занесение url статьи и изображения в массив    
            $url_ar[$ii]['url']  = $tmp_article_url; 
            if( !empty($tmp_uri_ar[4][$i]) )
                $url_ar[$ii]['img']  = $this->parse_lib->uri2absolute($tmp_uri_ar[4][$i],$url);
            $ii++;
        }
        //=== /получение массива url-адресов ===//

        //=== скачивание статей ===//
        foreach($url_ar as $url_img){
            $article_html = $this->parse_lib->down_with_curl($url_img['url']);
            $article_html = iconv('windows-1251', 'utf-8', $article_html);
            
            $html_obj = str_get_html($article_html);
            
            if( !isset($url_img['img']) ) $url_img['img'] = false;
            
            $article_data['url']    = $url_img['url'];
            $article_data['img']    = $url_img['img'];
            $article_data['title']  = $html_obj->find('h1',0)->innertext;
            $article_data['text']   = $html_obj->find('.news-detail',0)->innertext;
            $article_data['text']   = preg_replace("#\d{2}\.\d{2}\.\d{4}#i", ' ', $article_data['text']);
            $article_data['date']   = date("Y-m-d", rand(time()-3600*24*50, time() ) );
            
            $this->parse_lib->insert_news( $article_data );
            
            $html_obj->clear();
            unset($html_obj);
            
            flush();
            sleep(2);
//            break;
        }        
        //=== /скачивание статей ===//
        
        endfor;
    }
    
    function hitsec(){
        header("Content-type:text/plain;Charset=utf-8");
        
//        $url = 'http://www.hitsec.ru/articles.htm';
        
        //=== получение массива url-адресов ===//
        for($i=0; $i<=2; $i++){
            if( $i==0 )
                $url = 'http://www.hitsec.ru/articles.htm';
            else
                $url = 'http://www.hitsec.ru/articles-'.$i.'.htm';
            
            
            $html_list = $this->parse_lib->down_with_curl($url);
            $html_list = iconv('windows-1251', 'utf-8', $html_list);

            $html_obj = str_get_html($html_list);

            foreach( $html_obj->find('.cr7 p b a') as $tmp_a ){
                $link_ar[] = $this->parse_lib->uri2absolute( $tmp_a->href , $url);
            }
            
            $html_obj->clear();
            unset($html_obj);
            
            sleep(3);
//            break;
        }
        //=== /получение массива url-адресов ===//
//        print_r($link_ar);
        
        
        //=== получение и обработка статьи ===//
        foreach($link_ar as $article_url){
            $article_html = $this->parse_lib->down_with_curl( $article_url );
            $article_html = iconv('windows-1251', 'utf-8', $article_html);
            
            $html_obj = str_get_html($article_html);
            
            $article_data['url']    = $article_url;
            $article_data['img']    = '';
            $article_data['title']  = $html_obj->find('.cr7 h1',0)->innertext;
            $article_data['text']   = $html_obj->find('.cr7',0)->innertext;
            $article_data['text']   = preg_replace("#<div class=\"submenu[\s\S]*?</div>#i", ' ', $article_data['text']);
            $article_data['text']   = preg_replace("#<h1[\s\S]*?</h1>#i", ' ', $article_data['text']);
            $article_data['date']   = date("Y-m-d", rand(time()-3600*24*90, time() ) );
            
            $this->parse_lib->insert_news( $article_data );
            
            $html_obj->clear();
            unset($html_obj);
            flush();
            sleep(2);
//            break;
        }
        //=== /получение и обработка статьи ===//
//        print_r($article_data);
    }
    
    function daily_sec(){
        header("Content-type:text/plain;Charset=utf-8");
        
        //=== получение массива url-адресов ===//
        $i=0;
        for($i_page=1; $i_page<=3; $i_page++){
//            $url = 'http://daily.sec.ru/pbls.cfm?ppos='.$i_page.'&rid=20&rp=1&cid=12&cp=2'; //cctv
//            $url = 'http://daily.sec.ru/pbls.cfm?ppos='.$i_page.'&rid=22&rp=1&cid=12&cp=2'; //fire alarm
//            $url = 'http://daily.sec.ru/pbls.cfm?ppos='.$i_page.'&rid=21&rp=1&cid=12&cp=2'; //skud
//            $url = 'http://daily.sec.ru/pbls.cfm?ppos='.$i_page.'&rid=24&rp=1&cid=12&cp=2'; //comleks security
            $url = 'http://daily.sec.ru/pbls.cfm?ppos='.$i_page.'&rid=27&rp=1&cid=12&cp=2'; //охрана периметра
            
            $html_list  = $this->parse_lib->down_with_curl($url);
            $html_obj   = str_get_html($html_list);
            
            foreach( $html_obj->find('.articles') as $articles_block ){
                $link_ar[$i]['url'] = $this->parse_lib->uri2absolute( $articles_block->find('h2 a',0)->href, $url );
                if( is_object( $articles_block->find('.article-img img',0) ) )
                    $link_ar[$i]['img'] = $articles_block->find('.article-img img',0)->src;
                else
                    $link_ar[$i]['img'] = '';
                if( !empty($link_ar[$i]['img']) ) 
                    $link_ar[$i]['img'] = $this->parse_lib->uri2absolute( $link_ar[$i]['img'], $url );
                $i++;
            }            
            
            $html_obj->clear();
            unset($html_obj);
            
            sleep(3);
//            break;
        }
//        print_r($link_ar);
        //=== /получение массива url-адресов ===//
        
        
        //=== получение и обработка статьи ===//
        foreach($link_ar as $article_url){
            $article_html = $this->parse_lib->down_with_curl( $article_url['url'] );
            
            $html_obj = str_get_html($article_html);
            
            $article_data['url']    = $article_url['url'];
            $article_data['img']    = $article_url['img'];
            $article_data['title']  = $html_obj->find('.article-body h1',0)->innertext;
            
            $html_obj->find('.article-body h1',0)->outertext = '';
            $html_obj->find('.article-body h3',0)->outertext = '';
            $html_obj->find('.article-body a[href=http://www.dean.ru/] img',0)->outertext = '';
            $html_obj->find('.article-body',0)->last_child('table')->outertext = '';
            
            $article_data['text']   = $html_obj->find('.article-body',0)->innertext;
            $article_data['text']   = preg_replace("#<img\s+src=.?http://r\.sec\.ru/ab/\?id=41823[\s\S]*?>#i", ' ', $article_data['text']);
            $article_data['text']   = preg_replace("#<img[\s\S]*?pimg00583666.jpg[\s\S]*?>#i", ' ', $article_data['text']);
            $article_data['date']   = date("Y-m-d", rand(time()-3600*24*180, time() ) );
            
//            echo "<h1>++++{$article_data['title']}++++</h1>";
//            echo $this->parse_lib->clear_txt( $article_data['text'] );
//            echo "<br />\n<br />\n<br />\n<br />\n<br />\n ============================================ <br />\n<br />\n<br />\n<br />\n<br />\n";
            
            $this->parse_lib->insert_news( $article_data );
            
            $html_obj->clear();
            unset($html_obj);
            flush();
//            sleep(2);
//            break;
        }
        //=== /получение и обработка статьи ===//
    }
    
    function secuteck(){
        header("Content-type:text/plain;Charset=utf-8");
        
        //=== получение массива url-адресов ===//
        $i=0;
        for($i_page=1; $i_page<=2; $i_page++){
//            $url = 'http://www.secuteck.ru/articles2/videonabl/'.$i_page.'/'; //видеонаблюдение
//            $url = 'http://www.secuteck.ru/articles2/dvr/'.$i_page.'/'; //видеорегистраторы
//            $url = 'http://www.secuteck.ru/articles2/ip-security/'.$i_page.'/'; //IP-Secutity
//            $url = 'http://www.secuteck.ru/articles2/OPS/'.$i_page.'/'; //Охранная и охранно-пожарная сигнализация, периметральные системы
            $url = 'http://www.secuteck.ru/articles2/sys_ogr_dost/'.$i_page.'/'; //Системы контроля и управления доступом (СКУД)
			
            $html_list  = $this->parse_lib->down_with_curl($url);
            $html_list  = iconv('windows-1251', 'utf-8', $html_list);
            $html_obj   = str_get_html($html_list);
            
            foreach( $html_obj->find('p[align=center] div[style=border-bottom: 1px dotted #c0c0c0;]') as $articles_block ){
                $link_ar[$i]['url']     = $this->parse_lib->uri2absolute( $articles_block->find('a',0)->href, $url );
                $link_ar[$i]['img']     = '';
                $link_ar[$i]['title']   = $articles_block->find('a',0)->innertext;
                
                $i++;
            }            
            
            $html_obj->clear();
            unset($html_obj);
            
            sleep(3);
//            break;
        }
//        print_r($link_ar);
        //=== /получение массива url-адресов ===//
        
        
        //=== получение и обработка статьи ===//
        foreach($link_ar as $article_url){
            $article_html = $this->parse_lib->down_with_curl( $article_url['url'] ); //$article_url['url']
            $article_html = iconv('windows-1251', 'utf-8', $article_html);
            
            $html_obj = str_get_html($article_html);
            
            $article_data['url']    = $article_url['url'];
            $article_data['img']    = $article_url['img'];
            $article_data['title']  = $article_url['title']; //$html_obj->find('h1',0)->innertext;
            
			if( !is_object($html_obj) ) continue;
            $content_obj = $html_obj->find('table[bordercolor=#498c13]',0);
			if( !is_object($content_obj) ) continue;
			$content_obj = $content_obj->find('tr',1);
			if( !is_object($content_obj) ) continue;
			$content_obj = $content_obj->find('td',1);
			
            $content_obj->find('div[align=center]',0)->outertext = '';
            $content_obj->find('h1',0)->outertext = '';
            foreach( $content_obj->find('a[href=/articles2/videonabl], a[href=/articles2], a[href=/articles2/allauthors], a[href=/articles2/allpubliks], a[href=/adv.php]') as $a )
                    $a->outertext = '';
            $content_obj->find('form',0)->outertext = '';
            $article_data['text']   = $content_obj->innertext;
            $article_data['text']   = preg_replace("#<h3>Добавить комментарий</h3>#i", ' ', $article_data['text']);
            $article_data['text']   = preg_replace("#<p><i>Опубликовано:[\s\S]*?Посещений:[\s\S]*?<br>#i", ' ', $article_data['text']);
            $article_data['text']   = preg_replace("#<(/?)div#i", "<p$1", $article_data['text']);
            $article_data['date']   = date("Y-m-d", rand(time()-3600*24*900, time()-3600*24*210 ) );
            
//            echo "<h1>++++{$article_data['title']}++++</h1>";
//            echo $this->parse_lib->clear_txt( $article_data['text'] );
//            echo "<br />\n<br />\n<br />\n<br />\n<br />\n ============================================ <br />\n<br />\n<br />\n<br />\n<br />\n";
            
            $this->parse_lib->insert_news( $article_data, 80, false );
            
            $html_obj->clear();
            unset($html_obj);
            flush();
//            sleep(2);
//            break;
        }
        //=== /получение и обработка статьи ===//
//        print_r($article_data);
    }
    
    function pl_4safe(){
        header("Content-type:text/plain;Charset=utf-8");
        
        //=== получение массива url-адресов ===//
        $i=0;
        for($i_page=0; $i_page<=0; $i_page++){

            $url = 'http://www.4safe.pl/artykuly?page='.$i_page; 
			
            $html_list  = $this->parse_lib->down_with_curl($url);
//            $html_list  = iconv('windows-1251', 'utf-8', $html_list);
            $html_obj   = str_get_html($html_list);
            
            foreach( $html_obj->find('p[align=center] div[style=border-bottom: 1px dotted #c0c0c0;]') as $articles_block ){
                $link_ar[$i]['url']     = $this->parse_lib->uri2absolute( $articles_block->find('a',0)->href, $url );
                $link_ar[$i]['img']     = '';
                $link_ar[$i]['title']   = $articles_block->find('a',0)->innertext;
                
                $i++;
            }            
            
            $html_obj->clear();
            unset($html_obj);
            
            sleep(3);
//            break;
        }
//        print_r($link_ar);
        //=== /получение массива url-адресов ===//
        
        
        //=== получение и обработка статьи ===//
        foreach($link_ar as $article_url){
            $article_html = $this->parse_lib->down_with_curl( $article_url['url'] ); //$article_url['url']
            $article_html = iconv('windows-1251', 'utf-8', $article_html);
            
            $html_obj = str_get_html($article_html);
            
            $article_data['url']    = $article_url['url'];
            $article_data['img']    = $article_url['img'];
            $article_data['title']  = $article_url['title']; //$html_obj->find('h1',0)->innertext;
            
			if( !is_object($html_obj) ) continue;
            $content_obj = $html_obj->find('table[bordercolor=#498c13]',0);
			if( !is_object($content_obj) ) continue;
			$content_obj = $content_obj->find('tr',1);
			if( !is_object($content_obj) ) continue;
			$content_obj = $content_obj->find('td',1);
			
            $content_obj->find('div[align=center]',0)->outertext = '';
            $content_obj->find('h1',0)->outertext = '';
            foreach( $content_obj->find('a[href=/articles2/videonabl], a[href=/articles2], a[href=/articles2/allauthors], a[href=/articles2/allpubliks], a[href=/adv.php]') as $a )
                    $a->outertext = '';
            $content_obj->find('form',0)->outertext = '';
            $article_data['text']   = $content_obj->innertext;
            $article_data['text']   = preg_replace("#<h3>Добавить комментарий</h3>#i", ' ', $article_data['text']);
            $article_data['text']   = preg_replace("#<p><i>Опубликовано:[\s\S]*?Посещений:[\s\S]*?<br>#i", ' ', $article_data['text']);
            $article_data['text']   = preg_replace("#<(/?)div#i", "<p$1", $article_data['text']);
            $article_data['date']   = date("Y-m-d", rand(time()-3600*24*900, time()-3600*24*210 ) );
            
//            echo "<h1>++++{$article_data['title']}++++</h1>";
//            echo $this->parse_lib->clear_txt( $article_data['text'] );
//            echo "<br />\n<br />\n<br />\n<br />\n<br />\n ============================================ <br />\n<br />\n<br />\n<br />\n<br />\n";
            
            $this->parse_lib->insert_news( $article_data );
            
            $html_obj->clear();
            unset($html_obj);
            flush();
//            sleep(2);
//            break;
        }
        //=== /получение и обработка статьи ===//
//        print_r($article_data);
    }
}