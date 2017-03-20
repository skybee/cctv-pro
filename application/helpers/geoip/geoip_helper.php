<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function get_country(){
    include("application/helpers/geoip/files/geoip.inc");
    
    $gi = geoip_open("application/helpers/geoip/files/GeoIP.dat",GEOIP_STANDARD);
    
    $ip = $_SERVER['HTTP_X_REAL_IP'];
    
    $country_code = geoip_country_code_by_addr($gi, $ip);
    geoip_close($gi);
    
    return $country_code;
}


function get_city(){
    include("application/helpers/geoip/files/geoipcity.inc");
    include("application/helpers/geoip/files/geoipregionvars.php");
    
    $gi = geoip_open("application/helpers/geoip/files/GeoIPCity.dat",GEOIP_STANDARD);
    
    $ip = $_SERVER['HTTP_X_REAL_IP'];
    
    $record = GeoIP_record_by_addr($gi, $ip);
    
    if(is_object($record) && isset($record->city) && mb_strlen($record->city) > 2 ){
        $city   = $record->city;
    }
    else {
        $city = 'not-UA';
    }
    
    geoip_close($gi);
    
    return $city;
}

function getUaCity(){
    if(isset($_COOKIE['user_city'])){
        return $_COOKIE['user_city'];
    }
    
    $country_code = get_country();
    
    if($country_code == 'UA'){
        $city = get_city();
        return $city;
    }
    else{
        return 'not-UA';
    }
}
