<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Goods extends CI_Controller{
    
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('goods_m','goods');
        $this->load->helper('goods');
        $this->load->helper('cookie');
    }
    
    function index(){ show_404(); }
    
    
    function get_favorite(){
        
        if( isset($_POST['id']) )
            $_POST['id'] = (int) $_POST['id'];
        else
            $_POST['id'] = 0;
        
        if( $_POST['id'] > 0 )
            set_favorite( $_POST['id'], 5 ); //издранное (установка в куки)
        
        
        if( isset($_COOKIE['favorit']) )
            $goods_ar = json_decode( $_COOKIE['favorit'], true );
        else return FALSE;
        if( count($goods_ar) < 1 ) return FALSE;
        
//        if( $_POST['id'] > 0 )
//            $goods_ar[] = $_POST['id'];
        
        $data_ar['goods_list']  = $this->goods->get_goods_by_id( $goods_ar );
        $json_ar['html']        = $this->load->view('cctv-tmp/ajax/favorite_goods_view',$data_ar,TRUE); 
        
        echo json_encode($json_ar);
//        print_r($goods_ar);
//        print_r($data_ar);
    }
    
    function set_top(){
        $id     = (int) $_POST['id'];
        $ip     = $_SERVER['REMOTE_ADDR'];
        $ref    = $_POST['ref'];
        $rank   = 1;
        
        if( preg_match("#(google|yandex|mail.ru|Nigma|Rambler|Ukr.net|Bing)#i", $ref) )
            $rank = 7;    
        
        $this->goods->set_goods_rank($id, $ip, $rank);

//        //проверка наличие записи с таким IP и ID в базе
//        $query = $this->db->query(" SELECT COUNT(*) AS 'cnt' FROM `goods_top` WHERE `goods_id` = '{$id}' AND `ip` = '{$ip}' "); 
//        $row = $query->row_array();
//        
//        
//        if( $row['cnt'] < 1 ){ //запись новой записи в базу
//            $this->db->query("INSERT INTO `goods_top` SET `goods_id` = '{$id}', `ip` = '{$ip}', `rank` = {$rank} ");
//            
//            if( rand(1, 1000) <= 50 ){ //удаление старых записей
//                $control_date   = date("Y-m-d H:i:s", strtotime("- 50 day", time() ) ); //дата удаления записи
//                
//                $this->db->query("DELETE FROM `goods_top` WHERE `date` < '{$control_date}' ");
//            }
//        }
    }
}