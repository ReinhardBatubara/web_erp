
<form id="salesinvoice-input" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Date :</label></td>
            <td width="70%"><input type="text" size="13" class="easyui-datebox" required="true" name="invoice_date" id="invoice_date" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label" style="margin-left: 10px">Customer : </label> </td>
            <td>
                <input class="easyui-combobox" name="customerid" id="customerid" data-options="
                       url: '<?php echo site_url('customer/get') ?>',
                       method: 'post',
                       valueField: 'id',
                       textField: 'name',
                       panelHeight: '200',
                       mode: 'remote',
                       formatter: format_customer_si"
                       style="width: 200px" 
                       required="true">
                <script type="text/javascript">
                    function format_customer_si(row){
                        return '<span>'+row.name+'/'+row.code +'</span><br/>';
                    }
                    $(function () {
                        $('#customerid').combobox({
                            onSelect: function (row) {
                                $.get(base_url + 'customer/get_address/' + row.id, function (content) {
                                    $('#bill_to').val(content);
                                    $('#ship_to').val(content);
                                });
                            }
                        });
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label" style="margin-left: 10px">Bill To : </label></td>
            <td><textarea class="easyui-textbox" id="bill_to" name="bill_to" style="width:95%;height:40px"></textarea></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label" style="margin-left: 10px">Ship To : </label></td>
            <td><textarea class="easyui-textbox" id="ship_to" name="ship_to" style="width:95%;height:40px"></textarea></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label" style="margin-left: 10px">Ship Date : </label></td>
            <td><input type="text" size="12" class="easyui-datebox" id="ship_date" name="ship_date" data-options="formatter:myformatter,parser:myparser" required="true"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label" style="margin-left: 10px">Ship Via : </label></td>
            <td>
                <select class="easyui-combobox" name="ship_via" id="ship_via" required="true" panelHeight="auto">
                    <option></option>
                    <?php
                    foreach ($shipvia as $result) {
                        echo "<option value=" . $result->code . ">" . $result->code . "</option>";
                    }
                    ?>
                </select>    
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label" style="margin-left: 10px">Terms : </label></td>
            <td><input type="text" id="terms" name="terms" class="easyui-validatebox" size="20"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label" style="margin-left: 10px">Currency : </label></td>
            <td>
                <select class="easyui-combobox" id="currency" name='currency' required='true' style="width: 100px">
                    <option></option>
                    <?php
                    foreach ($currency as $result) {
                        echo "<option value='" . $result->code . "'>" . $result->code . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <td align="right"><label class="field_label">Description :</label></td>
            <td>
                <textarea name="description" class="easyui-validatebox" style="width: 95%;height: 40px"></textarea>
            </td>
        </tr>
    </table>        
</form>