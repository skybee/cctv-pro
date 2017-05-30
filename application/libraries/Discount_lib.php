<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discount_lib{
    private $city = false, 
            $cookie_name = 'user_city',
            $cookie_expire = 36000,
            $not_discount_city = array('not-UA','Kharkov','Kharkiv','Kiev','Kyiv'),
            $check_discount = 'undefined',
            $real_price = 0,
            $discount_exist = false;
    
    function __construct() {
        $ci =& get_instance();
        $ci->load->helper('cookie');
        $ci->load->helper('geoip/geoip_helper');
        
        $this->getCity();
    }
            
    function setCity($city){
        $this->city = $city;
    }
    
    private function getCity(){
        if(isset($_COOKIE[$this->cookie_name])){
            $city = $_COOKIE[$this->cookie_name];
            $this->setCity($city);
        }
        else {
            $city = getUaCity();
            $this->setCity($city);
            
            $cookieAr = array(
                'name'      => $this->cookie_name,
                'value'     => $city,
                'expire'    => $this->cookie_expire    
            );
            
            set_cookie($cookieAr);
        }
    }
    
    function checkDiscount(){
        
        if($this->check_discount !== 'undefined' ){
            return $this->check_discount;
        }
        else{
            if(array_search($this->city, $this->not_discount_city) !== false){
                $this->check_discount = false;
            }
            else{
                $this->check_discount = true;
            }
            
            return $this->check_discount;
        }
    }
    
    function addDiscount($price,$percent){
        
        $this->real_price = $price;
        
        if($this->checkDiscount() === false || $percent <= 0){
            return $price;
        }
        
        $this->discount_exist = true;
        
        $new_price = round($price * ( (100 - $percent) / 100)).'.00';
        
        return $new_price;
    }
    
//    function getRealPrice(){
//        if($this->discount_exist !== false && $this->real_price > 0){
//            return $this->real_price;
//        }
//        else{
//            return false;
//        }
//    }
}