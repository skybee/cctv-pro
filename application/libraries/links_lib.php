<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class links_lib {

    public $link_isset, $link_html;

    function __construct($param) {

        $this->ci = & get_instance();
        $this->ci->load->helper('links/sape');
        $this->ci->load->helper('links/trustlink');
        $this->ci->load->helper('links/ingots');

        $this->link_isset = FALSE;
        $this->link_html = '';

//        if (trim($_SERVER['REQUEST_URI'], '/') == '' && $param['main'] != false) //== главная страница (если отдана конкретной биржи)
//            $this->main_page_links($param['main']);
//        else
            $this->select_links(); //== все остальные страницы


            
//        $this->link_html = $this->add_nofollow( $this->link_html );
    }
    
    
    private function getIngotsSet(){
        return array(
            // Указание коду отображать ссылки, а не объявления 
            'CODE_TYPE' => 'l',
            // Ваш секретный код для ссылок в системе Ingots 
            'USERNAME' => '34091D9FC7020B673F6AC5F2935397D8',
            // Кодировка выводимых ссылок. Preset: win, utf, iso, koi. Default: utf. Либо любая другая кодировка в понятном для ICONV виде. 
            'charset' => 'utf',
            // Разделитель между текстами ссылками. Default: ' | ' 
            'splitter' => ' <br /> ',
            // HTML блок перед каждым текстом ссылки в блоке. Default: '' 
            'htmlbefore' => '',
            // HTML блок после каждого текста ссылки в блоке. Default: '' 
            'htmlafter' => '',
            // Значение атрибута STYLE для каждого тэга A в блоке ссылок. Default: '' 
            'style' => '',
            // Значение атрибута TARGET для каждого тэга A в блоке ссылок. Default: '' 
            'target' => '_blank',
            // Значение атрибута CLASS для каждого тэга A в блоке ссылок. Default: '' 
            'class_name' => '',
            // Поместить ли весь блок со ссылками в тэг SPAN. Possible: true, false. Default: false. 
            'span' => false,
            // Значение атрибута STYLE для тэга SPAN в который помещен блок ссылок. 
            'style_span' => false,
            // Значение атрибута CLASS для тэга SPAN в который помещен блок ссылок. 
            'class_name_span' => false,
            // Поместить ли весь блок со ссылками в тэг DIV. Possible: true, false. Default: false. 
            'div' => false,
            // Значение атрибута STYLE для тэга DIV в который помещен блок ссылок. 
            'style_div' => false,
            // Значение атрибута CLASS для тэга DIV в который помещен блок ссылок. 
            'class_name_div' => false,
            // Если используются значения span = true и div = true, то указанный этим параметром тэг будет выводиться первым. Default: div. 
            'div_span_order' => 'div',
            // Формат выдачи блока ссылок. Если установлено значение array, то результатом будет массив со ссылками блока, при этом внешнего оформления блока проводится не будет. Possible: text, array. Default: text. 
            'return' => 'text',
            // Параметр для использования нескольких блоков ссылок на одной страничке, задает индекс ссылки с которой начать выдачу. Индекс первого элемента массива: 0. Default: 0. 
            'limit_start' => 0,
            // Параметр для использования нескольких блоков ссылок на одной страничке, задает количество ссылок для выдаче после стартового элемента. Отсутствие ограничений: 0. Default: 0. 
            'limit_items' => 0,
            // Время хранения базы со ссылками в секундах. Default: 3600. 
            'update_time' => 3600,
            // Время отведенное на обновление базы со ссылками в секундах. То есть время, которое код будет игнорировать повторные запросы на обновление кода. Default: 300. 
            'update_lock_time' => 300,
            // Максимальное количество ссылок для вывода в блоке. Default: 20. 
            'max_links' => 5,
            // Время на соединение с серверами Ingots для обновления базы со ссылками. Если соединение пройдет успешно, то далее код будет скачивать базу ссылок, ограничения по времени на эту операцию отсутствуют в коде и определяются параметрами настройки PHP на Вашем хостинге, а конкретнее параметром максимального времени запущенного скрипта. Обычно это 30 секунд. Default: 6. 
            'socket_timeout' => 8,
            // Отображать ли коду тестовую ссылку? В режиме true выведет 1 тестовую ссылку. Использовать как помощник при установке кода. Possible: true, false. Default: false. 
            'test' => false,
            // Сколько тестовых ссылок отобразить. Default: 1. 
            'test_num' => 1,
        );
    }

    private function select_links() {

//        srand( abs( crc32( $_SERVER['REQUEST_URI'] ) ) );
//        $rnd_int = rand(1,10);
//        srand();
////        if( $rnd_int >= 1 && $rnd_int <= 4 ){ //== SAPE 40%
//            define('_SAPE_USER', '6a2abe87b0296a443fe436bc17f375ef');
//            $o['charset'] = 'UTF-8';
//            $sape   = new SAPE_client($o);
////            $sape_a = new SAPE_articles($o);
//            unset($o);
//            $this->link_html    = $sape->return_links(5);
////            $this->link_html   .= $sape_a->return_announcements(5);
////        }
//        if( $rnd_int >= 5 && $rnd_int <= 10 ){ //== TRUST 60%
        define('TRUSTLINK_USER', '67e06f377a81bf75093fa0a957f650da5fdc991b');
        $o['charset'] = 'utf-8'; //кодировка сайта
        $o['force_show_code'] = true;
        $trustlink = new TrustlinkClient($o);
        unset($o);
        $this->link_html .= '<br />' . $trustlink->build_links();
//        }
        //<IGNOTS>
        $o = $this->getIngotsSet();
        $client_lnk = new IngotsInit($o);
        // Вывод вечных ссылок  
        $this->link_html .= $client_lnk->ShowFLinks();
        // Вывод ссылок  
        $this->link_html .= $client_lnk->ShowLinks();
        //</IGNOTS>
        
        //<uniplace>
//        require_once($_SERVER['DOCUMENT_ROOT'].'/uniplacer_config.php');
//	require_once($_SERVER['DOCUMENT_ROOT'].'/'._UNIPLACE_USER_.'/uniplacer.php');
//	$Uniplacer = new Uniplacer(_UNIPLACE_USER_);
//	$Uniplacer->GetCode();
//	$links = $Uniplacer->GetLinks();
//	if($links){
//            foreach($links as $link){
//                $this->link_html .= '<br />'.$link;
//            }
//	}
        //</uniplace>

        if (stripos($this->link_html, 'href=') !== FALSE)
            $this->link_isset = TRUE;
    }

    private function main_page_links($main) {

        if ($main == 'sape') {
            if (!defined('_SAPE_USER'))
                define('_SAPE_USER', '6a2abe87b0296a443fe436bc17f375ef');
            $o['charset'] = 'UTF-8';
            $o['force_show_code'] = true;
            $sape = new SAPE_client($o);
//            $sape_a = new SAPE_articles($o);
            $this->link_html = $sape->return_links(5);
//            $this->link_html   .= $sape_a->return_announcements(5);
        }
        elseif ($main == 'trustlink') {
            define('TRUSTLINK_USER', '67e06f377a81bf75093fa0a957f650da5fdc991b');
            $o['charset'] = 'utf-8'; //кодировка сайта
            $o['force_show_code'] = true;
            $trustlink = new TrustlinkClient($o);
            $this->link_html = $trustlink->build_links();
        } 
        elseif ($main == 'ignots') {
            // Настройки кода для отображения ссылок  
            $o = $this->getIngotsSet();
            $client_lnk = new IngotsInit($o);
            // Вывод вечных ссылок  
            $this->link_html  = $client_lnk->ShowFLinks();
            // Вывод ссылок  
            $this->link_html .= $client_lnk->ShowLinks();
        }
        elseif ($main == 'uniplace') {
            require_once($_SERVER['DOCUMENT_ROOT'].'/uniplacer_config.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/'._UNIPLACE_USER_.'/uniplacer.php');
            $Uniplacer = new Uniplacer(_UNIPLACE_USER_);
            $Uniplacer->GetCode();
            $links = $Uniplacer->GetLinks();
            if($links){
                foreach($links as $link){
                    $this->link_html .= '<br />'.$link;
                }
            }
        }

        if (stripos($this->link_html, 'href=') !== FALSE)
            $this->link_isset = TRUE;
    }

    private function add_nofollow($link_html) {
        if (preg_match("#(google|yandex)#i", $_SERVER['HTTP_USER_AGENT']) &&
                preg_match("#(64.233|66.102|66.249|72.14|74.125|209.85|216.239|95.108|93.158|178.154|199.36|213.180)\.\d{1,3}\.\d{1,3}#i", $_SERVER['REMOTE_ADDR'])
        ) {
            $link_html = str_ireplace('<a ', '<a rel="nofollow" ', $link_html);
        }

        return $link_html;
    }

}
