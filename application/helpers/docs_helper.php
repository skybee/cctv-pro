<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getLoadFileJsonData($tmpFname){
    
    $data = file_get_contents($tmpFname);
    
    $json = json_decode($data,true);
    
    if(count($json)>=1){
        return $json;
    }
    else {
        return false;
    }
}