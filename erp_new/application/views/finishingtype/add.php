<div id="finishingtype-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#finishingtype-button">
    <form id="finishingtype-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right"><label class="field_label">Name : </label></td>
                <td><input type="text" name="name" class="easyui-validatebox" required="true" value="" style="width: 200px;"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Position : </label></td>
                <td>
                    <select class="easyui-combobox" 
                            name="positionid" 
                            required="true" 
                            panelHeight="auto"
                            style="width: 200px;"
                            required="true">
                        <option value=""></option>
                        <option value="1">SEEN FACE AREA</option>
                        <option value="2">TOP AREA</option>
                        <option value="3">UN-SEEN FACE</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Remark : </label></td>
                <td>
                    <textarea name="remark" class="easyui-validatebox" style="width: 95%;height: 50px"></textarea>
                </td>
            </tr>            
        </table>        
    </form>
</div>
<div id="finishingtype-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="finishingtype_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#finishingtype-form').dialog('close')">Cancel</a>
</div>