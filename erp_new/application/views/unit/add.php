<div id="unit-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#unit-button">
    <form id="unit-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Code : </label></td>
                <td><input type="text" name="codes" class="easyui-validatebox" required="true" value="" /></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Name : </label></td>
                <td><input type="text" name="names" class="easyui-validatebox" required="true" value=""/></td>
            </tr>
            <tr valign="top">
                <td align="right"><label class="field_label">Description : </label></td>
                <td>
                    <textarea name="remark" class="easyui-validatebox" style="width: 170px;height: 50px"></textarea>
                </td>
            </tr>            
        </table>        
    </form>
</div>
<div id="unit-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="unit_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#unit-form').dialog('close')">Cancel</a>
</div>