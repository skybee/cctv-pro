<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<html>
    <body>
        <div style="margin-bottom: 20px; font-size: 12px; font-family: arial, verdana">
            <table style="border-collapse: collapse;">
                <tr>
                    <td style="padding: 2px 5px 2px 5px;">Заказ №:</td>
                    <td style="padding: 2px 5px 2px 5px;">#<?=$order_id?></td>
                </tr>
                <tr>
                    <td style="padding: 2px 5px 2px 5px;">Сумма заказа:</td>
                    <td style="padding: 2px 5px 2px 5px;"><?=$summ?> грн.</td>
                </tr>
                <tr>
                    <td  style="padding: 2px 5px 2px 5px; width: 120px;">ФИО:</td>
                    <td style="padding: 2px 5px 2px 5px;"><? if(isset($sname)) echo $sname ?> <? if(isset($name)) echo $name ?> <? if(isset($thname)) echo $thname ?></td>
                </tr>
                <tr>
                    <td style="padding: 2px 5px 2px 5px;">Телефон:</td>
                    <td style="padding: 2px 5px 2px 5px;"><? if(isset($phone)) echo $phone ?></td>
                </tr>
                <tr>
                    <td style="padding: 2px 5px 2px 5px;">E-mail:</td>
                    <td style="padding: 2px 5px 2px 5px;"><? if(isset($mail)) echo $mail ?></td>
                </tr>
                <tr>
                    <td style="padding: 2px 5px 2px 5px;">Комментарий:</td>
                    <td style="padding: 2px 5px 2px 5px;"><? if(isset($comment)) echo $comment ?></td>
                </tr>
                <tr>
                    <td style="padding: 2px 5px 2px 5px;">Доставка:</td>
                    <td style="padding: 2px 5px 2px 5px;">
                        <? 
                            if( $order == 1 ) echo "Самовывоз (Харьков)";
                            elseif( $order == 2 ) echo $sklad;
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <div style="font-size: 12px; font-family: arial, verdana;">
                <?
                foreach ($goods_list as $goods_ar):
                    $goods_ar['price'] = abs($goods_ar['price']);
                    $count_ar[$goods_ar['id']] = abs($count_ar[$goods_ar['id']]);
                    ?>
                    
                    <div style="border: solid 1px #E6ECF0; border-radius: 4px; margin: 0px 0px 10px 0px; height: 90px; width: 670px" >
                        <div style="float: left; height: 80px; width: 80px; margin: 5px 0px 0px 5px;">
                            <table>
                                <tr>
                                    <td style="vertical-align: middle; text-align: center; height: 80px; width: 80px;">
                                        <img src="http://<?=$_SERVER['HTTP_HOST']?>/upload/images/70x70/<?= $goods_ar['main_img'] ?>" alt="" style=" width: 80px;" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div style="float: left; margin-left: 20px;">
                            <div style=" width: 350px; height: 15px; top:5px; left: 75px; font-size: 14px;">
                                <a style="text-decoration: none; color:#56ADF0;" href="http://<?=$_SERVER['HTTP_HOST']?>/goods/<?= $goods_ar['id'] ?>/<?= $goods_ar['url_name'] ?>/" target="_blank"><?= $goods_ar['name'] ?></a>
                            </div>

                            <div style="overflow: hidden; width: 400px; height: 55px; font-size: 11px; line-height: 13px; margin-top: 10px;">
                                <?= $goods_ar['short_description'] ?>
                            </div>
                        </div>
                        
                        <div style="float:right; top:5px; right: 5px; height: 60px; width: 135px;">
                            <table style="border-collapse: collapse; font-size: 12px;">
                                <tr>
                                    <td style="padding: 0 0 0 10px; margin: 0; border-collapse: collapse; line-height: 14px; vertical-align: middle;">К-во:</td>
                                    <td style="padding: 0 0 0 5px; margin: 0; border-collapse: collapse; line-height: 18px; vertical-align: middle; color: #12354E;"><?= $count_ar[$goods_ar['id']] ?> шт.</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 0 10px; margin: 0; border-collapse: collapse; line-height: 14px; vertical-align: middle;">Цена:</td>
                                    <td style="padding: 0 0 0 5px; margin: 0; border-collapse: collapse; line-height: 18px; vertical-align: middle; color: #12354E;"><?= $goods_ar['price'] ?> грн.</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 0 10px; margin: 0; border-collapse: collapse; line-height: 14px; vertical-align: middle;">Всего:</td>
                                    <td style="padding: 0 0 0 5px; margin: 0; border-collapse: collapse; line-height: 18px; vertical-align: middle; color: #12354E;"><span><?= number_format($goods_ar['price'] * $count_ar[$goods_ar['id']], 2, '.', '') ?></span> грн.</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                <? endforeach; ?>
        </div>
    </body>
</html>