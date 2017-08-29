<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<html>
    <head>
        <title>Ком_Предложение_<?=$_POST['doc_number']?>_от_<?= str_ireplace(' ', '_', $_POST['date'])?><</title>
        <style type="text/css"  >
            @page{
                margin: 2cm;
                width: 19cm;
            }
            body{
                font-size: 12px !important;
                color: #000;
                width: 18cm;
                font-family: Arial,Helvetica,Garuda,sans-serif;
            }
            h1{font-size: 14px; margin: 0;}
            #date{ text-align: right;}
            #goods_tbl{
                width: 100%;
/*                border: 1px #000 solid;*/
                border-collapse: collapse;
                font-size: 12px;
            }
            #goods_tbl td{
                border: 1px #000 solid;
                padding: 0px 5px;
            }
            
            #goods_tbl tr td:nth-child(5), #goods_tbl tr td:nth-child(6){
                text-align: right;
            }
            #goods_tbl tr td:nth-child(1), #goods_tbl tr td:nth-child(3), #goods_tbl tr td:nth-child(4){
                text-align: center;
            }
            
            #goods_tbl tr td:nth-child(1){width: 0.7cm;}
            #goods_tbl tr td:nth-child(3), #goods_tbl tr td:nth-child(4){width: 1.5cm;}
            #goods_tbl tr td:nth-child(5), #goods_tbl tr td:nth-child(6){width: 1.8cm;}
            
            #goods_tbl tr:nth-child(1) td{
                padding: 5px;
                font-weight: bold;
                background: #eee;
                text-align: left;
            }
            
            #goods_tbl tr:last-child td{
                border: 0;
                padding: 5px;
            }
            #goods_tbl tr:last-child td:nth-child(5){
                text-align: left;
            }
            #goods_tbl tr:last-child td:nth-child(5), #goods_tbl tr:last-child td:nth-child(6){
                font-weight: bold;
                border: 1px #000 solid;
            }
            #summ_txt{ border-bottom: 1px #000 solid;}
            #podpis{ text-align: left; margin-top: 70px;}
            
            
            #head_tbl{
                font-size: 12px;
                border-collapse: collapse;
                width: 100%;
            }
            #head_tbl td{
                vertical-align: top;
                padding-top: 10px;
            }
            #head_tbl tr td:nth-child(1){
                width: 100px;
                font-weight: bold;
            }
            #invoice_number{
                margin: 0;
                margin-top: 30px;
                font-weight: bold;
            }
            #invoice_date{
                margin: 5px 0px 0px 0px;
            }
            #invoice_period{
                margin: 20px 0px 10px 0px;
            }
            
        </style>    
    </head>
    <body>
        
        <!-- top contact information -->
            <?=$head_info;?>
        
<!--        <p>
        <table style="font-size: 12px;">
            <tr>
                <td>от</td>
                <td><b>"HOUSE CONTROL"</b></td>
            </tr>
            <tr><td colspan="2" style="height: 10px;"></td></tr>
            <tr>
                <td>Адрес:</td>
                <td>г. Харьков, пр-т. Ленина 40/3, офис 345</td>
            </tr>
            <tr>
                <td>Тел.:</td>
                <td>(057) 759-56-81, &nbsp;&nbsp; (098) 427-01-25</td>
            </tr>
            <tr>
                <td>Факс:</td>
                <td>(057) 720-45-54</td>
            </tr>
            <tr>
                <td>E-mail:</td>
                <td>mail@cctv-pro.com.ua</td>
            </tr>
            <tr>
                <td style="width: 70px;">WEB Сайт:</td>
                <td>http://house-control.org.ua</td>
            </tr>
        </table>
        </p>-->
        
        <center>
            <p id="invoice_number">КОММЕРЧЕСКОЕ ПРЕДЛОЖЕНИЕ № <?=$_POST['doc_number']?></p>
            <p id="invoice_date" style="margin: 15px 0;"> Цены актуальны на &nbsp;&nbsp; <?=$_POST['date']?> </p>
        </center>
        

        
        <table id="goods_tbl">
            <tr>
                <td>№</td>
                <td>Наименование</td>
                <td>Ед. изм.</td>
                <td>Кол-во</td>
                <td>Цена</td>
                <td>Сумма</td>
            </tr>
            
            <?php
                $cnt_position = count( $_POST['name'] );
                $summ_all = 0;
                for($i=0; $i<$cnt_position; $i++):
                    
                    if( empty($_POST['price'][$i]) || empty($_POST['name'][$i]) || empty($_POST['count'][$i]) )
                        continue;
                    
                    $cnt_unit   = trim( $_POST['count'][$i] );
                    $price      = trim( str_replace(',', '.', str_replace(' ', '', $_POST['price'][$i] ) ) );
                    $summ       = $price*$cnt_unit;
                    $summ_all   = $summ_all + $summ;
                    
                    $summ_str   = number_format($summ, 2, '.',' ');
                    $price_str  = number_format($price, 2, '.',' ');
                    
                    
            ?>
            
            <tr>
                <td><?=$i+1?></td>
                <td><?= stripcslashes($_POST['name'][$i])?></td>
                <td><?=$_POST['units'][$i]?></td>
                <td><?=$cnt_unit?></td>
                <td><?=$price_str?></td>
                <td><?=$summ_str?></td>
            </tr>
            
            <?php 
                endfor;
                
                $summ_all_str = number_format($summ_all, 2, '.',' ');
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>ИТОГО:</td>
                <td><?=$summ_all_str?></td>
            </tr>
        </table>
        
        <p id="summ_txt">
            Всего на сумму <?=$summ_all_str?> грн. 
            ( <?=$this->docs->num2str($summ_all);?> )
            <br />
            НДС не предусмотрен
        </p>
    </body>
</html>