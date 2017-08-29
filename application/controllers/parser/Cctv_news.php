<?php

class Ccctv_news extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('download_helper');
        $this->load->helper('parser/simple_html_dom_helper');
    }

    function get_url($host)
    {
        $urlList = array();
        
        $htmlDom = '';
        
        switch ($host)
        {
            case 'habr':
                $urlList = $this->getUrlHubr();
                break;
        }
    }
    
    
    private function getUrlHubr()
    {
        $queryStr[] = array('query'=>'видеонаблюдение','cnt_page'=>'8');
        $queryStr[] = array('query'=>'ip-камеры','cnt_page'=>'5');
        $queryStr[] = array('query'=>'видеорегистратор','cnt_page'=>'5');
        
        $url = 'https://habrahabr.ru/search/page'.$page.'/?q='.$query.'&target_type=posts&order_by=relevance';
        
        foreach($queryStr as $qStrAr)
        {
            $cntPage = $qStrAr['cnt_page'];
            $qStr    = $qStrAr['query'];
            
            for($i=1;$i<=$cntPage;$i++)
            {
                $url    = 'https://habrahabr.ru/search/page'.$i.'/?q='.$qStr.'&target_type=posts&order_by=relevance';
                $html   = down_with_curl($url);
                if(empty($html)){ continue; }
                $this->habrParseUrl($html);
            }
        }
    }
    
    private function habrParseUrl($html)
    {
        $htmlObj = str_get_html($html);
        if(!is_object($htmlObj->find('a.post__title_link',0)))
        {
            return false;
        }
        $returnAr = array();
        
        foreach ($htmlObj->find('a.post__title_link') as $aObj)
        {
            $returnAr[] = $aObj['href'];
        }
    }
    
}


