<form id="pricecomparison_add-input" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" style="width: 120px"><label class="field_label">Vendor : </label></td>
            <td style="width: 280px">
                <input id="text" name="vendorid" class="easyui-combobox" data-options="
                       valueField: 'id',
                       textField: 'text',
                       url: '<?php echo site_url('vendor/get_remote_data') ?>'" mode="remote" style="width: 280px">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Currency : </label></td>
            <td>
                <select class="easyui-combobox" name='currency' required='true' panelHeight="50" style="width: 100px">
                    <option></option>
                    <?php
                    foreach ($currency as $result) {
                        echo "<option value='" . $result->code . "'>" . $result->code . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Price : </label></td>
            <td><input type="text" class="easyui-numberbox" name='price' style="width: 250px;" required="true" decimalSeparator="." groupSeparator = "," precision="2" min="0"/></td>
        </tr>            
        <tr>
            <td align="right"><label class="field_label">Discount : </label></td>
            <td><input type="text" class="easyui-numberbox" name='discount' style="width: 250px;" decimalSeparator="." groupSeparator = "," precision="2" min="0"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Tax : </label></td>
            <td><input type="text" class="easyui-numberbox" name='ppn' style="width: 250px;" decimalSeparator="." groupSeparator = "," precision="2" min="0"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Expired Date : </label></td>
            <td><input type="text" class="easyui-datebox" name='expired_date'  style="width: 100px" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
    </table>        
</form>