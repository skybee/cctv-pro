<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<html>
    <head>
        <title>Гарантийный_талон</title>
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
            #goods_tbl tr td:nth-child(1), /*#goods_tbl tr td:nth-child(3),*/ #goods_tbl tr td:nth-child(4){
                text-align: center;
            }
            
            #goods_tbl tr td:nth-child(1){width: 0.7cm;}
            #goods_tbl tr td:nth-child(3){width: 5cm;} 
            #goods_tbl tr td:nth-child(4){width: 1.5cm;}
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
            #podpis{ text-align: right; margin-top: 80px;}
            
            
            /* гарантийный талон */
            #rwnt{ page-break-before:always; }
            #rwnt #goods_tbl tr:last-child td{
                border: #000 solid 1px !important;
                padding: 0px 5px;
            }
            #rwnt #goods_tbl tr:last-child td:nth-child(5), #goods_tbl tr:last-child td:nth-child(6){
                font-weight: normal;
                text-align: right;
            }
            #rwnt #goods_tbl tr:last-child td:nth-child(5), #rwnt #goods_tbl tr td:nth-child(5){ width: 120px; text-align: center; }
            #rwnt #goods_tbl tr:last-child td:nth-child(6){ width: 100px; }
            #rwnt_txt_block{
                
            }
            #rwnt_txt_block ul{ 
                list-style: decimal;
                list-style-position: inside;
                font-size: 10px;
                padding: 0px;
            }
            #rwnt_txt_block ul li{
                font-size: 10px;
                line-height: 9px;
                padding-bottom: 3px;
            }
            #rwnt_txt_block p{
                font-size: 11px;
                line-height: 10px;
            }
            #rwnt .client_podpis{
                float: left;
            }
            /* /гарантийный талон */
            
        </style>    
    </head>
    <body>
        <center><h1>Талон о принятии на <?=$_POST['checkname']?></h1></center>
        
        <p id="date"> <?=$_POST['date']?> </p>
        
        <?php if($_POST['flp'] == 'tor'):?>
            <p>
                СПД ФЛ Торяник Петр Евгениевич,<br /> 
                ИНН 2322422151 <br />
                Свидетельство: Серия В00 №:967399 <br />
                Адрес: г. Харьков, пр-т. Ленина 40/3, офис 345<br />
                Тел.: (057) 759-56-81, (098) 427-01-25<br />
                Факс: (057) 720-45-54<br />
                E-mail: mail@cctv-pro.com.ua
            </p>
        <?php else: ?>
            <p>
                СПД ФЛ Панасенко Игорь Сергеевич,<br /> 
                ИНН 2301623614 <br />
                Адрес: г. Харьков, пр-т. Ленина 40/3, офис 345<br />
                Тел.: (057) 759-56-81, (098) 427-01-25<br />
                Факс: (057) 720-45-54<br />
                E-mail: mail@cctv-pro.com.ua
            </p>
        <?php endif; ?>
        
        <p style="margin-top: 50px;">
            На ремонт были приняты следующие изделия:
        </p>
        
        <table id="goods_tbl">
            <tr>
                <td>№</td>
                <td>Наименование</td>
                <td>Сер.№</td>
                <td>Кол-во</td>
            </tr>
            
            <?php
                $cnt_position = count( $_POST['name'] );
                $summ_all = 0;
                for($i=0; $i<$cnt_position; $i++):
                    
                    if( empty($_POST['name'][$i]) || empty($_POST['count'][$i]) )
                        continue;
            ?>
            
            <tr>
                <td><?=$i+1?></td>
                <td><?=stripcslashes($_POST['name'][$i])?></td>
                <td><?=$_POST['wrnt_number'][$i]?></td>
                <td><?=$_POST['count'][$i]?></td>
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
            </tr>
        </table>
        
        
        <p id="podpis">
            Принял__________________________________
        </p>
        
        
    </body>
</html>