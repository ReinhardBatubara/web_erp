<div id="carver-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:350px; padding: 5px 5px" closed="true" buttons="#carver-button">
    <form id="carver-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="25%"><label class="field_label">Name : </label></td>
                <td><input type="text" name="name" class="easyui-validatebox" required="true" value="" style="width: 200px"/></td>
            </tr>
            <tr valign="top">
                <td align="right"><label class="field_label">Remark : </label></td>
                <td>
                    <textarea name="remark" class="easyui-validatebox" style="width: 200px;height: 50px"></textarea>
                </td>
            </tr>            
        </table>        
    </form>
</div>
<div id="carver-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="carver_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#carver-form').dialog('close')">Cancel</a>
</div>