<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<html>
    <head>
        <title>Товарный_Кассовый_чек</title>
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
            #podpis{ text-align: right; margin-top: 50px;}
            
            
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
        <center><h1><?=$_POST['checkname']?></h1></center>
        
        <p id="date"> <?=$_POST['date']?> </p>
        
        <?php #if($_POST['flp'] == 'tor'):?>
            <!--
            <p>
                СПД ФЛ Торяник Петр Евгениевич,<br /> 
                ИНН 2322422151 <br />
                Свидетельство: Серия В00 №:967399 <br />
                Адрес: г. Харьков, пр-т. Ленина 40/3, офис 345<br />
                Тел.: (057) 759-56-81, (098) 427-01-25<br />
                Факс: (057) 720-45-54<br />
                E-mail: mail@cctv-pro.com.ua
            </p>
        <?php #else: ?>
            <p>
                СПД ФЛ Панасенко Игорь Сергеевич,<br /> 
                ИНН 2301623614 <br />
                Адрес: г. Харьков, пр-т. Ленина 40/3, офис 345<br />
                Тел.: (057) 759-56-81, (098) 427-01-25<br />
                Факс: (057) 720-45-54<br />
                E-mail: mail@cctv-pro.com.ua
            </p>
            -->
        <?php #endif; ?>
            
            <p>
                Адрес: г. Харьков, ул. Шатилова Дача 4<br />
                Тел.: (068) 566-93-03 <br />
                &nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                (095) 883-63-14 <br />
                &nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                (063) 368-08-40<br />
                E-mail: mail@cctv-pro.com.ua <br />
                WEB Сайт: http://cctv-pro.com.ua
            </p>
        
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
            Товар отпустил_______________________
        </p>
        
        
        
        <!-- ГАРАНТИЙНЫЙ ТАЛОН -->
        
        <?php if( isset($_POST['print_wrnt']) && $_POST['print_wrnt'] == true ): ?>
        <div id="rwnt">
            <center><h1>ГАРАНТИЙНЫЙ ТАЛОН</h1></center>

            <p id="date"> <?=$_POST['date']?> </p>

            <?php #if($_POST['flp'] == 'tor'):?>
                <!--
                <p>
                    СПД ФЛ Торяник Петр Евгениевич,<br /> 
                    ИНН 2322422151 <br />
                    Свидетельство: Серия В00 №:967399 <br />
                    Адрес: г. Харьков, пр-т. Ленина 40/3, офис 345<br />
                    Тел.: (057) 759-56-81, (098) 427-01-25<br />
                    Факс: (057) 720-45-54<br />
                    E-mail: mail@cctv-pro.com.ua
                </p>
            <?php #else: ?>
                <p>
                    СПД ФЛ Панасенко Игорь Сергеевич,<br /> 
                    ИНН 2301623614 <br />
                    Адрес: г. Харьков, пр-т. Ленина 40/3, офис 345<br />
                    Тел.: (057) 759-56-81, (098) 427-01-25<br />
                    Факс: (057) 720-45-54<br />
                    E-mail: mail@cctv-pro.com.ua
                </p>
                -->
            <?php #endif; ?>
                
                <p>
                    Адрес: г. Харьков, ул. Шатилова Дача 4<br />
                    Тел.: (068) 566-93-03, (095) 883-63-14, (063) 368-08-40<br />
                    E-mail: mail@cctv-pro.com.ua
                </p>

            <table id="goods_tbl">
                <tr>
                    <td>№</td>
                    <td>Нименование</td>
                    <td>Ед. изм.</td>
                    <td>Кол-во</td>
                    <td>Серийный номер</td>
                    <td>Срок гарантии</td>
                </tr>

                <?php
                    $cnt_position = count( $_POST['name'] );
                    $summ_all = 0;
                    for($i=0; $i<$cnt_position; $i++):
                ?>

                <tr>
                    <td><?=$i+1?></td>
                    <td><?=$_POST['name'][$i]?></td>
                    <td><?=$_POST['units'][$i]?></td>
                    <td><?=$_POST['count'][$i]?></td>
                    <td><?=$_POST['wrnt_number'][$i]?></td>
                    <td><?=$_POST['wrnt'][$i]?></td>
                </tr>

                <?php endfor; ?>
            </table>
            
            <div id="rwnt_txt_block">
                <ul>
                    <li>
                        Покупатель имеет право на бесплатное устранение производственных дефектов, выявленных на протяжении гарантийного срока эксплуатации.
                    </li>
                    <li>
                        Приемка на гарантийное обслуживание осуществляется при наличии правильно заполненного гарантийного талона.
                    </li>
                    <li>
                        Продавец не несет гарантийных обязательств в случае:
                        <br />
                        - если имеются следы повреждения либо снятия заводской пломбы или серийного номера изделия;
                        <br />
                        - если оборудование, предназначенное для личных(бытовых, семейных) нужд, использовалось в производственных целях;
                        <br />
                        - если были нарушены правила установки, эксплуатации изделия, изложенные в инструкции по эксплуатации;
                        <br />
                        - если изделие имеет следы попыток не квалифицированного ремонта;
                        <br />
                        - если дефект вызван изменением конструкции, схемы изделия или базового программного обеспечения, сделанными не сотрудниками уполномоченного сервисного центра;
                        <br />
                        - если дефект вызван действием непреодолимых сил, несчастными случаями, умышленными или неосторожными действиями потребителя или третьих лиц;
                        <br />
                        - если обнаружены повреждения, вызванные попаданием вовнутрь изделия пыли, посторонних предметов, веществ, жидкостей, насекомых, животных;
                    </li>
                    <li>
                        Гарантийные обязательства не распространяются на следующие недостатки изделия:
                        <br />
                        - механические повреждения, возникшие после передачи оборудования потребителю;
                        <br />
                        - повреждения или ненормальное функционирование изделий вызванные не соответствиям стандартам параметров питающих, телекоммуникационных, кабельных сетей и других подобных факторов;
                        <br />
                        - повреждения, вызванные использованием нестандартных или некачественных расходных материалов, принадлежностей, элементов питания, носителей информации.
                    </li>
                    <li>
                        Продавец снимает с себя ответственность за возможный вред, прямо или косвенно нанесенный продукцией, реализованной Продавцом, людям, животным или имуществу вследствие хранения, использования или транспортировки изделий.
                    </li>
                </ul>
                <p>
                    С техническими характеристиками, комплектностью, целостностью (отсутствие механических, химических, электрических, тепловых) повреждений приобретенного изделия (ий), а также условиями гарантийного обслуживания покупатель ознакомлен, согласен и претензий не имеет.
                </p>
            </div>

            <p id="podpis">
                Подпись продавца_______________________
                <span class="client_podpis">
                    Подпись покупателя_______________________
                </span>
            </p>
        
        </div>
        <?php endif; ?>
        
        <!-- ГАРАНТИЙНЫЙ ТАЛОН -->
        
    </body>
</html>