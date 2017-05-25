<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="col-main col-xs-12 col-sm-9">
    <div class="padding-s">
        
        <div class="std docs_form">
            <h1>Создание и печать акта выполненных работ</h1>

            <form action="/print_docs/prnt_doc/act/" target="_blank" method="post" id="printcheck_form" >
                
                <!--
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
                -->
                
                
                <div id="invoice_input_block">

                    Номер акта:
                    <br />
                    <input type="text" name="doc_number" value="<?=$doc_data['doc_nbr']?>" />
                    <br />
                    Номер и дата счета:
                    <br />
                    <input type="text" name="invoice_number" />&nbsp;&nbsp;
                    <input type="text" name="invoice_date" value="<?=$doc_data['date']?>" style="width:120px;" />
                    <br />
                    Заказчик <i style="color:#333">ФИО (должность)</i>:
                    <br />
                    <input type="text" name="client" />

                </div>
                <table id="check_tbl">
                    <tr>
                        <td>№</td>
                        <td>Наименование работы (услуги)</td>
                        <td>Ед. изм.</td>
                        <td>Кол-во</td>
                        <td>Цена за ед.</td>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td><input type="text" name="name[]" ></td>
                        <td><input type="text" name="units[]" value=" - " ></td>
                        <td><input type="text" name="count[]" value="1" ></td>
                        <td><input type="text" name="price[]" ></td>
                    </tr>
                </table>
                <div id="check_btn_block">
                    <input type="button" id="add_line" value=" Добавить строку " />
                    <input type="submit" value=" Сформировать акт " />
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    Дата: <input type="text" name="date" value="<?=$doc_data['date']?>" style="width:120px;" />
                </div>
            </form>

        </div>
    </div>
</div>