<div id="finishing-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#finishing-button">
    <form id="finishing-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Code : </label></td>
                <td><input finishing="text" name="code" class="easyui-validatebox" required="true"/></td>
            </tr>            
            <tr valign="top">
                <td align="right"><label class="field_label">Description : </label></td>
                <td>
                    <textarea name="description" class="easyui-validatebox" style="width: 170px;height: 50px"></textarea>
                </td>
            </tr>            
        </table>        
    </form>
</div>
<div id="finishing-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="finishing_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#finishing-form').dialog('close')">Cancel</a>
</div>