<form id="goodreceive_input_form" method="post" novalidate style="margin: 3px;">
    <table width="100%" class="table_form">
        <tr>
            <td align="right" width="25%"><label class="field_label">Date : </label></td>
            <td width="75%">
                <input type="text" size="15" class="easyui-datebox" required="true" name="date" data-options="formatter:myformatter,parser:myparser"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Supplier : </label></td>
            <td>
                <input type="text" 
                       name="vendorid" 
                       panelWidth="300" 
                       class="easyui-combobox" 
                       data-options="
                       valueField: 'id',
                       textField: 'vendor_name',
                       url: '<?php echo site_url('purchaseorder/get_vendor_ots_delivery') ?>'" 
                       mode="remote" 
                       style="width: 300px"
                       panelHeight="250"
                       />

        </tr>
        <tr>
            <td align="right"><label class="field_label">D.O Number : </label></td>
            <td><input type="text" class="easyui-validatebox" name="no_sj"  required="true" style="width: 300px"/></td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">D.O Date : </label></td>
            <td>
                <input type="text" size="15" class="easyui-datebox" name="do_date" data-options="formatter:myformatter,parser:myparser"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark : </label></td>
            <td>
                <textarea name="remark" class="easyui-validatebox" style="width:300px;height: 40px"></textarea>
            </td>
        </tr>            
    </table>        
</form>