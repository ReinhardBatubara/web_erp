<div id="itemwarehousestock_edit-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#itemwarehousestock_edit-button">
    <form id="itemwarehousestock_edit-input" method="post" novalidate class="table_form">
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Rack :</label></td>
                <td width="30%"><input type="text" name="rack" class="easyui-validatebox" size="5" value="" style="width: 220px"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Stock :</label></td>
                <td><input type="text" name="qty" id="itemwarehousestock_qty_in" class="easyui-numberbox" size="10" style="width: 220px" value="" precision="5" onkeyup="if (event.keyCode == 13) {
                            $('#itemwarehousestock_edit_save_btn').focus()
                        }"/></td>
            </tr>
        </table>
    </form>
</div>
<div id="itemwarehousestock_edit-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" id="itemwarehousestock_edit_save_btn" iconCls="icon-ok" onclick="itemwarehousestock_edit_update()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#itemwarehousestock_edit-form').dialog('close')">Cancel</a>
</div>