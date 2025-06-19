<form id="purchaserequestdetail_set_price_form" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="25%"><strong>Supplier/Vendor : </strong></td>
            <td width="75%">
                <input id="text" 
                       name="vendorid" 
                       class="easyui-combobox" 
                       data-options="
                       valueField: 'id',
                       textField: 'text',
                       url: '<?php echo site_url('vendor/get_remote_data') ?>'" 
                       mode="remote" 
                       required="true"
                       style="width: 100%">
            </td>
        </tr>
        <tr>
            <td align="right"><strong>Currency : </strong></td>
            <td>
                <select class="easyui-combobox" name='currency' editable="false" required='true' panelHeight="auto" style="width: 100px">
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
            <td align="right"><strong>Unit Price : </strong></td>
            <td>
                <input type="text" class="easyui-numberbox" name='price' style="width: 250px;" required='true' decimalSeparator="." groupSeparator="," precision="2" min="0"/>
            </td>
        </tr>            
        <tr>
            <td align="right"><strong>Discount : </strong></td>
            <td>
                <input type="text" class="easyui-numberbox" name='discount_percent' style="width: 50px;" decimalSeparator="." groupSeparator="," precision="2" min="0"/>

<!--                <input class="easyui-numberbox" name='discount_percent' style="width: 50%;" decimalSeparator="."  precision="2" min="0"/>-->
                % </td>
        </tr>
        <tr>
            <td align="right"><strong>Tax : </strong></td>
            <td>
                <select class="easyui-combobox" name="ppn_percent" panelHeight="auto">
                    <option value="0">No</option>
                    <option value="10">Yes</option>
                </select>
<!--                <input type="text" decimalSeparator="." groupSeparator = "," class="easyui-numberbox" name='ppn' style="width: 250px;" precision="2" min="0"/>-->
            </td>
        </tr>
        <tr>
            <td align="right"><strong>Expired Date : </strong></td>
            <td><input type="text" class="easyui-datebox" name='expired_date'  style="width: 100px" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
    </table>        
</form>