<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Docs_m extends CI_Model{
    
    
    function __construct() {
        parent::__construct();
    }
    
    function getCheckDate()
    {
        switch ( date("m") )
        {
            case '1':
                $mounth = 'января';
                break;
            case '2':
                $mounth = 'февраля';
                break;
            case '3':
                $mounth = 'марта';
                break;
            case '4':
                $mounth = 'апреля';
                break;
            case '5':
                $mounth = 'мая';
                break;
            case '6':
                $mounth = 'июня';
                break;
            case '7':
                $mounth = 'июля';
                break;
            case '8':
                $mounth = 'августа';
                break;
            case '9':
                $mounth = 'сентября';
                break;
            case '10':
                $mounth = 'октября';
                break;
            case '11':
                $mounth = 'ноября';
                break;
            case '12':
                $mounth = 'декабря';
                break;       
        }
        return date("d").' '.$mounth.' '.date("Y").' г.';
    }

    function get_doc_number( $doc_name ){
        $doc_name   = $this->db->escape_str( $doc_name );
        $query = $this->db->query("SELECT `number` FROM `doc_number` WHERE `name`='{$doc_name}' ");
        
        if( $query->num_rows() > 0 ){
            $row = $query->row();
            return $row->number + 1;
        }
        else
            return 0;
    }
    
    function set_doc_number( $doc_name, $number ){
    
        $doc_name   = $this->db->escape_str( $doc_name );
        $number     = (int) $number;

        if( !$number ) return;

        $this->db->query("UPDATE `doc_number` SET `number`='{$number}' WHERE `name`='{$doc_name}' ");
    }
    
    
    function num2str($inn, $stripkop=false) {

    $nol = 'ноль';

    $str[100]= array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот', 'восемьсот','девятьсот');

    $str[11] = array('','десять','одиннадцать','двенадцать','тринадцать', 'четырнадцать','пятнадцать','шестнадцать','семнадцать', 'восемнадцать','девятнадцать','двадцать');

    $str[10] = array('','десять','двадцать','тридцать','сорок','пятьдесят', 'шестьдесят','семьдесят','восемьдесят','девяносто');

    $sex = array(

        array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),// m

        array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять') // f

    );

    $forms = array(

        array('копейка', 'копейки', 'копеек', 1), // 10^-2

        array('гривна', 'гривны', 'гривен',  0), // 10^ 0

        array('тысяча', 'тысячи', 'тысяч', 1), // 10^ 3

        array('миллион', 'миллиона', 'миллионов',  0), // 10^ 6

        array('миллиард', 'миллиарда', 'миллиардов',  0), // 10^ 9

        array('триллион', 'триллиона', 'триллионов',  0), // 10^12

    );

    $out = $tmp = array();

    // Поехали!

    $tmp = explode('.', str_replace(',','.', $inn));

    $rub = number_format($tmp[ 0], 0,'','-');

    if ($rub== 0) $out[] = $nol;

    // нормализация копеек

    $kop = isset($tmp[1]) ? substr(str_pad($tmp[1], 2, '0', STR_PAD_RIGHT), 0,2) : '00';

    $segments = explode('-', $rub);

    $offset = sizeof($segments);

    if ((int)$rub== 0) { // если 0 рублей

        $o[] = $nol;

        $o[] = $this->morph( 0, $forms[1][ 0],$forms[1][1],$forms[1][2]);

    }

    else {

        foreach ($segments as $k=>$lev) {

            $sexi= (int) $forms[$offset][3]; // определяем род

            $ri = (int) $lev; // текущий сегмент

            if ($ri== 0 && $offset>1) {// если сегмент==0 & не последний уровень(там Units)

                $offset--;

                continue;

            }

            // нормализация

            $ri = str_pad($ri, 3, '0', STR_PAD_LEFT);

            // получаем циферки для анализа

            $r1 = (int)substr($ri, 0,1); //первая цифра

            $r2 = (int)substr($ri,1,1); //вторая

            $r3 = (int)substr($ri,2,1); //третья

            $r22= (int)$r2.$r3; //вторая и третья

            // разгребаем порядки

            if ($ri>99) $o[] = $str[100][$r1]; // Сотни

            if ($r22>20) {// >20

                $o[] = $str[10][$r2];

                $o[] = $sex[ $sexi ][$r3];

            }

            else { // <=20

                if ($r22>9) $o[] = $str[11][$r22-9]; // 10-20

                elseif($r22> 0) $o[] = $sex[ $sexi ][$r3]; // 1-9

            }

            // Рубли

            $o[] = $this->morph($ri, $forms[$offset][ 0],$forms[$offset][1],$forms[$offset][2]);

            $offset--;

        }

    }

    // Копейки

    if (!$stripkop) {

        $o[] = $kop;

        $o[] = $this->morph($kop,$forms[ 0][ 0],$forms[ 0][1],$forms[ 0][2]);

    }

    return preg_replace("/\s{2,}/",' ',implode(' ',$o));

}
    /**
    * Склоняем словоформу
    */
    function morph($n, $f1, $f2, $f5) {

    $n = abs($n) % 100;

    $n1= $n % 10;

    if ($n>10 && $n<20) return $f5;

    if ($n1>1 && $n1<5) return $f2;

    if ($n1==1) return $f1;

    return $f5;

} 
}