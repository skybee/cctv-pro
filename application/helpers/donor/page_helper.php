<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');





function get_short_txt( $text, $length = 100 ){
        $text = strip_tags($text);
        return close_tags( mb_substr($text, 0, $length) ).'...';
    }
    
    
function close_tags($content)
    {
        $position = 0;
        $open_tags = array();
        //теги для игнорирования
        $ignored_tags = array('br', 'hr', 'img');

        while (($position = strpos($content, '<', $position)) !== FALSE)
        {
            //забираем все теги из контента
            if (preg_match("|^<(/?)([a-z\d]+)\b[^>]*>|i", substr($content, $position), $match))
            {
                $tag = strtolower($match[2]);
                //игнорируем все одиночные теги
                if (in_array($tag, $ignored_tags) == FALSE)
                {
                    //тег открыт
                    if (isset($match[1]) AND $match[1] == '')
                    {
                        if (isset($open_tags[$tag]))
                            $open_tags[$tag]++;
                        else
                            $open_tags[$tag] = 1;
                    }
                    //тег закрыт
                    if (isset($match[1]) AND $match[1] == '/')
                    {
                        if (isset($open_tags[$tag]))
                            $open_tags[$tag]--;
                    }
                }
                $position += strlen($match[0]);
            }
            else
                $position++;
        }
        //закрываем все теги
        foreach ($open_tags as $tag => $count_not_closed)
        {
            if( $count_not_closed < 0 ) $count_not_closed = 0;
            $content .= str_repeat("</{$tag}>", $count_not_closed);
        }

        return $content;
    }  
    
function get_rnd_block( $close_open, $int ){
        srand( abs(crc32($_SERVER['HTTP_HOST']))*$int );
        $cnt_block  = rand(2,8);
        srand();
        
        $class_name     = str_ireplace('.', '_', $_SERVER['HTTP_HOST']);
        $html_str       = '';
        $html_tab       = '';
        
        if( $close_open == 'open' ){
            for($i=0; $i<$cnt_block; $i++){
                $html_tab   .= "\t";
                $html_str   .= $html_tab.'<div class="'.$class_name.'_'.$int.'_'.$i.'">'."\n";
            }
        }
        elseif( $close_open == 'close' ){
            for($i=0; $i<$cnt_block; $i++){
                $html_tab   .= "\t";
                $html_str   .= $html_tab.'</div>'."\n";
            }
        }
        
        return $html_str;
    }