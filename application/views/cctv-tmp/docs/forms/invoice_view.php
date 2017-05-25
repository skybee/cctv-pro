<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="col-main col-xs-12 col-sm-9">
    <div class="padding-s">
        
        <div class="std docs_form">
            <h1>Создание и печать счета</h1>

            <form action="/print_docs/prnt_doc/invoice/" target="_blank" method="post" id="printcheck_form" enctype="multipart/form-data" >
                
                <div class="select_flp">
                    <span>Выбор ФЛП:</span>
                    
                    <label>
                        <input type="radio" name="flp" value="tor" />
                        Торяник П.Е.
                    </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="flp" value="pan" checked="checked" />
                        Панасенко И.С.
                    </label>
                </div>
                
                <div id="invoice_input_block">

                    Номер счета:
                    <br />
                    <input type="text" name="doc_number" value="<?=$doc_data['doc_nbr']?>" />
                    <br />
                    Получатель:
                    <br />
                    <input type="text" name="recipient" />
                    
                    <!--
                    <br /><br />
                    Выставил: &nbsp;&nbsp;
                    <label><input type="radio" name="employee_fio" value="СПД &nbsp;ФЛ  &nbsp; Торяник П.Е." checked="checked" /> Торяник П.Е.</label>
                    &nbsp;&nbsp;
                    <label><input type="radio" name="employee_fio" value="Панасенко И.С." /> Панасенко И.С.</label>
                    -->
                    <br /><br />

                </div>
                
                <div class="load_form">
                    Загрузка списка товаров:
                    <input type="file" value="" accept=".json" id="load_check_filelist" name="goods_file_list" />
                    <input type="button" value="OK" id="load_filelist_btn" />
                </div>
                
                <table id="check_tbl">
                    <tr>
                        <td>№</td>
                        <td>Наименование</td>
                        <td>Ед. изм.</td>
                        <td>Кол-во</td>
                        <td>Цена за ед.</td>
                    </tr>
                    <?php if(!$goods_list): ?>
                    <span style="display: none;" id="check_number" val="1"></span>
                    <tr>
                        <td>1.</td>
                        <td><input type="text" name="name[]" ></td>
                        <td><input type="text" name="units[]" value="шт." ></td>
                        <td><input type="text" name="count[]" value="1" ></td>
                        <td><input type="text" name="price[]" ></td>
                    </tr>
                    <?php
                        else:
                            $i = 1;
                            foreach($goods_list as $goods):
                    ?>
                    <tr>
                        <td><?=$i?>.</td>
                        <td><input type="text" name="name[]"    value="<?=$goods['name']?>" ></td>
                        <td><input type="text" name="units[]"   value="<?=$goods['units']?>" ></td>
                        <td><input type="text" name="count[]"   value="<?=$goods['count']?>" ></td>
                        <td><input type="text" name="price[]"   value="<?=$goods['price']?>" ></td>
                    </tr>
                    <?php 
                            $i++;
                            endforeach;
                    ?>
                    <span style="display: none;" id="check_number" val="<?=$i-1?>"></span>
                    <?php
                        endif; 
                    ?>
                </table>
                <div id="check_btn_block">
                    <input type="button" id="add_line" value=" Добавить строку " />
                    <input type="submit" value=" Сформировать счет " />
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    Дата: <input type="text" name="date" value="<?=$doc_data['date']?>" width="120px" />
                    
                    <br />
                    <input type="button" id="save_list" value="Сохранить список товаров" />
                </div>
            </form>

        </div>
    </div>
</div>