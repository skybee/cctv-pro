<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>



<html>
    <head>
        <title>Накладная_<?=$_POST['doc_number']?>_от_<?= str_ireplace(' ', '_', $_POST['date'])?></title>
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
            #podpis table{ font-size: 12px; width: 100%}
            
            
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
                margin: 5px 0px 20px 0px;
            }
/*            #invoice_period{
                margin: 20px 0px 10px 0px;
            }*/
            
        </style>    
    </head>
    <body>
        
        <table id="head_tbl">
            <tr>
                
                <td>Поставщик:</td>
                
                <!--
                <?php #if($_POST['flp'] == 'tor'):?>
                <td>
                    СПД ФЛ Торяник Петр Евгениевич,<br /> 
                    ИНН 2322422151 <br />
                    Сч. №26004052296791 в отд. №1 ХГРУ "Приват-Банк" МФО 351533<br />
                    Адрес: г. Харьков, пр-т. Ленина 40/3, офис 345<br />
                    Тел.: (057) 759-56-81, (098) 427-01-25<br />
                    Факс: (057) 720-45-54<br />
                    E-mail: mail@cctv-pro.com.ua
                </td>
                <?php #else: ?>
                <td>
                    СПД ФЛ Панасенко Игорь Сергеевич,<br /> 
                    ИНН 2301623614 <br />
                    Сч. №26000052206826 в отд. №1 ХГРУ "Приват-Банк" МФО 351533<br />
                    Адрес: г. Харьков, пр-т. Ленина 40/3, офис 345<br />
                    Тел.: (057) 759-56-81, (098) 427-01-25<br />
                    Факс: (057) 720-45-54<br />
                    E-mail: mail@cctv-pro.com.ua
                </td>
                <?php #endif; ?>
                -->
                <td>
                    <!-- top contact information -->
                    <?=$head_info;?>
                </td>
            </tr>
            <tr>
                <td>Получатель:</td>
                <td style="border-bottom: 1px solid #000"><?= stripslashes( $_POST['recipient'] )?></td>
            </tr>
            <tr>
                <td>Плательщик:</td>
                <td style="border-bottom: 1px solid #000"><?= stripslashes( $_POST['payer'] )?></td>
            </tr>
            <tr>
                <td>Основание:</td>
                <td style="border-bottom: 1px solid #000"><?= stripslashes( $_POST['basis'] )?></td>
            </tr>
        </table>
        
        <center>
            <p id="invoice_number">НАКЛАДНАЯ № <?=$_POST['doc_number']?> </p>
            <p id="invoice_date"> от <?=$_POST['date']?> </p>
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
                <td><?=stripcslashes($_POST['name'][$i])?></td>
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
        
        <p id="podpis">
            <table>
                <tr>
                    <td>
                        Отпустил: ______________ 
                        
                        <!--
                        <?php #=$_POST['employee_fio']?>
                        <?php #if($_POST['flp'] == 'tor'):?>
                        СПД &nbsp;ФЛ  &nbsp; Торяник П.Е.
                        <?php #else:?>
                        СПД &nbsp;ФЛ  &nbsp; Панасенко И.С.
                        <?php #endif;?>
                        -->
                        ФЛП  &nbsp; Лысак Е.А.
                    </td>
                    <td style="text-align: right;">Получил: _________________________________</td>
                </tr>
            </table>
        </p>
    </body>
</html>