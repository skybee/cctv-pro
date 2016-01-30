<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

echo"
Имя: $name
Тел: $phone
Товары:
";
foreach( $goods_list as $goods_ar ){
    $goods_ar['price'] = abs($goods_ar['price']);
    $count_ar[$goods_ar['id']] = abs($count_ar[$goods_ar['id']]);
    
    echo str_replace('&nbsp;', ' ', $goods_ar['name']).' ('.$goods_ar['price'].' грн/'.$count_ar[$goods_ar['id']]." шт) \n";
}
echo"Сумма: $summ грн";