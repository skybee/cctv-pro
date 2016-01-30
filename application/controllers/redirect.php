<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class redirect extends CI_Controller{
    
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    
    function index(){
        
    }
    
    function goods( $hash ){
        $query = $this->db->query("SELECT `id`, `url_name` FROM `goods` WHERE `tmp_hash`='$hash' ");
        if( $query->num_rows() < 1 ){
            show_404();
            return FALSE;
        }
        
        $row = $query->row_array();
        $url = '/goods/'.$row['id'].'/'.$row['url_name'].'/';
        
        header ('HTTP/1.1 301 Moved Permanently');
        header ('Location: '.$url);       
    }
    
    function category( $cat_name ){
        $url = '/category/'.$cat_name.'/';
        
        header ('HTTP/1.1 301 Moved Permanently');
        header ('Location: '.$url);
    }
    
    function services( $page_name ){
        
        $uri_ar = array(
            'kamer_videonabljudenija'   => '#ustanovka_videjnabludenie',
            'domofona_videodomofona'    => '#ustanovka_domofonov',
            'ohrannoj_signalizacii'     => '#ustanovka_signalizacii',
            'kondicionerov'             => '#ustanovka_kondicionerov'
        );
        
        redirect('/info/services/'.$uri_ar[$page_name], 'location', 301);
    }
    
    function other( $page ){
        $url_ar = array(
            'dostavka' => '/info/shipping_payment/',
            'contacty' => '/info/contacts/'
        );
        
        header ('HTTP/1.1 301 Moved Permanently');
        header ('Location: '.$url_ar[$page]);
    }
    
    function  print_doc( $doc_name ){
        header ('HTTP/1.1 301 Moved Permanently');
        header ('Location: /doc_form/'.$doc_name.'/');
    }
}