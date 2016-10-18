<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Cron extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('cron_m');
        $this->load->model('goods_m');
        $this->load->helper('download_helper');
    }
    
    function  check_competitors(){
        $this->load->library('cron/competitors_lib');
        
        $competitors_ar = $this->cron_m->get_competitors_links( 3, 48 );
        
        if( $competitors_ar != NULL )
            $this->competitors_lib->update( $competitors_ar );
        else
            echo "Нет позиций для обновления <br />\n";
    }
    
    function upd_goods_rank(){
        if( !$this->goods_m->upd_goods_rank() )
            echo 'Нет записей для обновления';
        else
            echo 'Записи обновлены';
    }
    
    function hc_price_synk()
    {
        $url = 'http://house-control.org.ua/price/cctv/';
        $jsonDataStr    = down_with_curl($url);
        $hcData         = json_decode($jsonDataStr, true);
        
        $goodsDataAr    = $this->goods_m->get_hcsync_goods_data();
        
        if(!$goodsDataAr or count($hcData)<10)
        {
            echo 'Error: No goods ID or Empty json data';
            exit();
        }
        
        
        foreach ($goodsDataAr as $gData)
        {
            if(!isset($hcData[$gData['hc_goods_id']]) or $hcData[$gData['hc_goods_id']]['price']<1)
            {
                continue;
            }
            
            $gData['hc_price'] = $hcData[$gData['hc_goods_id']]['price'];
            
            $newPrice = $gData['hc_price'] * $gData['hc_factor'];
            if($newPrice > 50)
            {
                $newPrice = round($newPrice);
            }
            
            if($this->goods_m->upd_price($gData['id'],$newPrice))
            {
                echo "ID: {$gData['id']} - Price: {$newPrice} - OK \n<br /><br />\n";
            }
            else
            {
                echo "ID: {$gData['id']} - Error \n<br /><br />\n";
            }
        }
    }
}