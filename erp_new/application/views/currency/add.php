<div id="currency-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#currency-button">
    <form id="currency-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Code : </label></td>
                <td><input type="text" name="curr" class="easyui-validatebox" size="5" required="true" value="" style="text-align: center"/></td>
            </tr>            
            <tr valign="top">
                <td align="right"><label class="field_label">Description : </label></td>
                <td>
                    <textarea name="desc" class="easyui-validatebox" style="width: 170px;height: 50px"></textarea>
                </td>
            </tr>            
        </table>        
    </form>
</div>
<div id="currency-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="currency_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#currency-form').dialog('close')">Cancel</a>
</div>