<?php


class Youtube_like_parse extends CI_Controller
{
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        set_time_limit(120);
    }
    
    
    function parse_like_video($cnt=1)
    {
        $cnt = (int) $cnt; 
        if($cnt<1) $cnt = 1;
        
        $articlesData   = $this->getGoods($cnt);
        
        if(!$articlesData)
        {
            echo 'No Articles';
            return;
        }
        
        foreach ($articlesData as $artData)
        {
            $likeVideoAr    = $this->getLikeVideo($artData['name']);
            
            $this->delOldVideo_setUpdGoods($artData['id']);
            
            if(count($likeVideoAr)<1){ continue; }
            
            foreach ($likeVideoAr as $ytVideoData)
            {
                $this->insertVideoData($artData['id'], $ytVideoData);
            }
            sleep(1);
        }
        
        
        
        
        echo '<pre>'.print_r($articlesData,1).'</pre>';
    }
    
    private function getGoods($cntGoods = 10)
    {
        $cntGoods = (int) $cntGoods;
        
        $updDate = date("Y-m-d",  strtotime("- 30 day"));
        
        $sql = "SELECT `id`, `name` "
                . "FROM `goods` "
                . "WHERE `youtube_upd` < '{$updDate}' "
                . "ORDER BY `youtube_upd` ASC "
                . "LIMIT {$cntGoods}";
                
        $query = $this->db->query($sql);
        
        if($query->num_rows() < 1)
        {
            return false;
        }
        
        $result_ar = array();
        
        foreach ($query->result_array() as $row)
        {
            $result_ar[] = $row;
        }
        
        return $result_ar;        
    }
    
    private function getLikeVideo($search)
    {
        //$search = "танк аэропорт донецк"; // Search Query
        $api    = "AIzaSyAa1pI7eAJpbs7sxL6L2A8DhgyCDNudYWM"; // YouTube Developer API Key
        $link   = "https://www.googleapis.com/youtube/v3/search?q=".urlencode($search). "&part=snippet&type=video&maxResults=4&key=". $api;
        $video  = file_get_contents($link);
        $video  = json_decode($video, true);

        $result_ar = array();
        
        $i=0;
        foreach ($video['items'] as $data){
            
            if(isset($data['id']['videoId']) && !empty($data['id']['videoId']))
            {
                $result_ar[$i]['title']         = $data['snippet']['title'];
                $result_ar[$i]['description']   = $data['snippet']['description'];
                $result_ar[$i]['video_id']      = $data['id']['videoId'];
                $i++;
            }
        }
        
        return $result_ar;
    }
    
    private function insertVideoData($articleId,$videoData)
    {
        $sql = "INSERT INTO `youtube_like` "
                . "SET "
                . "`goods_id`       = '{$articleId}', "
                . "`video_id`       = '".$this->db->escape_str($videoData['video_id'])."', "
                . "`title`          = '".$this->db->escape_str($videoData['title'])."', "
                . "`description`    = '".$this->db->escape_str($videoData['description'])."' ";
                
        if($this->db->query($sql))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    private function delOldVideo_setUpdGoods($goodsId)
    {
        $sqlDelOldVideo = "DELETE FROM `youtube_like` WHERE `goods_id`='{$goodsId}' "; 
        $this->db->query($sqlDelOldVideo);
        
        $sqlUpdGoods    = "UPDATE `goods` SET `youtube_upd`=NOW() WHERE `id`='{$goodsId}' LIMIT 1";
        $this->db->query($sqlUpdGoods);
    }
    
}