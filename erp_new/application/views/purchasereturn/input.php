<form id="purchasereturn_input" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Date : </label></td>
            <td width="70%"><input type="text" size="15" name="date" class="easyui-datebox" id="date" data-options="formatter:myformatter,parser:myparser" required="true"/></td>
        </tr>   
        <tr>
            <td align="right"><label class="field_label">Vendor : </label></td>
            <td>
                <input id="text" 
                       name="vendorid" 
                       class="easyui-combobox" 
                       data-options="
                       valueField: 'id',
                       textField: 'text',
                       url: '<?php echo site_url('vendor/get_remote_data') ?>'" 
                       mode="remote" 
                       required="true"
                       style="width: 200px">
            </td>
        </tr>
        <tr valign="top">
            <td align="right"><label class="field_label">Remark : </label></td>
            <td>
                <textarea name="remark" class="easyui-validatebox" style="width: 100%;height: 50px"></textarea>
            </td>
        </tr>            
    </table>        
</form>