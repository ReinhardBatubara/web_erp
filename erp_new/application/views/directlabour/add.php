<div id="directlabour-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#directlabour-button">
    <form id="directlabour-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr valign="top">
                <td align="right"><label class="field_label">Description : </label></td>
                <td>
                    <textarea name="description" class="easyui-validatebox" style="width: 170px;height: 50px"></textarea>
                </td>
            </tr>  
            <tr>
                <td align="right"><label class="field_label">Unit : </label></td>
                <td><input directlabour="text" name="unit" class="easyui-validatebox" required="true" value=""/></td>
            </tr>  
            <tr>
                <td align="right"><label class="field_label">Price : </label></td>
                <td><input directlabour="text" name="price" class="easyui-numberbox" required="true" value=""/></td>
            </tr>
            <tr>
                <td align="right" width="30%"><label class="field_label">Currency : </label></td>
                <td><input directlabour="text" name="curr" class="easyui-validatebox" required="true" value=""/></td>
            </tr>  
            <tr>
                <td align="right"><label class="field_label">Percentage : </label></td>
                <td><input directlabour="text" name="percentage" class="easyui-numberbox" required="true" value=""/></td>
            </tr>        
        </table>        
    </form>
</div>
<div id="directlabour-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="directlabour_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#directlabour-form').dialog('close')">Cancel</a>
</div>