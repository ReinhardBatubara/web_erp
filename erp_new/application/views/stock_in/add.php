<form id="stock_in-input" method="post" novalidate style="padding: 2px">
    <table width="100%" border="0" class="table_form">
        <tr>
            <td align="right" width="25%"><label class="field_label">BPnP : </label></td>
            <td><input type="text" size="15" name="bpnp" class="easyui-validatebox" id="date" required="true"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Date : </label></td>
            <td><input type="text" size="15" name="date" class="easyui-datebox" id="date" data-options="formatter:myformatter,parser:myparser" required="true"/></td>
        </tr>   
        <tr>
            <td align="right"><label class="field_label">Vendor : </label></td>
            <td>
                <input id="text" name="vendorid" class="easyui-combobox" data-options="
                       valueField: 'id',
                       textField: 'text',
                       url: '<?php echo site_url('vendor/get_remote_data') ?>'" mode="remote" style="width: 100%" required="true" >
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark : </label></td>
            <td>
                <textarea name="remark" class="easyui-validatebox" style="width: 100%;height: 40px"></textarea>
            </td>
        </tr>            
    </table>        
</form>